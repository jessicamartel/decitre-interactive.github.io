---
layout: post
title:  "Mise en place d'une borne magasin"
author: srogier
excerpt: "Comment nous avons mis en place dans nos librairies une borne interactive branchée sur une page web"
date: 2018-02-02 15:30:00+01:00
---

> *Mardi 2 mai 2017 - Siège de Decitre - 15h42 - Réunion de planification*
>
> *- Bon, l'équipe Marketing aimerait mettre en place une tablette dans les librairies qui permette d'accéder à decitre.fr, à un questionnaire de satisfaction et aux jeux-concours. Un modèle unique de tablette a été choisi, c'est de l'Android. Vous chiffrez ça à combien ?*
>
> *- Deux jours de dev ? On fait une pauvre page web avec 3 liens, on héberge ça sur [Github pages](https://pages.github.com/) et on n'en parle plus.*
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
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wgARCAAXAB4DAREAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAABwgJ/8QAGQEAAgMBAAAAAAAAAAAAAAAABQYEBwgD/9oADAMBAAIQAxAAAACd0vZ2nTJmsZiN0WB7ibOgC5jtKGsZjkwTbB5DctVm7JQUOf4IBXx//8QALhAAAgIBAgQDBgcAAAAAAAAAAQIDBAUABgcIESISIUEJExQkUrQxM0JxcoWh/9oACAEBAAE/AE4Uy34J7sWOgFYMFQgIDL/Aevr0+oggdSCNcnG0tnQ8rOy72T29irLv8WDNJjkld/nZwP0E69pHw+w1u1wmo4DCYynPk7F6BDBVjgDsxqhPF5DW6to5LZU1CpdIK2Kq2oApZR7sllHYwVkPYfIgHW0drWZtiwVV3JDivfgshX4eRkBZmUMzWlI9SOsfax+rXKPgprPK5suhNVRzAboZhZ8BR1vTggFQwI1z7bKrbsn4Z0LltMMIBkniACTKwBq+RMjxjXF/aNU333Fk8wJrd2VIXip1YXHbGB4ui2WIHRfXWQpJHWUO7Oi9CE/DxfuRrkjcPywbLKgAEXPvZ9e08/I4c/2Q+207vScNK/ew6dQOpP8Auv/EACoRAAIBAQUFCQAAAAAAAAAAAAECABEDBDGxwQUScYGRISIkNEJhodHw/9oACAECAQE/AAbQitZc28Opb3zM2iTVApxrpGa1Q1LGtPiWa93GnT7l0Wt3UcczL+gbcU9mOnCOlTvE/upglx8uvPMza3o56RWn/8QALREAAQIEBAUBCQAAAAAAAAAAAQIDAAQRMQUSIVEGByJBYTITNmJxgoOywvH/2gAIAQMBAT8AeVhrDoZW2mp+EafPT+XMcXS9cfmW2UgenYD0Jjl2lhAnnJlIIQEnUVtnrSJOXwqfStxqXRoSD0pve4qDe9YxF9sTpUWSvLvmA7A0AbNfPVqPEcVzCRj8w6lV8nbtkTvSOBZ1coJx5tOevswbi+fYKjBZ5QQJNhnpSCakq7nygbwDSONveCZ+n8ExytvOfb/eCiP/2Q=="
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
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAQDAwMDAgQDAwMEBAQFBgoGBgUFBgwICQcKDgwPDg4MDQ0PERYTDxAVEQ0NExoTFRcYGRkZDxIbHRsYHRYYGRj/2wBDAQQEBAYFBgsGBgsYEA0QGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBgYGBj/wgARCAAXAB4DAREAAhEBAxEB/8QAGAAAAwEBAAAAAAAAAAAAAAAAAwQFBgf/xAAaAQABBQEAAAAAAAAAAAAAAAAFAQIDBAYH/9oADAMBAAIQAxAAAADt8sNRYQo9VWQXjln1yCNjaM40eV7tnSQzR07CC2//xAAvEAABAwMCBAQEBwAAAAAAAAABAgMEBQYRAAcSEyEyCBRBURYxQnEYIzQ3gaLU/9oACAEBAAE/AKZDuSmwAI+zdvThIWqUoz6i0tbZcJVy0nkdqfkB6DSPihaP2Osn7Kntf59eWurgOdl7O7CjCamzn7/pu7UmXd8JkPjYy1H8hKOUKm0QO72j6uTZu7bhul+oxmY/lH3FOtnnjJ4vlkFPsffUbZTdiPDaiKptGebCcca5aeanHQYVw+uoOyG5zVsLgSYUBUkr4hIE9OR/BSeuttdrbusGvVKq3HGhoYlo5TfIkBw8RWVdRgapXiUtN52XVWolwogFsJYjOcAKeBKAe1ePo1+Jui3FvTT65TkXFDotMpjrc2A6sJD7izhCwhCyk4z66Y8XFmTK81R2KLcKXWncLc/LCFf3J1UvELY1JuZ2qVT4xmMzGkoRARy1sslH1ALcHU6//8QAJhEAAQMDAwIHAAAAAAAAAAAAAQACAxESMQQhcQUTFBVBUmGRsf/aAAgBAgEBPwBkEYBteTyu0PciwAZTYwd7kZGW2o6hu1tdhRCKXxbZ3OqAKZPz95HFFLqGyNDQMKPqIEznurb6BRdUiMZFDXgfqm17CRkLzOIOLt1//8QALBEAAQMCBAQEBwAAAAAAAAAAAQIDBAARBRIhMQciQVFhcZHRExVCQ4Kh8f/aAAgBAwEBPwCVibjygpTATZIHLa2gtrtr3NCWT9B/XvQkXNspHp70qSR9sn096Yw99uQt8EEK7/yvk8hSFhZTzKv5DXS9vGp7zD0ZceM2G0lQOUBNtMvhpsdt71huEvQ3nHXCLK2t5k9hUvhxObQiNmRnG5BPW/hWI8P50DkcWgkkWIJ7E9QKicOsQcjqfzosAOpvr+NReGuJS2fhJU2Mp3N7m/kk1//Z"
        data-src="{{ '/assets/posts/mise-en-place-borne-magasin/appli-ouverte-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/mise-en-place-borne-magasin/appli-ouverte-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/mise-en-place-borne-magasin/appli-ouverte-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/mise-en-place-borne-magasin/appli-ouverte-1.jpg' | prepend: site.baseurl  }}" /></noscript>
    
    <figcaption>Application ouverte sur decitre.fr</figcaption>
</figure>



Quant à l'hébergement, afin de faire au plus simple, on décide de passer par [Github pages](https://pages.github.com/).  

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
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wgARCAAXAB4DAREAAhEBAxEB/8QAGQAAAgMBAAAAAAAAAAAAAAAAAAUBBAYI/8QAGgEAAwEAAwAAAAAAAAAAAAAAAAUGAwEEB//aAAwDAQACEAMQAAAA6Ab+WVjKiznY26mwTXy7BUgoJYBYvo5OGTCdA//EACYQAAIBBAEDAwUAAAAAAAAAAAECAwQFERIhABATBjFxB0FRYWL/2gAIAQEAAT8Ak9L1cdviqt4SHXYx74ZRzjIPwentDJRmoFRTvgE+NZMuQDgkD8daFUTYjcjLKDkLyeM/GO1r+pNXbbQ9vejp6qNovDvMCWA56v8A6se+xLGKKnoowoXWnXA4JPcwX97z5le1rYo5tWU+U1LoYOP5DCYN+imPv70kN+huZNcbY1rkimeM0xl8+3nIiBBAUARA7cklvbjv/8QAJBEAAQIEBgMBAAAAAAAAAAAAAQIDBAUREgAQITFBYRNCUcH/2gAIAQIBAT8Aem8Kw8hhxVFKNo7OHJqy1GogFA3KFQdKc914+YbUtV14prp2MnZWy68HjuCFbcjCZKwmYiZkkrCbeqZkxHmp6/mGTEFwhzYZ/wD/xAAnEQABAwIEBgMBAAAAAAAAAAABAgQRBTEAAwZBEBITIXGBFLHB0f/aAAgBAwEBPwBvpKqOm6HGRl8wVt3/AERiq6XqNHQVu0gReO9yY72sJw5TkJKOgSZSJnZW48cGOsXrHJy8lKQeSxk4q+oXFYnrCJjcm3niE0z4BXB6tvZn+YeppgbJU2BCzF/YP1x//9k="
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
        src="data:image;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAQCAMAAAA25D/gAAAAS1BMVEXy8vL09PTt7vAwX4XY29/s7e3w8PHt7e/u7+/q6+zo6erO0tjS1tvj5um+xMxTc5JAZ4vz7+/T19zQ09nFzNPDytJ+kKVMbo8xX4YOR42VAAAAlElEQVQY032PWRLCIBBEB6RnAbO4e/+TmoCFRCp58DWPrmno9Zym+dTzHsf7Y6YQbiGlNKZ0XriGLVRgZdphiNHoAOb1FlyF1lO8U+11BXXcp/OIaDfNgAyDB4zMQICKSLPbtfS7BesLjRbbz19qM3YLPpqvSBOXrFnE/2g0hHIPSMRmuSsapR+pcKu/edOiVaF/1T97OQSV8K3legAAAABJRU5ErkJggg=="
        data-src="/assets/posts/mise-en-place-borne-magasin/hexnode-1.png"
        data-srcset="/assets/posts/mise-en-place-borne-magasin/hexnode-1.png 1x, /assets/posts/mise-en-place-borne-magasin/hexnode-2.png 2x"
    />
    
    <noscript><img src="{{ '/assets/posts/mise-en-place-borne-magasin/hexnode-1.jpg' | prepend: site.baseurl  }}" /></noscript>
</figure>


Dans l'outil, on configure une URL, une icône et voilà. Notre page Web est embarquée dans l'application Hexnode et s'ouvre dans un navigateur interne à leur solution basé sur Google Chrome.

Et c'est là que les problèmes ont commencé.

Sur decitre.fr, nous avons certains liens qui s'ouvrent dans un nouvel onglet : rien d'exceptionnel. 
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
        src="data:image;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAARCAMAAAD9uOxFAAABGlBMVEX////y8vLt7e38/Pz39/f19fWpq87o6Ojx8PD09PT5+fk/UbXr2dn+/v76+vr5+Pjv7+/s6uLt6d7j4+Pp6OHiABrx8O7p6ent7Ojt7OXm49mfzKHl5eXp6OTu6+Pp59/g39/o5d3g3tva2tqxtNWIv4k5SV7s6unj4+jq6OTs4td7g8JEVbap0aru7uvp4OHc3Nzn5tvs5tixttfn1tbn4dNzfMLC2cBfarznubpMW7iw0rGWxpdEUmZATmLn5unDz+fg4eTFy+Hn4dnW39Xh29PM2szm3MulqMvJ38qhpMh0hsjHx8dbcsJwecG+2b+6vL+rkry0trq42Lmly6WZx5rXmJr3n5KMwY2uWmKQUl5KWFziRkriNzzUx5u/AAABaUlEQVQoz23M13LbMBCF4QUWGwCMSYIlEsmoK1GXe++9917f/zUM2mOPPePvAhf4cQAnR/3Z08Hv7/qD+flBf3ZxEaam/ln7v350CJwzIip1Op21Uqkk+Tc1IOEAgJxbWr5Zvv9vXbfrcW+y1yvH5XINhCC0+eBqOBz+zS1161k1m9kKk3LcAPWem0VlCGSt6GMahMFElk3OnM01QJMWNmt0XQTPQcC0EtoH2V59d7sGjiCNIMeLRhMUI+P4SRBUwjhN49FCBFrYsWs/Z1qjjJSLSbUah0FaqQeFBhB6nutKqTQhKM587E6EYVgJqt0dm4Xn+Ggzc0SePRd5O0kKhVGzvnnXBl/4ACib48cbHsiIK9Ka7F3OZcAI8yycD8KoTxx80h6AJM2+EFq8MXZNnl2bsZHc9HR+jpkmN/mKgX2JgFouXDy//HlzO7IgiTHFGDIQRD6Ajs6fWiurK6uPD61W6zJi3FIOewUGTiavCxFR7gAAAABJRU5ErkJggg=="
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
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wgARCAAeABcDAREAAhEBAxEB/8QAFwABAAMAAAAAAAAAAAAAAAAACAYHCf/EABgBAAMBAQAAAAAAAAAAAAAAAAMEBQIG/9oADAMBAAIQAxAAAACDSqFFOKOWJWoGlJKbo9Z+f7UHFgoNhJpk1miu7E6aCoyL/8QAKhAAAgEDAwMEAAcAAAAAAAAAAQIDBAURAAYSByEiCBMxQRQyQkNSYWL/2gAIAQEAAT8A3FX7P6PbfS9VtKK3nOtNFPNE1Sgc58mIHEBcE4UE5wOQzqj9Wl62/uypZYaK92V6nnK6Ur03NCq49sFiUPY/mLZ1tCzy7/2vZ75YpeVDVqZ4uZKMUdI2H0ddVtvUXVzoza6lbki3ASJUw0EOHEg44aJmyuWzggAqoIGRjy1YegG/b9eEtsG2qumkJAknqYXihhwSp5SMOJ/l45/rXps6Z3KkbbtGk9XU0dmtfCpm5skU87gLl1Bwxyrtgg41ZrhFbrnPQLn8Mr+7AIxjwLE4GR9NyGMfGNbQudNdooJeZPvIHOMffc47d9eleqFTs2ulZHTlN+sYYLq/7Hp7TVVF2SeVeSsgp4m4r5nyXPyEP2NWyo3VBeEpaG9ikpmA5BARxHMk8APjsca9O3W289KKart7Frta5P2ZXw8Z/wAtr//EACERAAEEAQQDAQAAAAAAAAAAAAEAAgMRBBIiMVEUIUFh/9oACAECAQE/AGYco9yU38+oQtpZbmxkBw7QDYXkk2e0ZWAXayY3TyAtUwLtwR4tYtO1FRRuk22vGAj5UTNNgL//xAAkEQACAgIABAcAAAAAAAAAAAABAgADBBEFMUFREhMiYYGR4f/aAAgBAwEBPwB8nFG0q2578l/fv4hsJO5iIzozD2gpIgUzAz6MbhN2M6gu7rokAkAA70enTlMexKLg1q+IDp3gl6lQBLmrT1kcomaFbRrBnm95/9k="
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
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wgARCAAXAB4DAREAAhEBAxEB/8QAGAAAAgMAAAAAAAAAAAAAAAAABwgEBQb/xAAZAQACAwEAAAAAAAAAAAAAAAADBAABAgX/2gAMAwEAAhADEAAAAA/zujfZ1rqtIxkLOsbm4MxkkSrZVpiGFoJwLABr/8QALBAAAQMEAQQAAwkAAAAAAAAAAQIDBAUGBxEACBMhQRIUYhUiIyQxMkZxsf/aAAgBAQABPwDqutwRo+O6nKWw7WplMcZnLYQEbLfaI8D6nXOYcwdiyhQqVUsyXMunS6tHEuBQGO6nUdX7HX3EJJT8Y8pG08ydhjpzuSzRMsi5JFBqbsz5CGrciQw7I9IdS7taU/WCAOXZbU62a7Po9Ujri1GC+uPIZV+qFpJChzLGTZOXrr+1FsGHAjtCNBib322gSdq9FRJ2T/Q9c6o5c1/Inck3G1VqVIZbm0mKguflIbrTa2gApIRojQ+4pXlB3rlCoMitViLAYfYiyXlBLbktztICtbG1H2fXskgDnUhSpzGWawxU5rFRq0VEWJPlRfLbkpqM02/o6G/xELG9DlPw/UnI/cjSYzuhvS9oP+HmEs8Xbg6ksUe4bUp15W5EUVwky3G+/CUTs9lxQVob86KeZL6mbSrFyv3RY+MolqXir+QuznXXWT2+1tphPwtJUE+ASDyrxVzXlyHnFOuuKKlrWdqUT5JJPP/EAB0RAAICAgMBAAAAAAAAAAAAAAABAhEDIRAUMUH/2gAIAQIBAT8AfnGmLRJk7Fd0S06OwpPwx50PKvi4/8QAGxEAAgMBAQEAAAAAAAAAAAAAAAECESEDBEH/2gAIAQMBAT8AgW/gm0PTnHDnVDaqyGojwdYdPNJ6Q4tZJ4Uf/9k="
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
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wgARCAAeABcDAREAAhEBAxEB/8QAGQAAAgMBAAAAAAAAAAAAAAAABgcBBQgD/8QAFwEBAQEBAAAAAAAAAAAAAAAABAUCA//aAAwDAQACEAMQAAAANoNqtpmxkBLynpZNgOOpb27IpdrRQYjbXE4Tbiee/wD/xAApEAACAQMEAQMDBQAAAAAAAAABAgMEBREABgcSFBMxMiEzgRUiQlGR/9oACAEBAAE/AJ7TbOa+ZLtNRBrHtx6V7m8pj7TeLEuHcJn5s6sANcicYbCutpmfY15u9Xc4La14aC5QKEmpU+4wYKvVgDnqc63zeIf1ORBJ+5AF1tznm9bd5GG43qHu01VQ+JVQVUjdaiEMUeMkHIGHXW9+V7DLsWtn27tYbeljtclF5E1W0phgcBWiXPyBP8jqGyx3u4GeWVRHLmQ4IyAfbW7drUdGtPWwL1p44n7d5/icgj3z9MLrkzkCgqeLailpJ4KmaqWILAhIJCupf/Ma4DstBPXVc9XBHLNcxhPU+3EqZLgHOc5Caum7HrYI4nQtGcgq2CCMapqG20jzmmpDEZs+oWdnzn+sn6fjUNXFQ0fjQxdYR7L+df/EACERAAICAgIBBQAAAAAAAAAAAAECAAMEERIhEyIxQVFh/9oACAECAQE/AKRy95lYN2KivaOmGxFHUx7GCHfwZdl35Cqlr7C9D8EssYbCiU3tshu9zmJlWhlA+omMATCjMPUZ4dnc/8QAJBEAAgICAQIHAQAAAAAAAAAAAQIAAwQRIRJxFDFBQlFhkaH/2gAIAQMBAT8At2OBzK3W3r6fadHvEIAMvQBgVi1qnUVGix2fs/MorHmZfQpAI9JVhOzqHGlJA33gw/C5DVj+xsgmLksvAJ/Y+Y7nbcmf/9k="
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

