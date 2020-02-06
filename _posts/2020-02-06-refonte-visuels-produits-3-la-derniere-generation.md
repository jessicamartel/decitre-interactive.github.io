---
layout: post
title: Refonte de nos 3 millions de visuels produits - La dernière génération
author: srogier
date: 2020-02-06 10:00:00+01:00
excerpt: Refonte de nos 3 millions de visuels produits - La dernière génération
image: /assets/posts/refonte-visuels-produits-3/meta.jpg
---


Nous avons généré et utilisons [nos nouveaux JPEG](https://tech.decitre.fr/posts/refonte-visuels-produits-2-le-gif-maudit) tout propres en production. Comme expliqué précédemment, le gain de cette première étape est principalement axé sur la qualité. En effet, les JPEGs générés ont un poids relativement proche de celui de nos anciens GIFs, mais avec une meilleure qualité visuelle.

Maintenant que notre première itération fonctionne correctement en production, on va se concentrer sur l'aspect performance Web du projet et essayer de résoudre cette problématique : comment réduire l'impact des visuels sur les performances de [decitre.fr](https://www.decitre.fr/) tout en gardant une bonne qualité d'affichage.

## Ajout du WebP sur la plateforme

[WebP](https://fr.wikipedia.org/wiki/WebP) est un format développé par Google depuis 2011, qui gère la compression avec ou sans perte ainsi que la transparence. 

Depuis fin 2018, WebP est passé du statut de « format seulement supporté par Chrome » à celui de « format seulement non supporté par Safari ». Une belle progression en quelques mois après plusieurs années d'attente. 

Cela tombe plutôt bien, car WebP annonce des [images de meilleure qualité et plus légères](https://developers.google.com/speed/WebP/gallery1) que ce que le format JPEG peut fournir.

### Configuration du benchmarking pour WebP  
  
Comme pour les choix techniques autour de JPEG, nous allons lancer différentes analyses pour déterminer la valeur de qualité à utiliser pour le convertisseur WebP.  
  
À nouveau, nous allons nous baser sur [l’échantillon précédemment constitué](https://tech.decitre.fr/posts/refonte-visuels-produits-2-le-gif-maudit) pour générer et analyser des miniatures de nos visuels produits.  
  
Par rapport à JPEG, la difficulté va être de pouvoir comparer la source et la version compressée.  
  
Autre distinction avec JPEG, le format WebP gère la compression de manière différente. Là où JPEG va créer des artefacts grossiers lorsqu’on applique une faible valeur de qualité, WebP va « lisser » l’image en perdant en détail d’une façon plus subtile que ces fameux artefacts.  
  

<figure>
    <div class="overflow-auto">
        <img 
            class="lozad" 
            width="1566" height="353"
            src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAFABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAED/8QAFQEBAQAAAAAAAAAAAAAAAAAAAAH/2gAMAwEAAhADEAAAAchFB//EABUQAQEAAAAAAAAAAAAAAAAAAAAS/9oACAEBAAEFAqUp/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPwE//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPwE//8QAFhABAQEAAAAAAAAAAAAAAAAAMQAQ/9oACAEBAAY/AiM//8QAFhABAQEAAAAAAAAAAAAAAAAAAHEB/9oACAEBAAE/IZJIx//aAAwDAQACAAMAAAAQ/D//xAAVEQEBAAAAAAAAAAAAAAAAAAAAEf/aAAgBAwEBPxCq/8QAFREBAQAAAAAAAAAAAAAAAAAAABH/2gAIAQIBAT8QiP/EABkQAAIDAQAAAAAAAAAAAAAAAAERADFRgf/aAAgBAQABPxBuisxuiswGXtpn/9k="
            data-src="{{ '/assets/posts/refonte-visuels-produits-3/webp_qualite-1.jpg' | prepend: site.baseurl  }}" 
        />
        <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-3/webp_qualite-1.jpg' | prepend: site.baseurl  }}" width="1566" height="353"/></noscript>

    </div>
    <figcaption>Évolution de la qualité en WebP de 20 à 100 par palier de 20</figcaption>
</figure>


Dans l’exemple ci-dessus, là où JPEG aurait créé de gros artefacts sur les qualités basses, on constate que l’effet sur le sable se lisse. Plus la qualité baisse, plus l’impression d’un sable plat est présente.

Cela nous permet d’utiliser des versions dégradées de nos images avec une plus faible qualité et donc un niveau moindre de détail sans que cela soit choquant à l’œil.   
  
Pour les différentes tailles d’images utilisées, nous avons fait tourner sur un échantillon des générations au format WebP avec différents niveaux de qualité.
Puis, nous avons comparé les poids et le score DSSIM des WebP générés par rapport à ceux obtenus par rapport au JPEG généré et utilisé en production.

> Pour rappel le score DSSIM est un calcul de dissimilarité entre images, qui nous permet d’évaluer si deux images sont similaires ou non. Nous avions déjà utilisé cet outil lors de [la constitution du catalogue de visuels originaux](https://tech.decitre.fr/posts/refonte-visuels-produits-1-les-aventuriers-du-coffre-perdu#automatiser-les-comparaisons).

Notre objectif est de générer une image WebP au moins aussi qualitative que le JPEG et plus légère.

<figure>
    <img 
        class="lozad" 
        width="494" height="749"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAeABQDASIAAhEBAxEB/8QAGAABAQEBAQAAAAAAAAAAAAAAAAMEAQL/xAAXAQADAQAAAAAAAAAAAAAAAAAAAQMC/9oADAMBAAIQAxAAAAHTOskjwKaJVkTOln//xAAXEAADAQAAAAAAAAAAAAAAAAABEBEw/9oACAEBAAEFAoqjh//EABYRAQEBAAAAAAAAAAAAAAAAAAAREP/aAAgBAwEBPwFEz//EABURAQEAAAAAAAAAAAAAAAAAAAEQ/9oACAECAQE/AWM//8QAFBABAAAAAAAAAAAAAAAAAAAAMP/aAAgBAQAGPwJP/8QAGRAAAgMBAAAAAAAAAAAAAAAAADEQESBx/9oACAEBAAE/IehTTdH/2gAMAwEAAgADAAAAEGTOcf/EABkRAQACAwAAAAAAAAAAAAAAAAEAEBEhMf/aAAgBAwEBPxBdkwinlf/EABcRAAMBAAAAAAAAAAAAAAAAAAABEBH/2gAIAQIBAT8QY2v/xAAeEAEBAAEDBQAAAAAAAAAAAAABAEExUXEQESFhof/aAAgBAQABPxA9kuqFt9jHHQM23E4jMGnF3VDxrCv/2Q=="
        data-src="{{ '/assets/posts/refonte-visuels-produits-3/gain_webp-1.jpg' | prepend: site.baseurl  }}" 
    />
    <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-3/gain_webp-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Comparatif des gains pour les visuels utilisés dans nos widgets.</figcaption>
</figure>

Par exemple, pour cette taille de visuel utilisée dans l’animation de decitre.fr, une qualité de 90 permettra d’avoir une image 40 % plus légère avec une dégradation similaire à celle du JPEG par rapport à l’image originale.

À noter que dans les transformations effectuées, nous [préparons l’image](https://tech.decitre.fr/posts/refonte-visuels-produits-2-le-gif-maudit#un-outil-pour-redimensionner-les-images) (redimensionnement, modification de l’espace de couleur) puis nous l’optimisons. 

Nous avons constaté de meilleurs résultats sur le poids et la qualité lors de l’optimisation et la conversion au format WebP si l’image en entrée du convertisseur WebP était au format PNG et non au format JPEG comme initialement.

Finalement, nous avons opté pour générer nos WebP avec une qualité de 90. C’était pour nous le meilleur compromis parmi la gamme d’images utilisées sur nos sites.


## Mise en place des images pour les écrans à haute densité  


Depuis quelques années, sur les téléphones, tablettes ou ordinateurs les écrans à haute densité de pixels sont devenus la norme.  

Ces écrans proposent une très grande résolution sur une surface d’affichage réduite. Cela a pour effet de fournir des écrans avec un nombre de pixels par pouces élevés. L’objectif du Retina (appellation commerciale d’Apple pour ce type d’écran) est d’avoir une densité de pixel tellement élevée que l’œil humain ne puisse pas les décerner.  
  

<figure>
    <img 
        class="lozad" 
        width="600" height="457"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAPABQDASIAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAAIDBP/EABQBAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhADEAAAAemKg3B//8QAGhAAAgIDAAAAAAAAAAAAAAAAAQIAEBIiMf/aAAgBAQABBQI9LbRgTMGr/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPwE//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPwE//8QAGRAAAgMBAAAAAAAAAAAAAAAAABABESEx/9oACAEBAAY/AoKWHV//xAAbEAEAAgIDAAAAAAAAAAAAAAABABARQSFRYf/aAAgBAQABPyFoBucId1iFgk2Jz4V//9oADAMBAAIAAwAAABCjD//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQMBAT8QP//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8QP//EABsQAQEAAgMBAAAAAAAAAAAAAAERACEQMVFh/9oACAEBAAE/EJibNE7yEEYHV35xtgFKfMGQUI3Ac//Z"
        data-src="{{ '/assets/posts/refonte-visuels-produits-3/commit_strip-1.jpg' | prepend: site.baseurl  }}" 
    />
    <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-3/commit_strip-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>source <a href="http://www.commitstrip.com/fr/2012/06/12/deballage-du-nouveau-macbook-pro-retina/">CommitStrip</a></figcaption>
</figure>


  
Pour ne pas avoir un affichage trop petit, ces écrans jouent sur le ratio de contenu et le passent à 2:1 (voire 3:1) contre 1:1 pour un écran desktop classique. Cela a pour effet d’afficher sur les terminaux mobiles des images agrandies avec un rendu un peu flou.  
  
### Vers la haute résolution !  
  
Avec un [format vectoriel](https://fr.wikipedia.org/wiki/Image_vectorielle), nous n’aurions aucun souci : nos images s’adapteraient sans dégradation sur les différents écrans. Mais avec du bitmap, comment faire ?  
  
Pour éliminer l’effet de flou sur les écrans de ratio 2:1, il faut fournir une image dont on va doubler la largeur et la hauteur en pixel, mais en les faisant entrer dans l’espace normalement prévu (exemple : la version haute définition d’une image de 200x300 pixels sera de 400x600 pixels).  
  
Mais avec quatre fois plus de pixels à afficher, on va forcément produire des images plus lourdes. Vu qu’on est sur un article qui aborde la performance Web, ça serait dommage. Surtout quand on réserve ces visuels à un usage mobile où il peut ne pas y avoir un réseau 4G pour tous.  
  
[La technique](https://www.alsacreations.com/astuce/lire/1730-retina-trick-compressive-images-resolution-picture-img-srcset-responsive.html) (qui peut paraître un peu grossière) que nous avons mise en place consiste à réduire la valeur de qualité pour nos images de ratio 2.  
  
Pour ces images, en appliquant le ratio 2, la compression JPEG ou WebP est moins visible. Il faut donc trouver (encore une fois) le compromis entre poids de l’image par rapport à sa version en ratio 1 et valeur de qualité.  
  
Nous avons donc, à partir de notre échantillon d’images préféré, généré nos visuels de ratio 2 en faisant varier la qualité de compression de 20 à 100 par incrément de 5 en JPEG.  
  
Pour comparer, malheureusement, pas de DSSIM possible cette fois-ci. La qualité étant dégradée quand on regarde l’image dans ces dimensions réelles, les outils de calcul de dissimilarité ne nous seront pas d’une grande aide cette fois-ci.  
  
Nous avons donc opté pour une validation manuelle et avons généré des tableaux de comparaisons pour déterminer au [doigt mouillé](https://www.php.net/mt_rand) la valeur de qualité à appliquer.
  
Du côté du format JPEG, malheureusement, les images générées en ratio 2 sont plus lourdes que celle en ratio 1. La valeur de qualité choisie était la plus basse possible sans qu’il y ait un effet de dégradation visuelle trop prononcé.  
  
Pour le WebP, au contraire, on arrive à générer des visuels plus légers en ratio 2 qu’en ratio 1. Cela s’explique notamment par la différence d’algorithme entre les deux formats. En effet, on a vu que WebP, dans le cadre d’une compression agressive, détruisait moins l’image et n’altérait pas sa qualité globale à coup d’artefact de compression.  

Nous avons donc pu descendre à des valeurs de qualité d’image très basses pour le format WebP (entre 20 et 30 selon les dimensions des images à afficher, contre plus de 60 au format JPEG), ce qui nous permet de générer des images plus légères en ratio que leur équivalent au ratio 1.  
  
### 30 millions d’images  
*(la lala lala la lala lala la lalalalalalalaaaaaaa)*

Une fois encore, on repart pour une génération des variantes de nos 3 millions d’images. En plus du WebP, on profite de cette génération sur la globalité du catalogue pour optimiser certains ratio 2 JPEG créés précédemment où un mauvais réglage entraînait, dans certaines conditions, la génération d’images pesant plusieurs mégaoctets contre quelques kilooctets.  
  
16 jours, 13 heures et 28 minutes plus tard, nous avons généré les 30 millions de variantes en WebP et corrigé les 16 millions de JPEG non optimisés, portant notre catalogue total à plus de 60 millions d’images générées. 

Nous avons désormais des WebP et des images de ratio 2 prêtes à être utilisées sur nos sites en complément des JPEGs utilisés en production.  

Pour valider cette génération, nous avons extrait des données à partir de toutes les images qui composent notre catalogue produit.

<figure>
    <img 
        class="lozad" 
        width="900"
        height="556"
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="{{ '/assets/posts/refonte-visuels-produits-3/gain_webp_vs_jpeg.svg' | prepend: site.baseurl  }}" 
    />
    <noscript><img src="{{  '/assets/posts/refonte-visuels-produits-3/gain_webp_vs_jpeg.svg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Gain poids des WebP par rapport aux JPEG</figcaption>
</figure>

Déjà,  première confirmation : les fichiers WebP sont plus légers que les fichiers JPEG.
On constate un gain médian de 40 % et au 90e percentile le gain est de l’ordre de 30 %. Cela s’annonce plutôt bien pour la performance Web :)

Du côté des images au ratio 2, le gain est moins évident.

<figure>
    <img 
        class="lozad" 
        width="900"
        height="556"
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="{{ '/assets/posts/refonte-visuels-produits-3/gain_jpeg_ratio1_vs_ratio2.svg' | prepend: site.baseurl  }}" 
    />
    <noscript><img src="{{  '/assets/posts/refonte-visuels-produits-3/gain_jpeg_ratio1_vs_ratio2.svg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Gain poids des JPEG en ratio 2 par rapport au ratio 1</figcaption>
</figure>


Commençons par la comparaison des JPEG ratio 1 vs ratio 2. Le gain médian est de 16 % tandis qu’à partir du 79e percentile, les images JPEG au ratio 2 sont plus lourdes que leur version ratio 1. La courbe finit par amorcer une pente exponentielle à partir du 85e percentile.


<figure>
    <img 
        class="lozad" 
        width="900"
        height="556"
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="{{ '/assets/posts/refonte-visuels-produits-3/gain_webp_ratio1_vs_ratio2.svg' | prepend: site.baseurl  }}" 
    />
    <noscript><img src="{{  '/assets/posts/refonte-visuels-produits-3/gain_webp_ratio1_vs_ratio2.svg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Gain poids des WebP en ratio 2 par rapport au ratio 1</figcaption>
</figure>


Maintenant, comparons les ratio 2 au ratio 1, mais au format WebP cette fois-ci. On retrouve une courbe similaire à celle vue précédemment. Le gain médian est cette fois de 13 %, tandis que le ratio devient plus lourd à partir du 82e percentile. 
Par contre, la hausse de poids est plus limitée et se contente d’atteindre 37 % de hausse au 99e percentile contre 1000 % pour la courbe JPEG.

Cette hausse de poids des images de ratio 2 par rapport à celle des ratios 1 n’est pas surprenante : on compare une image avec une version qui fait quatre fois plus de pixels où on tente de compenser l’augmentation de la taille de l’image par une plus forte optimisation.
Il faut donc avoir une vigilance particulière sur les dix derniers pourcents des ratio 2 JPEG.

Toutefois le ratio 2 WebP permet d’être assez optimiste. La hausse de poids par rapport au ratio 1 WebP est à relativiser par rapport au gain global du format WebP par rapport au JPEG. 

C’est d’ailleurs ce qu’il faut retenir : dans la quasi-totalité des cas, un WebP de ratio 2 sera plus léger qu’un JPEG de ratio 1.

  
## LQIP ou le premier aperçu pas cher d’image produit & parfait complément du lazy loading  
### Le lazy loading  
  
Tout d’abord, commençons par expliquer ce qu’est le [lazy loading](https://developers.google.com/web/fundamentals/performance/lazy-loading-guidance/images-and-video). Il s’agit d’une technique consistant à ne charger une ressource qu’au moment où on en a besoin.  
  
Dans le cas de nos images, cela revient à ne déclencher leur chargement qu’à partir du moment où elles sont affichées à nos clients. 
  
Sur decitre.fr, nous utilisons [Lozad.js](https://github.com/ApoorvSaxena/lozad.js/) pour décaler le chargement des visuels produits, iframe, etc., et ainsi réduire l’impact sur les performances du chargement des images.  
  
Voici un exemple de balise que nous utilisons sur notre site.  

```html
    <img 
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
        title="Magento. Réussir son site e-commerce" 
        data-src="https://products-images.di-static.com/image/mickael-blanchard-magento/9782212125153-200x303-1.jpg" 
        class="lozad" 
    />
```

Le `src` contient une image de 1px par 1px au format GIF encodée en base64 et Lozad.js se charge de le remplir à partir du `data-src` lorsque l’image passe dans la zone d’affichage.  
  
### Ajouter les Low Quality Image Placeholder  
  
Avec la solution présentée ci-dessus, notre image reste une zone blanche en attendant qu’elle soit chargée. Le lazy loading déclenche le chargement de l’image quelques pixels avant son affichage. 

En théorie, sur une connexion rapide, on ne perçoit pas l’utilisation d’un lazy loader. Mais avec une connexion possédant une plus grosse latence ou un débit plus faible, on va avoir cet effet de clignotement le temps que l’image soit chargée.  

Pour améliorer cette zone blanche, et proposer un premier aperçu des couvertures de nos produits, nous allons utiliser une version miniature de l’image qui sera utilisée en attendant que le lazy loader ait chargé le visuel définitif : c’est ce qu’on appelle les [Low Quality Image Placeholders](https://www.guypo.com/introducing-lqip-low-quality-image-placeholders) ou LQIP pour faire plus court.

Pour éviter un hit HTTP, nous allons comme pour le GIF de 1px, utiliser une version [inlinée en base 64](https://www.alsacreations.com/article/lire/1439-data-uri-schema.html) posée directement dans le code HTML de la page. 

Par contre, il va falloir que notre image en base 64 soit la plus légère possible pour ne pas alourdir trop notre code HTML. Pour cela, nous prenons l’image à afficher et nous lui appliquons les modifications suivantes :  
* conversion en JPEG,  
* d’une largeur et hauteur maximale de 20px,  
* avec une qualité de 20.  
  
Ces réglages nous permettent de fabriquer une bouillie de pixel, certes reconnaissable, mais d’un poids acceptable aux alentours de 800 octets (un peu loin des [200 octets annoncés par Facebook](https://engineering.fb.com/android/the-technology-behind-preview-photos/)).  
  
```css
    img.lozad:not([data-loaded]) {  
      filter: blur(10px);  
    }
```
  
Enfin, pour rendre cette bouillie plus agréable à l’œil, nous faisons appel à CSS et au filtre `blur` qui va nous permettre d’appliquer un flou sur ce tas de pixels extrapolé.  
  

<div class="container">
    <div class="row">
        <div class="col-md">
            <figure>
                <img 
                    class="lozad" 
                    width="200"
                    height="275"
                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                    data-src="{{ '/assets/posts/refonte-visuels-produits-3/lqip_defaut.png' | prepend: site.baseurl  }}" 
                />
                <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-3/lqip_defaut.png' | prepend: site.baseurl  }}" /></noscript>
            
                <figcaption>LQIP tout seul</figcaption>
            </figure>
        </div>
        <div class="col-md">
            <figure>
                <img 
                    class="lozad" 
                    width="200"
                    height="275"
                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                    data-src="{{ '/assets/posts/refonte-visuels-produits-3/lqip_blur.png' | prepend: site.baseurl  }}" 
                />
                <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-3/lqip_blur.png' | prepend: site.baseurl  }}" /></noscript>
            
                <figcaption>LQIP avec blur</figcaption>
            </figure>
        
        </div>
        
        <div class="col-md">
            <figure>
                <img 
                    class="lozad" 
                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                    data-src="{{ '/assets/posts/refonte-visuels-produits-3/lqip_complet.png' | prepend: site.baseurl  }}" 
                />
                <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-3/lqip_complet.png' | prepend: site.baseurl  }}" /></noscript>
            
                <figcaption>Image originale</figcaption>
            </figure>
        </div>
    </div>
</div>


Du côté des calculs, afin de ne pas faire assumer la génération de la miniatures à chaque appel sur le serveur, nous stockons en base de données le contenu binaire de l’image afin qu’il soit facilement intégrable dans nos pages.


## C’est parti pour la mise en production 🚀 !

Pour rappel, nous avons sur decitre.fr des visuels produits JPEG en ratio 1.

Nous allons configurer les différentes combinaisons suivantes pour valider la performance Web :
* JPEG ratio 1 et JPEG ratio 2
* JPEG ratio 1 et WebP ratio 1
* JPEG ratio 1 et LQIP
* JPEG et WebP (ratio 1 et ratio 2)

Pour valider le bon fonctionnement de nos nouvelles images sur nos pages, nous nous sommes appuyés sur les outils d’analyse de la performance web comme [Dareboost](https://www.dareboost.com/), [GTmetrix](https://gtmetrix.com/) ou [WebPageTest](https://www.webpagetest.org/) que nous utilisons habituellement.

Nous nous sommes concentrés sur une fiche produit, dans un environnement desktop avec une connexion ADSL et un environnement mobile avec une connexion équivalent à de la 3G.

### Impact des WebP 

En comparant les poids totaux sur notre fiche produit, nous avons bien la confirmation que le format WebP permet d’avoir des pages plus légères.


<figure>
    <img
        class="lozad"
        width="400" height="170"
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="https://media.giphy.com/media/ZgYBhq1x7L1bW/giphy.gif"
    />
    <noscript><img src="https://media.giphy.com/media/ZgYBhq1x7L1bW/giphy.gif" /></noscript>

    <figcaption>WebP par rapport à JPEG ? (source : <a href="https://media.giphy.com/media/ZgYBhq1x7L1bW/giphy.gif">https://media.giphy.com/media/ZgYBhq1x7L1bW/giphy.gif</a>)</figcaption>
</figure>


En désactivant le lazy loading et donc en forçant le chargement de toutes les images présentes sur une fiche produit, la version avec JPEG charge 466 Ko d’image contre 323 Ko pour la version WebP. On obtient ainsi, pour notre exemple, un **gain de près de 30 %**.

### Impact des images haute résolution

On l’a vu, les images hautes résolutions ne garantissent pas une réduction du poids. Au contraire, dans 20 % des cas, l’image haute résolution sera plus lourde que son équivalent basse résolution. Ce qui nous intéresse dans cette fonctionnalité sera donc la qualité.


<div class="container">
    <div class="row">
        <div class="col-md">
            <figure>
                <img 
                    class="lozad" 
                    width="418" height="500"
                    src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAYABQDASIAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAAECA//EABUBAQEAAAAAAAAAAAAAAAAAAAAB/9oADAMBAAIQAxAAAAGZ5o25iggP/8QAFhABAQEAAAAAAAAAAAAAAAAAIQAw/9oACAEBAAEFAiMP/8QAFBEBAAAAAAAAAAAAAAAAAAAAIP/aAAgBAwEBPwEf/8QAFBEBAAAAAAAAAAAAAAAAAAAAIP/aAAgBAgEBPwEf/8QAFBABAAAAAAAAAAAAAAAAAAAAMP/aAAgBAQAGPwIf/8QAGBAAAwEBAAAAAAAAAAAAAAAAAAERIHH/2gAIAQEAAT8h5RA5d//aAAwDAQACAAMAAAAQX/D/AP/EABQRAQAAAAAAAAAAAAAAAAAAACD/2gAIAQMBAT8QH//EABQRAQAAAAAAAAAAAAAAAAAAACD/2gAIAQIBAT8QH//EABkQAQACAwAAAAAAAAAAAAAAAAEAMRARcf/aAAgBAQABPxAEUMNCoPIKgOQuJhNOGf/Z"
                    data-src="{{ '/assets/posts/refonte-visuels-produits-3/ratio1-1.jpg' | prepend: site.baseurl  }}" 
                />
                <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-3/ratio1-1.jpg' | prepend: site.baseurl  }}" /></noscript>
            
                <figcaption>Ratio 1</figcaption>
            </figure>

        </div>
        <div class="col-md">
            <figure>
                <img 
                    class="lozad" 
                    width="417" height="500"
                    src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAYABQDASIAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAAECA//EABUBAQEAAAAAAAAAAAAAAAAAAAAB/9oADAMBAAIQAxAAAAGZ5o25iggP/8QAFhABAQEAAAAAAAAAAAAAAAAAIQAw/9oACAEBAAEFAiMP/8QAFBEBAAAAAAAAAAAAAAAAAAAAIP/aAAgBAwEBPwEf/8QAFBEBAAAAAAAAAAAAAAAAAAAAIP/aAAgBAgEBPwEf/8QAFBABAAAAAAAAAAAAAAAAAAAAMP/aAAgBAQAGPwIf/8QAGBAAAwEBAAAAAAAAAAAAAAAAAAERIHH/2gAIAQEAAT8h5RA5d//aAAwDAQACAAMAAAAQX/D/AP/EABQRAQAAAAAAAAAAAAAAAAAAACD/2gAIAQMBAT8QH//EABQRAQAAAAAAAAAAAAAAAAAAACD/2gAIAQIBAT8QH//EABkQAQACAwAAAAAAAAAAAAAAAAEAMRARcf/aAAgBAQABPxAEUMNCoPIKgOQuJhNOGf/Z"
                    data-src="{{ '/assets/posts/refonte-visuels-produits-3/ratio2-1.jpg' | prepend: site.baseurl  }}" 
                />
                <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-3/ratio2-1.jpg' | prepend: site.baseurl  }}" /></noscript>
            
                <figcaption>Ratio 2</figcaption>
            </figure>

        
        </div>
    </div>
</div>

Comme vous pouvez le constater sur ces captures faites à partir d’un téléphone, le principal intérêt de ces visuels est l’amélioration du rendu sur nos fiches produits.

Dans cet exemple, on se rend compte que l’image haute résolution permet d’améliorer la lisibilité de certains détails comme le résumé sur une quatrième de couverture ou le code barre d’un produit. 

Et, le hasard faisant bien les choses, on gagne quelques Ko avec la haute résolution en passant de 40 Ko à 37,5 Ko pour ce visuel.

### Impact du Low Quality Image Placeholder

Notre objectif avec cette fonctionnalité était d’afficher au plus tôt une version dégradée des visuels. Ainsi nos utilisateurs auront un meilleur ressenti de la performance grâce à ce visuel affiché le plus tôt possible quitte à ce qu’il soit dans un premier temps dégradé.

<figure>
    <img 
        class="lozad" 
        width="900" height="325"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAHABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAEE/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEAMQAAAB2QAP/8QAFBABAAAAAAAAAAAAAAAAAAAAEP/aAAgBAQABBQJ//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPwE//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPwE//8QAFBABAAAAAAAAAAAAAAAAAAAAEP/aAAgBAQAGPwJ//8QAFhAAAwAAAAAAAAAAAAAAAAAAABAh/9oACAEBAAE/ISr/2gAMAwEAAgADAAAAEAPP/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPxA//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPxA//8QAGRAAAwADAAAAAAAAAAAAAAAAABEhATFx/9oACAEBAAE/EFJs6MNU/9k="
        data-src="{{ '/assets/posts/refonte-visuels-produits-3/comparatif_visuel-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/refonte-visuels-produits-3/comparatif_visuel-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/refonte-visuels-produits-3/comparatif_visuel-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-3/comparatif_visuel-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>En haut avec LQIP, en bas sans LQIP</figcaption>
</figure>



L’objectif semble atteint sur la comparaison image par image. Dès 750 ms, le rendu est terminé à 95 % contre 69 % pour la version sans LQIP.

<figure>
    <img 
        class="lozad" 
        width="900" height="432"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAKABQDASIAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAT/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIQAxAAAAGwAH//xAAUEAEAAAAAAAAAAAAAAAAAAAAg/9oACAEBAAEFAl//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/AT//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAg/9oACAEBAAY/Al//xAAUEAEAAAAAAAAAAAAAAAAAAAAg/9oACAEBAAE/IV//2gAMAwEAAgADAAAAEFMP/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPxA//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPxA//8QAFxABAQEBAAAAAAAAAAAAAAAAAREgIf/aAAgBAQABPxAO2uv/2Q=="
        data-src="{{ '/assets/posts/refonte-visuels-produits-3/comparatif_speedindex-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/refonte-visuels-produits-3/comparatif_speedindex-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/refonte-visuels-produits-3/comparatif_speedindex-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/refonte-visuels-produits-3/comparatif_speedindex-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>En bleu foncé avec LQIP, en bleu clair sans LQIP</figcaption>
</figure>


Cela est confirmé par l’évolution du SpeedIndex où la version LQIP nous permet d’atteindre les valeurs hautes plus rapidement.

## Le mot de la fin

Avec ce travail sur les balises images de nos visuels produits, les nouveaux formats, la haute résolution, etc. se termine la seconde phase de notre chantier.

Il y a encore plusieurs pistes d’améliorations possibles à étudier de notre côté :
* l’utilisation du header HTTP [Accept](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Accept) pour profiter de la [négociation de contenu](https://developer.mozilla.org/en-US/docs/Web/HTTP/Content_negotiation) et retourner le format optimal en fonction du support navigateur,
* l’utilisation de l’objet [NetworkingInformation](https://developer.mozilla.org/en-US/docs/Web/API/NetworkInformation) (enfin le jour où il sera mieux supporté) et d’un service worker (en s’inspirant du [travail de l’Équipe](https://www.welovespeed.com/en/2019/speakers/#raphael)) pour basculer automatiquement sur une qualité d’image plus dégradée quand la connexion est en économie de bande passante
* l’amélioration continue de la donnée source pour proposer des visuels originaux toujours plus qualitatifs et éliminer les dernières sources avec des dimensions inférieures à 200px.


Le projet aura été étalé dans le temps, mais nous avons pu le mettre en place itérativement, sans créer de chaos sur chacune des applications, tout en mettant en place de l’analyse et des métriques pour essayer de s’en sortir avec le volume de données à traiter.

Cet article clôt cette série sur la refonte de notre catalogue de visuels produits, quasiment 3 ans après démarrage du projet et après avoir atteint notre objectif initial de recentraliser tous ces visuels pour en fournir des versions plus qualitatives sur nos sites Webs. 

Et puis, de toute manière, étant donnée la source d’inspiration des titres, autant faire en sorte que la trilogie d’articles s’arrête, elle, à 3 🙂.
