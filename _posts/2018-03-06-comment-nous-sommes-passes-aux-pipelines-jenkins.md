---
title: Comment nous sommes passés aux pipelines pour nos builds Jenkins
author: broux
layout: post
excerpt: "Comment nous sommes passés aux pipelines pour nos builds Jenkins"
date: 2018-03-06 11:00:00+01:00
---

Il y a maintenant quelques mois, j’ai rejoint l’équipe Decitre Interactive. En arrivant, on me confie un nouveau projet.
C’est cool, j’évite de débuter par un projet qui contient des masses de code à assimiler et ça me permet de me
familiariser en douceur avec les pratiques de l’équipe.

Vient le moment de configurer l’intégration continue de mon projet. La conversation HipChat a donné à peu près ceci :

> *Les projets dans Jenkins, vous les configurez comment ?*
>
> *Euh … c’est le bazar. Y’a des jobs pour les PRs, des jobs pour le master*
>
> *Ça fait plein de configuration dupliquée*
>
> *Et y’a même du code dans certaines configurations*
>
> *Si on en profitait pour tester les pipelines ? Ça permettrait de ne plus dupliquer la configuration et de configurer
les jobs directement dans le repo github*
>
> *Ok, vendu*

<figure>
    <img
        class="lozad"
        width="600" height="337"
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="https://media.giphy.com/media/3oEjI5VtIhHvK37WYo/giphy.gif"
    />
    <noscript><img src="https://media.giphy.com/media/3oEjI5VtIhHvK37WYo/giphy.gif" /></noscript>

    <figcaption>Ok, vendu je teste les Jenkinsfile, ça a l'air cool et ça me rappelle Travis</figcaption>
</figure>

## Faut “juste” poser un Jenkinsfile dans le projet

Pour tirer parti des dernières fonctionnalités des pipelines, notamment de parallel, il a fallu mettre à jour
notre Jenkins et ses plugins. Pour la faire courte, les pipelines sont des builds configurables qui permettent
via le DSL de Jenkins de s’adapter aux workflows complexes (type déploiement continu).
Pour plus d’infos sur les pipelines, voir [ici](https://jenkins.io/doc/book/pipeline/)

On crée un projet de type “Multibranch pipeline”, on ajoute un Jenkinsfile dans le repo github et c’est parti.

La première version est assez simple :

-   elle lance les tests behat
-   elle vérifie que le code est conforme PSR2
-   elle vérifie qu’il n’y a pas de faille rapportée dans les dépendances du projet

```groovy
parallel behat: {
   node {
       stage('Behat - Prepare') {
            try {
                sh 'rm -rf *'
                git branch: 'ticket_21963_integration_continue', credentialsId: '***', url: '***'
                gitCommit = sh(returnStdout: true, script: 'git rev-parse HEAD').trim()
                githubNotify account: 'decitre-interactive', context: 'Behat', credentialsId: 'credential-github', description: '', gitApiUrl: '', repo: '***', sha: gitCommit, status: 'PENDING', targetUrl: "${env.BUILD_URL}"
                sh 'make docker-up daemon=true'
                sleep(10)
                sh 'make init'
            } catch(e) {
                hipchatSend color: 'RED', credentialId: 'HipChat-API-Token', message: "${env.JOB_NAME} #${env.BUILD_NUMBER} Build failed at stage Behat - Prepare (<a href=\"${env.BUILD_URL}\">Open</a>)", room: '***', sendAs: 'Jenkins', server: '', v2enabled: false
                githubNotify account: 'decitre-interactive', context: 'Behat', credentialsId: 'credential-github', description: '', gitApiUrl: '', repo: '***', sha: gitCommit, status: 'FAILURE', targetUrl: "${env.BUILD_URL}"
                sh 'docker-compose down'
                throw e
            }
        }
        stage('Behat - Build') {
            try {
                sh 'make test-behat'
                githubNotify account: 'decitre-interactive', context: 'Behat', credentialsId: 'credential-github', description: '', gitApiUrl: '', repo: '***', sha: gitCommit, status: 'SUCCESS', targetUrl: "${env.BUILD_URL}"
            } catch(e) {
                hipchatSend color: 'RED', credentialId: 'HipChat-API-Token', message: "${env.JOB_NAME} #${env.BUILD_NUMBER} Build failed at stage Behat - Build (<a href=\"${env.BUILD_URL}\">Open</a>)", room: '***', sendAs: 'Jenkins', server: '', v2enabled: false
                githubNotify account: 'decitre-interactive', context: 'Behat', credentialsId: 'credential-github', description: '', gitApiUrl: '', repo: '***', sha: gitCommit, status: 'FAILURE', targetUrl: "${env.BUILD_URL}"
                throw e
            } finally {
                sh 'docker-compose down'
            }
        }
    }
}, checkstyle: {
    node {
        stage('Checkstyle - Prepare') {
            try {
                sh 'rm -rf *'
                git branch: 'ticket_21963_integration_continue', credentialsId: '***', url: '***'
                gitCommit = sh(returnStdout: true, script: 'git rev-parse HEAD').trim()
                githubNotify account: 'decitre-interactive', context: 'Checkstyle', credentialsId: 'credential-github', description: '', gitApiUrl: '', repo: '***', sha: gitCommit, status: 'PENDING', targetUrl: "${env.BUILD_URL}"
                sh 'make composer'
            } catch(e) {
                hipchatSend color: 'RED', credentialId: 'HipChat-API-Token', message:"${env.JOB_NAME} #${env.BUILD_NUMBER} Build failed at stage Checkstyle - Prepare (<a href=\"${env.BUILD_URL}\">Open</a>)", room: '***', sendAs: 'Jenkins', server: '', v2enabled: false
                githubNotify account: 'decitre-interactive', context: 'Checkstyle', credentialsId: 'credential-github', description: '', gitApiUrl: '', repo: '***', sha: gitCommit, status: 'FAILURE', targetUrl: "${env.BUILD_URL}"
                throw e
            }
        }
        stage('Checkstyle - Build') {
           try {
                sh 'make checkstyle'
                githubNotify account: 'decitre-interactive', context: 'Checkstyle', credentialsId: 'credential-github', description: '', gitApiUrl: '', repo: '***', sha: gitCommit, status: 'SUCCESS', targetUrl: "${env.BUILD_URL}"
            }catch(e) {
                hipchatSend color: 'RED', credentialId: 'HipChat-API-Token', message: "${env.JOB_NAME} #${env.BUILD_NUMBER} Build failed at stage Checkstyle - Build (<a href=\"${env.BUILD_URL}\">Open</a>)", room: '***', sendAs: 'Jenkins', server: '', v2enabled: false
                githubNotify account: 'decitre-interactive', context: 'Checkstyle', credentialsId: 'credential-github', description: '', gitApiUrl: '', repo: '***', sha: gitCommit, status: 'FAILURE', targetUrl: "${env.BUILD_URL}"
                throw e
            } finally {
                sh 'docker-compose down'
            }
        }
   }
}, securitycheck: {
    node {
        stage('SecurityCheck - Prepare') {
            try {
                sh 'rm -rf *'
                git branch: 'ticket_21963_integration_continue', credentialsId: '***', url: '***'
                gitCommit = sh(returnStdout: true, script: 'git rev-parse HEAD').trim()
                githubNotify account: 'decitre-interactive', context: 'SecurityCheck', credentialsId: 'credential-github', description: '', gitApiUrl: '', repo: '***', sha: gitCommit, status: 'PENDING', targetUrl: "${env.BUILD_URL}"
                sh 'make composer'
            } catch(e) {
                hipchatSend color: 'RED', credentialId: 'HipChat-API-Token', message: "${env.JOB_NAME} #${env.BUILD_NUMBER} Build failed at stage SecurityCheck - Prepare (<a href=\"${env.BUILD_URL}\">Open</a>)", room: '***', sendAs: 'Jenkins', server: '', v2enabled: false
                githubNotify account: 'decitre-interactive', context: 'SecurityCheck', credentialsId: 'credential-github', description: '', gitApiUrl: '', repo: '***', sha: gitCommit, status: 'FAILURE', targetUrl: "${env.BUILD_URL}"
                throw e
            }
        }
        stage('SecurityCheck - Build') {
            try {
                sh 'make securitycheck'
                githubNotify account: 'decitre-interactive', context: 'SecurityCheck', credentialsId: 'credential-github', description: '', gitApiUrl: '', repo: '***', sha: gitCommit, status: 'SUCCESS', targetUrl: "${env.BUILD_URL}"
            } catch(e) {
                hipchatSend color: 'RED', credentialId: 'HipChat-API-Token', message: "${env.JOB_NAME} #${env.BUILD_NUMBER} Build failed at stage SecurityCheck - Build (<a href=\"${env.BUILD_URL}\">Open</a>)", room: '***', sendAs: 'Jenkins', server: '', v2enabled: false
                githubNotify account: 'decitre-interactive', context: 'SecurityCheck', credentialsId: 'credential-github', description: '', gitApiUrl: '', repo: '***', sha: gitCommit, status: 'FAILURE', targetUrl: "${env.BUILD_URL}"
                throw e
            } finally {
                sh 'docker-compose down'
            }
        }
   }
}
```

Il y a beaucoup de duplication dans le fichier et beaucoup de petites choses à améliorer, mais le but est atteint :
ça fonctionne. On a un build qui se lance à chaque commit (grâce à l’intégration de Jenkins dans Github)

<figure>
    <img 
        class="lozad" 
        width="600" height="432"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAOABQDASIAAhEBAxEB/8QAFwABAQEBAAAAAAAAAAAAAAAAAAIBBP/EABQBAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhADEAAAAevZoA//xAAUEAEAAAAAAAAAAAAAAAAAAAAg/9oACAEBAAEFAl//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/AT//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/AT//xAAUEAEAAAAAAAAAAAAAAAAAAAAg/9oACAEBAAY/Al//xAAWEAEBAQAAAAAAAAAAAAAAAAABEBH/2gAIAQEAAT8ho7f/2gAMAwEAAgADAAAAELPP/8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPxA//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPxA//8QAGxAAAgIDAQAAAAAAAAAAAAAAAAERIRBBUYH/2gAIAQEAAT8QhbEQuF6o9z//2Q=="
        data-src="{{ '/assets/posts/jenkinsfile/hook-github-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/jenkinsfile/hook-github-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/jenkinsfile/hook-github-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/jenkinsfile/hook-github-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>La configuration du hook Jenkins dans Github est très simple</figcaption>
</figure>

Après un peu de refactoring, on obtient un fichier qui ressemble à ça :

```groovy
String cron_string = BRANCH_NAME == "master" ? "@daily" : ""

properties([
    buildDiscarder(logRotator(artifactDaysToKeepStr: '', artifactNumToKeepStr: '', daysToKeepStr: '', numToKeepStr: '5')),
    [$class: 'GithubProjectProperty', displayName: '', projectUrlStr: '***'],
    [$class: 'RebuildSettings', autoRebuild: false, rebuildDisabled: false],
    pipelineTriggers([cron(cron_string)])
])

def notify (String stageName, String status) {
    sha = sh(returnStdout: true, script: 'git rev-parse HEAD').trim()
    if (BRANCH_NAME == 'master') {
        if (status == 'FAILURE') {
            hipchatSend color: 'RED', credentialId: 'HipChat-API-Token', message: "${env.JOB_NAME} #${env.BUILD_NUMBER} Build failed at stage ${stageName} (<a href=\"${env.BUILD_URL}\">Open</a>)", room: '***', sendAs: 'Jenkins', server: '', v2enabled: false
        }
    } else {
        githubNotify account: 'decitre-interactive', context: stageName, credentialsId: 'credential-github', description: '', gitApiUrl: '', repo: '***', sha: sha, status: status, targetUrl: "${env.BUILD_URL}"
    }
}

def composeProjectName(String step) {
    return "project-${BRANCH_NAME}-${BUILD_NUMBER}-${step}"
}

pipeline {
    agent any
    stages {
        stage('Build') {
            steps {
                checkout scm
                sh 'cp  docker-compose.override.yml-test docker-compose.override.yml'
                sh "COMPOSE_PROJECT_NAME=${composeProjectName('Behat')} make docker-up daemon=true"
                sleep(10)
                sh "COMPOSE_PROJECT_NAME=${composeProjectName('Behat')} make init"
            }
        }
        stage('Test') {
            parallel {
                stage('Behat') {
                    steps {
                        notify ('Behat', 'PENDING')
                        sh "COMPOSE_PROJECT_NAME=${composeProjectName('Behat')} make test-behat"
                    }
                    post {
                        success {
                            notify('Behat', 'SUCCESS')
                        }
                        failure {
                            notify('Behat', 'FAILURE')
                        }
                        always {
                            sh "COMPOSE_PROJECT_NAME=${composeProjectName('Behat')} docker-compose down"
                        }
                    }
                }
                stage('Unit') {
                    steps {
                        notify ('Unit', 'PENDING')
                        sh "COMPOSE_PROJECT_NAME=${composeProjectName('Unit')} make test-unit"
                    }
                    post {
                        success {
                            notify('Unit', 'SUCCESS')
                        }
                        failure {
                            notify('Unit', 'FAILURE')
                        }
                        always {
                            sh "COMPOSE_PROJECT_NAME=${composeProjectName('Unit')} docker-compose down"
                        }
                    }
                }
                stage('Checkstyle') {
                    steps {
                        notify ('Checkstyle', 'PENDING')
                        sh "COMPOSE_PROJECT_NAME=${composeProjectName('Checkstyle')} make checkstyle"
                    }
                    post {
                        success {
                            notify('Checkstyle', 'SUCCESS')
                        }
                        failure {
                            notify('Checkstyle', 'FAILURE')
                        }
                        always {
                            sh "COMPOSE_PROJECT_NAME=${composeProjectName('Checkstyle')} docker-compose down"
                        }
                    }
                }
                stage('SecurityCheck') {
                    steps {
                        notify ('SecurityCheck', 'PENDING')
                        sh "COMPOSE_PROJECT_NAME=${composeProjectName('SecurityCheck')} make securitycheck"
                    }
                    post {
                        success {
                            notify('SecurityCheck', 'SUCCESS')
                        }
                        failure {
                            notify('SecurityCheck', 'FAILURE')
                        }
                        always {
                            sh "COMPOSE_PROJECT_NAME=${composeProjectName('SecurityCheck')} docker-compose down"
                        }
                    }
                }
            }
        }
    }
}
```

Il y a toujours un docker-up en mode démon suivi d’un sleep qui me dérange. Mais c’est déjà beaucoup mieux.

## Ce qu’on a appris en cours de route

<figure>
    <img
        class="lozad"
        width="260" height="146"
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="https://media.giphy.com/media/yDYAHbqe5DfyM/giphy.gif"
    />
    <noscript><img src="https://media.giphy.com/media/yDYAHbqe5DfyM/giphy.gif" /></noscript>

    <figcaption>Quand je comprends que c'est plus compliqué que prévu et que j'ai plein de petits détails à ajuster</figcaption>
</figure>

### Suppression des anciens builds

En configurant le Multibranch pipeline, j’ai bien sûr voulu configurer la suppression automatique des anciens builds.
Ça prend de l’espace disque sur le serveur et on n’a pas d’intérêt à conserver tous les builds d’une feature branch qui a 3 ans.
J’ai donc naturellement coché la case “Discard old items” et mis le “Max # of old items to keep” à 10.
Je m’attendais à ce que Jenkins ne conserve que les 10 derniers builds quelque soit la branche sur laquelle ils ont été effectués.
Et bien, pas du tout !
Dans ce cas là, Jenkins va conserver tous les builds des 10 dernières branches.
Pour limiter le nombre de builds par branche, il faut en fait spécifier un paramètre dans le Jenkinsfile :

```groovy
properties([
    buildDiscarder(logRotator(artifactDaysToKeepStr: '', artifactNumToKeepStr: '', daysToKeepStr: '', numToKeepStr: '5'))
])
```

Cette propriété va s’appliquer sur le job que Jenkins créé (de lui-même) pour chaque branche.

C’est une première étape, mais comment je fais pour ne pas conserver mes vieilles branches ?
Limiter le nombre de branches est une solution qui me plait moyennement.
Mon objectif c’est plutôt conserver les builds sur les branches existantes du projet.
Ça tombe bien, c’est possible, même si ce n’est pas du tout intuitif.
Il faut configurer le Multibranch Pipeline de la manière suivante :

<figure>
    <img 
        class="lozad" 
        width="600" height="183"
        src="data:image;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDACgcHiMeGSgjISMtKygwPGRBPDc3PHtYXUlkkYCZlo+AjIqgtObDoKrarYqMyP/L2u71////m8H////6/+b9//j/2wBDASstLTw1PHZBQXb4pYyl+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/wgARCAAGABQDASIAAhEBAxEB/8QAFgABAQEAAAAAAAAAAAAAAAAAAAEE/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEAMQAAAB10AP/8QAFBABAAAAAAAAAAAAAAAAAAAAEP/aAAgBAQABBQJ//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAwEBPwE//8QAFBEBAAAAAAAAAAAAAAAAAAAAEP/aAAgBAgEBPwE//8QAFBABAAAAAAAAAAAAAAAAAAAAEP/aAAgBAQAGPwJ//8QAFRABAQAAAAAAAAAAAAAAAAAAEDH/2gAIAQEAAT8hj//aAAwDAQACAAMAAAAQg8//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAEDAQE/ED//xAAUEQEAAAAAAAAAAAAAAAAAAAAQ/9oACAECAQE/ED//xAAXEAADAQAAAAAAAAAAAAAAAAAAEBEx/9oACAEBAAE/EJoq/9k="
        data-src="{{ '/assets/posts/jenkinsfile/configuration-build-1.jpg' | prepend: site.baseurl  }}" 
        data-srcset="{{ '/assets/posts/jenkinsfile/configuration-build-1.jpg' | prepend: site.baseurl  }} 1x, {{ '/assets/posts/jenkinsfile/configuration-build-2.jpg' | prepend: site.baseurl  }} 2x" 
    />
    <noscript><img src="{{ '/assets/posts/jenkinsfile/configuration-build-1.jpg' | prepend: site.baseurl  }}" /></noscript>

    <figcaption>Discard old items permet de supprimer les builds des branches supprimées de Github</figcaption>
</figure>

### Exposition des ports

Ce projet était le premier à utiliser des images docker pour exécuter les tests.
Ce n’est pas gênant en soi, mais ça nous a permis de découvrir quelques points d’attention.

Par exemple, on utilisait le fichier docker-compose.yml de développement pour lancer les tests.
C’est bien, mais celui-ci expose des ports (pour apache et MySQL par exemple).
Si à un moment vous avez plusieurs builds en parallèle vous allez avoir des soucis parce que les ports vont déjà être utilisés.

Trois solutions possibles :

- ne pas lancer les builds en parallèle mais c’est à mon sens une solution à n’utiliser qu’en dernier recours.
- utiliser un fichier docker-compose.yml spécifique. Mais cela impose de maintenir les deux docker-compose.yml
- n’exposer les ports que dans le docker-compose.override.yml et en fournir un spécifique pour Jenkins.
C’est la solution qui a été retenue car elle permet à chacun de configurer ses ports comme il l’entend.

### Nommer les conteneurs

Un autre souci qui s’est posé avec les builds en parallèle c’est que par défaut les containers utilisés portent le même nom dans chaque build.
C’est problématique lorsqu’on lance des commandes pour arrêter les containers.
Il m’est arrivé que la fin d’un build stop un conteneur utilisé par un autre build.
Il faut donc différencier les noms des conteneurs.
Ça tombe bien, la variable d’environnement COMPOSE\_PROJECT\_NAME est là pour ça.

```groovy
def composeProjectName(String step) {
    return "project-${BRANCH_NAME}-${BUILD_NUMBER}-${step}"
}
```

## Et si on migrait les projets existants ?

Une fois le test du premier projet concluant, est venu le temps de migrer les projets existants.
On s’est dit que la maintenance serait plus aisée si le code et la configuration des builds étaient centralisés au même endroit.
Par ailleurs, l’utilisation de docker permettra d’être plus souple sur les montées de version de php.
Plus besoin que tous les projets soient compatibles pour migrer le serveur.
Il devient possible de le faire projet par projet.

**_Vous la voyez venir la fausse bonne idée ?_**

J’ai implicitement associé les deux changements : utiliser un Jenkinsfile pour contrôler les builds et lancer les tests dans des containers docker.
Introduire plusieurs changements à la fois c’est **TOUJOURS** une mauvaise idée et pourtant je continue à le faire régulièrement.
Ça rend l’identification des erreurs beaucoup plus difficile.
J’aurais tout à fait pu le faire en deux temps, mais j’ai préféré tout faire d’un coup, surement parce que j’aime me compliquer la vie.

### Marche arrière toute

On a laissé tourner les deux systèmes de builds en parallèle notamment pour s’assurer de la cohérence des résultats des nouveaux builds.

Quelques semaines plus tard, le constat est là, l’utilisation de docker pour lancer les tests nous crée plus de problèmes qu’elle n’en résout.

-   L’espace disque

Docker a cette faculté incroyable à manger de l’espace disque de manière totalement irraisonnée.

-   Les fausses promesses

Ce point est mon principal grief contre docker (mais cela pourrait faire l’objet d’un billet à part entière).
Toujours est-il que j’ai toujours été emballé par la promesse de docker. La réalité par contre est toute autre.
Dès lors qu’on lance dans Jenkins un docker run avec l’option `--rm` pour supprimer le conteneur à la fin de l’exécution,
on se retrouve avec un souci de suppression du volume par docker.
C’est très probablement lié à notre infrastructure / à la version du kernel que l’on utilise.
Mais bon courage pour débugger ce genre de problème. D’où d’ailleurs une autre partie de nos problèmes d’espace disque.

<figure>
    <img
        class="lozad"
        width="480" height="471"
        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
        data-src="https://media.giphy.com/media/p8Uw3hzdAE2dO/giphy.gif"
    />
    <noscript><img src="https://media.giphy.com/media/p8Uw3hzdAE2dO/giphy.gif" /></noscript>

    <figcaption>Moi, face à un problème avec docker</figcaption>
</figure>

Devant la complexité des problèmes rencontrés et mon incapacité à trouver une solution pérenne,
nous avons fait marche arrière sur la partie docker des builds.
Les tests sont lancés directement sur la machine où est installé notre Jenkins. Et depuis, aucun problème à signaler.

### En conclusion

-   Je râle beaucoup.
-   Tous nos projets utilisent maintenant un Jenkinsfile pour configurer leurs builds
-   Je me suis rappelé de [cet article](https://thehftguy.com/2016/11/01/docker-in-production-an-history-of-failure/) et
j’ai définitivement basculé dans la catégorie : j’utilise docker le moins possible (ie: pour un environnement de dév : ok, sinon c'est non)
