---
layout: post
title: Un tableau Kanban physique ? Oui, mais connecté !
author: vdechenaux
date: 2019-04-09 10:00:00+02:00
excerpt: Un tableau Kanban physique ? Oui, mais connecté !
image: /assets/posts/impression-des-tickets-du-sprint/video-thumb.jpg
---

Pour gérer nos tickets de sprints nous utilisons un board Kanban sur un tableau blanc, avec des Post-it et des aimants de couleurs différentes pour différencier les affectations des membres de l’équipe.
Ça fonctionne très bien à un point près : il faut écrire les Post-it après chaque planification d’un nouveau sprint !

Ça se fait en une dizaine de minutes si on s’y met à plusieurs, mais on est des développeurs alors on aime bien automatiser ce qu’on peut automatiser, pas vrai ?

<figure>
    <img 
        class="lozad" 
        width="450" height="366"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/wgALCAAQABQBAREA/8QAFgABAQEAAAAAAAAAAAAAAAAAAgME/9oACAEBAAAAAdJczX//xAAYEAEBAAMAAAAAAAAAAAAAAAABAAIQIf/aAAgBAQABBQJ3nwGL/8QAFBABAAAAAAAAAAAAAAAAAAAAIP/aAAgBAQAGPwJf/8QAGhAAAgIDAAAAAAAAAAAAAAAAAAERIRAxQf/aAAgBAQABPyFlhOiVFkvGjQ//2gAIAQEAAAAQ9//EABoQAQADAQEBAAAAAAAAAAAAAAEAEVEhYfD/2gAIAQEAAT8QIlgus4dAl2KislV5cFIeJJ8M/9k="
        data-src="{{ '/assets/posts/impression-des-tickets-du-sprint/is_it_worth_the_time-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/impression-des-tickets-du-sprint/is_it_worth_the_time-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/impression-des-tickets-du-sprint/is_it_worth_the_time-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/impression-des-tickets-du-sprint/is_it_worth_the_time-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Avec la solution présentée dans cet article on sera gagnants rapidement 😄 (source : <a href="https://xkcd.com/1205/" target="_blank">https://xkcd.com/1205/</a>)</figcaption>
</figure>

J’ai dans un premier temps réfléchi à construire quelque chose qui pourrait imprimer sur les Post-it directement, sans trouver une idée folle 😟.
Puis, un vendredi après-midi en fin de <a href="/posts/offre-emploi-developpement-php#avantages" target="_blank">Tech Week</a>, lors d’une conversation avec l’équipe de développeurs en charge de l’ERP et des magasins au sujet de l’impression d'étiquettes, j’ai eu le déclic : pourquoi ne pas <strong>utiliser une imprimante à tickets de caisse</strong> et ainsi remplacer les Post-it ?

# Impression des tickets du sprint

## Eh bien, pourquoi pas, c’est parti !

S’en suit une rapide analyse des coûts pour être sûrs de ne pas exploser le budget <a href="https://fr.wikipedia.org/wiki/Papier_thermique" target="_blank">papier thermique</a> et faire tout ça pour rien :
Si dans le pire des cas les tickets ont tous une hauteur de 10 cm, à raison de 45 tickets maximum par sprint et 21 sprints par an, on passerait alors un peu plus de 94 mètres de rouleau. Un rouleau fait 80 mètres et coûte quelques euros, on est large !

## C’est bien beau, mais il faut une imprimante à ticket ?

Eh oui, mais nous travaillons à proximité de l’équipe de développement de l’ERP et de la caisse, et eux, ils ont une caisse de test avec imprimante à tickets !

## Du coup comment fait-on ?

Les prérequis :
<ul>
    <li>Quelque chose de simple à utiliser</li>
    <li>Ne pas débrancher l’imprimante de la caisse (qui est branchée avec un <a href="https://fr.wikipedia.org/wiki/D-sub#Applications_typiques" target="_blank">câble DE-9</a>)</li>
</ul>

Après une (très) rapide lecture de la documentation de 679 pages (vous comprenez pourquoi !) je fonce tête baissée pour essayer l’imprimante, tel un enfant avec un nouveau jouet 😄.

Je fais un premier test depuis la caisse Windows avec un PuTTY sur le COM1, et ça marche !

<figure>
    <img 
        class="lozad" 
        width="400" height="352"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAASABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAED/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEAMQAAAB0KASgB//xAAUEAEAAAAAAAAAAAAAAAAAAAAw/9oACAEBAAEFAh//xAAUEQEAAAAAAAAAAAAAAAAAAAAg/9oACAEDAQE/AR//xAAUEQEAAAAAAAAAAAAAAAAAAAAg/9oACAECAQE/AR//xAAUEAEAAAAAAAAAAAAAAAAAAAAw/9oACAEBAAY/Ah//xAAYEAACAwAAAAAAAAAAAAAAAAABECAxQf/aAAgBAQABPyE3LX//2gAMAwEAAgADAAAAEGAIPP/EABQRAQAAAAAAAAAAAAAAAAAAACD/2gAIAQMBAT8QH//EABQRAQAAAAAAAAAAAAAAAAAAACD/2gAIAQIBAT8QH//EABkQAQADAQEAAAAAAAAAAAAAAAEAESExEP/aAAgBAQABPxANuza0lRW+QbPHqUZh5//Z"
        data-src="{{ '/assets/posts/impression-des-tickets-du-sprint/essai-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/impression-des-tickets-du-sprint/essai-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/impression-des-tickets-du-sprint/essai-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/impression-des-tickets-du-sprint/essai-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>A que coucou ! 👋</figcaption>
</figure>

Maintenant qu’on a apprivoisé la bête, on peut faire le vrai programme !
Après un essai de programme en C qui envoie sur le COM1 tout ce qu’il reçoit sur un port TCP, je décide de faire beaucoup plus simple : un appel curl sur notre Intranet avec sa sortie redirigée sur le COM1.
Eh oui, <a href="https://curl.haxx.se/windows/" target="_blank">curl est disponible sous Windows</a>.

Nous avons déjà sur notre Intranet une page qui nous permet de consulter les tickets d’un sprint, via un fichier JSON contenant les tickets au sprint et leur estimation, ainsi qu’une connexion à la base Redmine pour calculer l’avancement grâce aux temps saisis.

<figure>
    <img 
        class="lozad" 
        width="900" height="313"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAHABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAEE/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEAMQAAAB1wKD/8QAFxABAAMAAAAAAAAAAAAAAAAAAQAQEf/aAAgBAQABBQKLlf/EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQMBAT8BP//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8BP//EABQQAQAAAAAAAAAAAAAAAAAAABD/2gAIAQEABj8Cf//EABYQAAMAAAAAAAAAAAAAAAAAAAAQEf/aAAgBAQABPyEgX//aAAwDAQACAAMAAAAQh8//xAAWEQADAAAAAAAAAAAAAAAAAAABEDH/2gAIAQMBAT8QFX//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/ED//xAAXEAEBAQEAAAAAAAAAAAAAAAABABEx/9oACAEBAAE/EHk2oEag70v/2Q=="
        data-src="{{ '/assets/posts/impression-des-tickets-du-sprint/intradi-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/impression-des-tickets-du-sprint/intradi-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/impression-des-tickets-du-sprint/intradi-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/impression-des-tickets-du-sprint/intradi-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>L’Intranet en question</figcaption>
</figure>

L’idée est donc de rajouter une option via l’URL pour pouvoir générer une sortie compréhensible par l’imprimante directement, à la place d’une page HTML.

Cette étape fut assez simple étant donné que les fonctionnalités de l’imprimante sont déclenchables par de simples caractères de contrôle (pour couper le ticket, mettre en gras, augmenter la taille…).
Le plus compliqué fut de trouver la bonne fonctionnalité parmi les multiples fonctionnalités de l’énorme doc !

Côté Windows au final c’est un simple script .bat qui fait un prompt de l’id de sprint à imprimer, du numéro du premier ticket à imprimer (utile pour reprendre l’impression au milieu s’il y a eu un problème de papier ou autre), un appel curl avec les 2 paramètres et une redirection vers COM1.

<figure>
    <img 
        class="lozad" 
        width="400" height="323"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAQABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAEC/8QAFQEBAQAAAAAAAAAAAAAAAAAAAAH/2gAMAwEAAhADEAAAAbZqDQ//xAAXEAADAQAAAAAAAAAAAAAAAAAAARAh/9oACAEBAAEFAqtiR//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQMBAT8BP//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8BP//EABQQAQAAAAAAAAAAAAAAAAAAACD/2gAIAQEABj8CX//EABkQAAIDAQAAAAAAAAAAAAAAAAARARAhMf/aAAgBAQABPyF7aQccEYH/2gAMAwEAAgADAAAAEO/v/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPxA//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPxA//8QAGRABAAMBAQAAAAAAAAAAAAAAAQARITFB/9oACAEBAAE/EAPUUqGm1ACpWjLeSzU//9k="
        data-src="{{ '/assets/posts/impression-des-tickets-du-sprint/premierticketpotable-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/impression-des-tickets-du-sprint/premierticketpotable-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/impression-des-tickets-du-sprint/premierticketpotable-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/impression-des-tickets-du-sprint/premierticketpotable-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Le premier ticket ressemblant à quelque chose était né !</figcaption>
</figure>

Sauf qu’on trouve que ce n’est pas très lisible sur un tableau blanc, et on décide de pousser un peu plus loin en ajoutant un peu de style !

<figure>
    <img 
        class="lozad" 
        width="400" height="385"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAATABQDASIAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAAIBA//EABUBAQEAAAAAAAAAAAAAAAAAAAAB/9oADAMBAAIQAxAAAAHdnYpY50HUH//EABUQAQEAAAAAAAAAAAAAAAAAACAB/9oACAEBAAEFAjB//8QAFBEBAAAAAAAAAAAAAAAAAAAAIP/aAAgBAwEBPwEf/8QAFBEBAAAAAAAAAAAAAAAAAAAAIP/aAAgBAgEBPwEf/8QAFBABAAAAAAAAAAAAAAAAAAAAMP/aAAgBAQAGPwIf/8QAGBABAQEBAQAAAAAAAAAAAAAAARAAITH/2gAIAQEAAT8hWpDyGPN//9oADAMBAAIAAwAAABD8OP7/xAAUEQEAAAAAAAAAAAAAAAAAAAAg/9oACAEDAQE/EB//xAAUEQEAAAAAAAAAAAAAAAAAAAAg/9oACAECAQE/EB//xAAaEAEBAQADAQAAAAAAAAAAAAABABEQITFB/9oACAEBAAE/EHWHDzY7+WliHvDyBpEBl//Z"
        data-src="{{ '/assets/posts/impression-des-tickets-du-sprint/ticketactuel-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/impression-des-tickets-du-sprint/ticketactuel-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/impression-des-tickets-du-sprint/ticketactuel-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/impression-des-tickets-du-sprint/ticketactuel-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Quelques caractères spéciaux pour faire les bordures et le tour est joué</figcaption>
</figure>

On imprime alors quelques tickets pour essayer et c’est le drame au premier accent venu :

<figure>
    <img 
        class="lozad" 
        width="400" height="387"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAATABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAEC/8QAFQEBAQAAAAAAAAAAAAAAAAAAAAH/2gAMAwEAAhADEAAAAdogogID/8QAFxABAQEBAAAAAAAAAAAAAAAAABEgIf/aAAgBAQABBQKq4iZ//8QAFBEBAAAAAAAAAAAAAAAAAAAAIP/aAAgBAwEBPwEf/8QAFBEBAAAAAAAAAAAAAAAAAAAAIP/aAAgBAgEBPwEf/8QAFBABAAAAAAAAAAAAAAAAAAAAMP/aAAgBAQAGPwIf/8QAGBAAAwEBAAAAAAAAAAAAAAAAAAERECH/2gAIAQEAAT8hgg6xAltP/9oADAMBAAIAAwAAABD0GH3/xAAUEQEAAAAAAAAAAAAAAAAAAAAg/9oACAEDAQE/EB//xAAUEQEAAAAAAAAAAAAAAAAAAAAg/9oACAECAQE/EB//xAAbEAEBAAIDAQAAAAAAAAAAAAABABFRECFBcf/aAAgBAQABPxAYkrPbiAmrdEDjfD9hHt//2Q=="
        data-src="{{ '/assets/posts/impression-des-tickets-du-sprint/accentKO-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/impression-des-tickets-du-sprint/accentKO-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/impression-des-tickets-du-sprint/accentKO-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/impression-des-tickets-du-sprint/accentKO-1.jpg' | prepend: site.baseurl  }}" /></noscript>
    
    <figcaption>L’imprimante n’aime pas l’UTF-8, c’était prévisible, mais ça se tentait</figcaption>
</figure>

Après recherche, je m’aperçois que l’imprimante est conçue pour fonctionner avec un <a href="https://fr.wikipedia.org/wiki/Page_de_code_437" target="_blank">charset CP437</a>. Un appel à iconv plus tard le dernier problème est résolu !
```php
$content = iconv('UTF-8', 'CP437', $content);
```

<figure>
    <img 
        class="lozad" 
        width="400" height="382"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAATABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAEC/8QAFQEBAQAAAAAAAAAAAAAAAAAAAAH/2gAMAwEAAhADEAAAAdoigyCg/8QAFBABAAAAAAAAAAAAAAAAAAAAMP/aAAgBAQABBQIf/8QAFBEBAAAAAAAAAAAAAAAAAAAAIP/aAAgBAwEBPwEf/8QAFBEBAAAAAAAAAAAAAAAAAAAAIP/aAAgBAgEBPwEf/8QAFBABAAAAAAAAAAAAAAAAAAAAMP/aAAgBAQAGPwIf/8QAGRAAAgMBAAAAAAAAAAAAAAAAABEBECAx/9oACAEBAAE/IWM7SIx//9oADAMBAAIAAwAAABDUH0H/xAAUEQEAAAAAAAAAAAAAAAAAAAAg/9oACAEDAQE/EB//xAAUEQEAAAAAAAAAAAAAAAAAAAAg/9oACAECAQE/EB//xAAbEAADAAIDAAAAAAAAAAAAAAAAAREhMRBBcf/aAAgBAQABPxBUOBJZCVVsIO3prhY0f//Z"
        data-src="{{ '/assets/posts/impression-des-tickets-du-sprint/accentOK-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/impression-des-tickets-du-sprint/accentOK-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/impression-des-tickets-du-sprint/accentOK-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/impression-des-tickets-du-sprint/accentOK-1.jpg' | prepend: site.baseurl  }}" /></noscript>
    
    <figcaption>😍</figcaption>
</figure>

# Le résultat en vidéo

Puisque vous avez été sages jusqu’à la fin, vous avez le droit à une vidéo !

<figure>
    <video controls width="500">
        <source src="/assets/posts/impression-des-tickets-du-sprint/video.mp4" type="video/mp4">
        Votre navigateur ne supporte pas les vidéos ! Vous n'utilisez pas Lynx quand même, si ?
    </video>
</figure>
