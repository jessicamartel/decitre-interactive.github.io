---
layout: post
title: Retour sur We Love Speed 2019
author: srogier
date: 2019-10-02 10:00:00+01:00
excerpt: Retour sur We Love Speed 2019
---

En tant que membre de l’équipe Decitre Interactive, j’ai eu la chance de me rendre à Lille le 20 septembre dernier pour assister à [We Love Speed](https://www.welovespeed.com/2019/).

C’est donc l’occasion de faire un retour sur les conférences auxquelles j’ai pu assister.

## Why does frontend performance matter?

Pour démarrer la journée, [Matt Hobbs](https://twitter.com/TheRealNooshu) nous explique l’importance de la webperf et surtout de l’impact sur les utilisateurs, notamment via le stress occasionné par certaines démarches administratives.

À partir d’une analyse sur les conditions d’utilisation (fragmentation sur les terminaux utilisés, la qualité de connexion), l’objectif est d’apprendre à connaître ses utilisateurs (par exemple 6% du trafic total se fait sur des « *devices legacy* »). Il est donc important que les sites des services publics puissent fonctionner sur des terminaux plus anciens, moins performants et ayant accès à une bande passante plus limitée.

À l’aide de la mise en place de technique comme HTTP/2, Woff2, du lazyloading ou bien [Brotli](https://github.com/google/brotli), afin de réduire le poids des pages et en améliorer l’utilisabilité.

Vous pouvez retrouver les slides soit dans leur [version originale](https://docs.google.com/presentation/d/1hVBrqg-7oWj8-V9xvAcoEMtmRsZefNySxEGW7fAkWzw/edit#slide=id.g57858d1abe_0_0), soit dans une [version traduite](https://docs.google.com/presentation/d/1t6rCx26c9UsXf8Bp3pMMy3f0iAEm3L885vgO_XnmtAg/edit#slide=id.g57858d1abe_0_0).

Mon avis : présentation très intéressante qui met au centre l’utilisateur en essayant d’offrir la meilleure expérience en fonction des conditions d’utilisation.

## Responsible JavaScript

Pour la présentation de [Jeremy Wagner](https://twitter.com/malchata), tout part d’un constat : la taille des fichiers JavaScripts utilisés sur nos sites augmente d’année en année.

Ce constat est d’autant plus vrai avec l’émergence des frameworks JS ces dernières années comme React. L’objectif de ce sujet était donc d’essayer de proposer des pistes pour fournir du Javascript de la manière la plus responsable possible.

Il propose déjà de s’appuyer sur les fondamentaux et ce qui est fourni par HTML au lieu d’abuser des balises *div* alors que le langage propose des balises adaptées (exemple de *form* écrit à coup de *div*).

Il aborde également d’autres techniques, comme écrire son code de manière à ce que Babel le transpile dans une version moins lourde, le *differential serving* qui permet de servir du code supplémentaires pour le bon fonctionnement dans les navigateurs qui le nécessitent.

Vous pouvez retrouver les slides [ici](https://speaking.jeremy.codes/sN2UQZ/responsible-javascript).

Mon avis : n’étant pas développeur JS à la base, j’ai trouvé ces pistes pleines de bon sens, et ai apprécié cette approche de tenter d’avoir un site capable de gérer non pas **si** JavaScript ne va pas s’activer mais **quand** JavaScript va crasher.

## Comment PagesJaunes s’est hissé dans le top 10 du classement webperf

C’est au tour de [Loïc Troquet](https://twitter.com/loic_troquet) de nous présenter un retour d’expérience sur ce qui a été fait par pagesjaunes.fr pour monter dans le top 10 JDN de la webperf pour les sites français.

Après nous avoir expliqué les enjeux et indicateurs, Loïc nous a détaillé les différentes optimisations effectuées avec leur impact en terme de score SpeedIndex. Au programme, du HTTP/2, des images optimisées, de l’[OCSP Stapling](https://en.wikipedia.org/wiki/OCSP_stapling), Brotli, etc.

Étape après étape, nous pouvons voir l’évolution et voir le classement évoluer de la 30e place à la 5e en quasiment 2 ans.

Vous pouvez retrouver les slides [ici](https://www.welovespeed.com/assets/docs/2019/loic-rex-pj.pdf).

Mon avis : un retour d’expérience intéressant et avec un écho particulier car j’ai pu y retrouver pas mal de similarités par rapport [à notre démarche sur la webperf](https://afup.org/talks/1799-de-7-a-3s-retour-d-experience-sur-la-performance-web-sur-decitre-fr), mais aussi des pistes à étudier pour nous dans le futur.

## Chaperones and curfews: minimising 3rd party impact

Pour ce sujet, [Ryan Townsend](https://twitter.com/ryantownsend) nous parle du mal absolu : les scripts tiers.

Tous ces scripts qu’on ne maîtrise pas, qui sont sur nos sites, pour lesquels on nous vend « 0 surcharge sur la performance de votre site », mais où, dans les faits on en est un peu loin.

Toutefois, ces scripts tiers sont souvent là parce que « chacun son métier » et qu’on ne peut pas tout faire. Il est donc difficile de tous s’en passer.

Ryan va nous donner quelques pistes pour s’en accommoder au mieux : décalage de chargement, flag d’activation, service worker pour gérer un timeout, hébergement des scripts, etc.

Vous pouvez retrouver les slides [ici](https://speakerdeck.com/ryantownsend/chaperones-and-curfews-we-love-speed-2019).

Mon avis : Un bon état des lieux de ces différents scripts et des différentes manières de les gérer.

## Progressive Web App et performance

Lors de cette présentation, Raphaël Dardeau ne nous a pas parlé des bienfaits et du fonctionnement des Progressive Web App utilisées dans la nouvelle version de l’équipe.fr.

Il nous a plutôt parlé de comment nous appuyer sur les PWA pour aider à proposer un principe d’amélioration progressive sur nos sites.

Par exemple, sur les images en se combinant avec la Network Information API, on va décider de charger une image de très faible qualité sur les terminaux avec une faible bande passante, tout en proposant une image retina sur les machines capables de la télécharger.

Ces différentes techniques ont pu permettre de quasiment diviser par 3 le temps de chargement des pages.

Vous pouvez retrouver les slides [ici](https://www.welovespeed.com/assets/docs/2019/pwa-webperf.pdf).

Mon avis : un retour d’expérience encore une fois très concret avec plusieurs cas d’usages qui devraient s’avérer être intéressants à tester.

## Dans quoi s’embarque-t-on en lançant un projet d’optimisation de la webperf ?

Dans cette conférence, Mathilde Lassort et Quentin Mathieu nous racontent comment s’est organisé oui.sncf autour du sujet de la performance web.

Nous avons pu apprendre comment, avec des équipes spécialisées par feature, ils ont fait en sorte de propager la connaissance et le réflexe web-performance.

Ils ont formé une équipe dédiée chargée de déblayer les sujets et à l’aide d’outils, par exemple des hackatons, ont fait en sorte de propager les connaissances de cette core team webperf vers les différentes features teams.

Toutes les équipes sont ainsi impliquées et ont à gérer leur budget de performance.

Vous pouvez retrouver les slides [ici](https://www.welovespeed.com/assets/docs/2019/wls_oui.sncf.pdf).  

Mon avis : une présentation très intéressante, plus axée sur l’humain et l’organisationnel que sur la technique pour responsabiliser les différents acteurs à ce sujet.

## En conclusion

C’est la première édition de We Love Speed à laquelle j’ai participé. Même s’il manquait de sujets techniques purs, il y avait beaucoup de bons retours d’expérience suffisamment variés pour être différents avec pas mal d’idées à ramener chez nous pour tester :)

Autre point important, toutes les conférences ont été filmées. Ce qui a pu aider lors des difficiles choix entre deux sujets. 
Je vous invite à suivre le compte [Twitter de We Love Speed](https://twitter.com/_welovespeed) pour suivre la mise en ligne des différentes présentations.

Merci à l’équipe d’organisation pour cette journée qui s’est très bien déroulée et j’espère à l’année prochaine (à Lyon peut-être ?).

