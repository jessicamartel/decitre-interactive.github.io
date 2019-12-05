---
layout: post
title: Furet.com &#58; comment nous avons migré un site de e-commerce de 2 millions de références en 2 minutes...
author: jmartel,cpeney,srogier
date: 2019-12-05 08:00:00+01:00
excerpt: Retour sur le BlendWebMix 2019
---

En janvier 2019, la société Furet du Nord rachetait les sociétés Decitre et Decitre Interactive ; nous devenions le groupe Furet Decitre. De nombreux projets d'harmonisation ont eu lieu et d’autres sont encore menés afin d’unir ces deux enseignes. 
L’un des projets était la transformation et la migration du site [furet.com](https://www.furet.com).


<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-4"></div>
        <div class="col-md col-sm">
            <figure>
                <img 
                    class="lozad" 
                    width="112" height="110"
                    src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAUABQDASIAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAAECA//EABgBAQADAQAAAAAAAAAAAAAAAAEAAgME/9oADAMBAAIQAxAAAAHldzPqikzAtRD/xAAYEAEBAQEBAAAAAAAAAAAAAAAAAREgIf/aAAgBAQABBQJFZHjJx//EABYRAQEBAAAAAAAAAAAAAAAAABEAEP/aAAgBAwEBPwFnf//EABQRAQAAAAAAAAAAAAAAAAAAACD/2gAIAQIBAT8BH//EABcQAAMBAAAAAAAAAAAAAAAAAAAQMSD/2gAIAQEABj8CdKXH/8QAGRAAAgMBAAAAAAAAAAAAAAAAABEQITEg/9oACAEBAAE/IRHeCOsgLkH/2gAMAwEAAgADAAAAEMjXg//EABcRAQADAAAAAAAAAAAAAAAAAAEAEBH/2gAIAQMBAT8QwkBf/8QAFREBAQAAAAAAAAAAAAAAAAAAESD/2gAIAQIBAT8QI//EAB0QAQACAgIDAAAAAAAAAAAAAAEAESFBIDFhgfH/2gAIAQEAAT8QiBTe0TdU0jrvnxDFaPkQ6t7OH//Z"
                    data-src="{{ '/assets/posts/migration-furet/logo_decitre-1.jpg' | prepend: site.baseurl  }}" 
                    data-srcset="{{ '/assets/posts/migration-furet/logo_decitre-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/migration-furet/logo_decitre-2.jpg' | prepend: site.baseurl  }} 2x" 
                />
                <noscript><img src="{{ '/assets/posts/migration-furet/logo_decitre-1.jpg' | prepend: site.baseurl  }}" /></noscript>
            
            </figure>
        </div>
        <div class="col-md col-sm">
            <figure>
                <img 
                    class="lozad" 
                    width="110" height="110"
                    src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAUABQDASIAAhEBAxEB/8QAFwABAAMAAAAAAAAAAAAAAAAAAAECA//EABYBAQEBAAAAAAAAAAAAAAAAAAACBP/aAAwDAQACEAMQAAABzXmNGSSqgA//xAAZEAACAwEAAAAAAAAAAAAAAAAAEQEQMUH/2gAIAQEAAQUCQprjJ2//xAAVEQEBAAAAAAAAAAAAAAAAAAARIP/aAAgBAwEBPwFj/8QAFBEBAAAAAAAAAAAAAAAAAAAAIP/aAAgBAgEBPwEf/8QAFxAAAwEAAAAAAAAAAAAAAAAAABAxIP/aAAgBAQAGPwJ0uf/EABoQAQACAwEAAAAAAAAAAAAAAAEAESAhQWH/2gAIAQEAAT8htVzyiI0wdI6x3//aAAwDAQACAAMAAAAQz888/8QAGBEAAgMAAAAAAAAAAAAAAAAAAAEQETH/2gAIAQMBAT8QsLJ//8QAFREBAQAAAAAAAAAAAAAAAAAAESD/2gAIAQIBAT8QI//EABoQAQADAQEBAAAAAAAAAAAAAAEAESFhIDH/2gAIAQEAAT8Qz1sdnXHQUkMwWFUxKJ+jcjGw3Zr3x//Z"
                    data-src="{{ '/assets/posts/migration-furet/logo_furet-1.jpg' | prepend: site.baseurl  }}" 
                    data-srcset="{{ '/assets/posts/migration-furet/logo_furet-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/migration-furet/logo_furet-2.jpg' | prepend: site.baseurl  }} 2x" 
                />
                <noscript><img src="{{ '/assets/posts/migration-furet/logo_furet-1.jpg' | prepend: site.baseurl  }}" /></noscript>

            
            </figure>

        
        </div>
        <div class="col-md-4"></div>
    </div>
</div>




L’ancien site était géré intégralement en sous-traitance. Certains composants du site étaient en marque blanche chez des prestataires comme les livres numériques.
Fortes de leur expérience sur les marques blanches et la vente en ligne, les équipes techniques de Decitre, en collaboration étroite avec les fonctionnels des deux enseignes ont procédé à la création du site en marque blanche ainsi qu’à la migration de l'existant.




## Création du site

Decitre Interactive, pionnier de la vente en ligne de livres, sur le site [decitre.fr](https://www.decitre.fr) (1.3 M visites/mois, 2 000 000 références produits) depuis 1997, propose également son expertise et son savoir-faire e-commerce à d’autres enseignes majeures de la distribution. 

Son offre clé en main permet aux acteurs du e-commerce de bénéficier d’un site en marque blanche, de notre catalogue de qualité, de la puissance de notre infrastructure logistique et d’un service client expert. 

Dans ce cadre nous opérons en marque blanche pour de nombreuses grandes enseignes culturelles.  La volonté était d’inscrire [furet.com](https://www.furet.com) dans l’un de ces modèles permettant ainsi de capitaliser sur notre expérience utilisateur ([UX](https://fr.wikipedia.org/wiki/Exp%C3%A9rience_utilisateur)), de bénéficier de services annexes déjà développés sur notre plateforme, tout en conservant son identité propre grâce à la charte du site.

### Mise en place d’une équipe projet


Pour pouvoir sortir le nouveau [furet.com](https://www.furet.com) dans les délais impartis (sortie du nouveau site à l’automne), nous nous sommes organisés en équipe projet afin de pouvoir démarrer le travail préparatoire, définir ensemble les lignes directrices du nouveau site, créer le plan de charge technique et fonctionnel avec un rétroplanning macro, et enfin mettre en place les groupes de travail entre équipes techniques et fonctionnelles des deux enseignes. La transformation et migration de [furet.com](https://www.furet.com) ont en effet impliqué, en plus de la technique, de nombreuses équipes Decitre et Furet : e-commerce, marketing-communication, produits, approvisionnements et logistique, service client, magasins, juridique… Nous avons dû promouvoir la méthodologie agile, qui n’était pas en place au sein de Furet, et promouvoir la culture web.

Le coeur de l’équipe projet s’est constitué autour d’une cheffe de projet, d’une product owner et d’un ou une membre de chaque principale équipe concernée (à savoir technique, e-commerce, marketing-communication et service client) pour former un comité de pilotage. Un ou plusieurs membres des autres équipes ont été sollicités de manière ponctuelle tout au long du projet en fonction des besoins. 

Le comité de pilotage se réunissait toutes les semaines sur un court créneau afin de discuter des sujets en cours, de trancher sur certaines problématiques, de faire le point sur l’avancée de chaque équipe pour tenir les délais. L’organisation s’est mise en place juste avant les deux mois d’été et donc des vacances... Nous avons conservé la récurrence des comités de pilotage toutes les semaines, même à effectifs réduits pour pouvoir avancer sur les sujets. On a dû s’organiser pour avancer au mieux dans l’été malgré les faibles ressources.

Outre cette réunion, plusieurs outils et moyens ont été mis en place pour faciliter la communication, les prises de décisions et pour suivre l’avancement du projet au sein du comité de pilotage, mais aussi entre l’ensemble des équipes des deux enseignes qui ont travaillé sur le nouveau [furet.com](https://www.furet.com).


### Travail préparatoire et outils 

Faire un audit de l’existant pour ne surtout pas engendrer de régressions de fonctionnalités risquant de perdre les anciens utilisateurs était la première étape avant d’initier le projet. Le travail préparatoire à la création du site est un enjeu majeur. Il permet de prendre un minimum de risques tout en maximisant la qualité de la qualification pour le travail qui va suivre.

Lors de la réalisation de cet audit, le but était d’avoir ensuite un cahier des charges des fonctionnalités et du fonctionnement sur le nouveau site, pour permettre la constitution du plan de charge technique et fonctionnel permettant la mise en ordre de marche des équipes projet.

Normalement, il est de coutume de sortir un [MVP](https://www.decitre.fr/livres/the-lean-startup-9781524762407.html) (Minimum Viable Product) avec ce qui est strictement essentiel au bon fonctionnement. Cependant, forts de notre expérience avec la création de nombreuses marques blanches, nous avons pu proposer un MVP plus complexe un [MLP](https://labs.sogeti.com/the-minimum-lovable-product/) (Minimum Lovable Product). Nous proposons ainsi un site dont les utilisateurs vont aimer se servir plutôt que juste consommer ce dont ils ont besoin. 

Le site mis en production est riche et diversifié dans les services proposés aux utilisateurs et clients furet.com basés sur nos propres modules et fonctionnalités créés au fil des années pour [decitre.fr](https://www.decitre.fr).

Le plan de charge que nous avons réussi à définir a été validé ensuite par toute l’équipe projet afin de formaliser ensemble les objectifs, les contraintes techniques, la charte graphique et tous les éléments constitutifs. 

Enfin, un groupe de discussion a été créé sur Slack, une boîte mail dédiée également et un dossier Google Drive rassemblant l’ensemble de nos documents de travail.

Nous étions donc partis pour trois mois complets de développements dédiés, réunions d’équipes, d’organisation avec les partenaires etc. Nous vivions Furet.com, transpirions Furet.com, nous étions Furet.com.

<figure>
    <img
        class="lozad"
        width="499" height="214"
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="https://media.giphy.com/media/YkfsOvmvh5uTK/giphy.gif"
    />
    <noscript><img src="https://media.giphy.com/media/YkfsOvmvh5uTK/giphy.gif" /></noscript>

    <figcaption>(source : <a href="https://media.giphy.com/media/YkfsOvmvh5uTK/giphy.gif">https://media.giphy.com/media/YkfsOvmvh5uTK/giphy.gif</a>)</figcaption>
</figure>



### Modification du webdesign

Pendant toute la durée du projet, le webdesign du nouveau [furet.com](https://www.furet.com) a été préparé de façon itérative sur une instance de pré-production.

Un petit groupe de travail s'est constitué au début du projet pour travailler la base, à partir de la charte print de l'enseigne Furet du Nord d'un côté et d'éléments utilisés sur nos sites en marque blanche de l'autre. Quelques aspects ont aussi été piochés sur l'ancien site.

<figure>
    <img 
        class="lozad" 
        width="600" height="385"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAANABQDASIAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAAMCBP/EABUBAQEAAAAAAAAAAAAAAAAAAAAB/9oADAMBAAIQAxAAAAHp3OiAv//EABYQAQEBAAAAAAAAAAAAAAAAAAEQIf/aAAgBAQABBQKhs//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQMBAT8BP//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8BP//EABQQAQAAAAAAAAAAAAAAAAAAACD/2gAIAQEABj8CX//EABcQAQEBAQAAAAAAAAAAAAAAAAEREDH/2gAIAQEAAT8hq9mzTv8A/9oADAMBAAIAAwAAABALz//EABYRAQEBAAAAAAAAAAAAAAAAAAEQEf/aAAgBAwEBPxAdn//EABURAQEAAAAAAAAAAAAAAAAAAAEQ/9oACAECAQE/EGf/xAAbEAEAAgIDAAAAAAAAAAAAAAABACEQEUFR4f/aAAgBAQABPxAUi0Oj2Fk1AqLHiBj/2Q=="
        data-src="{{ '/assets/posts/migration-furet/boutons-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/migration-furet/boutons-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/migration-furet/boutons-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/migration-furet/boutons-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Sondage via Slack pour les choix de base de la nouvelle charte</figcaption>
</figure>


Forts de notre expertise sur l'ergonomie et le design des différentes plateformes de e-commerce que nous gérons, les équipes techniques, e-commerce et communication ont peu à peu modelé le design du nouveau site : tests d'agencement, structure et présentation des différents types de pages, ajustement de couleurs, nouvelle charte de bannière, échanges via notre outil de discussion pour les cas à débat... Un travail de longue haleine (mais passionnant !) s'est déroulé sur plusieurs mois pour dessiner la nouvelle ligne graphique de [furet.com](https://www.furet.com).


<div class="container">
    <div class="row">
        <div class="col-md">
            <figure>
                <img 
                    class="lozad" 
                    width="475" height="343"
                    src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAOABQDASIAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAAECA//EABUBAQEAAAAAAAAAAAAAAAAAAAAB/9oADAMBAAIQAxAAAAHuWK0P/8QAGBABAAMBAAAAAAAAAAAAAAAAAQARIRD/2gAIAQEAAQUCy7IBGiY8/8QAFREBAQAAAAAAAAAAAAAAAAAAECH/2gAIAQMBAT8Bp//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8BP//EABQQAQAAAAAAAAAAAAAAAAAAACD/2gAIAQEABj8CX//EABoQAAMBAAMAAAAAAAAAAAAAAAABMREhUaH/2gAIAQEAAT8hpwPp8MEHatQtoQ//2gAMAwEAAgADAAAAEGs//8QAFhEBAQEAAAAAAAAAAAAAAAAAABEB/9oACAEDAQE/EKXX/8QAFREBAQAAAAAAAAAAAAAAAAAAAAH/2gAIAQIBAT8QR//EABsQAQACAwEBAAAAAAAAAAAAAAEAESExYUFx/9oACAEBAAE/EBAN7fQxNDB5CLVfoR8VW3EsTcrfZRgan//Z"
                    data-src="{{ '/assets/posts/migration-furet/furet_avant-1.jpg' | prepend: site.baseurl  }}" 
                    data-srcset="{{ '/assets/posts/migration-furet/furet_avant-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/migration-furet/furet_avant-2.jpg' | prepend: site.baseurl  }} 2x" 
                />
                <noscript><img src="{{ '/assets/posts/migration-furet/furet_avant-1.jpg' | prepend: site.baseurl  }}" /></noscript>
            
                <figcaption>Avant</figcaption>
            </figure>

        </div>
        <div class="col-md">
            <figure>
                <img 
                    class="lozad" 
                    width="475" height="282"
                    src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAMABQDASIAAhEBAxEB/8QAFwAAAwEAAAAAAAAAAAAAAAAAAAEDAv/EABQBAQAAAAAAAAAAAAAAAAAAAAH/2gAMAwEAAhADEAAAAdqqFlBP/8QAGBABAAMBAAAAAAAAAAAAAAAAAQACIRL/2gAIAQEAAQUCVHpldF0dn//EABURAQEAAAAAAAAAAAAAAAAAABAR/9oACAEDAQE/Aaf/xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAg/9oACAEBAAY/Al//xAAZEAEBAQADAAAAAAAAAAAAAAABABFhcZH/2gAIAQEAAT8hchc1rVWQz1J5i//aAAwDAQACAAMAAAAQDw//xAAXEQEAAwAAAAAAAAAAAAAAAAAAARFR/9oACAEDAQE/EKYl/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPxA//8QAGhABAAMBAQEAAAAAAAAAAAAAAQARIVFxkf/aAAgBAQABPxBREB+xzpabGIpeMchyoHS7OvZon//Z"
                    data-src="{{ '/assets/posts/migration-furet/furet_apres-1.jpg' | prepend: site.baseurl  }}" 
                    data-srcset="{{ '/assets/posts/migration-furet/furet_apres-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/migration-furet/furet_apres-2.jpg' | prepend: site.baseurl  }} 2x" 
                />
                <noscript><img src="{{ '/assets/posts/migration-furet/furet_apres-1.jpg' | prepend: site.baseurl  }}" /></noscript>
            
                <figcaption>Après</figcaption>
            </figure>

        
        </div>
    </div>
</div>


### La recette

Ce terme pouvant faire saliver les novices n’est pas la partie la plus agréable mais elle est pourtant nécessaire. Il était important d’impliquer des collaborateurs des deux enseignes, et d’avoir une mixité entre les personnes ayant participées au projet depuis le début et des personnes qui découvraient le site. Cette étape de validation de l’ensemble des développements et modifications opérées était essentielle et son aspect collaboratif était déterminant.

La recette devait être faite par certaines personnes novices au monde numérique et pour qui parler d’environnement de préprod ou de prod n’était pas évident. Comme nous démarrions sur notre interface de migration, nous avons pu leur proposer de valider directement sur ce qui allait être la future version de production pour plus de facilité. 

Une phase de recette a été faite en itératif par les équipes projet et une seconde phase qui a pris un mois complet a été réalisée entre toutes les équipes.

La partie la plus longue était celle des transporteurs puisqu’il fallait tester les connexions avec l'entrepôt (qui lui aussi changeait) et tous les moyens de transport, retours clients compris. L’autre partie sensible était la connexion entre deux ERP différents, ceux de Furet et Decitre. Une fois ces deux parties évacuées il restait à « chercher la petite bête » sur tout le site.

Design, intégration, coquilles, balises de référencement, liens, tout doit être passé au crible pour être sûr de ne rien laisser passer.

Pour nous aider dans cette recette un document de référence le « plan de recette » a été élaboré et partagé avec l’ensemble des équipes.
Il reprend tous les éléments à tester, les dates de tests, les testeurs, les navigateurs et les devices à tester. 

<figure>
    <img 
        class="lozad" 
        width="900" height="373"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAIABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAEE/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEAMQAAAB1AgP/8QAFhAAAwAAAAAAAAAAAAAAAAAAABAR/9oACAEBAAEFAlT/xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/AT//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAQ/9oACAEBAAY/An//xAAYEAACAwAAAAAAAAAAAAAAAAAAEQFhcf/aAAgBAQABPyFwx2aP/9oADAMBAAIAAwAAABD77//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQMBAT8QP//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8QP//EABoQAAMAAwEAAAAAAAAAAAAAAAABESExUZH/2gAIAQEAAT8Qg2UNbp6Vwf/Z"
        data-src="{{ '/assets/posts/migration-furet/plan_de_recette-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/migration-furet/plan_de_recette-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/migration-furet/plan_de_recette-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/migration-furet/plan_de_recette-1.jpg' | prepend: site.baseurl  }}" /></noscript>


    <figcaption>Les différentes étapes de notre plan de recette</figcaption>
</figure>


Le document permettait également les retours de recette qui pouvaient être adressés à deux services, les développeurs et le service e-commerce pour tout ce qui concernait le webdesign et le webmerch. Le but étant d’uniformiser les retours de recette, nous avons donc communiqué un ID correspondant à des étapes découpées et normées pour indiquer quelle partie de la recette est effectuée et son statut.

Au niveau des outils nous avons utilisé un Google Drive partagé pour le plan de recette et [BrowserStack](https://www.browserstack.com/) pour la partie de l’équipe qui a véritablement testé sur tous les navigateurs et tous les appareils.

BrowserStack est un site web et une application mobile qui permet de tester votre site web sur plusieurs devices et plusieurs navigateurs (avec quasiment toutes les versions disponibles). Si vous souhaitez découvrir tout ce qu’il est possible de tester vous pouvez visiter [ce lien](https://www.browserstack.com/list-of-browsers-and-platforms/live).

La migration pouvait alors commencer :) Challenge : migrer le tout en moins de deux minutes.


## La migration du site

On va commencer à parler — un peu — technique. La plateforme source qui fait tourner l’ancienne version de furet.com est un Magento. Cela tombe bien, car [decitre.fr](https://www.decitre.fr) et toutes les marques blanches qui tournent sur notre infrastructure sont également sur Magento. 

Une des particularités de la précédente version de [furet.com](https://www.furet.com) est de devoir migrer plusieurs sites (furet.com, sa version belge, les versions mobiles). On a donc plusieurs domaines à basculer vers une seule cible : [www.furet.com](https://www.furet.com) qui gérera les magasins français et belges et qui adoptera le principe du [Responsive Web Design](https://fr.wikipedia.org/wiki/Site_web_r%C3%A9actif) pour la version mobile.


### S’assurer de ne pas casser le SEO 

Avec un lancement du nouveau site prévu sur le mois de novembre, il fallait anticiper et préparer la reprise du référencement lors de la migration du site web afin de ne pas perdre de trafic avant Noël. 

Le nouveau site contient un catalogue produit sensiblement similaire, mais une arborescence différente et des pages annexes enrichies. De plus, comme mentionné précédemment, nous allons avoir trois domaines différents qui vont converger vers un seul. 

Il faudra également penser à toutes les URLs produits, catégories, etc. qui vont être modifiées sur la nouvelle infrastructure. Nous avons donc analysé les logs applicatifs pour identifier les pages parcourues par les robots des moteurs de recherche, qualifier ces pages et définir notre [plan de redirection](https://fr.wikipedia.org/wiki/Redirection_d%27URL). 

L’objectif à atteindre pour ce plan est de gérer des redirections sur un maximum de pages indexées par Google (nos fiches produits par exemple) et de réduire à un niveau le plus acceptable possible le nombre de pages qui répondront en 404. 

Pour valider ce plan, nous avons repris un historique des logs Apache sur une période significative que nous avons filtrée sur le UserAgent Googlebot. 

Une fois ces URLs identifiées, nous avons fait un script en Go pour lancer un tir sur notre environnement de préproduction et valider notre plan de redirection. Ce script prend une liste d'URLs et nous indique le code retour HTTP de chaque page testée. 

Ainsi nous avons pu voir, par rapport au contenu connu par Google, quelles pages allaient être redirigées, quelles pages retourneraient un code retour 404 pour ainsi ajuster le plan de redirection.


### La récolte des clients et des commandes

Nous avons plutôt l’habitude de créer de nouvelles marques blanches sur notre plateforme e-commerce. Dans le cas de [furet.com](https://www.furet.com), nous faisons face à une problématique nouvelle pour nous : migrer un site e-commerce avec un historique de plus de 10 ans de clients et commandes. 

Comme nous n’aimons pas les surprises de dernière minute, qui généralement sont mauvaises, nous avons décidé de migrer au plus tôt et d’appliquer la stratégie de la migration continue. 

Nous ne souhaitions pas faire une seule migration le jour J de toutes les données et prendre le risque que cela plante ou de découvrir un cas limite non anticipé. Nous avons donc choisi de lancer les migrations de données plusieurs fois par jour. 


<figure>
    <img
        class="lozad"
        width="480" height="480"
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="https://media.giphy.com/media/l41YcLnzt7SNyxUha/giphy.gif"
    />
    <noscript><img src="https://media.giphy.com/media/l41YcLnzt7SNyxUha/giphy.gif" /></noscript>

    <figcaption>Quand la migration de données devient incontrôlable (source : <a href="https://media.giphy.com/media/l41YcLnzt7SNyxUha/giphy.gif">https://media.giphy.com/media/l41YcLnzt7SNyxUha/giphy.gif</a>)</figcaption>
</figure>

Ainsi, nous exportons l’exhaustivité des commandes et clients ciblés depuis le serveur source (dans des fichiers plats). Puis, nous les récupérons et lançons une intégration de ces données sur notre plateforme cible. 

Cela nous a permis de migrer toutes les données souhaitées, de suivre et faire évoluer par exemple les commandes en fonction de leur statut et surtout d’avoir un site cible à jour avant même qu’il ne soit en production. 

Pendant près d’un mois, nous avons chargé toutes ces données sur notre production (la future version de furet.com et surtout les serveurs de production où tournent decitre.fr et nos  marques blanches) et pris le temps de gérer la plupart des problèmes de migration rencontrés avant que la bascule du site ne soit effectuée.

De la même manière, nous avons travaillé avec [Vivlio](https://www.vivlio.fr/) pour migrer en continu également toutes les commandes ebooks qui étaient sur leur plateforme vers la nôtre. Pour ces commandes, nous avons utilisé une API de synchronisation présente sur decitre.fr qui permet de récupérer toute commande passée dans l’écosystème Vivlio pour les passer sur notre plateforme. De cette façon, nous avons pu récupérer les achats faits par les clients de furet.com peu importe la plateforme où ils ont été effectués.

### La migration bascule DNS


Toute cette préparation en amont a fait qu’au moment de la bascule, nous n’avons eu que quelques tâches à effectuer. Nous avons eu principalement de la configuration et surtout une bascule DNS pour faire pointer le nom de domaine [furet.com](https://www.furet.com) et ses sous-domaines vers notre infrastructure.




<figure>
    <video controls loop muted width="250" height="401">
        <source src="https://video.twimg.com/ext_tw_video/1190720348439924737/pu/vid/532x854/evQNwMZFo_SRILfB.mp4"
                type="video/mp4">
    </video>

    <figcaption>Reconstitution de la migration (source : <a href="https://twitter.com/campuscodi/status/1190906457954365440">https://twitter.com/campuscodi/status/1190906457954365440</a>)</figcaption>
</figure>

Et voilà ! En deux minutes, le temps de propagation des enregistrements DNS, le site est désormais basculé sur notre plateforme, concluant ainsi plusieurs mois d’analyse, préparation, développement et intégration, permettant à nos clients de bénéficier d’une nouvelle version de leur site.

<figure>
    <img 
        class="lozad" 
        width="600" height="178"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAGABQDASIAAhEBAxEB/8QAFwABAAMAAAAAAAAAAAAAAAAAAAEDBP/EABUBAQEAAAAAAAAAAAAAAAAAAAAB/9oADAMBAAIQAxAAAAHZSEhf/8QAFxABAQEBAAAAAAAAAAAAAAAAAAEREv/aAAgBAQABBQJtdV//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/AT//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAQ/9oACAEBAAY/An//xAAWEAADAAAAAAAAAAAAAAAAAAAAECH/2gAIAQEAAT8hLI//2gAMAwEAAgADAAAAEHfv/8QAFhEBAQEAAAAAAAAAAAAAAAAAAAER/9oACAEDAQE/EIx//8QAFREBAQAAAAAAAAAAAAAAAAAAABH/2gAIAQIBAT8QR//EABgQAQEBAQEAAAAAAAAAAAAAAAERADGB/9oACAEBAAE/EFAszYj5iHDf/9k="
        data-src="{{ '/assets/posts/migration-furet/new_relic_mep-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/migration-furet/new_relic_mep-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/migration-furet/new_relic_mep-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/migration-furet/new_relic_mep-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>It’s Alive</figcaption>
</figure>




Le premier projet Web commun Furet du Nord-Decitre, visible par tous les collaborateurs et collaboratrices est enfin sorti. 

Il y a eu trois mois depuis le lancement du chantier en mode projet, mais en comptant les anticipations techniques, les analyses de l’existant, la recette et les retours, ce beau projet nous aura occupé durant bien six mois sur les différentes équipes.

La deadline a été respectée et la qualité est au rendez-vous, cela nous a permis de mieux communiquer entre nous tout en propageant la culture web. Le MVP amélioré étant sorti, il est temps pour nous de passer aux  futurs développements et à l’amélioration continue, ce n’est donc encore que le début :)

<figure>
    <img 
        class="lozad" 
        width="600" height="450"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAPABQDASIAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAAIBA//EABYBAQEBAAAAAAAAAAAAAAAAAAIAAf/aAAwDAQACEAMQAAAByOrESj//xAAaEAACAgMAAAAAAAAAAAAAAAAAAQIREhMx/9oACAEBAAEFAp1Z0wZrZTP/xAAVEQEBAAAAAAAAAAAAAAAAAAAQIf/aAAgBAwEBPwGH/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPwE//8QAFhAAAwAAAAAAAAAAAAAAAAAAACAx/9oACAEBAAY/Alp//8QAGRAAAwEBAQAAAAAAAAAAAAAAAAERITFh/9oACAEBAAE/IWbBRJadGHpjIcH/2gAMAwEAAgADAAAAEKT/AP/EABURAQEAAAAAAAAAAAAAAAAAABAR/9oACAEDAQE/EKP/xAAVEQEBAAAAAAAAAAAAAAAAAAAQEf/aAAgBAgEBPxCH/8QAGhABAAMBAQEAAAAAAAAAAAAAAQARITFBUf/aAAgBAQABPxBNlrbMixOh3SXQpvxjEbLOHkEUfsnHg7P/2Q=="
        data-src="{{ '/assets/posts/migration-furet/equipe_projet-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/migration-furet/equipe_projet-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/migration-furet/equipe_projet-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/migration-furet/equipe_projet-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>L'équipe projet</figcaption>
</figure>

