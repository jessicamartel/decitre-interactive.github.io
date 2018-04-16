---
layout: post
title: Comment nous avons sécurisé nos synchronisations de fichiers avec rrsync
author: srogier
date: 2018-04-17 10:00:00+02:00
---

Notre besoin est simple : afin de ne pas stocker sur nos serveurs de production plusieurs gigaoctets mensuels de logs divers, stockés dans des fichiers, nous souhaitons mettre en place un mécanisme qui nous permettrait de déplacer ces fichiers de logs sur des serveurs où l'espace disque n'est pas (trop) un problème.

Pour ces synchronisations, voici les contraintes que nous nous sommes fixées :

* nous voulons synchroniser le contenu de différents dossiers d'un même serveur,
* d'un serveur vers un autre,
* en cloisonnant les accès entre les machines.


## Le réflexe rsync


En lisant nos contraintes, ce qui vient directement à l'esprit en terme de choix d'outil, c'est [rsync](https://rsync.samba.org/).

`rsync` (pour *remote synchronization*) est un outil en ligne de commande de synchronisation de fichiers d'une source vers une destination.

On peut l'utiliser pour synchroniser deux dossier locaux, mais aussi pour synchroniser des dossiers entre deux machines différentes. Dans ce cas, rsync va s'appuyer sur une connexion SSH.


On va partir du principe que la machine locale, qui produit les logs va être celle qui les pousse vers notre serveur distant de stockage.


Pour commencer, il faut s'assurer que rsync est bien installé sur les deux serveurs.

On va ensuite générer sur notre serveur local une paire de clé SSH. 

    decitre@local$ ssh-keygen -f ~/.ssh/id_backup_server

Côté serveur de stockage, on crée un nouvel utilisateur (`backup_log` par exemple). 


On autorise ensuite le serveur local à se connecter sur le serveur distant, en ajoutant la clé publique dans le fichier `.ssh/authorized_keys`  de l'utilisateur `backup_log`.

À partir de là, c'est simple : on lance notre rsync pour envoyer nos fichiers de logs vers le serveur distant.

    decitre@local$ rsync -avz /home/logs/apache/ backup_log@remote:logs/apache


Sur le papier, cela répond à notre besoin.

Sauf qu'on peut aussi faire l'inverse. C'est à dire tirer des fichiers de la machine distante depuis la machine locale. Les fichiers pouvant être récupérés ne seraient pas seulement ceux du dossier contenant les fichiers synchronisés, mais tous les fichiers du serveur de stockage sur lequel l'utilisateur a le droit de lecture.


Bref, si notre serveur qui pousse les logs voit sa sécurité compromise, il y aura un accès en lecture possible sur le contenu de tout notre serveur de stockage.

<figure>
    <img 
        class="lozad" 
        width="400" height="300"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAPABQDASIAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAQD/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIQAxAAAAERCo//xAAWEAADAAAAAAAAAAAAAAAAAAAQESD/2gAIAQEAAQUCCj//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/AT//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAg/9oACAEBAAY/Al//xAAYEAEBAAMAAAAAAAAAAAAAAAAAERAhYf/aAAgBAQABPyGdTDaq/9oADAMBAAIAAwAAABBwz//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQMBAT8QP//EABQRAQAAAAAAAAAAAAAAAAAAABD/2gAIAQIBAT8QP//EABwQAAICAgMAAAAAAAAAAAAAAAERACExQVFxof/aAAgBAQABPxB279xwa4szI2Imx7Gs7Mpqf//Z"
        data-src="{{ '/assets/posts/securisation-synchronisation-rrsync/security-fail-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/securisation-synchronisation-rrsync/security-fail-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/securisation-synchronisation-rrsync/security-fail-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/securisation-synchronisation-rrsync/security-fail-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>&ldquo;Il n'y a aucune raison que les règles de sécurité mises en place soient contournées&rdquo; </figcaption>
</figure>

La solution ? Peut-être faut-il ajouter des droits au dossier où on pousse les logs avec un user et un group particulier afin de restreindre ces accès ?

Nous avons testé cette solution. Mais nous n'étions pas chaud pour gérer nous-mêmes cette sécurité via des droits. On aimerait plutôt arriver à cloisonner le dossier de destination du rsync pour ne pas en sortir.


## Utiliser chroot pour créer un environnement isolé ?

Ça tombe bien, pour isoler un environnement, Linux met à notre disposition une commande efficace appelée [chroot](https://en.wikipedia.org/wiki/Chroot).

Le but de chroot est de fournir à un programme un environnement d'exécution isolé du système hôte.

En cas de compromission de l'accès, la machine hôte n'est pas accessible et cela permet de limiter les dégâts.

Voilà (très brièvement) pour le  principe de chroot.

Maintenant, comment on applique ça dans le contexte d'une connexion SSH ouverte pour exécuter un rsync ?

On va modifier la configuration de notre serveur ssh contenue dans le fichier `/etc/ssh/sshd_config`. Dedans, on ajoute une règle qui permet, pour notre utilisateur `backup_log`, de définir le dossier qui sera la racine de notre environnement isolé.

    Match User backup_log
            ChrootDirectory /home/backup_log/



On recharge le serveur pour prendre en compte la nouvelle configuration et c'est bon. 

Notre environnement fourni par chroot est certes isolé, mais il est surtout totalement vide. Il n'a connaissance d'aucune commande. Pas de `ls`, `cat` et donc encore moins de `rsync`.


Par exemple, pour ajouter `ls`, on identifie les librairies dont `ls` a besoin grâce à la commande `ldd`.

    root@remote$ ldd /usr/bin/rsync 
        linux-vdso.so.1 (0x00007ffd40d1f000)
        libattr.so.1 => /lib/x86_64-linux-gnu/libattr.so.1 (0x00007fbbd092e000)
        libacl.so.1 => /lib/x86_64-linux-gnu/libacl.so.1 (0x00007fbbd0725000)
        libpopt.so.0 => /lib/x86_64-linux-gnu/libpopt.so.0 (0x00007fbbd0518000)
        libc.so.6 => /lib/x86_64-linux-gnu/libc.so.6 (0x00007fbbd0179000)
        /lib64/ld-linux-x86-64.so.2 (0x00007fbbd0dbc000)



Puis, on les copie dans notre système miroir de manière à construire notre environnement chrooté.

    root@remote$ cp /lib64/ld-linux-x86-64.so.2 /home/backup_log/lib64/ld-linux-x86-64.so.2

Et ainsi de suite pour chaque commande.

<figure>
    <img
        class="lozad"
        width="468" height="263"
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="https://media.giphy.com/media/al7hG5GiD4hzO/giphy.gif"
    />
    <noscript><img src="https://media.giphy.com/media/al7hG5GiD4hzO/giphy.gif" /></noscript>

    <figcaption>Lorsque je comprends que je suis en train de créer un truc inmaintenable <a href="http://gph.is/28Vxrk0">http://gph.is/28Vxrk0</a></figcaption>
</figure>

Il y a bien sûr plus propre comme approche, et plus industrialisable. Mais, devoir copier des binaires manuellement en fonction des besoins en commande, penser à ce que ces binaires devront être recopiés lorsque les fichiers seront mis à jour, font que cette solution du chroot ne nous a pas semblé être une solution qui réponde à notre besoin. 

chroot est une commande beaucoup trop puissante pour qu'elle soit rentable à utiliser dans le cas d'une simple volonté de bridage de rsync.



## rrsync : le bon compromis


On a déjà établi que rsync nous convenait bien pour envoyer nos fichiers. Par contre, c'est le manque d'isolation qui nous posait problème et nous avait fait abandonner cette possibilité. 


En fait, une solution est apportée par rsync grâce à un script qui s’appelle [rrsync](https://ftp.samba.org/pub/unpacked/rsync/support/rrsync) (pour *restricted rsync*) et qui permet de restreindre l'usage de rsync à un dossier.


Comme pour la partie rsync, on se base sur la clé générée sur la machine locale et déposée sur le serveur hôte.

Sur le serveur hôte, on vérifie la présence du script rrsync. Il est normalement distribué avec rysnc, mais pas forcément exécutable. C'était le cas sur nos serveurs debian.
On ajoute rrsync dans la liste des exécutables disponibles.

    backup_log@remote$ gunzip /usr/share/doc/rsync/scripts/rrsync.gz -c > ~/bin/rrsync
    backup_log@remote$ chmod +x ~/bin/rrsync



Maintenant, on va vouloir autoriser notre machine locale à se connecter au serveur distant. 


Comme toute connexion SSH, on ajoute la clé publique dans `.ssh/authorized_keys`. Par contre, on va compléter cette ligne en ajoutant un attribut `COMMAND` qui permet de restreindre l'accès SSH à une commande, rrsync en l’occurrence, et à qui on passe en argument le dossier où seront stockés les fichiers synchronisés.

    command="/home/backup_log/bin/rrsync  /home/backup_log/backup/",no-agent-forwarding,no-port-forwarding,no-pty,no-user-rc,no-X11-forwarding ssh-rsa <reste de la clé ssh>


Du côté de notre machine locale, on peut désormais lancer la commande rsync suivante :

    local@decitre$ rsync -avz  --rsync-path='rsync --server --fake-super' --rsh='ssh -i .ssh/id_backup_server' /home/logs/apache/ backup_log@remote:logs/apache

L'option `--rsync-path` permet de spécifier des options à rsync du côté du serveur distant. On utilise l'option `--fake-super` qui va dire au serveur de stocker les [attributs étendus](https://en.wikipedia.org/wiki/Extended_file_attributes) (dont les informations sur le user d'origine). En cas de restauration des fichiers à partir de la machine distante, on pourra réattribuer ces informations sur les fichiers.


L'option `--rsh` permet d'affecter des options à la connexion SSH utilisée par rsync. On lui passe donc la clé publique spécialement générée pour l'accès au point de stockage sur le serveur de stockage.


Et voilà, grâce à cette commande, on lance simplement rsync sur notre machine locale et le serveur distant va utiliser rrsync et se contenter de nous fournir un accès restreint au dossier sur lequel on a configuré rrsync. 


<figure>
    <img
        class="lozad"
        width="480" height="263"
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="https://media.giphy.com/media/3ohs4gSs3V0Q7qOtKU/giphy.gif"
    />
    <noscript><img src="https://media.giphy.com/media/3ohs4gSs3V0Q7qOtKU/giphy.gif" /></noscript>

    <figcaption>Notre script de synchronisation de données en train de tourner<a href="http://gph.is/2EpCeKc">http://gph.is/2EpCeKc</a></figcaption>
</figure>

Tout ça se fait sans avoir à fournir un effort de configuration trop poussé pour les non-administrateurs systèmes que nous sommes.

> *Disclaimer*
>
> Je suis conscient qu'il est très probable que des administrateur·e·s systèmes se soient étouffé·e·s ou aient jeté leur téléphone (ou killé lynx) de dépit à la lecture de cet article. Je m'en excuse (même s'ils·elles ne sont pas arrivé·e·s jusqu'ici).
>
> Il est possible que les solutions envisagées avant rrsync aient pu être viables, mais vu que dans notre équipe, nous avons plus des profils orientés développement, nous avons choisi la solution qui nous semblaient la moins risquée et la plus simple à mettre en place.
