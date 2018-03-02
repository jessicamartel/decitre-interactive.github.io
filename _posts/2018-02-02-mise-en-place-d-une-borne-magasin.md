---
layout: post
title:  "Mise en place d'une borne magasin"
author: srogier
excerpt: "Comment nous avons mis en place dans nos librairies une borne interactive branchée sur une page web"
date: 2018-02-02 14:30:00+01:00
---

> *Mardi 2 mai 2017 - Siège de Decitre - 15h42 - Réunion de planification*
>
> *- Bon, l'équipe Marketing aimerait mettre en place une tablette dans les librairies qui permette d'accéder à [decitre.fr](https://www.decitre.fr), à un questionnaire de satisfaction et aux jeux-concours. Un modèle unique de tablette a été choisi, c'est de l'Android. Vous chiffrez ça à combien ?*
>
> *- Deux jours de dev ? On fait une pauvre page web avec 3 liens, on héberge ça sur [Github Pages](https://pages.github.com/) et on n'en parle plus.*
>
> *- Vendu pour deux jours*

Et voilà, en deux phrases, le cahier des charges de notre borne magasin. 

Bon, en vrai, on avait aussi des maquettes.
 
L'objectif : faire une page répartie en 3 volets qui serait chacun un lien vers un site externe.

Une contrainte quand même, la tablette sera intégrée sur un support qui empêchera l'accès physique aux différents boutons.

Sur le papier, rien de compliqué. **Mais ça, c'était l'approche naïve**.

<figure>
    <img 
        class="lozad" 
        width="600" height="450"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAPABQDASIAAhEBAxEB/8QAGAAAAwEBAAAAAAAAAAAAAAAAAAMEAQL/xAAVAQEBAAAAAAAAAAAAAAAAAAABA//aAAwDAQACEAMQAAAB4emgpGaFP//EABcQAAMBAAAAAAAAAAAAAAAAAAACMgP/2gAIAQEAAQUCWtJFrST/xAAWEQADAAAAAAAAAAAAAAAAAAABEDH/2gAIAQMBAT8BNX//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAXEAADAQAAAAAAAAAAAAAAAAAAARAx/9oACAEBAAY/AkZFf//EABoQAAMBAAMAAAAAAAAAAAAAAAABIVERgaH/2gAIAQEAAT8hRdgiyo1T0Expyf/aAAwDAQACAAMAAAAQN8//xAAWEQEBAQAAAAAAAAAAAAAAAAAAETH/2gAIAQMBAT8QzR//xAAWEQADAAAAAAAAAAAAAAAAAAABEDH/2gAIAQIBAT8QEX//xAAaEAEAAwEBAQAAAAAAAAAAAAABABEhMVGB/9oACAEBAAE/EObG/ERwxMIJQ35G1rlJhcNIpdZ//9k="
        data-src="{{ '/assets/posts/mise-en-place-borne-magasin/appli-accueil-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/mise-en-place-borne-magasin/appli-accueil-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/mise-en-place-borne-magasin/appli-accueil-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/mise-en-place-borne-magasin/appli-accueil-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>L'objectif fixé</figcaption>
</figure>



## Une “pauvre” page Web

En effet, la partie web en elle-même est super simple. 

Nous n'avions que très peu de contraintes : un seul modèle de tablette à supporter, pour une version de Google Chrome récente. On peut même se permettre de jouer avec des fonctionnalités CSS comme [les variables](https://developer.mozilla.org/en-US/docs/Web/CSS/Using_CSS_variables) ou [les grids](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Grid_Layout). Bref, que du bonheur.

Le fonctionnement est simple : au clic sur un des volets, on charge une iframe vers le contenu distant afin d'intégrer, par exemple, notre site dans l'application de la borne.

<figure>
    <img 
        class="lozad" 
        width="600" height="450"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAPABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAQAC/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEAMQAAAB0oUx/8QAGRABAAMBAQAAAAAAAAAAAAAAAAECEhEh/9oACAEBAAEFAnUet1bq3D//xAAWEQADAAAAAAAAAAAAAAAAAAAAARL/2gAIAQMBAT8Blks//8QAFREBAQAAAAAAAAAAAAAAAAAAABH/2gAIAQIBAT8BV//EABcQAAMBAAAAAAAAAAAAAAAAAAAQ4TH/2gAIAQEABj8ChCLF/8QAHBAAAgICAwAAAAAAAAAAAAAAAAERIXGhUWGB/9oACAEBAAE/IZSqRDnQopodGhQqUnBhXh//2gAMAwEAAgADAAAAEJcf/8QAFREBAQAAAAAAAAAAAAAAAAAAEFH/2gAIAQMBAT8Qqf8A/8QAFhEBAQEAAAAAAAAAAAAAAAAAABEB/9oACAECAQE/ELiH/8QAGhABAQEBAQEBAAAAAAAAAAAAAREhADFRYf/aAAgBAQABPxC/In573zhek0is08iKh+XuSklDPAr4XA7/AP/Z"
        data-src="{{ '/assets/posts/mise-en-place-borne-magasin/appli-ouverte-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/mise-en-place-borne-magasin/appli-ouverte-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/mise-en-place-borne-magasin/appli-ouverte-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/mise-en-place-borne-magasin/appli-ouverte-1.jpg' | prepend: site.baseurl  }}" /></noscript>
    
    <figcaption>Application ouverte sur decitre.fr</figcaption>
</figure>



Quant à l'hébergement, afin de faire au plus simple, on décide de passer par [Github Pages](https://pages.github.com/).

Pour isoler notre page Web, on décide de tester de passer un [Manifeste d'application Web](https://developer.mozilla.org/fr/Add-ons/WebExtensions/manifest.json).
En un fichier JSON, on décrit comment notre page doit se comporter en tant qu’application autonome.

```json
{
  "name": "Borne magasin",
  "version": "0.0.1",

  "display": "standalone",
  "orientation": "landscape",

  "theme_color": "#e2001a",
  "background_color": "#e2001a",

  "start_url": "/"
}
```

Grâce à cette description, on peut avoir une application avec son icône sur le bureau, qui se lance de manière indépendante dans une WebView Android sans tout le contexte du navigateur : une [Progressive Web Application](https://en.wikipedia.org/wiki/Progressive_web_app) dans toute sa splendeur (😁).

C'est bien beau, l'application est bien isolée, mais qu'est-ce qui empêche l'utilisateur de quitter la page web, d'accéder à l’ensemble des applications de la tablette et de faire n’importe quoi ? Là, comme ça, rien...

## À la recherche de l'application Kiosque parfaite

Comment isoler notre application du reste de la tablette ?
Il faudra donc que l'application soit toujours active car, sans l'accès aux boutons physiques, sortir du mode veille sera compliqué.


Envisagé, le mode enfant de la tablette est rapidement éliminé, pour des raisons évidentes.

<figure>
    <img 
        class="lozad" 
        width="600" height="450"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAPABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAED/8QAFgEBAQEAAAAAAAAAAAAAAAAAAQAD/9oADAMBAAIQAxAAAAHWSuYR/8QAFBABAAAAAAAAAAAAAAAAAAAAIP/aAAgBAQABBQJf/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPwE//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPwE//8QAFBABAAAAAAAAAAAAAAAAAAAAIP/aAAgBAQAGPwJf/8QAFxABAAMAAAAAAAAAAAAAAAAAEBEhUf/aAAgBAQABPyGG8f/aAAwDAQACAAMAAAAQhD//xAAWEQADAAAAAAAAAAAAAAAAAAABEHH/2gAIAQMBAT8QMX//xAAVEQEBAAAAAAAAAAAAAAAAAAABEP/aAAgBAgEBPxAn/8QAGhAAAgMBAQAAAAAAAAAAAAAAATEAECGREf/aAAgBAQABPxBQQR2F17rnXAq//9k="
        data-src="{{ '/assets/posts/mise-en-place-borne-magasin/mode-enfant-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/mise-en-place-borne-magasin/mode-enfant-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/mise-en-place-borne-magasin/mode-enfant-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/mise-en-place-borne-magasin/mode-enfant-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Le mode enfant de la tablette et son professionnalisme qui saute aux yeux</figcaption>
</figure>



### Hexnode MDM


Notre premier essai se fait avec [Hexnode MDM](https://www.hexnode.com/mobile-device-management/). C'est un outil de type Mobile Device Management, qui permet de gérer un parc de tablettes et qui propose un mode kiosque où l’on peut isoler une application Android ou une page Web.

<figure>
    <img
        class="lozad"
        width="600" height="323"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAALABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAQAE/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEAMQAAAB0rBMf//EABcQAAMBAAAAAAAAAAAAAAAAAAABESD/2gAIAQEAAQUCiIiY/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPwE//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPwE//8QAFhABAQEAAAAAAAAAAAAAAAAAMQAg/9oACAEBAAY/AiM//8QAGRAAAgMBAAAAAAAAAAAAAAAAAGEBESBR/9oACAEBAAE/IVBQpyMf/9oADAMBAAIAAwAAABCzz//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQMBAT8QP//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8QP//EABcQAAMBAAAAAAAAAAAAAAAAAAAQ8QH/2gAIAQEAAT8QiEQjLF//2Q=="
        data-src="/assets/posts/mise-en-place-borne-magasin/hexnode-1.png"
        data-srcset="/assets/posts/mise-en-place-borne-magasin/hexnode-1.png 1x, /assets/posts/mise-en-place-borne-magasin/hexnode-2.png 2x"
    />
    
    <noscript><img src="{{ '/assets/posts/mise-en-place-borne-magasin/hexnode-1.jpg' | prepend: site.baseurl  }}" /></noscript>
</figure>


Dans l'outil, on configure une URL, une icône et voilà. Notre page Web est embarquée dans l'application Hexnode et s'ouvre dans un navigateur interne à leur solution basé sur Google Chrome.

Et c'est là que les problèmes ont commencé.

Sur [decitre.fr](https://www.decitre.fr), nous avons certains liens qui s'ouvrent dans un nouvel onglet : rien d'exceptionnel.
Le souci c'est que dans l'appli kiosque, il n'y a pas d'onglet (normal c'est une WebView d'une page). Il remplace donc la page de la borne par la page appelée.

Sauf qu'il faut autoriser les différents domaines affichables et que si le domaine n'est pas autorisé on a une très belle page blanche, sans aucun bouton retour possible (et je rappelle que les boutons physiques de la tablette ne sont pas accessibles et qu’il n’y a pas de barre de navigation). C'est donc un problème plutôt gênant.

Hexnode ne permettant pas de configurer cela pour une page web, on décide de passer à l'étape suivante et de sortir le tutoriel des débutants pour Android : nous allons créer nous-mêmes notre [APK qui fera la WebView](https://developer.chrome.com/multidevice/webview/gettingstarted).

En plus, c'est super pratique. Grâce à [l'appel d'une méthode](https://developer.android.com/reference/android/webkit/WebViewClient.html#shouldOverrideUrlLoading(android.webkit.WebView, java.lang.String)), on peut définir le comportement sur les liens et empêcher de sortir de l'application.

Le souci, c'est que développeur Android c'est un métier, et ce n'est pas le nôtre. L'application Android fonctionne, mais en cas de problème nous n'avions pas forcément les compétences pour pouvoir les régler. Nous n'étions donc pas totalement confiants pour mettre cet APK en production.

Mais bon, nous avons poussé l'expérience jusqu'au bout, installé une tablette dans nos locaux, mis l'APK en mode kiosque et commencé à la faire tester par nos collègues pour avoir les premiers retours.

Le souci c'est qu'avec l'APK, l'application Hexnode en mode kiosque ne tenait pas plus de 24h et crashait sans même pouvoir effectuer un rapport de bug. Avec 15 minutes de montage/démontage du socle pour pouvoir redémarrer la tablette (5 minutes avec entraînement), on s'est vite rendu compte que cette solution n'était pas la bonne pour nous.

Nous décidons donc d'abandonner Hexnode, l'APK et de trouver un nouvel outil pour notre borne.

### Mobilock Pro

Nous avons choisi de tester [Mobilock Pro](https://mobilock.in/), un autre outil de kiosque.

<figure>
    <img
        class="lozad"
        width="600" height="346"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAMABQDASIAAhEBAxEB/8QAGAAAAgMAAAAAAAAAAAAAAAAAAAMBAgT/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIQAxAAAAHTAoaXD//EABgQAAMBAQAAAAAAAAAAAAAAAAABAhES/9oACAEBAAEFAuUcoxFvJi22f//EABURAQEAAAAAAAAAAAAAAAAAABAR/9oACAEDAQE/AYf/xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAWEAADAAAAAAAAAAAAAAAAAAAQIDH/2gAIAQEABj8CET//xAAaEAACAgMAAAAAAAAAAAAAAAAAARFhEFGR/9oACAEBAAE/IXoRQuFQZMiBvH//2gAMAwEAAgADAAAAEBTP/8QAFxEAAwEAAAAAAAAAAAAAAAAAARARIf/aAAgBAwEBPxAYq//EABYRAAMAAAAAAAAAAAAAAAAAAAABEf/aAAgBAgEBPxCsrP/EABwQAQACAQUAAAAAAAAAAAAAAAEAEYEhMUFR8f/aAAgBAQABPxBNUWIFumE8WKK7HmBFKrqGpP/Z"
        data-src="/assets/posts/mise-en-place-borne-magasin/mobilock-1.png"
        data-srcset="/assets/posts/mise-en-place-borne-magasin/mobilock-1.png 1x, /assets/posts/mise-en-place-borne-magasin/mobilock-2.png 2x"
    />
    
    <noscript><img src="{{ '/assets/posts/mise-en-place-borne-magasin/mobilock-1.jpg' | prepend: site.baseurl  }}" /></noscript>
</figure>


Dans cet outil, on définit une liste de sites webs autorisés et pour chaque site, on peut entre autres régler un rafraîchissement régulier de la page web ou bien désactiver la saisie automatique dans les formulaires (ce qui est pratique dans le cas d’une tablette ouverte au public).

Il est moins orienté MDM que Hexnode. On ne pourra pas, avec cet outil, installer des APK issus de Google Play, mais visuellement il est plus simple et agréable à configurer, et plus personnalisable pour les pages Web.

Et surtout, on peut le lancer sans que la tablette ne crashe au bout de 24h.

Après quelques allers/retours avec le support de Mobilock pour aider à la configuration, nous décidons de poursuivre les tests, et de laisser la tablette quelques temps dans son socle, pour voir comment ça se passe avant la mise en production.

## Découverte des bugs matériels

Si la partie logicielle semble être plus stable, côté matériel nous allons découvrir pas mal de soucis auxquels nous n'aurions pas pensés au premier usage.

Déjà, notre tablette est allumée en permanence. Cela signifie donc que l'écran consomme et qu'elle se décharge vite. Pour l'intégrer dans son socle, nous avions acheté des câbles USB-C de plusieurs mètres pour pouvoir atteindre la prise électrique. Sauf qu'avec cette rallonge, la tablette se déchargeait plus vite qu'elle ne se chargeait et finissait par s'éteindre après quelques heures.

Donc note pour plus tard, sur des câbles USB-C, il faut bien regarder la capacité de chargement du câble pour éviter ce genre de problème.

<figure>
    <img
        class="lozad"
        width="445" height="345"
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="https://imgs.xkcd.com/comics/usb_cables.png"
    />
    <noscript><img src="https://imgs.xkcd.com/comics/usb_cables.png" /></noscript>
    
    <figcaption>Petit rappel sur l'utilisabilité des cables USB <a href="https://xkcd.com/1892/">https://xkcd.com/1892/</a></figcaption>
</figure>

Avec le socle monté, nous constatons un nouveau problème. Parfois, l'application de kiosque s'arrête, et on voit dans Google Analytics un pic de connexion sur la page juste avant l'heure d'arrêt de l'application de kiosque.

En fait, là c'est le support de tablette qui a décidé de nous pourrir la vie : le nouveau câble d'alimentation de la tablette passe entre la base du support et la tablette, et comme il est un peu plus rigide que le précédent, cela fait un effet levier qui remonte légèrement la tablette. 

Et ce décalage est suffisant pour que le bouton d'accueil de la tablette finisse par être en contact avec le couvercle du support de tablette après quelques utilisations.

Et là, c'est le drame. Normalement, un appui long sur le bouton d'accueil déclenche l’ouverture de Google Assistant. Mais comme il est enfoncé longtemps, il le déclenche beaucoup de fois. Tellement de fois, que l'application kiosque finit par abandonner et planter.

<figure>
    <img
        class="lozad"
        width="450" height="600"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAbABQDASIAAhEBAxEB/8QAGQAAAgMBAAAAAAAAAAAAAAAAAAIBAwQF/8QAFgEBAQEAAAAAAAAAAAAAAAAAAQAC/9oADAMBAAIQAxAAAAGtWgtBaGsViq56BkG//8QAGxAAAgMAAwAAAAAAAAAAAAAAAAECESESIjH/2gAIAQEAAQUCb4kZbQ+yjDUsLF4xFn//xAAUEQEAAAAAAAAAAAAAAAAAAAAg/9oACAEDAQE/AR//xAAUEQEAAAAAAAAAAAAAAAAAAAAg/9oACAECAQE/AR//xAAWEAADAAAAAAAAAAAAAAAAAAAgITD/2gAIAQEABj8CBw//xAAbEAEBAQADAQEAAAAAAAAAAAABABEhMVEQcf/aAAgBAQABPyEB+y4Hq3DD2TDM4dwPZcPgGwg4b//aAAwDAQACAAMAAAAQjyfM/8QAFhEAAwAAAAAAAAAAAAAAAAAAABAh/9oACAEDAQE/ECP/xAAXEQADAQAAAAAAAAAAAAAAAAAAAREQ/9oACAECAQE/ECMmf//EABsQAQADAQEBAQAAAAAAAAAAAAEAETEhgUFx/9oACAEBAAE/ECCHcNXU4DVzMlnRhU33kIwAN0fZuVarEiPZTxAUG+QFZssGuwoIH7P/2Q=="
        data-src="{{ '/assets/posts/mise-en-place-borne-magasin/borne-vide-1.jpg' | prepend: site.baseurl  }}"
        data-srcset="{{ '/assets/posts/mise-en-place-borne-magasin/borne-vide-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/mise-en-place-borne-magasin/borne-vide-2.jpg' | prepend: site.baseurl  }} 2x"
    />
    <noscript><img src="{{ '/assets/posts/mise-en-place-borne-magasin/borne-vide-1.jpg' | prepend: site.baseurl  }}" /></noscript>
    
    <figcaption>Le support de la tablette sans son socle</figcaption>
</figure>

<figure>
    <img
        class="lozad"
        width="600" height="450"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAPABQDASIAAhEBAxEB/8QAFwAAAwEAAAAAAAAAAAAAAAAAAAECA//EABUBAQEAAAAAAAAAAAAAAAAAAAEA/9oADAMBAAIQAxAAAAHKoYo1I//EABgQAQEBAQEAAAAAAAAAAAAAAAEAESEx/9oACAEBAAEFAiUbsZOR5//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQMBAT8BP//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8BP//EABgQAQEAAwAAAAAAAAAAAAAAAAAhARAR/9oACAEBAAY/AkmqjHH/xAAaEAEAAgMBAAAAAAAAAAAAAAABABEhMWFB/9oACAEBAAE/IUBbnk0DDsy1bHpeuRE3b9Y2T//aAAwDAQACAAMAAAAQEB//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/ED//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/ED//xAAbEAEAAwEAAwAAAAAAAAAAAAABABEhQTFRof/aAAgBAQABPxAKQ1xNQJXYutDDzAPYTPgaPEWGZTR8mWZW725//9k="
        data-src="{{ '/assets/posts/mise-en-place-borne-magasin/support-tablette-1.jpg' | prepend: site.baseurl  }}"
        data-srcset="{{ '/assets/posts/mise-en-place-borne-magasin/support-tablette-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/mise-en-place-borne-magasin/support-tablette-2.jpg' | prepend: site.baseurl  }} 2x"
    />
    <noscript><img src="{{ '/assets/posts/mise-en-place-borne-magasin/support-tablette-1.jpg' | prepend: site.baseurl  }}" /></noscript>
    
    <figcaption>Le réceptacle de la tablette avec sa partie creusée sur la droite</figcaption>
</figure>


Pour régler ça, l'équipe Marketing, tel MacGyver a gratté un peu le support de tablette pour laisser un peu plus de place au câble et bombé le couvercle du support pour qu'il n'y ait plus de surface de contact avec le bouton. Problème réglé.

## Borne to be alive !

Après toutes ces péripéties, ce projet a enfin pu être mis en production dans nos 10 librairies.

<figure>
    <img
        class="lozad"
        width="450" height="600"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAbABQDASIAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAgABA//EABUBAQEAAAAAAAAAAAAAAAAAAAAB/9oADAMBAAIQAxAAAAHSdl4yhioUI//EABsQAAEEAwAAAAAAAAAAAAAAAAEAAhARICEx/9oACAEBAAEFAul0Xtxgom0MP//EABQRAQAAAAAAAAAAAAAAAAAAACD/2gAIAQMBAT8BH//EABQRAQAAAAAAAAAAAAAAAAAAACD/2gAIAQIBAT8BH//EABcQAAMBAAAAAAAAAAAAAAAAAAABITD/2gAIAQEABj8CZM//xAAcEAEAAwACAwAAAAAAAAAAAAABABEhEFEgMXH/2gAIAQEAAT8hxDgbAe7Z3Lgz6lxuQJ24iArw/9oADAMBAAIAAwAAABDDEv8A/8QAFhEBAQEAAAAAAAAAAAAAAAAAABEQ/9oACAEDAQE/EMqv/8QAFxEBAQEBAAAAAAAAAAAAAAAAABEBQf/aAAgBAgEBPxDisR//xAAZEAEBAQEBAQAAAAAAAAAAAAABEQAhMUH/2gAIAQEAAT8QYWioPcMYBRMetYHYiPRzjBT8MKU7kHHpkIggYSrzyZXXXf/Z"
        data-src="{{ '/assets/posts/mise-en-place-borne-magasin/borne-complete-1.jpg' | prepend: site.baseurl  }}"
        data-srcset="{{ '/assets/posts/mise-en-place-borne-magasin/borne-complete-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/mise-en-place-borne-magasin/borne-complete-2.jpg' | prepend: site.baseurl  }} 2x"
    />
    <noscript><img src="{{ '/assets/posts/mise-en-place-borne-magasin/borne-complete-1.jpg' | prepend: site.baseurl  }}" /></noscript>
    
    <figcaption>Une borne fièrement mise en production dans notre librairie de Bellecour</figcaption>
</figure>


Pour ce projet, la partie développement de la partie Web a été négligeable en comparaison des autres parties. C'est la première fois que l’on doit gérer un parc de tablettes, ouvertes au public, avec la volonté d'en brider l'usage. 


La partie développement du site a été faite en un peu de moins de 2 jours, alors que les différents tests et recherches sur le mode kiosque ont pris plus de 4 jours. On est loin du chiffrage initial et, dans un sens, c’est normal. 

Toute cette partie hors développement était une première dans l’équipe, on a donc dû faire une grande part de recherche sur les outils à installer, avec pas mal d’échecs mais au final une solution qui fonctionne et quelques bugs matériels ce qui change des traditionnelles SegFault.

Même si au final nous ne l’utilisons pas, nous avons pu tester la configuration d'un Manifest et voir les possibilités offertes par ce mécanisme.

Côté gestion de parc de tablettes, il y aura probablement des points à améliorer pour la suite, notamment en ce qui concerne l'ajout d'applications.

Ces bornes magasins étant destinées à un usage unique, nous n'avons pas trop poussé sur cet aspect, mais si dans le futur nous sommes amenés à gérer plusieurs tablettes avec des applications à installer il faudra consolider et industrialiser ces installations.

