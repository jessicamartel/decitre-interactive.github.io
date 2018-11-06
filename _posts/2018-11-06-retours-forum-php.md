---
layout: post
title: Retours sur le Forum PHP 2018
author: srogier
date: 2018-11-06 10:00:00+01:00
excerpt: Retour sur l'édition 2018 du Forum PHP à laquelle nous avons assisté
---



Cette année encore, nous avons eu la chance de participer au [ForumPHP](https://event.afup.org/forumphp2018/) de l’[AFUP](https://twitter.com/afup). 

Voici le retour sur les conférences auxquelles j’ai assistées.

## Conférences du jeudi 25 octobre


<figure>
    <img 
        class="lozad" 
        width="600" height="400"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAANABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAEE/8QAFgEBAQEAAAAAAAAAAAAAAAAAAQAC/9oADAMBAAIQAxAAAAHPY2QF/8QAGBAAAwEBAAAAAAAAAAAAAAAAAAEREBL/2gAIAQEAAQUCg1lOin//xAAVEQEBAAAAAAAAAAAAAAAAAAAQEf/aAAgBAwEBPwGH/8QAFhEBAQEAAAAAAAAAAAAAAAAAABES/9oACAECAQE/AdK//8QAFBABAAAAAAAAAAAAAAAAAAAAIP/aAAgBAQAGPwJf/8QAGRABAQEAAwAAAAAAAAAAAAAAAQARITFR/9oACAEBAAE/Id7KWcEJbb2S/C//2gAMAwEAAgADAAAAEPc//8QAFhEBAQEAAAAAAAAAAAAAAAAAABEB/9oACAEDAQE/EITH/8QAFhEBAQEAAAAAAAAAAAAAAAAAABEB/9oACAECAQE/EKxb/8QAGBABAQEBAQAAAAAAAAAAAAAAAREhADH/2gAIAQEAAT8QFkm7wo066ZpeRK+GTOoAEvVYAYHf/9k="
        data-src="{{ '/assets/posts/forum-php-2018/pupitre-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/forum-php-2018/pupitre-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/forum-php-2018/pupitre-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/forum-php-2018/pupitre-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Source <a href="https://www.flickr.com/photos/julienpauli/31696639078/in/pool-3071907@N25/">Julien Pauli</a></figcaption>
</figure>

### [Comment j’ai commencé à aimer ce qu’ils appellent « design pattern »](https://www.slideshare.net/samuelroze/how-i-started-to-love-design-patterns-120688063)

À partir d’exemples concrets, [Samuel Rozé](https://twitter.com/samuelroze) nous présente un rappel utile de l’usage des Design Patterns et de leur capacité à nous faciliter la vie lors des refactoring en améliorant la réutilisabilité, la lisibilité et la maintenabilité de nos applications.

En décrivant 3 des principaux patterns que sont Adapter, Event Dispatcher et Decorator, cette conférence était un bon rappel de ce à quoi doivent servir les Design Patterns, qu’on peut résumer à l’aide de la citation finale : _« They just help us to enable change »_.


### Sylius quelques chocolats plus tard

Présentation en duo de l’équipe de [Monsieur Biz](https://twitter.com/MonsieurBiz) rodée sur Magento 1.X et qui, déçue par la version 2, a décidé de tenter l’aventure de Sylius.

Ce retour d’expérience a démarré par un historique de Sylius, ses forces et faiblesses par rapport à Magento 2 et comment la transition du développement des projets dans leurs équipes est passée de Magento vers Sylius en décrivant l’outillage mis en  place et la courbe d’apprentissage.

La présentation s’est ensuite appuyée sur un cas client concret, mais (petit regret) n’est pas trop rentrée dans la technique.

### [Maintenir et faire évoluer une API GraphQL](https://spyl.net/slides/forumphp-2018.html#)

Conférence très intéressante de [Aurélien David](https://twitter.com/spyl94), pleine de bons conseils sur la manière de gérer, maintenir et faire vieillir de manière propre et efficace nos API.

Comment aborder les changements bloquants (indice : _« On ne casse pas le schéma »_ ), l’importance de soigner la communication dans les changements (préciser les _« quand »_, _« pourquoi »_, _« comment »_  aux utilisateurs) sont abordés parmi les bonnes pratiques.

Enfin, les spécificités liées à GraphQL terminent cette liste de bonnes pratiques à appliquer dans la vie de nos API. Parmi les outils liés à GraphQL, nous avons eu un aperçu de [GraphQL Doctor](https://github.com/cap-collectif/graphql-doctor), outil qui permet d’alerter lors des revues de code des modifications de schéma pouvant entraîner des changements bloquants.

### [Voyage au centre du cerveau humain ou comment manipuler des données binaires en Javascript](https://talk.tom32i.fr/binary-brain/#/)

Un sujet qui avait le mérite de sortir du cadre de PHP où [Thomas Jarrand](https://twitter.com/Tom32i) nous a parlé de la manipulation d’informations binaires (en l’occurrence des données sorties de l’IRM d’un cerveau) afin de traiter et afficher ces informations directement dans le navigateur grâce à Javascript.

La présentation était dynamique et concrète et l’exemple présenté permettait d’appuyer sur l’intérêt de l’utilisation des données binaires dans certains cas d’usage, par rapport à des formats plus structurés (comme XML ou JSON) notamment pour alléger la bande passante en cas de gros volume échangé sur le réseau.

### [Comment fonctionne la cryptographie ?](https://www.slideshare.net/jpauli/basics-of-cryptography-stream-ciphers-and-prng/jpauli/basics-of-cryptography-stream-ciphers-and-prng)

Malgré un sujet a priori plutôt complexe et violent (surtout en plein après-midi) mais vendu sans trop de mathématiques (_« équation polynomiale »_ n’a été prononcé que 3 fois, il me semble), [Julien Pauli](https://twitter.com/julienPauli) a réalisé une présentation plutôt claire sur les notions de cryptographie et sur la manière d’implémenter un algorithme de chiffrement.

Malheureusement, j’ai perdu le fil après avoir été perturbé par mon téléphone, mais j’attends avec hâte le replay qui devrait me permettre d’accompagner efficacement les slides.

### Mentorat & parcours de reconversion : comment faciliter l’apprentissage ?

Conférence Alien de la première journée, [Anne-Laure de Boissieu](https://twitter.com/AnneLaure2B) nous a présenté son parcours de reconversion en tant que développeuse Web, l’accompagnement dans cette démarche par [Éric Daspet](https://twitter.com/edasfr) dans un rôle de mentor, les différentes étapes et l’évolution de leur relation au cours de cette reconversion.

J’ai trouvé très inspirante cette expérience réussie et c’est un bel exemple de ce qui peut être fait en tant que personne expérimentée pour faire profiter à la communauté de cette expérience acquise. Pour compléter le sujet du mentorat, cette préentation fait aussi un bon écho avec la conférence [Mentoring à tous les étages](https://tech.decitre.fr/posts/retours-sur-mixit-2018#mentoring-%C3%A0-tous-les-%C3%A9tages-vue-par-s%C3%A9bastien) vue lors de MiXit 2018 et qui évoquait le rôle du mentorat en entreprise pour aider à l’intégration.

## Conférences du vendredi 26 octobre


<figure>
    <img 
        class="lozad" 
        width="600" height="400"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAANABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAID/8QAFQEBAQAAAAAAAAAAAAAAAAAAAAH/2gAMAwEAAhADEAAAAazRFsVf/8QAGBABAQEBAQAAAAAAAAAAAAAAAQARITH/2gAIAQEAAQUCWW1vJ6bl/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPwE//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPwE//8QAGBAAAgMAAAAAAAAAAAAAAAAAABABETH/2gAIAQEABj8CMU0//8QAGRABAQEBAQEAAAAAAAAAAAAAAQARMSFh/9oACAEBAAE/IVPoykG5GLhkkNheC//aAAwDAQACAAMAAAAQfA//xAAXEQEAAwAAAAAAAAAAAAAAAAAAAREh/9oACAEDAQE/EIxb/8QAFhEBAQEAAAAAAAAAAAAAAAAAABEx/9oACAECAQE/ENR//8QAGRABAQEBAQEAAAAAAAAAAAAAAREAIUEx/9oACAEBAAE/ECACjk9cD1F4K4X5A5hCMH2mQFVx1IXf/9k="
        data-src="{{ '/assets/posts/forum-php-2018/public-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/forum-php-2018/public-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/forum-php-2018/public-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/forum-php-2018/public-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Source <a href="https://www.flickr.com/photos/julienpauli/31696635278/in/pool-3071907@N25/">Julien Pauli</a></figcaption>
</figure>


### [MySQL 8.0 : quoi de neuf ?](https://www.slideshare.net/freshdaz/mysql-80-whats-new-forum-php-2018)

On démarre la seconde journée par une présentation de MySQL 8.0 effectuée par [Olivier Dasini](https://twitter.com/freshdaz) et des nouveautés apportées par cette version.

Au programme, pas mal de nouvelles fonctions liées à la manipulation du JSON (coucou le NoSQL), le support des Common Table Expression et des Window Function (coucou PostgreSQL) et une présentation de MySQL Shell.

### [Docker en prod ? Oui avec Kubernetes !](https://blog.pascal-martin.fr/public/slides-docker-en-prod-avec-kubernetes-forum-php-2018/#/)

Encore un très bon retour d’expérience, cette fois sur l’utilisation de Docker en production à l’aide de Kubernetes. Après avoir expliqué les concepts autour de Kubernetes, [Pascal Martin](https://twitter.com/pascal_martin) nous a présenté la migration effectuée chez M6Web et de comment ils ont migré leurs applications dans le Cloud en s’appuyant sur Docker.

Ne connaissant pas Kubernetes et son univers, j’ai apprécié la présentation très progressive qui en a été faite.

### [Beyond design patterns and principles - writing good OO code](https://www.slideshare.net/matthiasnoback/beyond-design-principles-and-patterns)

Cette présentation était également orientée sur les bonnes pratiques de développement autour de la POO.

Avec quelques principes de base (_« Objects introduce meanings »_), la cohésion (_« What belongs together, gets together »_), la séparation requêtage et commande (_« Asking for information doesn’t change state»_),  [Matthias Noback](https://twitter.com/matthiasnoback) nous explique ces bonnes pratiques qui nous aident à concevoir de meilleurs objets.

Au final, une conférence très claire et très intéressante.

### Cessons les estimations
Tout est dans le titre. Dans cette présentation à mi chemin entre conférence et one-man-show, [Frédéric Leguedois](https://twitter.com/f_leguedois) nous explique pourquoi il ne sert à rien de faire des estimations ou de se fixer des deadlines inatteignables.

Il nous livre à cette occasion le secret d’une estimation fiable : _« Prendre un nombre aléatoire. Et le multiplier par un autre nombre aléatoire »_.

Cette conférence m’avait été fortement conseillé suite à [MiXiT](https://tech.decitre.fr/posts/retours-sur-mixit-2018#cessons-les-estimations--vue-par-éric) plus tôt cette année et je n’ai pas été déçu. Un excellent et divertissant plaidoyer pour le mouvement No Estimate, une prestation mémorable et un des meilleurs sujets présentés lors de ce ForumPHP 2018.

### Développeurs de jeux vidéo: les rois de la combine

Pour conclure cette édition, on termine par la conférence Alien du jour. [Laurent Victorino](https://twitter.com/on_code), développeur de jeux vidéo, nous vend la débrouillardise de ses confrères (et la sienne au passage) qui semblent savoir appliquer mieux que personne le _« It’s not a bug, it’s a feature »_ quitte à tromper (de manière grossière, ou pas) les joueurs que nous sommes, en nous racontant plusieurs anecdotes autour de petits arrangements faits sur certains jeux.

Une bonne manière de finir ces deux jours de manière ludique et interactive.

## Conclusion

Encore une très belle édition du ForumPHP. 

Encore merci à l’[AFUP](https://twitter.com/afup) pour toute l’organisation, quasi sans accrocs (à part le problème d’affichage lors de la première conférence). Les vidéos seront bientôt disponibles [ici](https://afup.org/talks/). 

Rendez-vous pour l’AFUP Day l’année prochaine à [Lyon](https://event.afup.org/afup-day-2019/afup-day-2019-lyon/) ou [ailleurs](https://event.afup.org/afup-day-2019).


