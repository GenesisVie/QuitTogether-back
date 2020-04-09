# Présentation du projet

Ce projet est a été réalisé dans le contexte de projet de fin d'année pour notre 3ème année de Bachelor au sein de l'école Ynov situé a Lyon.
QuitTogether est une application mobile qui permet a ses utilisateurs d'arreter ou de diminuer la cigarette.
Notre but est d'apporter une plateforme aux personnes qui souhaitent se débrasser de cette addiction qui est la cigarette.
Et de les aider dans leur aventure pour accomplir ce but.
Pour l'instant ce site n'est destiné qu'a l'administration de l'application.
Notre plateforme est seulement destiné pour les mobiles, alors je vous invite a télécharger l'application "QuitTogether".

# Participants du projet

Ce projet a été realisé par deux élèves de B3 Développement Informatique.
ANANDANADARADJA David (spécialité Web-Mobile).
MOUSSET Antoine (spécialité Web-Mobile).

# Période du projet

La période oû ce projet a été réalisé est du mois d'octobre 2019 au mois d'avril 2020.

# Technologies du projet

Pour le back et le front office ce projet a été réalisé a l'aide du framework Symfony.
Et l'application a été réalisé a l'aide du framework React Native.


## Installation du Back office 

`composer update`

`bin/console d:d:c`

`bin/console d:s:u --force`


**Fixtures**

`bin/console d:f:l`


## Générer les clés pour le JWT

`openssl genrsa -out config/jwt/private.pem -aes256 4096`

`openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem`


