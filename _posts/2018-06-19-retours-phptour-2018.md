---
layout: post
title: Retour vers le PHP Tour
author: broux
date: 2018-06-19 11:00:00+02:00
excerpt: Retour sur le PHP Tour 2018 qui s'est tenu à Montpellier les 17 et 18 mai
---

En tant que membre de l’équipe Decitre Interactive, j’ai eu l’occasion d’assister au PHP Tour. Cela fait partie des avantages du [poste](https://tech.decitre.fr/posts/offre-emploi-developpement-php). Si vous voulez voir ou revoir une des conférences, elles sont disponibles en vidéo [ici](https://afup.org/talks/?q=&hPP=7&idx=afup_talks&p=0&dFR%5Bhas_video%5D%5B0%5D=true&fR%5Bevent.title%5D%5B0%5D=PHP%20Tour%20Montpellier%202018&is_v=1)

Je vous mets ci-dessous la liste des conférences auxquelles j'ai assisté et parce que je suis vraiment sympa, je vous mets même des liens pour accéder à la partie qui vous intéresse.

Conférences du jeudi
* [Le RGPD expliqué par un développeur](#le-rgpd-expliqué-par-un-développeur)
* [Retour sur 5 ans de cli pour importer le catalogue chez Deezer](#retour-sur-5-ans-de-cli-pour-importer-le-catalogue-chez-deezer)
* [Bienvenue dans la matrice !](#bienvenue-dans-la-matrice-)
* [E-learning sans internet, ou presque](#e-learning-sans-internet-ou-presque)
* [IT Figures](#it-figures)
* [Sans documentation, la fonctionnalité n'existe pas !](#sans-documentation-la-fonctionnalité-nexiste-pas-)
* [CQRS, Fonctionnel, Event Sourcing & Domain Driven Design](#cqrs-fonctionnel-event-sourcing--domain-driven-design)
* [Ethique et macarons](#ethique-et-macarons)

Conférences du vendredi
* [REST ou GraphQL ? Exemples illustrés avec Symfony et Api Platform](#rest-ou-graphql--exemples-illustrés-avec-symfony-et-api-platform)
* [Caching with PSRs](#caching-with-psrs)
* [GRAOU : La production ferroviaire collaborative](#graou--la-production-ferroviaire-collaborative)
* [Traduire efficacement une application Symfony](#traduire-efficacement-une-application-symfony)
* [Décryptez votre contrat de travail](#décryptez-votre-contrat-de-travail)
* [Merci de laisser ce code dans l'état dans lequel vous aimeriez le trouver](#merci-de-laisser-ce-code-dans-létat-dans-lequel-vous-aimeriez-le-trouver)
* [La pire meilleure idée : faire du batch processing avec doctrine](#la-pire-meilleure-idée--faire-du-batch-processing-avec-doctrine)
* [Jouons tous ensemble à un petit jeu](#jouons-tous-ensemble-à-un-petit-jeu)

## Le RGPD expliqué par un développeur
*Conférence animée par : [Frédéric Hardy](https://twitter.com/mageekguy)*

*Pourquoi j'ai choisi cette conférence ?*  
Un  sujet pour le moins d'actualité (Le RGPD entrant en application une semaine après le PHP Tour). J'y suis allé en me disant "je ne maîtrise pas le sujet", je ne croyais pas si bien dire.

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2505-le-rgpd-explique-par-un-developpeur)  
Frédéric revient sur les parties "connues" du RGPD :

* A qui s'applique-t-il ?
* L'obligation de consentement
* La collecte du strict minimum nécessaire
D'ailleurs chose importante que je ne savais pas et que je rappelle ici : **il est obligatoire d'écrire une documentation prouvant la raison de la collecte**

Frédéric a également étendu à des aspects moins connus / évoqués du RGPD. Comme l'impact potentiel du "Privacy by design"
* Chiffrement de toutes les communications
* Pseudonymisation des bases
* Fin des partages de compte
* Gestion des logs
* Les services tiers doivent être eux aussi conforme au RGPD
* La communication sur les hacks
* L'obligation de documentation

*Ce que j'en ai pensé :*  
Une conférence vraiment très intéressante notamment parce qu'elle traduit un texte de loi en termes que nous comprenons tous. J'en suis ressorti avec le moral au fond des chaussettes vu l'impact potentiel sur les développements. Le RGPD va potentiellement beaucoup plus loin que ce que l'on imagine au premier abord. Cela va dépendre de la volonté et des moyens mis à disposition des différentes CNIL européennes mais une chose est sûre : on n'a pas fini d'entendre parler du RGPD et il va falloir suivre attentivement les différents jugements sur le sujet.

*La citation : "Traitez les données des autres comme vous traitez vos propres données"*

## Retour sur 5 ans de cli pour importer le catalogue chez Deezer
*Conférence animée par : [Jean Pasdeloup](https://twitter.com/@PasdeloupNet) et [Romain Cottard](https://twitter.com/velkuns)*

*Pourquoi j'ai choisi cette conférence ?*  
Elle traite d'un sujet qui nous touche au quotidien. Pas dans les mêmes volumes, ni avec les mêmes architectures impliquées mais j'étais curieux de savoir comment ils ont résolu leurs problèmes. Et peut-être en tirer quelques idées pour nos imports, qui sait ?

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2527-retour-sur-5-ans-de-cli-php-pour-importer-le-catalogue-chez-deezer)  
Jean et Romain nous parlent de l'industrialisation de l'import du catalogue Deezer. Comment passer de quelques scripts php peu structurés à un système isolé, facilement identifiable, compréhensible et documenté. On suit les différentes étapes qui ont marqué ces cinq années d'évolution.

*Ce que j'en ai pensé :*  
Conférence intéressante. J'ai été particulièrement intéressé par la partie démon et worker.  Cela m'a permis de me rendre compte qu'on applique les mêmes principes pour l'import de catalogue et que les pistes envisagées pour améliorer nos imports semblent fonctionner chez Deezer.

## Bienvenue dans la matrice !
*Conférence animée par : [Benoit Jacquemont](https://twitter.com/@bjacquemont)*

*Pourquoi j'ai choisi cette conférence ?*  
Parce que cette conférence parle "d'outils de barbus" et que ça m'amuse beaucoup. Peut-être aussi que plus d'une fois, je me suis retrouvé face à un process qui semblait attendre infiniment. Quand ça vous arrive en production, sans outil de debug donc, la galère commence.

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2575-bienvenue-dans-la-matrice)  
Benoit nous explique comment utiliser des outils tels que lsof, strace et ltrace pour diagnostiquer un processus. Comment analyser l'état d'un processus et comprendre ce qui se passe.

*Ce que j'en ai pensé :*  
J'ai déjà assisté à une conférence de Benoît sur PHP Meminfo. Son style n'a pas changé et la recette fonctionne à nouveau. Il arrive à rendre accessible des outils qui sont de prime abord un peu compliqués à utiliser.

*La citation : "Bob, il vit pleinement sa vie de processus"*

## E-learning sans internet, ou presque
*Conférence animée par : [Richard Hanna](https://twitter.com/richardhanna)*

*Pourquoi j'ai choisi cette conférence ?*  
Parce que les Progressive Web App et le offline ce n'est pas ma spécialité. Même si le front, ce n'est pas la partie que je préfère, il est toujours utile d'approfondir ses connaissances.

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2445-e-learning-sans-internet-ou-presque)  
Richard nous explique comment développer une web app progressive "offline first" à l'aide de React. Il y parle de GraphQL, de Cache Storage, de Local Storage, de Service Worker et de manifest. Comment tous ces outils sont combinés pour réduire la consommation de données.

*Ce que j'en ai pensé :*  
Cette conférence a été pour moi une première piqûre de rappel. En 2018 tout le monde n'a pas encore une connexion internet fiable et continue. Je salue l'aspect éthique de ce projet. Au passage, cela m'a permis de mieux comprendre comment le manifest, les Service Workers et le Local Storage se combinent pour offrir de la navigation offline.

## It FIGures
*Conférence animée par : [Sara Golemon](https://twitter.com/saramg)*

*Pourquoi j'ai choisi cette conférence ?*  
Parce que je sais tout le travail que Sara fait au quotidien pour PHP et au sein du FIG. J'étais curieux de savoir ce qu'elle a à en dire.

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2630-it-figures)  
Sara nous présente le FIG, ses objectifs, sa composition et passe en revue les différentes PSR et leur statut. Elle en profite pour nous inviter à rejoindre le FIG.

*Ce que j'en ai pensé :*  
Je suis resté sur ma faim. Sara a expliqué qu'elle a volontairement choisi l'une de ses conférences les plus abordables pour éviter que la barrière de la langue ne vienne s'ajouter à un sujet complexe. En voyant la désertion de la salle avant le début de sa conférence, je ne peux que lui donner raison. Mais je suis persuadé qu'elle a tout un tas de talks que j'aurais trouvé plus intéressants dans ses cartons.

## Sans documentation, la fonctionnalité n'existe pas !
*Conférence animée par : [Sarah Haïm-Lubczanski](https://twitter.com/sarahhaim)*

*Pourquoi j'ai choisi cette conférence ?*  
La documentation c'est ce qui fait la différence entre une librairie / un projet facile à prendre en main et impossible à utiliser si on ne l'a pas développé. Mais comment écrire une bonne documentation ?

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2607-sans-documentation-la-fonctionnalite-n-existe-pas)  
Sarah nous présente les critères de qualité d'une documentation. Comment la créer, la mettre à jour, la valoriser et l'améliorer. Elle nous présente également quelques outils pour générer de la documentation.

*Ce que j'en ai pensé :*  
Je suis le premier à râler quand il n'y a pas de documentation mais également le premier à râler quand je dois en écrire. Un bon rappel sur le fait que la documentation fait partie du produit / de la fonctionnalité.

## CQRS, Fonctionnel, Event Sourcing & Domain Driven Design
*Conférence animée par : [Arnaud Lemaire](https://twitter.com/@lilobase)*

*Pourquoi j'ai choisi cette conférence ?*  
C'était un peu ma conférence "récré". Celle qui parle de tout un tas de choses donc je suis convaincu depuis longtemps mais que je n'ai pas l'occasion d'appliquer au quotidien.

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2628-cqrs-fonctionnel-event-sourcing-domain-driven-design)  
Comme le titre l'indique, le sujet couvert est très vaste. Arnaud nous présente le Domain Driven Design et son focus sur l'intention utilisateur. Point intéressant, le CQRS est présenté d'abord indépendamment de l'Event Sourcing. Cela permet de mieux séparer les concepts.

*Ce que j'en ai pensé :*  
Beaucoup trop de contenu. Afin de tout couvrir dans le temps imparti, tout est allé très vite et on passe sur des concepts clés en quelques secondes. C'est probablement une des conférences que j'ai le moins retenu car tout est allé trop vite.

*La citation : "Ne jamais écrire du code qui ne répond pas à un besoin métier"*

## Ethique et macarons
*Conférence animée par : [Laurent Chemla](https://twitter.com/laurentchemla)*

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2641-ethique-et-macarons)  
Le format est très différent des autres conférences. C'est un débat en format questions - réponses qui nous est proposé. Quelques semaines après le scandale Cambridge Analytica, Laurent nous emmène au coeur du débat sur la place de l'éthique dans nos métiers.

*Ce que j'en ai pensé :*  
Le format était intéressant bien qu'un peu déroutant au début. Laurent est l'un de ses conférenciers au parcours un peu hors-norme dont l'humilité force le respect (cf la citation)

*La citation : "je crois que moi et d’autres développeurs on s’est plantés !"*

## REST ou GraphQL ? Exemples illustrés avec Symfony et API Platform
*Conférence animée par : [Kévin Dunglas](https://twitter.com/dunglas)*

*Pourquoi j'ai choisi cette conférence ?*  
Parce que j'ai entendu un peu tout et n'importe quoi sur GraphQL et que n'ayant jamais pris le temps d'approfondir le sujet,  je ne savais pas quoi en penser.

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2644-rest-ou-graphql-exemples-illustres-avec-symfony-et-api-platform)  
La conférence est centrée autour des possibilités d'API Platform.  Kevin revient sur les bases de chacun des concepts et nous présente les similarités et différences.

*Ce que j'en ai pensé :*  
J'ai aimé la manière neutre de présenter les deux technologies. On sent que Kévin maîtrise son sujet et connaît bien l'écriture d'APIs via ces deux technologies. Comme toujours, pour le choix de l'une ou l'autre, le contexte est roi.

## Caching with PSRs
*Conférence animée par : [Hannes Van De Vreken](https://twitter.com/hannesvdvreken)*

*Pourquoi j'ai choisi cette conférence ?*  
J'ai un avis assez tranché sur la PSR-6 et j'étais curieux de savoir si cet avis était partagé et ce qui a conduit à l'adoption de cette interface.

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2588-caching-with-psrs)  
C'est l'une des conférences qui part des bases. Qu'est-ce que le cache et pourquoi le besoin d'une standardisation ?
Puis on passe en revue les deux PSRs liées au cache ([6](https://www.php-fig.org/psr/psr-6/) et [16](https://www.php-fig.org/psr/psr-16/)). On voit les détails de chacune des deux interfaces.

*Ce que j'en ai pensé :*  
Une conférence que j'ai trouvée facile à suivre car bien rythmée. Le volume de contenu était bien dosé par rapport à la durée de la conférence, ce qui laissait au conférencier le temps d'expliquer chaque concept présenté.

*La citation : "Your app should not fail if your caching layer fails"*

## GRAOU : La production ferroviaire collaborative

*Conférence animée par : [Nicolas Wurtz](https://twitter.com/@graou_sncf)*

*Pourquoi j'ai choisi cette conférence ?*  
Principalement par curiosité. J'ai eu l'impression lors de ce PHP Tour de préférer les conférences les moins techniques. J'ai donc choisi celle de Nicolas. (Spoiler : Ça s'est confirmé ).

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2586-graou-la-production-ferroviaire-collaborative)  
Nicolas nous présente son application GRAOU. Un outil créé au départ pour un besoin personnel : numériser les plannings papier. De là suivent tout un tas d'évolutions dans les fonctionnalités mais toujours orientées autour d'un même but : simplifier la vie des utilisateurs et créer du lien entre eux.

*Ce que j'en ai pensé :*  
Probablement la meilleure conférence que j'ai vu et au vu de la réaction de la salle, je pense ne pas avoir été le seul. Nicolas a réussi l'exploit de nous faire aimer la SNCF un jour de grève ! En tout cas il nous rappelle que nos applications n'ont qu'un seul but : servir leurs utilisateurs. Si vous ne devez voir ou revoir qu'une des conférences données, c'est celle-ci que je vous conseille.

*La citation : "On a créé du lien grâce à l'outil numérique"*

## Traduire efficacement une application Symfony
*Conférence animée par : [Mathieu Santostefano](https://twitter.com/welcomattic)*

*Pourquoi j'ai choisi cette conférence ?*  
De ce que j'ai pu voir, la gestion des traductions a toujours un workflow un peu moyen. Il y a toujours une étape dans le process qui paraît mal à propos. Mais j'étais curieux de voir si il était possible aujourd'hui de faire mieux.

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2538-traduire-efficacement-une-application-symfony)  
Mathieu nous présente ce qui doit être traduit dans une application et les outils à disposition pour le faire (des plus simples aux plus avancés).

*Ce que j'en ai pensé :*  
C'était intéressant. Et les solutions SAAS semblent apporter plus de souplesse dans le workflow de gestion des traductions. J'en prends bonne note pour la prochaine fois que j'aurais ce type de problématique à gérer.

## Décryptez votre contrat de travail
*Conférence animée par : [Hélène Schapira](https://twitter.com/@libellule)*

*Pourquoi j'ai choisi cette conférence ?*  
Le sujet a attiré ma curiosité. Il faut dire qu'un contrat de travail est écrit dans un jargon auquel je ne comprends pas grand chose. Et puis, j'avais un bon feeling avec les conférences non techniques.

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2500-decryptez-votre-contrat-de-travail)  
Le sujet est vaste et Hélène nous explique les différentes contraintes que doit respecter un contrat. Elle fait un gros effort de vulgarisation des termes employés dans un langage qui nous parle à tous. Elle revient sur les syndicats, la durée du travail, la rémunération et les déplacements professionnels.

*Ce que j'en ai pensé :*  
La conférence était intéressante notamment parce qu'elle m'a permis de me rendre compte à quel point personne n'a jamais pris le temps de m'expliquer ce qui y a été dit.

## Merci de laisser ce code dans l'état dans lequel vous aimeriez le trouver
*Conférence animée par : [Cédric Spalvieri](https://twitter.com/le_skwi)*

*Pourquoi j'ai choisi cette conférence ?*  
Parce que la maintenance de code, c'est toujours un sujet intéressant. C'est ce qui nous occupe la majorité du temps.

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2474-merci-de-laisser-ce-code-dans-l-etat-dans-lequel-vous-aimeriez-le-trouver)  
Cédric nous parle de bon code, de dette technique et surtout de communication au sens large. Il y évoque la charge cognitive, les design pattern, la documentation, les code reviews et les feedback loops.

*Ce que j'en ai pensé :*  
L'approche de cette conférence est différente de ce que j'ai pu voir sur le sujet. Ici, tout est question de communication. Cela donne un autre visage à la plupart de ces aspects.

*La citation : "Code toujours comme si la personne qui va maintenir ton code est un violent psychopathe qui sait où tu habites"*

## La pire meilleure idée : faire du batch processing avec Doctrine
*Conférence animée par : [Romain Monceau](https://twitter.com/RomainMonceau)*

*Pourquoi j'ai choisi cette conférence ?*  
Parce que j'adore râler injustement contre Doctrine. Faire du batch processing avec Doctrine est effectivement une très mauvaise idée. Et en même temps, j'étais sûr que Doctrine est suffisamment bien fait pour s'en sortir honorablement.

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2523-la-pire-meilleure-idee-faire-du-batch-processing-avec-doctrine)  
Romain aborde les problèmes courants rencontrés lors de traitements de gros volume avec Doctrine et y apporte des solutions.

*Ce que j'en ai pensé :*  
La conférence va assez loin dans les différentes optimisations possibles. Suffisamment pour j'en retienne quelques points intéressants pour de futures utilisations.

La citation : "Doctrine has not been done for batch processes"

## Jouons tous ensemble à un petit jeu
*Conférence animée par : [Thomas Sieffert](https://twitter.com/CaporalDead)*

*Le contenu :*  
[Retrouvez la conférence ici](https://afup.org/talks/2642-jouons-tous-ensemble-a-un-petit-jeu)  
Conférence sur un format différent. On participe à un petit jeu et on apprend comment est géré l'aspect temps réel.

*Ce que j'en ai pensé :*  
Le format était original mais très déroutant. Au final j'ai eu l'impression qu'on a passé beaucoup de temps sur la partie jeu et il a donc fallu passer très vite sur la partie technique.

## Conclusion
Cette édition du PHP Tour a été une réussite.  
Le seul bémol pour moi était le taux de présence aux conférences en anglais surtout au vu de la qualité des conférencières et conférenciers présents. Je me demande si c’est dû à la barrière de la langue.   
Un grand bravo à l’AFUP pour l'organisation. Tout s'est déroulé sans accroc et les timings ont été respectés. Petit aparté sur le lieu : le cinéma était une excellente idée. Aucun problème de visibilité de l'écran et être assis confortablement fait toute la différence. Merci également à toutes les conférencières et conférenciers.



