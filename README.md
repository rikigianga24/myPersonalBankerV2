This REST web service is the back-end layer for my personal banker, developed by:
- [Riccardo Giangani]

It is expected to be used with the [clientMypersonalBanker](https://github.com/rikigianga24/clientMyPersonalBanker).

## Getting started

### Prerequisites
- [PHP 7.x](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/download/)
- [Symfony](https://symfony.com/download)
- [MySQL](https://dev.mysql.com/downloads/)

### Installation
Follow the steps below to install and run locally the web service.
* Clone this repository:

    ```sh 
    git clone https://github.com/rikigianga24/myPersonalBankerV2.git
    ```
    You can also use the [GitHub CLI](https://github.com/cli/cli):
    
     ```sh
     gh repo clone rikigianga24/myPersonalBankerV2
     ```
* Move into the project directory and install the required dependecies:

  ```sh
  cd myPersonalBankerV2
  composer update
  ```
* Set your custom database URL as you prefer by adding the `DATABASE_URL` variable in a file named `.env.local`:

  ```sh
  touch .env.local
  echo "DATABASE_URL=mysql://root:password@host:port/db_name?serverVersion=server-version" > .env.local
  example: DATABASE_URL="mysql://root:@127.0.0.1:3306/bank_db?serverVersion=5.7"
  ```
  Remember to replace `user`, `password`, `host` and `port` with your MySQL credentials.
  You also have to set the `server-version`: follow the [Symfony guide](https://symfony.com/doc/current/doctrine.html#configuring-the-database).
* Generate the database and its schema using [Doctrine](https://www.doctrine-project.org/):

  ```sh
  bin/console doctrine:database:create
  bin/console doctrine:schema:create
  ```
  or
  ```sh
  symfony console doctrine:database:create
  symfony console doctrine:schema:create
  ```
* Create some fake datas for testing using AppFixtures feature
   ```sh
   $php bin/console doctrine:fixtures:load
   ```
* Now you can finally run the web service with the Symfony built-in web server:
  
  ```sh
  symfony server:start
  ```
  
  or
  ```sh
  symfony serve
  ```
