---
layout: post
title: Refonte de notre interface e-commerce de choix de points de retrait
author: agallou
date: 2018-03-27 11:00:00+01:00
---


# Introduction

Sur [decitre.fr](https://www.decitre.fr), nos clients peuvent récupérer leurs achats de différentes façons :

* en livraison à domicile,
* dans l'un de nos magasins en région Rhône-Alpes ou région parisienne,
* en point relais (via Relais colis ou Mondial Relay).

De plus, sur nos sites en marque blanche ([Uculture](https://www.uculture.fr/) et [Carrefour Livres](https://livres.carrefour.fr/)), les clients peuvent récupérer leur commande dans l'un des nombreux magasins de ces enseignes.

Il y a quelques temps, nous avons effectué une refonte de la façon dont nos clients sélectionnent leur lieu de retrait dans notre tunnel de commande.

Après avoir constitué un panier, il faut choisir le mode et le lieu de livraison. En cas de livraison en point retrait, cela passe par l’affichage d’une fenêtre modale. C’est en grande partie cette modale qui a été refondue.

Dans cet article nous allons présenter pourquoi cette refonte a été effectuée et comment elle a été mise en place. Vous trouverez ci-dessous des images de la modale de choix de point de retrait avant et après la refonte.

<figure>
    <img
        class="lozad"
        width="890" height="636"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAOABQDASIAAhEBAxEB/8QAFwAAAwEAAAAAAAAAAAAAAAAAAAECBP/EABQBAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhADEAAAAdNJiJD/xAAWEAADAAAAAAAAAAAAAAAAAAABECD/2gAIAQEAAQUCRj//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/AT//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAg/9oACAEBAAY/Al//xAAaEAABBQEAAAAAAAAAAAAAAAAAARARMWEh/9oACAEBAAE/IZxrUQcFXD//2gAMAwEAAgADAAAAELDf/8QAFREBAQAAAAAAAAAAAAAAAAAAABH/2gAIAQMBAT8QR//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8QP//EABwQAQABBAMAAAAAAAAAAAAAAAEAESFBkTFRcf/aAAgBAQABPxCxpRqHgwGDjqApmXRFuNz/2Q=="
        data-src="{{ '/assets/posts/refonte-choix-points-retraits/relais_colis_avant-1.jpg' | prepend: site.baseurl  }}"
        data-srcset="{{ '/assets/posts/refonte-choix-points-retraits/relais_colis_avant-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/refonte-choix-points-retraits/relais_colis_avant-2.jpg' | prepend: site.baseurl  }} 2x"
    />
    <noscript><img src="{{ '/assets/posts/refonte-choix-points-retraits/relais_colis_avant-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Modale de choix de Relais Colis avant la refonte</figcaption>
</figure>

<figure>
    <img 
        class="lozad" 
        width="890" height="632"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAOABQDASIAAhEBAxEB/8QAFwAAAwEAAAAAAAAAAAAAAAAAAAECBP/EABUBAQEAAAAAAAAAAAAAAAAAAAAB/9oADAMBAAIQAxAAAAHRUuGBX//EABUQAQEAAAAAAAAAAAAAAAAAABEg/9oACAEBAAEFAmv/xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/AT//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAg/9oACAEBAAY/Al//xAAYEAEBAQEBAAAAAAAAAAAAAAABACEQMf/aAAgBAQABPyHEM+8Mm//aAAwDAQACAAMAAAAQjA//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/ED//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/ED//xAAaEAADAQEBAQAAAAAAAAAAAAAAAREhMUGh/9oACAEBAAE/EHWTzxDH2ENs+ETddFWEsOtdP//Z"
        data-src="{{ '/assets/posts/refonte-choix-points-retraits/relais_colis_et_mondial_relay_apres-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/refonte-choix-points-retraits/relais_colis_et_mondial_relay_apres-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/refonte-choix-points-retraits/relais_colis_et_mondial_relay_apres-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/refonte-choix-points-retraits/relais_colis_et_mondial_relay_apres-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Modale de choix de Relais Colis ou Mondial Relay après la refonte.</figcaption>
</figure>


# Le fonctionnement avant la refonte

## Mondial Relay

Pour afficher la modale listant les points Mondial Relay, nous appelions en PHP le webservice SOAP de Mondial Relay. Ce webservice permettait de lister les points à partir de la ville et/ou du code postal.

## Relais Colis

Pour afficher la modale listant les points Relais Colis, nous appelions un webservice fourni par Relais Colis et hebergé sur l'un de nos serveurs.

## Magasins U
La liste des magasins U était maintenue dans une table spécifique dans notre base qui était utilisée pour lister des magasins dans le tunnel.


# Les problématiques

## De plus en plus de types de points de retrait

Après la livraison en Relais Colis, en Mondial Relay, dans les magasins U ainsi que dans les magasins Decitre, est venu le moment d’ajouter un cinquième type de point de retrait : la livraison en magasin Carrefour (dans le cadre de la marque blanche [livres.carrefour.fr](https://livres.carrefour.fr)).

Jusqu’à présent, chaque type de point de retrait était géré indépendamment :  la maintenance n’était donc pas facilitée, le coût de l’ajout d’une fonctionnalité dans les modules était multiplié car il fallait la réécrire autant de fois que de types de point de retrait.

L’ajout de ce cinquième type nous a donc amené à factoriser cette gestion des points de retrait.

## Des problèmes de disponibilité/performance des webservices

Par moment, des services comme Mondial Relay n'étaient pas disponibles.
Nous devions donc désactiver temporairement ce mode de livraison.
Cela fait donc des fonctionnalités en moins pour nos clients, ce qui peut nous amener à des pertes de vente.
Afin d'éviter cela, nous souhaitions passer sur un système non basé sur un service tiers (ou un service tiers en lequel nous pouvions avoir confiance).


En plus des indisponibilités, nous avions aussi des problèmes de performance lors des appels. A l’instar des indisponibilités, lors des lenteurs sur le webservice, nous désactivions la fonctionnalité.
Un tel service, présent dans le tunnel de commande se doit d’être performant et résiliant : en effet si celui-ci est lent, nous pouvons perdre des commandes.

## Un module uStoreLocator problématique

La carte que nous utilisions pour notre marque blanche [uculture.fr](https://www.uculture.fr) utilisait le module Magento [uStoreLocator](https://secure.unirgy.com/products/ustorelocator/).

Le module nécessitait l’utilisation de l’extension PHP [ionCube](http://www.ioncube.com/), ce qui posait plusieurs problèmes :

* ionCube n’était pas disponible en PHP 7 lorsque nous avons commencé à mettre à jour notre infrastructure dans cette version de PHP.
* Ce module propriétaire nécessitait une license.
* Les deux points cités précédemment ne simplifiaient pas l’utilisation de la carte en environnement de développement.


## Obligation de maintenir des serveurs sous Windows
La mise en place du serveur Relais Colis nous obligeait à avoir une machine sous Windows dans notre infrastructure (deux dans les faits, car nous avons une machine en fallback si la première venait à ne plus fonctionner). Maintenir ce serveur avait donc un coût à la fois en frais de serveur et temps de maintenance.


## Une interface pouvant être améliorée

Voici l’interface de choix des points Relais Colis avant notre migration :

<figure>
    <img
        class="lozad"
        width="890" height="636"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAOABQDASIAAhEBAxEB/8QAFwAAAwEAAAAAAAAAAAAAAAAAAAECBP/EABQBAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhADEAAAAdNJiJD/xAAWEAADAAAAAAAAAAAAAAAAAAABECD/2gAIAQEAAQUCRj//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/AT//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAg/9oACAEBAAY/Al//xAAaEAABBQEAAAAAAAAAAAAAAAAAARARMWEh/9oACAEBAAE/IZxrUQcFXD//2gAMAwEAAgADAAAAELDf/8QAFREBAQAAAAAAAAAAAAAAAAAAABH/2gAIAQMBAT8QR//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8QP//EABwQAQABBAMAAAAAAAAAAAAAAAEAESFBkTFRcf/aAAgBAQABPxCxpRqHgwGDjqApmXRFuNz/2Q=="
        data-src="{{ '/assets/posts/refonte-choix-points-retraits/relais_colis_avant-1.jpg' | prepend: site.baseurl  }}"
        data-srcset="{{ '/assets/posts/refonte-choix-points-retraits/relais_colis_avant-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/refonte-choix-points-retraits/relais_colis_avant-2.jpg' | prepend: site.baseurl  }} 2x"
    />
    <noscript><img src="{{ '/assets/posts/refonte-choix-points-retraits/relais_colis_avant-1.jpg' | prepend: site.baseurl  }}" /></noscript>
</figure>


Et voici la même interface pour Mondial Relay :

<figure>
    <img
        class="lozad"
        width="890" height="641"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAOABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAQAE/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEAMQAAAB0shEf//EABYQAQEBAAAAAAAAAAAAAAAAABEAIP/aAAgBAQABBQLK3//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQMBAT8BP//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8BP//EABQQAQAAAAAAAAAAAAAAAAAAACD/2gAIAQEABj8CX//EABkQAAIDAQAAAAAAAAAAAAAAAAABEBExkf/aAAgBAQABPyHghlQtD//aAAwDAQACAAMAAAAQR8//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/ED//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/ED//xAAbEAEAAgMBAQAAAAAAAAAAAAABABEhMZFBUf/aAAgBAQABPxAc1Qi1g5ALo5Ap5yBXsMUv5mf/2Q=="
        data-src="{{ '/assets/posts/refonte-choix-points-retraits/mondial_relay_avant-1.jpg' | prepend: site.baseurl  }}"
        data-srcset="{{ '/assets/posts/refonte-choix-points-retraits/mondial_relay_avant-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/refonte-choix-points-retraits/mondial_relay_avant-2.jpg' | prepend: site.baseurl  }} 2x"
    />
    <noscript><img src="{{ '/assets/posts/refonte-choix-points-retraits/mondial_relay_avant-1.jpg' | prepend: site.baseurl  }}" /></noscript>
</figure>



Nous pouvons constater plusieurs différences :

* Au niveau de la recherche, celle de Relais Colis se base seulement sur le code postal, tandis que la recherche Mondial Relay utilise à la fois la ville et le code postal. Cette recherche se fait d’ailleurs dans deux champs différents, ce qui **n’est pas ergonomique**.
* Le **niveau d’information est différent selon le transporteur** : les horaires sont seulement affichés pour Relais Colis.
* L**'affichage de la carte est différent** : là où Mondial Relay utilise des lettres pour afficher les points (liés à la même lettre dans la liste de droite), Relais Colis utilise son logo pour afficher les points.


Ces interfaces, issues de modèles fournis par les transporteurs, ont la même utilité : choisir un point de retrait ; pourtant, bien que sur le même site, les points sont affichés différemment, et le périmètre fonctionnel est différent.

# Objectifs de la refonte

## Afficher sur une carte des points sans widget tiers

Nous avions un développement spécifique pour afficher sur une carte les points de retrait disponibles sur le site uculture.fr en dehors du tunnel. Une des volontés était de factoriser cette partie afin d’avoir un affichage de carte similaire entre celui du tunnel de commande et hors de celui-ci.

## Une interface unifiée

Un des objectifs était de permettre d'afficher les points Relais Colis et Mondial Relay sur une même carte : cela permet à nos clients de voir d'un coup d'oeil les points d'une zone, ainsi que leurs horaires, peu importe le transporteur.

En général les utilisateurs sont plus intéressés par la localisation et les horaires du retrait que par le choix du transporteur.

Avant mise en production complète, les performances de cette nouvelle carte unifiée furent comparées à celles de la version précédente (où les cartes des deux transporteurs sont séparées), dans le cadre d’un test A/B, qui nous a permis de valider qu’il y avait au moins autant de commandes avec cette nouvelle version.

## Une interface similaire selon le mode de commande

Comme vu précédemment les modales de choix de point Relais Colis et Mondial Relay présentaient une interface différente. Un des objectifs était d’uniformiser cet affichage.

## Ergonomie

L'interface devra être plus ergonomique : ne pas avoir deux champs ville et code postal, mais un champ unique de recherche où l’on peut saisir une adresse complète ou une partie de l’adresse.

# La réalisation

Cette carte a été réalisée en deux grosses étapes :

* centralisation des informations sur les points
* création de l'interface

## Centralisation des informations

Afin de mettre en place notre nouvelle interface d’affichage des points de retrait, nous avons tout d’abord centralisé les informations sur ces points dans une table MySQL.

Les différents transporteurs (Relais Colis, Mondial Relay) nous envoient chaque jour des fichiers contenant l’ensemble des points.

Le format de ces fichiers est différent pour chaque transporteur, nous avons donc une passe d’harmonisation pour les faire rentrer dans notre schéma.

Nous avons donc, entre-autres, ces informations dans notre table :

* nom du point
* adresse / code postal / ville / pays du point
* jour de début d’ouverture du point, jour de début de fermeture définitive du point
* pour chaque jour de la semaine 4 horaires, pour indiquer les heures d’ouverture
* une table liée contenant les fermetures temporaires (congés)
* un type de point (le transporteur)

## Affichage de la carte

### Leaflet

Pour utiliser la carte nous utilisons la librairie javascript [Leaflet](http://leafletjs.com/). Leaflet est une librairie de référence pour afficher des cartes, celle-ci nous permet de contrôler le fonds de carte, de facilement ajouter des points sur la carte, et globalement nous laisse beaucoup de contrôle sur comment la présenter.

Pour ce qui est du fond de carte nous avons choisi d’utiliser Google Maps. En effet, Leaflet permet d’utiliser de nombreux fournisseurs de fonds de carte, mais des différents tests que nous avons effectués, aucun ne dépassait Google Maps en terme de lisibilité.

Une des difficultés qui se pose quand on affiche une telle carte est de choisir quand mettre à jour son contenu (les points relais / de retrait que nous affichons). Cette mise à jour se fait lors des déplacements sur la carte, mais pas tous. Quand un utilisateur clique sur un item de la liste à droite, nous centrons le point en question sur la carte et affichons une bulle avec les infos du point. Dans ce cas nous ne mettons pas à jour les points sur la nouvelle zone affichée afin de conserver la même liste et ne pas en perturber l’utilisation.

## Recherche de points

### Geocoding d’adresse

* Comme nous l’avons vu précédemment, les anciennes versions des interfaces de choix de point de retrait permettaient de ne faire des recherches que via le code postal, avec parfois la ville. Nous avons décidé de n’avoir qu’un seul champ de recherche, où l’utilisateur peut y saisir l’adresse complète, la ville ou le code postal.
* Nous utilisons donc la librairie PHP [Geocoder](http://geocoder-php.org/Geocoder/) afin de transformer cette recherche utilisateur en coordonnées.
* Geocoder permet d’utiliser différents providers pour réaliser le geocoding : nous utilisons celui de Google. Il y a besoin de créer un compte pour l’utiliser, mais permet une utilisation gratuite en dessous de 2500 appels par jours.

### API de géolocalisation

La plupart des navigateurs supportent l’API [geolocation](https://caniuse.com/#feat=geolocation), une des méthodes pour se positionner sur la carte est donc de cliquer sur un bouton qui va faire un appel à cette API afin de géolocaliser le client. Nous évitons de faire l’appel directement lors de l’affichage de la modale afin de ne pas être trop intrusif (le navigateur affichera une demande d’autorisation d’accès à cette API).

### Filtrage des points à afficher

Nous avons plusieurs sources de zones à afficher :

* d’après l'**adresse saisie** dans la zone de recherche par l’utilisateur
* d’après l'**api de géolocalisation** du navigateur, quand l’utilisateur clique sur le bouton de géolocalisation
* d’après la **zone actuellement visible** sur la carte (quand l’utilisateur se déplace).


Dans les 2 premiers cas (adresse et API de géolocalisation), nous avons des coordonnées (latitude et longitude) : nous recherchons alors tous les points autour des coordonnées dans un rayon que nous augmentons jusqu’à trouver des points[a][b]. Dans ces cas, nous ordonnons les points en fonction de la proximité avec les coordonnées utilisées.

Dans le dernier cas (pour l'affichage d’après la zone visible sur la carte), il suffit d’utiliser la zone actuellement affichée et requêter la base via les coordonnées latitude et longitude du point nord est, latitude et longitude du point sud ouest.

Dans tous les cas, les recherches sont effectuées en utilisant les fonctions de [l'extension “spatial” de MySQL](https://dev.mysql.com/doc/refman/5.7/en/spatial-extensions.html). Nous pouvons utiliser ces fonctions car les coordonnées des points de retrait sont stockées dans un champ de type POINT.


### Règles de gestion

Un des avantages de cette refonte est la possibilité d’appliquer beaucoup plus facilement des règles de gestion sur l’affichage de la liste des points de retrait.

Certains points de retrait peuvent être temporairement fermés pour congés :

* Si la fermeture advient en dehors des dates de promesse de livraison, nous les affichons à titre informatif.
* Si la fermeture advient pendant les dates de promesse de livraison, le point sera alors masqué, pour éviter au client de se faire livrer dans un point inaccessible.

Un tel contrôle sur les règles d’affichage des points nous permet donc de fournir à nos clients un service de meilleure qualité en s’assurant que le point de retrait ne soit pas fermé, et éviter ainsi des problèmes à la livraison.

# Pistes d'amélioration

Nous avons passé en production cette nouvelle version du choix des points de retrait, mais nous avons de nouvelles idées d’évolutions pour la suite :

* Parfois certaines adresses ne peuvent être géocodées. Afin de limiter le nombre de recherches infructueuses, une possibilité serait de supprimer au fur et à mesure des mots de la recherche afin de tomber sur une recherche dont le geocoding fonctionne.
* Toujours dans l’optique d’améliorer la recherche, nous pourrions ajouter de l’autocomplétion. Pour cela une des pistes envisagées serait l’utilisation d’[Algolia Places](https://community.algolia.com/places/).

# Conclusion

Le projet a, au total, consommé environ une trentaine de jours homme, mais nous a permis de reprendre le contrôle sur ces données et d’offrir ainsi à nos clients une meilleure expérience d’achat sur decitre.fr et nos marques blanches.
