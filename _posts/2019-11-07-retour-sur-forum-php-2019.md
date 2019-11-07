---
layout: post
title: Retour sur le Forum PHP 2019
author: vdechenaux
date: 2019-11-07 09:00:00+01:00
excerpt: Retour sur le Forum PHP 2019
---

Comme chaque année nous avons eu la chance de participer au [ForumPHP](https://event.afup.org/forumphp2019/) de l’[AFUP](https://twitter.com/afup).

Cela fait partie des avantages du [poste](/posts/offre-emploi-developpement-senior-php).

<figure>
    <img 
        class="lozad" 
        width="600" height="400"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAANABQDASIAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAAIBA//EABYBAQEBAAAAAAAAAAAAAAAAAAEAAv/aAAwDAQACEAMQAAAB5QnRqRf/xAAWEAADAAAAAAAAAAAAAAAAAAAAESD/2gAIAQEAAQUCHP8A/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPwE//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPwE//8QAFBABAAAAAAAAAAAAAAAAAAAAIP/aAAgBAQAGPwJf/8QAGhAAAgMBAQAAAAAAAAAAAAAAAAERITEQgf/aAAgBAQABPyGa1Ehy9bHYr85//9oADAMBAAIAAwAAABA7P//EABYRAAMAAAAAAAAAAAAAAAAAAAEQIf/aAAgBAwEBPxARf//EABYRAAMAAAAAAAAAAAAAAAAAAAEQIf/aAAgBAgEBPxA1f//EABsQAAIDAQEBAAAAAAAAAAAAAAERACExQWGR/9oACAEBAAE/EC73A4jcJDqvkIjIPsFb2C5fH2HZ/9k="
        data-src="{{ '/assets/posts/forum-php-2019/public-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/forum-php-2019/public-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/forum-php-2019/public-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/forum-php-2019/public-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Source <a href="https://www.flickr.com/photos/99511626@N04/48989655811/in/album-72157711575860401/">Benjamin Lévêque</a></figcaption>
</figure>

## [PHP Pragmatic Development (Frédéric BOUCHERY)](https://afup.org/talks/3087-php-pragmatic-development)

On commence sur une belle présentation issue d’un grand nombre d’années passées dans le milieu du développement logiciel, ce qui permet un retour d’expérience très intéressant.

Frédéric commence par nous rappeler que nous codons pour les autres avant de coder pour soi-même, et que par conséquent il faut écrire du code compréhensible par les humains, pas seulement compréhensible par les machines.

Au milieu de beaucoup d’acronymes plus ou moins connus, Frédéric nous parle de [YAGNI](https://fr.wikipedia.org/wiki/YAGNI) et [KISS](https://fr.wikipedia.org/wiki/Principe_KISS) et d’une matrice qu’il utilise depuis des années pour trancher entre plusieurs solutions techniques au cours d’une réunion.

La présentation se finit en beauté sur :

>“ Less code
>
> More brain
>
> No hasty
>
> No dogma “

On retiendra aussi quelques citations :
> “Le code c'est comme les blagues si on doit l'expliquer c'est qu'il est mauvais.”

> “Les bons programmeurs écrivent du code que les humains peuvent comprendre.”

> “Pas d’abstraction, c’est toujours mieux qu’une mauvaise abstraction.”

## [Redis, ce n'est pas que pour le cache (Grégoire PINEAU)](https://afup.org/talks/3094-redis-ce-n-est-pas-que-pour-le-cache)

On continue sur une présentation qui va lever une idée répandue qui est que Redis ne sert que pour le cache / les sessions dans notre milieu.

On se rend compte que Redis peut nous servir sur plusieurs utilisations simples, par exemple :
- Compteur de visite
- Gestion de stock en temps réel
- Stockage de feature flags

Redis est la plupart du temps plus performant qu’autre chose sur ces points-là.

Grégoire nous montre ensuite des structures de données plus avancées, telles que [Sorted sets](https://redis.io/topics/data-types#sorted-sets), [Hyperloglogs](https://redis.io/topics/data-types#bitmaps-and-hyperloglogs), [Streams](https://redis.io/topics/streams-intro), …

Enfin, Grégoire nous encourage à aller voir les [modules Redis](https://redis.io/modules), certains sont vraiment intéressants, et sont supportés directement par RedisLabs.

## [Une application résiliente, dans un monde partiellement dégradé (Pascal MARTIN)](https://afup.org/talks/3135-une-application-resiliente-dans-un-monde-partiellement-degrade)

> “Things are going to fail. It's a fact.”

> “Everything will fail over time.“

> “At scale, things fail a lot.“

Ça va casser, faisons en sorte que ça se passe au mieux !

Pascal nous montre quelques exemples, qui peuvent sembler évidents, mais pour lesquels je ne suis pas sûr que cela se passe comme ça partout :
- Vous avez une wishlist avec 10 articles dont 1 que vous n’arrivez pas à charger ? Affichez en 9 !
- Vous ne pouvez pas servir une réponse mais vous avez un cache expiré ? Utilisez le !
- Vous ne pouvez pas afficher une version dynamique ? Affichez en une statique !

En parallèle de ça, Pascal nous explique qu’il peut être intéressant de désactiver des features automatiquement via feature flag en cas de problème.

> “Plus les pannes sont fréquentes mieux elles sont tolérées, alors cassons !”

Suite à cette phrase, Pascal nous parle de Chaos Monkey.

Il nous invite à prendre une instance de prod / un service de prod et à le couper, et regarder ce qu’il se passe ! (On peut commencer en préprod, par sécurité, qu’il a aussi dit 😋)
Chez M6, ils gèrent ça très simplement avec des [Instances Spot Amazon](https://aws.amazon.com/fr/ec2/spot/) qui coûtent beaucoup moins cher mais peuvent être coupées à n'importe quel moment, quand leur prix augmente.
Il y a donc un double effet, l’infra coûte moins chère, et est résiliente aux coupures de machines !

## [Concevoir des applications PHP résilientes en 2019 (Mickaël ANDRIEU)](https://afup.org/talks/3046-concevoir-des-applications-php-resilientes-en-2019)

En complément de la précédente présentation, Mickaël nous parle de [Circuit Breaker](https://arodrigues.developpez.com/tutoriels/architecture/design-pattern-circuit-breaker/#LVI).

Ce design pattern permet de gérer une machine à état et par exemple de renvoyer une réponse dégradée sans rappeler un service tiers.

Chez PrestaShop, il a participé au développement en PHP de [prestashop/circuit-breaker](https://github.com/PrestaShop/circuit-breaker) que vous pouvez réutiliser dans vos projets.

## [PHP 8 et Just In Time Compilation (Benoit JACQUEMONT)](https://afup.org/talks/3015-php-8-et-just-in-time-compilation)

Benoit commence sa présentation sur un historique de JIT et PHP, en parlant d’HHVM, qui est le premier moteur PHP à intégrer JIT.

Puis en 2014, la core team PHP se penche sérieusement sur JIT, mais ses essais ne sont pas concluants, la version avec JIT est moins performante que sans.

Ils se sont alors rendu compte qu’il fallait d’abord changer des choses dans les structures internes avant de se pencher sur le JIT, c’est là qu’est né [PHP Next Generation](https://www.php.net/archive/2014.php#id2014-05-27-1) qui deviendra ensuite le PHP 7 que nous connaissons.

PHP 8 arrive très bientôt, avec JIT. Mais pour quels gains ?
Benoit nous montre que suivant les applications les gains diffèrent énormément, et que pour la plupart des usages que nous avons, cela n’apporte pas énormément pour le moment...

À suivre !

## [Se prémunir contre l’imprévisible : une analyse des failles les plus courantes en PHP (Paul MOLIN)](https://afup.org/talks/3142-se-premunir-contre-l-imprevisible-une-analyse-des-failles-les-plus-courantes-en-php)

J’ai personnellement été un peu déçu par cette présentation, à la lecture du résumé je me suis dit qu’on allait voir des choses nouvelles, mais non.

Cependant, si vous n’êtes pas à l’aise avec CSRF, XSS, RCE, … je vous invite à regarder la présentation !

## [Mercure, et PHP s'enamoure enfin du temps réel (Kévin DUNGLAS)](https://afup.org/talks/3077-mercure-et-php-s-enamoure-enfin-du-temps-reel)

Avec HTTP/2, le protocole WebSocket est devenu obsolète.
Mercure arrive en remplacement, en tirant parti des fonctionnalitées d’HTTP/2 (et même 3 !).
Il est supporté nativement par tous les navigateurs modernes, sans l’ajout d’un paquet quelconque.

Présentation très intéressante, avec un retour d’expérience de iGRAAL qui utilise Mercure.

## [Concevoir pour des futurs souhaitables (Marie-Cécile GODWIN et Thomas DI LUCCIO)](https://afup.org/talks/3167-concevoir-pour-des-futurs-souhaitables)

Si le sujet vous intéresse (ou pas) je vous invite à regarder la présentation, qui fait réfléchir… 😉

## [Lightning talks](https://afup.org/talks/3190-lightning-talks)

Plusieurs talks dont un de [@paxal](https://twitter.com/paxal/status/1187980952032686083) qui m’a vraiment donné envie de tester PHP 7.4 et FFI !
Chose que j’ai fait dans le trajet retour en train et que j’ai [publié ici](https://github.com/vdechenaux/PhpWebcam) 😊

## [Si Darwin avait raison, l'agilité fonctionne par hasard (François ZANINOTTO)](https://afup.org/talks/3080-si-darwin-avait-raison-l-agilite-fonctionne-par-hasard)

<figure>
    <img 
        class="lozad" 
        width="600" height="400"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAANABQDASIAAhEBAxEB/8QAFwAAAwEAAAAAAAAAAAAAAAAAAAIEA//EABUBAQEAAAAAAAAAAAAAAAAAAAAB/9oADAMBAAIQAxAAAAFVNycoF//EABoQAAICAwAAAAAAAAAAAAAAAAASARECEDH/2gAIAQEAAQUCyi5UUazmv//EABURAQEAAAAAAAAAAAAAAAAAAAAR/9oACAEDAQE/AYj/xAAVEQEBAAAAAAAAAAAAAAAAAAAAEf/aAAgBAgEBPwGq/8QAFhAAAwAAAAAAAAAAAAAAAAAAAREg/9oACAEBAAY/Agq//8QAGhAAAgMBAQAAAAAAAAAAAAAAAAERITEQQf/aAAgBAQABPyEwTPCQqFHoqZz/2gAMAwEAAgADAAAAEKwP/8QAFhEBAQEAAAAAAAAAAAAAAAAAAAER/9oACAEDAQE/EJDD/8QAFREBAQAAAAAAAAAAAAAAAAAAECH/2gAIAQIBAT8Qg//EABkQAQADAQEAAAAAAAAAAAAAAAEAESFBMf/aAAgBAQABPxDPSnFvsE6rGN3kYUgQ5ENQduZbk//Z"
        data-src="{{ '/assets/posts/forum-php-2019/francois-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/forum-php-2019/francois-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/forum-php-2019/francois-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/forum-php-2019/francois-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Source <a href="https://www.flickr.com/photos/99511626@N04/48989875937/in/album-72157711575860401/">Benjamin Lévêque</a></figcaption>
</figure>

Une présentation (un spectacle en fait 🤔) très bien exécutée !

Par contre la présentation était tellement portée sur le troll que j’ai du mal à en garder quelque-chose en sortie !

Mais c’est à voir !

## [Le TDD dans la vraie vie avec Panther (Adrien LUCAS)](https://afup.org/talks/3159-le-tdd-dans-la-vraie-vie-avec-panther)

Après un rappel sur les différents types de tests (end to end, unitaire, intégration) et où et quand les utiliser, Adrien se lance dans le live coding très bien préparé.

En partant d’un `WebTestCase` classique, il ajoute du JS dans une des vues et casse ainsi les tests. C’est alors qu’il change l’extend en `PantherTestCase` et que par magie, ça fonctionne !

Moi qui n’aime pas spécialement Behat, c’est une alternative très sympa qui est proposée ici pour faire du test end to end avec du JS.

## [Symfony HttpClient vs Guzzle vs HTTPlug (Nicolas GREKAS)](https://afup.org/talks/3172-symfony-httpclient-vs-guzzle-vs-httplug)

Je suis clairement venu ici avec un a priori “qu’est-ce que ça fait de mieux que Guzzle” et je n’ai pas été déçu.

On peut voir par les différents benchmarks que dans certains cas (avec HTTP/2) ce client HTTP est bien plus performant en terme de vitesse et d’utilisation CPU.

## [Symfony Checker is coming (Valentine BOINEAU)](https://afup.org/talks/3134-symfony-checker-is-coming)

J’ai été un peu déçu par cette présentation qui est passée très très rapidement sur le sujet et a terminé en présentation commerciale.

Je m’attendais vraiment à ce que l’on parle d’AST, CFG, SSA comme indiqué dans le résumé, mais cette partie a été assez brève.

## [Tout pour se préparer à PHP 7.4 (Damien SEGUY)](https://afup.org/talks/3120-tout-pour-se-preparer-a-php-7-4)

Damien nous fait un tour de toutes les nouveautés de PHP 7.4, et surtout de toutes les vieilleries que nous ne pourrons plus utiliser (short tags, is_real et bien d’autres).

Toujours intéressant à avoir en tête pour effectuer les migrations.

## [Une année de PHP asynchrone en production (Benoit VIGUIER)](https://afup.org/talks/3101-une-annee-de-php-asynchrone-en-production)

Une présentation de Benoit comme on les aime !

Un seul but : “Réduire toutes les attentes inutiles”, et pour y arriver Benoit nous montre les différents mécanismes qui sont utilisés chez M6.

Ils ont d’ailleurs créé un projet pour ça [m6web/tornado](https://github.com/M6Web/Tornado).

## [Gérez le Traefik de vos services (Sylvain COMBRAQUE)](https://afup.org/talks/3022-gerez-le-traefik-de-vos-services)

Une présentation sur un outil qui m’a semblé être très intéressant et que j’ai maintenant envie de tester !

J’aurais peut-être voulu en savoir un peu plus !

## The end

C’est tout pour moi !

Le temps de discuter un peu et de partir prendre le train, j’ai raté [une présentation](https://afup.org/talks/3180-pratiquons-la-physique-avec-star-wars) et la keynote de clôture.

A très bientôt (à l’[AFUP DAY](https://event.afup.org/afup-day-2020/afup-day-2020-lyon/) ?) !
