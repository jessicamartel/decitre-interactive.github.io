---
layout: post
title: Limiter les dégâts du chargement d’un JS tiers
author: vdechenaux
date: 2019-12-18 10:00:00+01:00
excerpt: Limiter les dégâts du chargement d’un JS tiers
---

Vous êtes comme ça quand un tiers vous demande d’inclure un fichier JS dans `<head></head>` sans <a href="https://developer.mozilla.org/fr/docs/Web/HTML/Element/script#attr-async">async ni defer</a> ?

Alors la suite peut vous intéresser 😉

<figure>
    <img class="lozad" width="400" height="300" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="https://media.giphy.com/media/pVAMI8QYM42n6/giphy.gif" />
    <noscript><img src="https://media.giphy.com/media/pVAMI8QYM42n6/giphy.gif" /></noscript>

    <figcaption>(source : <a href="https://media.giphy.com/media/pVAMI8QYM42n6/giphy.gif">https://media.giphy.com/media/pVAMI8QYM42n6/giphy.gif</a>)</figcaption>
</figure>

Sur <a href="https://www.decitre.fr">decitre.fr</a> nous avons récemment intégré <a href="https://www.abtasty.com/">AB Tasty</a>, et en premier lieu nous avions intégré le JS comme demandé, dans `<head></head>` avec un simple `<script src=”...”>`.
Mais, rapidement nous nous sommes rendu compte que cela entraînait un trop gros ralentissement du chargement de la page grâce à nos outils de surveillance (GTMetrix et Dareboost).

Le chargement de ce script ne pouvant être <a href="https://developer.mozilla.org/fr/docs/Web/HTML/Element/script#attr-async">décalé</a> sans risque d’avoir un effet de blink, nous avons cherché une solution au niveau de la récupération du script JS par le navigateur.

Comme ce script est hébergé sur un domaine dédié, le navigateur va effectuer une résolution DNS, une ouverture de connexion TCP et un handshake TLS.

<figure>
    <img 
        class="lozad" 
        width="500" height="143"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAGABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAEE/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEAMQAAAB1goP/8QAFBABAAAAAAAAAAAAAAAAAAAAEP/aAAgBAQABBQJ//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPwE//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPwE//8QAFBABAAAAAAAAAAAAAAAAAAAAEP/aAAgBAQAGPwJ//8QAGBAAAgMAAAAAAAAAAAAAAAAAABEBEDH/2gAIAQEAAT8hjBqv/9oADAMBAAIAAwAAABDzz//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQMBAT8QP//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8QP//EABcQAQEBAQAAAAAAAAAAAAAAAAEAETH/2gAIAQEAAT8QOx5MOm3/2Q=="
        data-src="{{ '/assets/posts/optimiser-chargement-js-tiers/image1-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/optimiser-chargement-js-tiers/image1-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/optimiser-chargement-js-tiers/image1-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/optimiser-chargement-js-tiers/image1-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>La requête vers le JS tiers avant optimisation.</figcaption>
</figure>


N’oublions pas que ce script étant chargé de manière synchrone, il est sur le chemin critique du chargement de la page.

Le but ici va être de se passer de ces 3 étapes en utilisant le fait que le navigateur est déjà connecté au domaine <a href="https://www.decitre.fr">decitre.fr</a>.

Pour ce faire, nous avons mis en place un <a href="https://httpd.apache.org/docs/2.4/fr/mod/mod_proxy.html#proxypass">reverse proxy</a> sur nos serveurs Apache qui s’occupe de faire le passe-plat vers les serveurs AB Tasty, et dans la balise script on utilise notre url spécifique au lieu du JS directement.

> Oui mais ça ne fait que déplacer le problème, ces 3 étapes seront faites par Apache lorsqu’il va ouvrir la connexion vers AB Tasty, à chaque requête ?!

Oui et non ! Ce serait le cas si nous n’avions pas Varnish devant Apache. 

*Je vous invite à voir ou revoir <a href="https://twitter.com/srogier">Sébastien</a> qui nous <a href="https://youtu.be/81ZJrH_ndrA?t=872">présente la stack actuelle</a>.*

Varnish va garder dans son cache, pendant 5 minutes, le JS en question. Il n’y aura donc au maximum qu’une seule requête vers AB Tasty, par tranche de 5 minutes.
En plus de ce cache côté serveur, Varnish a été configuré pour imposer un cache côté client de 5 minutes aussi.

Et voilà ce que ça donne si l’on se place sur la ligne du JS en question dans une console de développement d’un navigateur:

<figure>
    <img 
        class="lozad" 
        width="500" height="144"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAGABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAEE/8QAFAEBAAAAAAAAAAAAAAAAAAAAAf/aAAwDAQACEAMQAAAB1gKF/8QAFhAAAwAAAAAAAAAAAAAAAAAAABAR/9oACAEBAAEFAir/xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/AT//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAQ/9oACAEBAAY/An//xAAWEAADAAAAAAAAAAAAAAAAAAABEDH/2gAIAQEAAT8hEb//2gAMAwEAAgADAAAAEA/P/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPxA//8QAFREBAQAAAAAAAAAAAAAAAAAAARD/2gAIAQIBAT8QZ//EABgQAQEBAQEAAAAAAAAAAAAAAAEAESFR/9oACAEBAAE/EOA2PGHTb//Z"
        data-src="{{ '/assets/posts/optimiser-chargement-js-tiers/image2-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/optimiser-chargement-js-tiers/image2-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/optimiser-chargement-js-tiers/image2-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/optimiser-chargement-js-tiers/image2-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>La requête vers le JS tiers, servie par notre stack.</figcaption>
</figure>

Au lieu de 314ms pour le premier exemple, on tombe à 63ms ici, soit -80% !
Une différence de 251ms sur une ressource bloquante, c’est toujours bon à prendre 🚀

