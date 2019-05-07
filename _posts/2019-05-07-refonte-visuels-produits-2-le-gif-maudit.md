---
layout: post
title: Refonte de nos 3 millions de visuels produits - Le GIF maudit
author: srogier
date: 2019-05-07 10:00:00+01:00
excerpt: Refonte de nos 3 millions de visuels produits - Le GIF maudit
image: /assets/posts/refonte-visuels-produits-2/post.png
---

Après plusieurs jours (voire semaines) d’effort, nous avons [précédemment récupéré 2.5 millions d’images](https://tech.decitre.fr/posts/refonte-visuels-produits-1-les-aventuriers-du-coffre-perdu) non redimensionnées ou optimisées pour un usage Web. Que va-t-on pouvoir en faire ?

Tous ces visuels sont dans des formats différents (GIF, JPEG, PNG, TIFF et parfois du BMP), dans des dimensions allant de moins d’une centaine de pixels de large à plusieurs milliers.

Toutes ces images ont un but : être utilisées sur nos différents sites pour illustrer notre catalogue de produits. Nous allons devoir réfléchir à comment mettre en place un mécanisme qui va servir à nos clients des images :
* d’un poids acceptable,
* de bonne qualité, peu importe le terminal utilisé (coucou le Retina),
* dans un format supporté par les navigateurs,
* le plus rapidement possible.

## Tout générer en amont pour ne servir que des fichiers statiques

L’un des objectifs de notre nouvelle plateforme d’images est de servir rapidement les visuels de nos produits.

C’était un des points faibles de notre infrastructure e-commerce basée sur Magento qui générait à la demande les visuels redimensionnés s’ils n’existaient pas, et donc devait vérifier à chaque appel la présence de l’image redimensionnée sur le disque (entraînant un coût sur la performance).

De plus, avec des sources pouvant faire plusieurs mégaoctets, il est difficile de s’attendre à ce qu’une génération d’image redimensionnée à la volée puisse se faire rapidement en quelques millisecondes. On avait donc parfois, pour la première génération, un coût en secondes qu’on faisait subir à nos clients (quand le redimensionnement de l’image ne partait pas en erreur, la [memory_limit](http://php.net/manual/en/ini.core.php#ini.memory-limit) ayant été franchie).


Sur nos sites, nous avons retravaillé l’utilisation des images pour réduire la gamme de tailles utilisées. Désormais, nous n’utilisons plus que 5 tailles d’images différentes en fonction du contexte, ce qui nous permet de mieux maîtriser la gamme d’images à utiliser et réduire l’espace de stockage dédié. 

<figure>
    <img 
        class="lozad" 
        width="600" height="381"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAANABQDASIAAhEBAxEB/8QAFwAAAwEAAAAAAAAAAAAAAAAAAAIDBP/EABUBAQEAAAAAAAAAAAAAAAAAAAAB/9oADAMBAAIQAxAAAAHZNUi4of/EABgQAQEBAQEAAAAAAAAAAAAAAAEAEQIS/9oACAEBAAEFAp6yHRdvNyYf/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPwE//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPwE//8QAFhAAAwAAAAAAAAAAAAAAAAAAECAx/9oACAEBAAY/Ako//8QAGBAAAwEBAAAAAAAAAAAAAAAAAAEhEUH/2gAIAQEAAT8hNiWFgZHC0Oof/9oADAMBAAIAAwAAABCc7//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQMBAT8QP//EABYRAAMAAAAAAAAAAAAAAAAAABARUf/aAAgBAgEBPxBwf//EABoQAQEBAQADAAAAAAAAAAAAAAERACExQWH/2gAIAQEAAT8QUCuOoROp6xwTzrdguSYRVc+YkBNbv//Z"
        data-src="{{ '/assets/posts/refonte-visuels-produits-2/gamme_image-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/refonte-visuels-produits-2/gamme_image-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/refonte-visuels-produits-2/gamme_image-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-2/gamme_image-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Notre gamme de tailles d’images utilisées sur le site</figcaption>
</figure>



Ces éléments font que nous avons décidé d’orienter notre plateforme vers une génération systématique et en amont des visuels redimensionnés afin de ne servir que des fichiers statiques déjà prêts et ainsi réduire les temps de chargement.

## Le choix du format

Nous avons envisagé l’utilisation de 3 formats pour cette refonte :
* PNG
* JPEG
* WebP

### PNG

[PNG](https://fr.wikipedia.org/wiki/Portable_Network_Graphics) est un format d’image capable de gérer la transparence et la compression sans perte. Nous avons rapidement éliminé ce format parmi nos choix, car si la qualité des visuels était au rendez-vous, le poids des fichiers était trop important par rapport aux formats gérant la compression avec pertes.

### JPEG

[JPEG](https://fr.wikipedia.org/wiki/JPEG) est un format de compression d’images créé au début des années 1990, qui permet une compression irréversible avec perte. C’est un format populaire, qu’on retrouve sur Internet ou pour la photographie numérique.

JPEG définit le format d’enregistrement et l’algorithme de décodage des fichiers. Il existe de multiples implémentations d’outils pour créer des JPEGs, plus ou moins performantes, mais qui produisent des images capables d’être décodées selon la définition de la norme.
### WebP

[WebP](https://fr.wikipedia.org/wiki/WebP) est un format développé par Google depuis 2011, gérant la compression avec ou sans perte ainsi que la transparence. La capacité de compression de WebP est [annoncée comme plus importante](https://developers.google.com/speed/WebP/gallery1) que celle de JPEG permettant ainsi de faire des fichiers plus légers à qualité visuelle équivalente.

Le problème de WebP est son support non universel par les navigateurs : au moment de faire nos choix techniques, seuls Chrome et Opéra [géraient nativement le format](https://caniuse.com/#feat=WebP).

La problématique autour du support WebP a beaucoup évolué en octobre 2018 avec les annonces successives de Microsoft et [Mozilla](https://bugzilla.mozilla.org/show_bug.cgi?id=1294490) sur le support de WebP dans les versions à venir de Firefox (version 65 publiée en janvier 2019) et Edge (version publiée en octobre 2018).

Il ne reste donc plus qu’à Safari de franchir également le pas.

Même s'il est désormais possible [d'utiliser des balises HTML pour gérer plusieurs formats](https://developer.mozilla.org/fr/docs/Apprendre/HTML/Comment/Ajouter_des_images_adaptatives_%C3%A0_une_page_web#Utilisez_largement_les_formats_d'image_modernes) en fonction du support navigateur, nous avons choisi pour notre première itération de ne gérer que le format JPEG.
 
 ```html
 <picture>
   <source type="image/jpeg" srcset="visuel_produit.jpg" media="(max-width: 800px)">
   <source type="image/webp" srcset="visuel_produit.webp"> 
   <img src="visuel_produit_par_défault.png" alt="Cas par défaut si aucune des sources n’est applicable">
 </picture>
 ```
 
Enfin, une fois notre plateforme rodée et un certain nombre d’évolutions développées sur nos sites Internet, nous ajouterons le support WebP.

## Un outil pour redimensionner les images

Le format de sortie étant désormais défini, il nous faut maintenant générer les différents visuels aux dimensions attendues.

D’abord, à partir des sources qui, je le rappelle, ne sont pas uniformes en termes de formats et dimensions, nous convertissons au format JPEG sans compression et en choisissant l’espace de couleur [sRGB](https://fr.wikipedia.org/wiki/SRGB).

Ce point est important, car certaines sources étaient au format [CMYK](https://fr.wikipedia.org/wiki/Quadrichromie), un format destiné à l’impression et cela avait un impact sur le rendu des couleurs utilisées.


<div class="container">
    <div class="row">
        <div class="col-md">
             <figure>
                 <img 
                     class="lozad" 
                     width="200" height="212"
                     src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAVABQDASIAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAAEDAv/EABYBAQEBAAAAAAAAAAAAAAAAAAEDAv/aAAwDAQACEAMQAAABtuRnVwS0hcB//8QAFxAAAwEAAAAAAAAAAAAAAAAAAAEREP/aAAgBAQABBQKEIQbyb//EABgRAAIDAAAAAAAAAAAAAAAAAAARARAS/9oACAEDAQE/AUZFFf/EABYRAQEBAAAAAAAAAAAAAAAAABEAEP/aAAgBAgEBPwFmc//EABQQAQAAAAAAAAAAAAAAAAAAADD/2gAIAQEABj8CH//EABsQAAMAAgMAAAAAAAAAAAAAAAABERBBITFx/9oACAEBAAE/IbUrHOz2ckhmxNzq4TH/2gAMAwEAAgADAAAAEJDo/wD/xAAZEQACAwEAAAAAAAAAAAAAAAAAAREhQWH/2gAIAQMBAT8QpbJPDkQj/8QAGREAAwADAAAAAAAAAAAAAAAAAAERIUFx/9oACAECAQE/ELbwdlPZWf/EAB4QAQACAgEFAAAAAAAAAAAAAAEAESExQVFhgZHR/9oACAEBAAE/ELGw94uVjyQw+JdFNuXOosBVUcba63uJeX3CrtgVguf/2Q=="
                     data-src="{{ '/assets/posts/refonte-visuels-produits-2/diff-cmyk-original.jpg' | prepend: site.baseurl  }}" 
                     data-srcset="{{ '/assets/posts/refonte-visuels-produits-2/diff-cmyk-original.jpg' | prepend: site.baseurl  }}" 
                 />
                 <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-2/diff-cmyk-original.jpg' | prepend: site.baseurl  }}" /></noscript>
             
                 <figcaption>Image originale avec l’espace de couleur CMYK</figcaption>
             </figure>

        </div>
        <div class="col-md">
            <figure>
                <img 
                    class="lozad" 
                    width="200" height="213"
                    src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAVABQDASIAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAAECA//EABUBAQEAAAAAAAAAAAAAAAAAAAED/9oADAMBAAIQAxAAAAFbzDaE0I1oH//EABcQAQEBAQAAAAAAAAAAAAAAABEAARD/2gAIAQEAAQUCIiLd4Rz/xAAWEQEBAQAAAAAAAAAAAAAAAAARABD/2gAIAQMBAT8BIjP/xAAWEQEBAQAAAAAAAAAAAAAAAAARABD/2gAIAQIBAT8BZnP/xAAUEAEAAAAAAAAAAAAAAAAAAAAw/9oACAEBAAY/Ah//xAAZEAADAQEBAAAAAAAAAAAAAAAAARExEHH/2gAIAQEAAT8htaOT2XEMwVawniQ//9oADAMBAAIAAwAAABA7J3//xAAZEQACAwEAAAAAAAAAAAAAAAAAEQEhUTH/2gAIAQMBAT8Qp0fBMFB//8QAGBEAAwEBAAAAAAAAAAAAAAAAAAERUSH/2gAIAQIBAT8QpvhOlaVn/8QAHRABAAMAAQUAAAAAAAAAAAAAAQARITFRYZGh0f/aAAgBAQABPxBYW53GLpfcMfEUQNdd4lMTVRkbve4p18wN3ACi6n//2Q=="
                    data-src="{{ '/assets/posts/refonte-visuels-produits-2/diff-cmyk-cible.jpg' | prepend: site.baseurl  }}" 
                    data-srcset="{{ '/assets/posts/refonte-visuels-produits-2/diff-cmyk-cible.jpg' | prepend: site.baseurl  }}" 
                />
                <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-2/diff-cmyk-cible.jpg' | prepend: site.baseurl  }}" /></noscript>
            
                <figcaption>La même image convertie en sRGB</figcaption>
            </figure>
        </div>
    </div>
</div>

Ensuite, nous générons les variantes aux dimensions voulues et attendues sur nos sites Internet, en laissant la qualité de l’image en sortie à 100. Cela nous permet de séparer les responsabilités à chaque outil entre ceux qui préparent l’image et ceux qui compressent.

Pour ces transformations, tant le redimensionnement que le changement d’espace de couleur, nous utilisons [ImageMagick ](https://www.imagemagick.org/script/index.php) et son outil en CLI `convert` qui nous permet de chaîner les différentes opérations en une seule commande.

## Optimiser les images pour un usage Web

Nos visuels sont propres, à la bonne taille et au bon format, mais leur poids est trop important pour un usage Web et va dégrader les performances de nos sites Internet en augmentant les temps de chargement.

Il existe sur le marché plusieurs outils pour optimiser les images qui, en fonction d’une qualité donnée, vont générer des fichiers plus ou moins propres, plus ou moins lourds dans un délai plus ou moins raisonnable.

Il faut aussi noter qu’une même valeur de qualité passée dans différents outils va donner des images différentes avec des artefacts de compression plus ou moins prononcés.

On va donc, pour un même échantillon, effectuer des mesures en faisant varier :
* les outils de compression,
* la qualité du JPEG,
* la taille du visuel en entrée.

Parmi les métriques à surveiller, nous avons choisi :
* le poids de l’image générée,
* le temps de génération de l’image optimisée,
* le score DSSIM par rapport à l’original.

> Pour rappel le score DSSIM est un calcul de dissimilarité entre images, qui nous permet d’évaluer si deux images sont similaires ou non. Nous avions déjà utilisé cet outil lors de [la constitution du catalogue de visuel originaux](https://tech.decitre.fr/posts/refonte-visuels-produits-1-les-aventuriers-du-coffre-perdu#automatiser-les-comparaisons).

Pour chacune des images sources de notre échantillon, nous allons générer les différentes tailles d’images attendues sur nos sites.

Grâce à ces mesures, notre objectif va être de déterminer quel est le couple _{outil, valeur de qualité}_ qui va nous donner l’image la plus légère tout en limitant la dégradation par rapport à la source.

### Les outils de compression mis en concurrence

Nous avons testé trois outils pour optimiser la génération d’images au format JPEG, mais nous avons également profité de ce benchmark pour intégrer la génération au format WebP afin d’avoir des métriques pour l’itération suivante du projet.

Il existe différentes bibliothèques capables d’encoder au format JPEG. Une des implémentations libres et parmi les plus anciennes est [libjpeg](http://www.ijg.org/). Au fil des années et des évolutions est apparu [libjpeg-turbo](https://libjpeg-turbo.org/), version plus rapide de `libjpeg`.

La plupart des outils que nous allons comparer se basent sur ces implémentations.

#### MozJPEG

[MozJPEG ](https://github.com/mozilla/mozjpeg) est une suite d’outils de manipulation fournie par Mozilla et est basée sur `libjpeg-turbo`. Elle est censée réduire le poids des visuels par rapport à `libjpeg` de près de 5% à qualité équivalente.

Cet outil, créé en 2014 par Mozilla, était la réponse au format WebP de Google avec l’objectif de réduire le poids des images tout en conservant la compatibilité avec les navigateurs grâce au format JPEG.

Pour notre comparatif, nous allons utiliser l’outil en CLI `cjpeg` qui permet de créer des images compressées et progressives pour une qualité souhaitée.

#### jpegoptim

Autre outil de compression d’image au format JPEG et également basé sur une implémentation de `libjpeg`, [jpegoptim](https://www.kokkonen.net/tjko/src/man/jpegoptim.txt) gère de la génération progressive, avec ou sans perte (même si nous n’allons étudier que la compression avec perte de données).

#### Guetzli

Projet de Google, [Guetzli](https://github.com/google/guetzli) permet la compression des JPEG (non progressifs uniquement) et annonce des fichiers plus légers de l’ordre de 20 à 30% à qualité équivalente par rapport à libjpeg, ce qui est assez prometteur.

#### WebP

Enfin pour WebP, nous allons utiliser le [convertisseur](https://developers.google.com/speed/webp/) fourni par Google qui annonce un gain de 25 à 34% par rapport au JPEG à score DSSIM équivalent.

### Les résultats du benchmarking

Voici les résultats de notre analyse. Pour celle-ci, nous nous sommes à nouveau fixé une valeur seuil DSSIM de 0.0015 pour définir si les deux images comparées sont similaires.  
Cette valeur a été choisie arbitrairement, à partir d’un échantillon, où nous avions estimé qu’au-delà de ce seuil, l’image subit une trop forte dégradation et que la qualité demandée est trop faible par rapport aux critères que nous nous sommes fixés.

Pour cet article, nous allons nous concentrer sur la taille de visuel utilisée en tant que visuel principal sur nos fiches produits.

Pour comprendre les résultats, nous avons commencé par construire des tableaux de données brutes où, image après image, nous listons pour chaque tuple _{taille d’image, outil, valeur de qualité}_, les métriques recueillies.

<figure>
    <img 
        class="lozad" 
        width="600" height="509"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAARABQDASIAAhEBAxEB/8QAGAABAQEBAQAAAAAAAAAAAAAAAAIBAwT/xAAWAQEBAQAAAAAAAAAAAAAAAAAAAgH/2gAMAwEAAhADEAAAAfRlRjXMrtAmAv8A/8QAGRAAAgMBAAAAAAAAAAAAAAAAAAEQETES/9oACAEBAAEFAizqXsPf/8QAFhEAAwAAAAAAAAAAAAAAAAAAABAR/9oACAEDAQE/ASP/xAAUEQEAAAAAAAAAAAAAAAAAAAAg/9oACAECAQE/AR//xAAUEAEAAAAAAAAAAAAAAAAAAAAw/9oACAEBAAY/Ah//xAAbEAACAgMBAAAAAAAAAAAAAAABEACRESExQf/aAAgBAQABPyHcyhIL22Hto//aAAwDAQACAAMAAAAQ6Mi8/8QAGBEAAgMAAAAAAAAAAAAAAAAAAAEQETH/2gAIAQMBAT8QElQsP//EABcRAAMBAAAAAAAAAAAAAAAAAAABEBH/2gAIAQIBAT8QZo5//8QAGxAAAwACAwAAAAAAAAAAAAAAAAExEXEhQWH/2gAIAQEAAT8Qa6swP15GGG+RQc6FhQjoWP/Z"
        data-src="{{ '/assets/posts/refonte-visuels-produits-2/recap_metrique_bench-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/refonte-visuels-produits-2/recap_metrique_bench-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/refonte-visuels-produits-2/recap_metrique_bench-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-2/recap_metrique_bench-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Extrait de tableau de métrique</figcaption>
</figure>

En version plus simple à lire, nous générons des tableaux de récapitulatifs par outil et taille d’image avec des données agrégées pour trouver le compromis qualité d’image/poids le plus acceptable.


<figure>
    <img 
        class="lozad" 
        width="600" height="484"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAQABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAIE/8QAFQEBAQAAAAAAAAAAAAAAAAAAAQL/2gAMAwEAAhADEAAAAdACAV//xAAXEAEBAQEAAAAAAAAAAAAAAAABABAR/9oACAEBAAEFAmLrMZ//xAAWEQEBAQAAAAAAAAAAAAAAAAAAARH/2gAIAQMBAT8BbH//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAg/9oACAEBAAY/Al//xAAZEAEAAwEBAAAAAAAAAAAAAAAAESExAWH/2gAIAQEAAT8hotL2ZZ6h/9oADAMBAAIAAwAAABDkL//EABcRAQADAAAAAAAAAAAAAAAAABEBEEH/2gAIAQMBAT8QJXKv/8QAFhEBAQEAAAAAAAAAAAAAAAAAABFB/9oACAECAQE/ENV//8QAGBAAAwEBAAAAAAAAAAAAAAAAAREhADH/2gAIAQEAAT8QBAtBiZqG+4kEONxOVmHu/9k="
        data-src="{{ '/assets/posts/refonte-visuels-produits-2/bench_jpegoptim-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/refonte-visuels-produits-2/bench_jpegoptim-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/refonte-visuels-produits-2/bench_jpegoptim-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-2/bench_jpegoptim-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Résumé des optimisations MozJPEG</figcaption>
</figure>





Par outil de compression, voici la répartition des poids des images générées. Pour pouvoir les comparer, on intègre aussi une série de données qui se basent sur le poids des images en production (nos fameux GIFs).


<figure>
    <img 
        class="lozad" 
        width="900"
        height="556"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAIABQDASIAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAT/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIQAxAAAAGwAH//xAAUEAEAAAAAAAAAAAAAAAAAAAAQ/9oACAEBAAEFAn//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/AT//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAQ/9oACAEBAAY/An//xAAUEAEAAAAAAAAAAAAAAAAAAAAQ/9oACAEBAAE/IX//2gAMAwEAAgADAAAAEPPP/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPxA//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPxA//8QAFBABAAAAAAAAAAAAAAAAAAAAEP/aAAgBAQABPxB//9k="
        data-src="{{ '/assets/posts/refonte-visuels-produits-2/graph_poids.svg' | prepend: site.baseurl  }}" 
    />
    <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-2/graph_poids.svg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Percentiles des poids des images générées par outil</figcaption>
</figure>


On constate déjà que MozJPEG, à score DSSIM équivalent, génère des visuels plus lourds que les autres outils mais aussi plus lourds que nos GIFs de production.
Sans surprise, WebP est celui qui génère les visuels les plus légers, tandis que jpegoptim et Guetzli donnent des résultats similaires avec un poids inférieur à nos images de production.

On analyse ensuite le temps de traitement nécessaire pour fabriquer chacune de nos images.


<figure>
    <img 
        class="lozad" 
        width="900"
        height="556"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAIABQDASIAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAT/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIQAxAAAAGwAH//xAAUEAEAAAAAAAAAAAAAAAAAAAAQ/9oACAEBAAEFAn//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/AT//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAQ/9oACAEBAAY/An//xAAUEAEAAAAAAAAAAAAAAAAAAAAQ/9oACAEBAAE/IX//2gAMAwEAAgADAAAAEPPP/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPxA//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPxA//8QAFBABAAAAAAAAAAAAAAAAAAAAEP/aAAgBAQABPxB//9k="
        data-src="{{ '/assets/posts/refonte-visuels-produits-2/graph_temps.svg' | prepend: site.baseurl  }}" 
    />
    <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-2/graph_temps.svg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Percentiles des temps de génération par outil (on n’a pas l’occasion tous les jours d’utiliser une échelle logarithmique)</figcaption>
</figure>


Le fait d’utiliser une échelle logarithmique pour faire cohabiter Guetzli et les autres méthodes n’est pas vraiment un bon signe. Le temps de génération se compte en secondes. On monte même à plus de 10 secondes pour les images de plus grande dimension, mais cet effet était annoncé dès le [README du projet](https://github.com/google/guetzli#using).

En se basant sur les autres outils, on obtient des délais plus raisonnables comme on peut le voir au 95e percentile :
* MozJPEG : 58ms / image
* jpegoptim : 8 ms / image
* WebP : 16ms / image

Dernière dimension d’analyse, la valeur de qualité à appliquer avant de trop dégrader le score DSSIM par rapport à notre source.

<figure>
    <img 
        class="lozad" 
        width="900"
        height="556"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAIABQDASIAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAT/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIQAxAAAAGwAH//xAAUEAEAAAAAAAAAAAAAAAAAAAAQ/9oACAEBAAEFAn//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/AT//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAQ/9oACAEBAAY/An//xAAUEAEAAAAAAAAAAAAAAAAAAAAQ/9oACAEBAAE/IX//2gAMAwEAAgADAAAAEPPP/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPxA//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPxA//8QAFBABAAAAAAAAAAAAAAAAAAAAEP/aAAgBAQABPxB//9k="
        data-src="{{ '/assets/posts/refonte-visuels-produits-2/graph_qualite.svg' | prepend: site.baseurl  }}" 
    />
    <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-2/graph_qualite.svg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Percentiles des valeurs de qualité par outil</figcaption>
</figure>


Pour ce graphique, les données sont plus regroupées. On constate que jpegoptim et WebP peuvent prendre une valeur de qualité plus faible que MozJPEG et Guetzli sans forcément dégrader les visuels en sortie.

Ces trois métriques vont nous permettre de faire un choix. **Plus rapide, étant capable de générer des images plus légères et de bonne qualité, jpegoptim est l’outil qui ressort de notre de notre comparatif.**

De plus, en fixant la qualité des JPEG à une valeur de 95, nous considérons que l’impact  de la compression ne se verra pas sur 80% des visuels.

Cette analyse nous confirme également le potentiel du format WebP qui nous permettra à terme de fournir des visuels d’aussi bonne qualité, mais encore plus légers. Cela nous conforte dans l’objectif d’apporter ce support dans la seconde itération du projet.

## C’est parti pour la génération de plus de 28 millions d’images

Nos outils sont choisis, maintenant il faut générer les images.

Pour chacune de nos 3 millions d’images sources, nous allons construire au maximum 10 images (le pourquoi de ces 10 versions d’images sera expliqué dans un prochain article #retina #teasing).

On est bien sûr dépendants de nos images sources, mais on peut estimer traiter 6000 images par heure. Cela nous donne donc une durée totale de traitement de 21 jours pour fabriquer tout notre contenu à partir de notre historique.

<figure>
    <img 
        class="lozad" 
        width="600" height="286"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAKABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAMC/8QAFgEBAQEAAAAAAAAAAAAAAAAAAgED/9oADAMBAAIQAxAAAAG094zlgX//xAAYEAADAQEAAAAAAAAAAAAAAAAAAQIRMf/aAAgBAQABBQKngq1lC6f/xAAWEQEBAQAAAAAAAAAAAAAAAAABECH/2gAIAQMBAT8BXZ//xAAWEQEBAQAAAAAAAAAAAAAAAAABABH/2gAIAQIBAT8BAxi//8QAFBABAAAAAAAAAAAAAAAAAAAAIP/aAAgBAQAGPwJf/8QAFxABAQEBAAAAAAAAAAAAAAAAAQAREP/aAAgBAQABPyHAtiGRyDEX/9oADAMBAAIAAwAAABAsH//EABURAQEAAAAAAAAAAAAAAAAAAAEA/9oACAEDAQE/EFAE3//EABYRAQEBAAAAAAAAAAAAAAAAAAEhAP/aAAgBAgEBPxBSJbhN/8QAGRABAAMBAQAAAAAAAAAAAAAAAQARITFR/9oACAEBAAE/EGA2mNQC+ziARsvYCgDfJxP/2Q=="
        data-src="{{ '/assets/posts/refonte-visuels-produits-2/utilisation_cpu-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/refonte-visuels-produits-2/utilisation_cpu-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/refonte-visuels-produits-2/utilisation_cpu-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-2/utilisation_cpu-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Utilisation des CPU pendant la génération des images</figcaption>
</figure>


21 jours plus tard (à quelques jours près), nous nous retrouvons avec 28 millions de JPEG propres, légers et prêts à être utilisés sur nos sites.

Ça n’est pas encore un énorme gain en termes de web-performance. Le poids de nos nouvelles images est encore relativement proche de celui de nos anciens GIFs. Mais cette première itération est un grand pas en termes de qualité. Maintenant, on va pouvoir travailler la web-performance de nos pages en essayant encore de réduire l’impact des visuels produits : cela sera l’occasion de poursuivre cette série d’articles.


    
