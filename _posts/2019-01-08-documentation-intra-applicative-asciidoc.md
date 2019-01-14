---
layout: post
title: Générer une documentation intra-applicative avec Asciidoc
author: agallou
date: 2019-01-08 10:00:00+01:00
excerpt: Générer une documentation intra-applicative avec Asciidoc
---

# Introduction

[ORB](https://www.base-orb.fr) notre outil de recherche bibliographique vendu en SaaS a toujours eu un large éventail fonctionnel (vous pouvez en demander une demo sur [la page dédiée](https://www.base-orb.fr/contact), et dès ses premières versions avait une documentation incluse dans l’application. Il y a quelques mois nous avons nettement amélioré celle-ci. Nous verrons ci-dessous pourquoi et comment.

# Notre problématique / Nos besoins

L’ancienne version de la documentation consistait en une page avec un lien vers un fichier PDF.

Ce fichier était hébergé dans le dépôt git du projet et était modifié très peu fréquemment.


Nous avions donc plusieurs problèmes :
* La documentation n’était pas complètement intégrée dans l’application, c’était un PDF à télécharger.
* Il n’était pas possible de faire un lien direct vers une section particulière de la documentation (ce qui empêchait par exemple sur une modale d’avoir un lien sur le détail d’une fonctionnalité).
* Le workflow de modification de la documentation n'incitait pas à la modifier par incréments. Le product owner générait le PDF sous word et créait un ticket pour l’intégrer dans l’application.
* Notre application a évolué et nous avons maintenant 2 versions de celles-ci : une destinée aux libraires, l’autre aux bibliothécaires, et la gestion de deux fichiers Word était compliquée pour notre Product Owner.
* La saisie de certaines parties de la documentation étaient chronophage : des sections comme “Conseil d’utilisation” étaient parfois longues à rédiger car prenaient du temps pour les mettre en forme.
* La présentation et le contenu étaient mélangés et il était difficile d’avoir un rendu similaire et centralisé dans toute la documentation.

Nous avions donc plusieurs besoins :
* Que la documentation soit modifiable facilement : une précision/correction doit être effectuée en quelques clics. 
* Avoir une seule source de la documentation, avec des parties conditionnellement activées selon le mode de l’application (un mode librairie et un mode bibliothèque).
* Que la documentation soit accessible directement dans l’application et qu’on puisse effectuer des liens sur certaines parties tout en proposant toujours une version PDF.
* Mieux structurer la documentation, l’écrire dans un langage de type Markdown et afin de séparer la présentation du contenu dans le but d’avoir plusieurs sorties différentes et d’uniformiser le rendu.

# Candidats potentiels / pistes diverses

Au début des réflexions, nous nous sommes demandés si un stockage de la documentation sous git ne pouvait pas être une bonne chose : cela aurait permis de faire des Pull Requests et de la revue de documentation. Après une phase de recherche, nous n’avons pas trouvé d’outil permettant aux fonctionnels de pouvoir facilement contribuer de cette façon (c’était soit des outils en SaaS payants et peu flexibles, soit de l’utilisation d’un IDE en local/git mais complexifiant grandement la contribution).

Dans les outils/formats candidats potentiels nous avions donc :
* Markdown : avec un des nombreux d’outils de générateurs de site statiques du marché. Mais le Markdown bénéficie de peu de fonctionnalités liés à des grosses documentations (conditions, notes, macros…).
* reStructuredText : avec [sphinx-doc](http://www.sphinx-doc.org/) : très adapté à la documentation, mais ayant un écosystème vieillissant et une syntaxe parfois peu naturelle.
* AsciiDoc : avec [Asciidoctor](https://asciidoctor.org/) ou l’un de ses portages. A un écosystème très dynamique, et une syntaxe naturelle, facile à utiliser par tout type de public (assez proche du markdown sur certains points).

# Mise en place

## Génération de la documentation en asynchrone

Notre choix s’est donc porté sur Asciidoctor qui à la base est écrit en Ruby. Ne souhaitant pas maintenir une stack Ruby en production, nous sommes partis sur l’implémentation en Java : [AsciidoctorJ](https://asciidoctor.org/docs/asciidoctorj/) (Java étant déjà installé sur nos serveurs pour Elasticsearch).

Nous avons donc une tâche cron qui tourne régulièrement (tous les quarts d’heure) et qui, s’il y a eu des changements dans la documentation, va en lancer la génération. La documentation est générée 4 fois : une version librairie et une version bibliothèque, toutes deux avec un format PDF et un format HTML. Cette génération prend environ 30 secondes.

Ces versions de la documentation vont être stockées sur notre serveur. Nous accédons ensuite à ces fichiers depuis le front de notre application pour les servir / intégrer (nous planifions de pouvoir dans l’application ajouter des liens vers certaines de parties de la documentation).

## Affichage de la documentation

La documentation HTML générée en front peut être personnalisée très facilement : Asciidoctor utilise des [templates ERB](http://ruby-doc.org/stdlib-2.5.3/libdoc/erb/rdoc/ERB.html) et nous avons, via l’option “[template-dir](https://asciidoctor.org/docs/user-manual/#document-conversion)”, utilisé notre propre template qui nous a permis de simplifier le thème de base pour ne garder que le contenu du body.

Comme vu précédemment, le contenu de la documentation est donc par la tâche cron : c’est un contrôleur va servir le contenu contenu en utilisant des fichiers sources différents selon si l’utilisateur est dans une version librairie ou bibliothèque.

## Historisation des changements

La documentation est longue, nous nous devions de conserver les différentes versions, et ce, notamment pour pouvoir revenir dessus en cas d’erreur de saisie.

Le projet ORB est en PHP et utilise l’ORM Doctrine pour une bonne part de ses interactions avec la base de données. Des extensions à Doctrine permettent de gérer le versionning, mais ci nous ne les avons pas utilisées : nous avons fait simple et créé une table contenant sur chaque ligne une version de la documentation, avec comme informations le contenu de la documentation, qui l’a mis à jour et quand elle a été générée. 

A chaque mise à jour de la documentation, nous créons une nouvelle ligne en base et concevons ainsi l’historique de tous les changements. Actuellement, aucun mécanisme n’est prévu dans l’administration pour consulter ces versions : si le besoin s’en fait ressentir nous pourrons l’ajouter. 

## Prévisualisation des changements dans l’administration


Bien que nous affichons un lien vers le référentiel de la syntaxe AsciiDoc, une prévisualisation du rendu de la documentation nous est apparu nécessaire, cela dans le but de valider que le texte saisi donne le rendu escompté.

Afin de générer cet aperçu nous avons utilisé [Asciidoctor.js](https://asciidoctor.org/docs/asciidoctor.js/). Le temps de génération de documentation n’étant pas instantané, la prévisualisation se met à jour seulement quand l’utilisateur clique sur un bouton dédié (nous avons gardé les choses simples dans cette première version de l’interface de saisie de la documentation, qui est déjà une grande amélioration par rapport à la précédente).

# Le produit final

Après mise en place, voici le rendu de la documentation au sein d’ORB :

<figure>
    <img 
        class="lozad" 
        width="600" height="318"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAALABQDASIAAhEBAxEB/8QAGAAAAwEBAAAAAAAAAAAAAAAAAAMEAQL/xAAVAQEBAAAAAAAAAAAAAAAAAAAAAf/aAAwDAQACEAMQAAABq3hEViCv/8QAGRAAAQUAAAAAAAAAAAAAAAAAAAECEBEx/9oACAEBAAEFApdliH//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/AT//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAg/9oACAEBAAY/Al//xAAYEAADAQEAAAAAAAAAAAAAAAAAASEQEf/aAAgBAQABPyFbA6Hh/9oADAMBAAIAAwAAABDf3//EABURAQEAAAAAAAAAAAAAAAAAAAAh/9oACAEDAQE/EIj/xAAVEQEBAAAAAAAAAAAAAAAAAAAQIf/aAAgBAgEBPxCn/8QAHBAAAgICAwAAAAAAAAAAAAAAAAERITFBUXGR/9oACAEBAAE/EGtqRLogutZks14h7eYzwf/Z"
        data-src="{{ '/assets/posts/documentation-intra-applicative-asciidoc/front-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/documentation-intra-applicative-asciidoc/front-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/documentation-intra-applicative-asciidoc/front-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/documentation-intra-applicative-asciidoc/front-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Rendu de la documentation au sein de l'application</figcaption>
</figure>

La documentation est complètement intégrée à l’application. La version (librairie / bibliothèque) est affichée en fonction de l’utilisateur connecté. Un bouton permet à l’utilisateur de télécharger une version PDF afin de pouvoir consulter la documentation hors ligne.


Et voici le rendu de la gestion de la documentation dans l’administration :


<figure>
    <img 
        class="lozad" 
        width="600" height="304"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAKABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAwAB/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEAMQAAABZSU2yP/EABYQAAMAAAAAAAAAAAAAAAAAAAMQMv/aAAgBAQABBQIUIUL/xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/AT//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAg/9oACAEBAAY/Al//xAAXEAADAQAAAAAAAAAAAAAAAAAAARAx/9oACAEBAAE/IcBzAc//2gAMAwEAAgADAAAAEFDP/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPxA//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPxA//8QAGRABAQADAQAAAAAAAAAAAAAAAQAQMZGh/9oACAEBAAE/EF0YCmPQ20X/2Q=="
        data-src="{{ '/assets/posts/documentation-intra-applicative-asciidoc/admin-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/documentation-intra-applicative-asciidoc/admin-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/documentation-intra-applicative-asciidoc/admin-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/documentation-intra-applicative-asciidoc/admin-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Gestion de la documentation dans l'administration</figcaption>
</figure>

Dans la zone de texte à gauche toute la documentation y est saisie. A droite, l’aperçu se met à jour en cliquant sur un bouton. Un autre bouton permet de changer cet aperçu pour passer de la version bibliothèque à la version librairie. En faisant glisser/déposer une image dans la zone de texte, celle-ci est uploadée et la balise correspondante est ajoutée dans la zone de texte.


# Conclusion

Pour finir, si vous avez un projet de documentation, nous vous conseillons fortement à étudier si AsciiDoc correspond à votre besoin. Nous avons pu l’intégrer à notre application et l’adapter facilement à nos usages et il a notamment permis de générer des documentations PDF très qualitatives. Ce nouveau workflow a été très bien accueilli par le public peu fonctionnel : sur les 7 premiers mois après la mise en place du projet, nous avons environ 300 versions de créées (soit en moyenne 2 versions par jour).


Nous tenons à remercier [Dan Allen](https://twitter.com/mojavelinux) et [tous les contributeurs](https://github.com/orgs/asciidoctor/people) de ce projet et son écosystème.







