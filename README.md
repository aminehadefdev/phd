# phd
##start project
- 1: ```git clone project```
- 2: ```yarn install``` or ```npm install```
- 3: ```composer install```
- 4: change the constant DATABASE_URL in /.env
- 5: ```php bin/console doctrine:database:create```
- 6: ```php bin/console doctrine:migrations:migrate```
- 7: ```symfony server:start```
- 8: ```yarn run dev-server``` or ```npm run dev-server```