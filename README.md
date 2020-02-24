# QuitTogether-back

`composer update`

`bin/console d:d:c`

`bin/console d:s:u --force`

**Fixtures**

`bin/console d:f:l`

##Générer les clés pour le JWT
`openssl genrsa -out config/jwt/private.pem -aes256 4096`

`openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem`


