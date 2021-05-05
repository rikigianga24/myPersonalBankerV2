# myPersonalBanker
## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)
## General-info
This is a WebServices that offer some bank services like getting your money, send money and track transactions.

## Technologies
This is implemented using Symfony

## Setup
1) clone your project into a folder using cmd
```
$git clone https://github.com/rikigianga24/myPersonalBanker
```

2) install all the rquired dependencies using composer
```
$project_folder/ composer install
```

3) create local database for testing it
   - modify .env using your settings of mysql db
 ```
$symfony console doctrine:schema:create
```

4) create some fake datas for testing using AppFixtures feature
```
$php bin/console doctrine:fixtures:load
```
5) finally you can start the WebService using 
```
$symfony serve
```
