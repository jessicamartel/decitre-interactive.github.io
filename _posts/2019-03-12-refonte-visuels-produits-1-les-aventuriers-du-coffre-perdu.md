---
layout: post
title: Refonte de nos 3 millions de visuels produits - Les aventuriers du coffre perdu
author: srogier
date: 2019-03-12 10:00:00+01:00
excerpt: Refonte de nos 3 millions de visuels produits - Les aventuriers du coffre perdu
image: /assets/posts/refonte-visuels-produits-1/post.png
---

Cet article est le premier d’une série qui va parler de la refonte de nos visuels produits sur [decitre.fr](https://www.decitre.fr). 
Avant de parler des choix techniques que nous avons faits pour le format des images, les outils utilisés et comment nous les affichons, on va d’abord démarrer par la base : qu’affiche-t-on actuellement sur notre site et que va-t-on pouvoir faire de cette base de travail ?

## État des lieux

### Des visuels de mauvaise qualité

Vestige d’un choix technique fait il y a de nombreuses années, peut-être au début des années 2000 (voire 1990 ?), les visuels principaux de nos produits sont au format [GIF](https://fr.wikipedia.org/wiki/Graphics_Interchange_Format).

<figure>
    <img
        class="lozad"
        width="301" height="221"
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="https://media.giphy.com/media/OvoY5YaoOb8n6/giphy.gif"
    />
    <noscript><img src="https://media.giphy.com/media/OvoY5YaoOb8n6/giphy.gif" /></noscript>

    <figcaption>Bongour (source : <a href="https://media.giphy.com/media/OvoY5YaoOb8n6/giphy.gif">https://media.giphy.com/media/OvoY5YaoOb8n6/giphy.gif</a>)</figcaption>
</figure>

En plus d’apporter d’interminables débats sur sa prononciation, le GIF est un format populaire car il permet d’être composé de plusieurs images dans un même fichier pour fournir une animation. Mais dans le cas de visuels produits, cette fonctionnalité d’image animée ne nous est pas très utile.

Côté qualité, ça n’est pas très positif : le format est limité à 256 couleurs choisies parmi les 16 millions de couleurs de la palette RVB. On se retrouve donc avec des visuels produits de qualité moyenne. Dur de donner envie d’acheter un livre avec ce genre d’image.

<div class="container">
    <div class="row">
        <div class="col-md">
            <figure>
                <img 
                    class="lozad" 
                    width="475" height="340"
                    src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAOABQDASIAAhEBAxEB/8QAGAAAAgMAAAAAAAAAAAAAAAAAAAECAwT/xAAVAQEBAAAAAAAAAAAAAAAAAAAAAf/aAAwDAQACEAMQAAAB0jhFgw//xAAZEAACAwEAAAAAAAAAAAAAAAAAAQIREhD/2gAIAQEAAQUCcjVpGVahz//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQMBAT8BP//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8BP//EABUQAQEAAAAAAAAAAAAAAAAAABAR/9oACAEBAAY/Amv/xAAZEAADAQEBAAAAAAAAAAAAAAAAASERQTH/2gAIAQEAAT8hSmcAjys4dMFXovKf/9oADAMBAAIAAwAAABAEP//EABcRAQADAAAAAAAAAAAAAAAAAAABEWH/2gAIAQMBAT8QjVv/xAAWEQEBAQAAAAAAAAAAAAAAAAABABH/2gAIAQIBAT8QR2y//8QAGxABAAIDAQEAAAAAAAAAAAAAAQARITFBUZH/2gAIAQEAAT8QTFjW/YWXFruIHYYv9m4bDu7JYHXZ/9k="
                    data-src="{{ '/assets/posts/refonte-visuels-produits-1/fruits-et-legumes-a-couper.jpg' | prepend: site.baseurl  }}" 
                    data-srcset="{{ '/assets/posts/refonte-visuels-produits-1/fruits-et-legumes-a-couper.jpg' | prepend: site.baseurl  }}" 
                />
                <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-1/fruits-et-legumes-a-couper.jpg' | prepend: site.baseurl  }}" /></noscript>
            
                <figcaption>Image originale</figcaption>
            </figure>
        </div>
        <div class="col-md">
            <figure>
                <img 
                    class="lozad" 
                    width="475" height="340"
                    src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAOABQDASIAAhEBAxEB/8QAGAAAAwEBAAAAAAAAAAAAAAAAAAECAwT/xAAVAQEBAAAAAAAAAAAAAAAAAAAAAf/aAAwDAQACEAMQAAAB6VURoMP/xAAZEAACAwEAAAAAAAAAAAAAAAAAAQIREhD/2gAIAQEAAQUCcjVpGVahz//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQMBAT8BP//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8BP//EABUQAQEAAAAAAAAAAAAAAAAAABAR/9oACAEBAAY/Amv/xAAZEAADAQEBAAAAAAAAAAAAAAAAAREhQTH/2gAIAQEAAT8hSmcBU1nC0gtdF4f/2gAMAwEAAgADAAAAEEQv/8QAFhEBAQEAAAAAAAAAAAAAAAAAAAER/9oACAEDAQE/EI1//8QAFREBAQAAAAAAAAAAAAAAAAAAAQD/2gAIAQIBAT8QRi//xAAZEAEBAQEBAQAAAAAAAAAAAAABEQAxQZH/2gAIAQEAAT8QTFqdwEZGe4Hocv8AVxtdWmoF7v/Z"
                    data-src="{{ '/assets/posts/refonte-visuels-produits-1/fruits-et-legumes-a-couper.gif' | prepend: site.baseurl  }}" 
                    data-srcset="{{ '/assets/posts/refonte-visuels-produits-1/fruits-et-legumes-a-couper.gif' | prepend: site.baseurl  }}" 
                />
                <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-1/fruits-et-legumes-a-couper.gif' | prepend: site.baseurl  }}" /></noscript>
            
                <figcaption>GIF : on sent clairement la limite de la palette de couleurs</figcaption>
            </figure>
        
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md">
            <figure>
                <img 
                    class="lozad" 
                    width="200" height="243"
                    src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAYABQDASIAAhEBAxEB/8QAGAABAAMBAAAAAAAAAAAAAAAAAAEDBAL/xAAVAQEBAAAAAAAAAAAAAAAAAAAAAf/aAAwDAQACEAMQAAAB1zVnTaF5rC4H/8QAGxABAAEFAQAAAAAAAAAAAAAAAQACAxAREiL/2gAIAQEAAQUCzU6nfqJ0FsGf/8QAFBEBAAAAAAAAAAAAAAAAAAAAIP/aAAgBAwEBPwEf/8QAFBEBAAAAAAAAAAAAAAAAAAAAIP/aAAgBAgEBPwEf/8QAGBAAAgMAAAAAAAAAAAAAAAAAEBEAASD/2gAIAQEABj8Cwwo6H//EABsQAAMAAgMAAAAAAAAAAAAAAAABERAxIUGB/9oACAEBAAE/IaqXG+74jrC0Lo0ItOMf/9oADAMBAAIAAwAAABA7CLz/xAAWEQADAAAAAAAAAAAAAAAAAAABEBH/2gAIAQMBAT8QJii//8QAFREBAQAAAAAAAAAAAAAAAAAAEBH/2gAIAQIBAT8QhT//xAAbEAEBAAIDAQAAAAAAAAAAAAABEQAxECFBgf/aAAgBAQABPxBKFbgKF7fOAcGbtJ9wp1RehxUOrjmtbjjkD0PvH//Z"
                    data-src="{{ '/assets/posts/refonte-visuels-produits-1/php-7-avance.jpg' | prepend: site.baseurl  }}" 
                    data-srcset="{{ '/assets/posts/refonte-visuels-produits-1/php-7-avance.jpg' | prepend: site.baseurl  }}" 
                />
                <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-1/php-7-avance.jpg' | prepend: site.baseurl  }}" /></noscript>
            
                <figcaption>Image originale</figcaption>
            </figure>
        </div>
        <div class="col-md">
            <figure>
                <img 
                    class="lozad" 
                    width="200" height="241"
                    src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAYABQDASIAAhEBAxEB/8QAGQABAAIDAAAAAAAAAAAAAAAAAAMEAQIF/8QAFQEBAQAAAAAAAAAAAAAAAAAAAAH/2gAMAwEAAhADEAAAAbWYqqdALrEE4P/EABsQAAICAwEAAAAAAAAAAAAAAAABAhIDEBEi/9oACAEBAAEFAu7k6l/ZJWSxJSP/xAAUEQEAAAAAAAAAAAAAAAAAAAAg/9oACAEDAQE/AR//xAAUEQEAAAAAAAAAAAAAAAAAAAAg/9oACAECAQE/AR//xAAYEAADAQEAAAAAAAAAAAAAAAABEBEAIP/aAAgBAQAGPwLihQ6hf//EABsQAAICAwEAAAAAAAAAAAAAAAERABAhMUGB/9oACAEBAAE/IUajDreL8FQMiB4EBGY5X//aAAwDAQACAAMAAAAQ/wAAPP/EABYRAAMAAAAAAAAAAAAAAAAAAAERIP/aAAgBAwEBPxBmP//EABURAQEAAAAAAAAAAAAAAAAAABAR/9oACAECAQE/EIU//8QAHBABAQACAgMAAAAAAAAAAAAAAREAIRAxQVGB/9oACAEBAAE/EEKW4SF2+ODUGe6B9wVkouhxQUlMX0punG2jst3j/9k="
                    data-src="{{ '/assets/posts/refonte-visuels-produits-1/php-7-avance.gif' | prepend: site.baseurl  }}" 
                    data-srcset="{{ '/assets/posts/refonte-visuels-produits-1/php-7-avance.gif' | prepend: site.baseurl  }}" 
                />
                <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-1/php-7-avance.gif' | prepend: site.baseurl  }}" /></noscript>
            
                <figcaption>GIF : le dégradé se fait par seuil et l'image est plus sombre que l'originale</figcaption>
            </figure>
        </div>
    </div>
</div>

On pourrait se dire que c’est bien d’avoir des visuels de mauvaise qualité, qu’au moins en terme de performances web, on est bon car les fichiers sont légers. 

Eh bien, non ! Malgré une faible quantité de couleur, on arrive à des poids d’images allant jusqu’à quelques dizaines de kilo-octets. Ce poids on pourrait facilement l’atteindre avec un format JPEG ou PNG sans travailler sur sa compression : on est donc perdant en qualité et poids.

Un point positif malgré tout, seul le visuel principal subit ce traitement (#historique). Les autres visuels (quatrième de couverture, extraits du livre, autres angles de vue du produit) nous sont envoyés aux formats PNG ou JPEG.

### Le fonctionnement des images avant la refonte

Notre site est alimenté par notre ERP qui nous transmet régulièrement des visuels à afficher.

On reçoit deux types de visuels :

* les principaux, au format GIF et redimensionnés avec une taille n’excédant pas 500px de large,
* les secondaires dont le format n’est pas figé et qui ne subissent aucun traitement de redimensionnement.

Ces visuels sont ensuite retaillés à la demande et au besoin par Magento. Bien évidemment la version retaillée n’est faite qu’une fois, mais cette génération a un coût en terme de temps. Temps qui va être subi par l’utilisateur sur qui va tomber la génération.

Pire, on a parfois des pages qui atteignent la limite de mémoire PHP car on demande à notre Magento de retailler un visuel de 60Mo d’une image de 26000x26000 pixels et pour lequel, bizarrement, il a du mal à faire cette opération.

Notre infra, telle qu’elle est conçue actuellement, ne nous permet pas de générer lors l’intégration les différentes versions retaillées utilisées sur le site, ce qui aurait pu nous faire gagner en performance et éviter de faire subir ce coût de génération au premier utilisateur affichant l’image.

### L’objectif de cette refonte

Voici donc ce que l’on souhaite obtenir dans le cadre de cette refonte :

* avoir des rendus de visuels **plus qualitatifs** en abandonnant le format GIF,
* générer en amont les visuels pour **accélérer la génération** côté serveur de nos pages webs,
* trouver un **compromis acceptable entre le poids et la qualité** des visuels générés,
* à terme, fournir des **images adaptées pour les écrans à haute densité** de pixels (_Retina_ ou _Super-AMOLED_ selon les marques).

On va pouvoir recevoir un nouveau flux venant de l’ERP, avec des visuels non altérés, c’est-à-dire qui n’ont subi aucune transformation de format ou de redimensionnement et dans un format d’origine (qui ne sera pas du GIF).

Pour les futures images, c’est une bonne nouvelle. Le problème, c’est l’historique.

## 20 ans de GIFs, ça se paye !

[Decitre.fr](https://www.decitre.fr/) existe depuis 1997, soit plus de 20 ans. Et en 20 ans, on en accumule des images. Entre le début du site et l’arrivée de ce fameux flux d’images non modifiées, nous avons 2.5 millions d’images au format GIF utilisées pour nos visuels principaux.

Vu qu’on revoit la qualité de nos visuels, ça serait dommage de ne pas s’occuper de ces 2.5 millions d’images pour que tout le site en profite.

Et c’est là que notre projet va connaître sa première difficulté : il n’y a pas d’historique officiel des images non modifiées depuis le début du site. Au pire, on a nos superbes GIFs comme base de travail, mais aucune trace du fichier à partir duquel ce GIF a été généré.

Heureusement, certains visuels peuvent être récupérés directement à partir de flux fournis par les éditeurs, d’autres peuvent être récupérés à partir des postes de notre équipe chargée de la numérisation des livres ou sur les serveurs de l’ERP.

<figure>
    <img
        class="lozad"
        width="320" height="240"
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="https://media.giphy.com/media/lH8U0yIsCyzja/giphy.gif"
    />
    <noscript><img src="https://media.giphy.com/media/lH8U0yIsCyzja/giphy.gif" /></noscript>

    <figcaption>À la recherche de l’image source parfaite (source : <a href="https://media.giphy.com/media/lH8U0yIsCyzja/giphy.gif">https://media.giphy.com/media/lH8U0yIsCyzja/giphy.gif</a>)</figcaption>
</figure>

Il va falloir chercher, à l’aide de ces différentes sources plutôt éparses, à reconstituer notre catalogue d’originaux.

À noter le point archéologie gagné par notre coffre-fort, où nous avons exhumé une centaine de DVDs et CDs pour les visuels d’avant 2007.

<figure>
    <img 
        class="lozad" 
        width="338" height="600"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAkABQDASIAAhEBAxEB/8QAGAAAAwEBAAAAAAAAAAAAAAAAAAIDAQT/xAAVAQEBAAAAAAAAAAAAAAAAAAAAAf/aAAwDAQACEAMQAAABa/Hc0YTlpF1qIJJwl0Cv/8QAGRABAAMBAQAAAAAAAAAAAAAAAQIQEQAx/9oACAEBAAEFAoWqJJyPnbRZf//EABQRAQAAAAAAAAAAAAAAAAAAACD/2gAIAQMBAT8BX//EABQRAQAAAAAAAAAAAAAAAAAAACD/2gAIAQIBAT8BX//EABgQAAIDAAAAAAAAAAAAAAAAAAAQITAx/9oACAEBAAY/AjVFn//EABwQAAMBAAMBAQAAAAAAAAAAAAABIRExQVFxEP/aAAgBAQABPyHstvRwqVdu0qHJhU9BOr4e9Ni+DekwV/SiP//aAAwDAQACAAMAAAAQg+kPDB//xAAXEQEAAwAAAAAAAAAAAAAAAAARECBB/9oACAEDAQE/EMhKf//EABYRAQEBAAAAAAAAAAAAAAAAABEQIP/aAAgBAgEBPxCDj//EABwQAQADAQADAQAAAAAAAAAAAAEAESExQVFhsf/aAAgBAQABPxBgLVOL5GiWANV8w2fRb7jdqFfIx6i26RG+lWGKqDSw9MsWGnwJcE8CBQfqDcbsVFD5BsDI3Cf/2Q=="
        data-src="{{ '/assets/posts/refonte-visuels-produits-1/coffre-fort-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/refonte-visuels-produits-1/coffre-fort-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/refonte-visuels-produits-1/coffre-fort-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-1/coffre-fort-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Le coffre-fort, gardien du trésor numérique (et aussi tombeau d’un tas de CD-ROMs datant du précédent millénaire)</figcaption>
</figure>

> Point backup : les DVDs d’au moins 2004 sont toujours lisibles tandis que les CDs d’avant cette date sont inutilisables. Moralité, ça n’est pas tout de backuper, mais il faut également s’assurer que les contenus sauvegardés soient encore exploitables au fil du temps.


## Le choix des candidats

Grâce à toutes ces sources,  nous avons pu récupérer plus de 9 millions de visuels. Pour s’y retrouver, chaque image contient dans son nom l’[EAN](https://fr.wikipedia.org/wiki/EAN_13) du produit auquel il fait référence.

On se retrouve donc avec plusieurs images candidates pour un même produit. Comment choisir l’image adéquate ? On va trier nos visuels en prenant en compte les critères suivants :
* la date de l’image,
* son poids,
* ses dimensions,
* l’endroit où l’image a été récupérée,
* son format.

L’objectif est de privilégier l’image la plus récente ayant la meilleure qualité possible. Ce tri nous permet de passer de 9 millions d’images à (seulement) 2 millions d’images après dédoublonnage.

Malheureusement, ces images ne sont pas toutes éligibles pour être directement utilisées sur le site. Parmi ces visuels, rien ne garantit qu’on en ait la dernière version, et on souhaite éviter de revenir à des contenus obsolètes par rapport aux GIFs actuellement en production.

Pour éviter cela, la prochaine étape va être de comparer 2 à 2 près de 5 millions d’image afin de prendre l’image candidate si elle est similaire au GIF ou bien le GIF si la différence entre les deux images est trop importante.

## Trouver la meilleure image pour chaque produit

À raison de 2 millions et demi de comparaisons, si on compte 5s par comparaison, il va falloir 144 jours en continu (à peu près) à une seule personne pour y arriver, sans avoir aucune garantie que sa santé mentale ne soit pas altérée à la fin de ce processus.

On pouvait également envisager de passer par [Amazon Mechanical Turk](https://www.mturk.com/) pour sous-traiter ces comparaisons. Mais le coût aurait été élevé.

### Automatiser les comparaisons
Heureusement, on peut automatiser tout ça grâce à [dssim](https://github.com/kornelski/dssim), un outil de calcul de dissimilarité entre deux images. 

Pour les plus pressés, on calcule un score de similarité (SSIM pour Structural SIMilarity) et dssim retourne une valeur `1/SSIM - 1`. Plus la valeur est proche de 0, plus on peut considérer les visuels comparés comme étant identiques. 

Pour les moins pressés, on trouve plus de littérature sur [l’algorithme SSIM](https://ece.uwaterloo.ca/%7Ez70wang/research/ssim/).

Pour ce calcul, notre choix s’est porté sur [dssim](https://github.com/kornelski/dssim). Un autre outil, [Butteraugli](https://github.com/google/butteraugli), avait été envisagé, mais il était plus lent que dssim.

dssim va nous imposer plusieurs contraintes pour pouvoir fonctionner :

* les images doivent être au format PNG,
* les images doivent avoir les mêmes dimensions.

D’un côté, on va prendre le GIF utilisé en production, le convertir en PNG sans perte de compression. De l’autre, on prend notre image candidate, également convertie en PNG, puis on va la redimensionner aux dimensions du GIF.

Ensuite, on lance `dssim` pour obtenir notre score de similarité entre les deux images générées.

Le souci, c’est que le GIF a subi beaucoup d’altérations et que cela donne des scores DSSIM élevés alors que les images candidates peuvent être recevables.

Pour rattraper ces cas, on prépare un second calcul de score DSSIM en convertissant les deux images en niveau de gris. Cela permet dans certains cas de lisser les différences dues au passage à 256 couleurs du GIF et d’obtenir un score DSSIM acceptable.

### Analyser les résultats des comparaisons

75h plus tard, nos 2.5 millions de comparaisons sont terminées et pour chaque couple d’images on a deux scores DSSIM sur lesquels il va falloir statuer.

Pour faire ce choix, nous avons considéré que tout score inférieur à 0.0015 était synonyme d’image similaire. Cette valeur a été choisie arbitrairement sur différents échantillons, où nous avons regardé à partir de quelles valeurs les images comparées étaient différentes.

On pose également quelques règles de décision automatiques peu importe le score (par exemple, on considère que certaines sources sont forcément les bonnes).

Cela nous laisse à peu près 20 000 images pour lesquelles nous n’avons pas pu prendre de décision.

Pour nous aider à analyser ce qui reste, nous nous sommes créés une interface affichant les deux images et les différentes propriétés puis, visuel après visuel, on indique lequel doit être conservé.

<figure>
    <img 
        class="lozad" 
        width="600" height="386"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAANABQDASIAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAAIBBP/EABQBAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhADEAAAAetolQ//xAAXEAADAQAAAAAAAAAAAAAAAAAAASAx/9oACAEBAAEFAh5H/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPwE//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPwE//8QAFBABAAAAAAAAAAAAAAAAAAAAIP/aAAgBAQAGPwJf/8QAHBAAAQMFAAAAAAAAAAAAAAAAAAERICExQVHR/9oACAEBAAE/IVfBR0btD//aAAwDAQACAAMAAAAQE8//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/ED//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/ED//xAAZEAEBAQEBAQAAAAAAAAAAAAABEQBBMSH/2gAIAQEAAT8QFNATp3JRoJ3xiLVx00vv3Q3/2Q=="
        data-src="{{ '/assets/posts/refonte-visuels-produits-1/interface-1.jpg' | prepend: site.baseurl  }}"
        data-srcset="{{ '/assets/posts/refonte-visuels-produits-1/interface-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/refonte-visuels-produits-1/interface-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-1/interface-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Outil de comparaison des images récupérées et de la version en production</figcaption>
</figure>


L’étape est légèrement fastidieuse, mais cela nous permet de préparer une base utilisant le plus possible des visuels qualitatifs à la place des GIFs.

Une quarantaine d’heures d’analyse plus tard, les choix restants ont été faits. Certaines règles automatiques ont été affinées, les images avec un score dssim proche du seuil fixé ont été traitées manuellement, et pour les autres nous avons conservé la version de production.

## La suite au prochain épisode

La morale de toute cette première phase est la suivante : vu le coût du stockage aujourd’hui, la valeur de ce type de média et les nouveaux formats numériques à venir (dont on ne connaît pas encore l’existence), backupez proprement vos originaux :)

Malgré cela, toutes ces étapes de préparation nous ont permis de reconstituer notre historique d’une manière plutôt fiable. L’étape a été plutôt longue, le temps d’identifier et récupérer les différents contenus, enchaîner des journées de calculs, mais nous sommes désormais prêts à construire notre nouveau catalogue d’images produits, mais cela fera l’objet d’un [prochain article](https://tech.decitre.fr/posts/refonte-visuels-produits-2-le-gif-maudit).

