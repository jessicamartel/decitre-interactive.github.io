---
layout: post
title: "Retour d'incident : Elasticsearch, l'aggrégation Histogram et la validation de données"
author: agallou
date: 2018-07-10 11:00:00+02:00
excerpt: "Retour d'incident : Elasticsearch, l'aggrégation Histogram et la validation de données"
---

Une de nos application a pour principe de base de rechercher dans notre base de données de livres, cette application reçoit des données de notre ERP pour les ajouter dans Elasticsearch. Pendant plusieurs minutes au cours du mois dernier cette application était indisponible en production, nous allons ici vous expliquer les raisons de cette indisponibilité.

Sur celle-ci, nous utilisons l'[agrégation Histogram](https://www.elastic.co/guide/en/elasticsearch/reference/5.5/search-aggregations-bucket-histogram-aggregation.html) afin d’afficher une liste de filtres sur les prix.

Voilà à quoi ressemble la facette des prix : 

<figure>
    <img 
        class="lozad" 
        width="600" height="273"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAJABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAEE/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEAMQAAAB10CD/8QAFBABAAAAAAAAAAAAAAAAAAAAIP/aAAgBAQABBQJf/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPwE//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPwE//8QAFBABAAAAAAAAAAAAAAAAAAAAIP/aAAgBAQAGPwJf/8QAFxAAAwEAAAAAAAAAAAAAAAAAAAEgMf/aAAgBAQABPyEWQj//2gAMAwEAAgADAAAAEDMP/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPxA//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPxA//8QAGRAAAgMBAAAAAAAAAAAAAAAAAREAIDEh/9oACAEBAAE/EGiVDJ62mJ//2Q=="
        data-src="{{ '/assets/posts/incident-elasticsearch/facette-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/incident-elasticsearch/facette-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/incident-elasticsearch/facette-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/incident-elasticsearch/facette-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Facette des prix</figcaption>
</figure>


Cette facette était générée en ajoutant une agrégation comme celle-ci lors de nos requêtes : 

```json
    {
        "aggs" : {
            "prices" : {
                "histogram" : {
                    "field" : "price",
                    "interval" : 5
                }
            }
        }
    }
```

Cette agrégation va envoyer le nombre de produits trouvés dans chaque intervalle de 5€ entre le prix minimum et maximum. Ces intervalles sont appelés buckets.

Cela faisait plus de 3 années que cette fonctionnalité était en production et ne nous avait pas posé de problème.

Mais un midi de mai 2018 notre cluster Elasticsearch (en version 5.5.3) a nettement ralenti, les temps de réponses étaient désastreux, pour finir par ne plus répondre. Dans les logs nous avions cette erreur : 

    [2018-05-23T13:34:51,601][ERROR][o.e.b.ElasticsearchUncaughtExceptionHandler] [orb-dec3] fatal error in thread [elasticsearch[orb-dec3][search][T#10]], exiting
    java.lang.OutOfMemoryError: Java heap space
           at java.util.Arrays.copyOf(Arrays.java:3181) ~[?:1.8.0_121]
           at java.util.ArrayList.grow(ArrayList.java:261) ~[?:1.8.0_121]
           at java.util.ArrayList.ensureExplicitCapacity(ArrayList.java:235) ~[?:1.8.0_121]
           at java.util.ArrayList.ensureCapacityInternal(ArrayList.java:227) ~[?:1.8.0_121]
           at java.util.ArrayList.add(ArrayList.java:475) ~[?:1.8.0_121]
           at java.util.ArrayList$ListItr.add(ArrayList.java:956) ~[?:1.8.0_121]
           at org.elasticsearch.search.aggregations.bucket.histogram.InternalHistogram.addEmptyBuckets(InternalHistogram.java:343) ~[elasticsearch-5.5.3.jar:5.5.3]
           at org.elasticsearch.search.aggregations.bucket.histogram.InternalHistogram.doReduce(InternalHistogram.java:364) ~[elasticsearch-5.5.3.jar:5.5.3]
           at org.elasticsearch.search.aggregations.InternalAggregation.reduce(InternalAggregation.java:119) ~[elasticsearch-5.5.3.jar:5.5.3]
           at org.elasticsearch.search.aggregations.InternalAggregations.reduce(InternalAggregations.java:77) ~[elasticsearch-5.5.3.jar:5.5.3]
           at org.elasticsearch.action.search.SearchPhaseController.reduceAggs(SearchPhaseController.java:513) ~[elasticsearch-5.5.3.jar:5.5.3]
           at org.elasticsearch.action.search.SearchPhaseController.reducedQueryPhase(SearchPhaseController.java:490) ~[elasticsearch-5.5.3.jar:5.5.3]
           at org.elasticsearch.action.search.SearchPhaseController.reducedQueryPhase(SearchPhaseController.java:408) ~[elasticsearch-5.5.3.jar:5.5.3]
           at org.elasticsearch.action.search.SearchPhaseController$1.reduce(SearchPhaseController.java:725) ~[elasticsearch-5.5.3.jar:5.5.3]
           at org.elasticsearch.action.search.FetchSearchPhase.innerRun(FetchSearchPhase.java:102) ~[elasticsearch-5.5.3.jar:5.5.3]
           at org.elasticsearch.action.search.FetchSearchPhase.access$000(FetchSearchPhase.java:45) ~[elasticsearch-5.5.3.jar:5.5.3]
           at org.elasticsearch.action.search.FetchSearchPhase$1.doRun(FetchSearchPhase.java:87) ~[elasticsearch-5.5.3.jar:5.5.3]
           at org.elasticsearch.common.util.concurrent.ThreadContext$ContextPreservingAbstractRunnable.doRun(ThreadContext.java:638) ~[elasticsearch-5.5.3.jar:5.5.3]
           at org.elasticsearch.common.util.concurrent.AbstractRunnable.run(AbstractRunnable.java:37) ~[elasticsearch-5.5.3.jar:5.5.3]
           at java.util.concurrent.ThreadPoolExecutor.runWorker(ThreadPoolExecutor.java:1142) ~[?:1.8.0_121]
           at java.util.concurrent.ThreadPoolExecutor$Worker.run(ThreadPoolExecutor.java:617) ~[?:1.8.0_121]
           at java.lang.Thread.run(Thread.java:745) [?:1.8.0_121]

Après redémarrage du cluster, l’erreur apparaissait après un délai différent à chaque fois. Comme nous le verrons par la suite cela était dû au fait qu’elle dépendait des produits retournés dans les résultats de recherche.

Après plusieurs minutes d’indisponibilité, et avoir recherché la source du problème, nous avons désactivé les facettes sur l’application afin de rendre à nouveau celle-ci disponible.

Cette erreur était due à un problème dans nos données : en effet, nous importons les données reçues depuis notre ERP sans effectuer de validation au niveau du prix.

Nous avons donc importé un produit avec pour prix 9 782 321 011 392,00€ (qui correspond à l’EAN d’un produit saisi dans un champ prix).



À chaque fois que ce produit était retourné dans les résultats de recherche, des buckets dans la facette histogramme de prix étaient créés en intervalles de 5€ jusqu’à 9 782 321 011 392. Cela faisait donc 1 956 464 200 000 buckets à créer et c’est cela qui posait les problèmes de mémoire dépassée. 

Afin de résoudre ce problème de façon pérenne nous avons avons utilisé l’option "[minimum_doc_count](https://www.elastic.co/guide/en/elasticsearch/reference/5.5/search-aggregations-bucket-histogram-aggregation.html#_minimum_document_count)".

Comme on peut le lire dans la documentation : 

> By default the response will fill gaps in the histogram with empty buckets. It is possible change that and request buckets with a higher minimum count thanks to the min_doc_count setting.

Cela correspond exactement à notre problématique et l’ajout d’un min_doc_count à 1 a permis de créer des buckets seulement s’il y a des produits dans l’intervalle de prix correspondant et donc d’éviter les problèmes de mémoire.

Cet incident aura permis de rajouter des contrôles sur certaines entrées dans notre ERP (nous continuons de considérer ces données comme fiables), tout en fiabilisant nos requêtes sur Elasticsearch. Il aura mis en évidence des améliorations possibles sur notre infrastructure (comme le fait que nous n’ayons pas de ES cluster de backup si tous les noeuds tombent), que nous pourrons mettre en place pour améliorer la résilience de notre application. De plus cela nous incite à mettre à jour notre cluster, pour bénéficier de nouveaux paramètres comme "[search.max_buckets](https://www.elastic.co/guide/en/elasticsearch/reference/6.2/search-aggregations-bucket.html)".
