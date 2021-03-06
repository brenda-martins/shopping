# Loja Virtual 

Simple online store that I used to apply some of my knowledge

### PS: 
Online store was the simplest context I found, but the code used here can be used in any system or even used to complement the idea.
Example: 

# Reason

This project is part of my personal portfolio. My intention is to improve my programming logic, so i will be very happy with any feedback on the algorithm or code structure, after all we always have something to learn or something to improve...

# Some screens

![](https://github.com/brenda-martins/shopping/blob/master/images-project/home.png)
![](https://github.com/brenda-martins/shopping/blob/master/images-project/register.png)
![](https://github.com/brenda-martins/shopping/blob/master/images-project/login.png)
![](https://github.com/brenda-martins/shopping/blob/master/images-project/search.png)
![](https://github.com/brenda-martins/shopping/blob/master/images-project/cart.png)
![](https://github.com/brenda-martins/shopping/blob/master/images-project/checkout1.png)
![](https://github.com/brenda-martins/shopping/blob/master/images-project/credit-card.png)
![](https://github.com/brenda-martins/shopping/blob/master/images-project/confirm.png)
![](https://github.com/brenda-martins/shopping/blob/master/images-project/area-administrativa.png)

# Functionalities

1. Login/Logout
2. Register
3. Recover password with email
4. CRUD Products and Category
5. Product filter by name
6. Add as remove cart using ajax
7. Add address
8. Add card credit
9. Confirm purchase

# Some technical information#

1. Cloning the Repository

```
$ git clone  https://github.com/brenda-martins/shopping.git
$ cd shopping
```

2. Run the composer

```
$composer update
```

3. Set your DB settings in Source/Config.php


```
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "shop",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);
```

4. Set your email provider settings in Source/Config.php

```
define("MAIL", [
    "host" => "smtp.gmail.com",
    "port" => "587",
    "user" => "",
    "passwd" => "",
    "from_name" => "",
    "from_email" => ""
]);
```

5. I used the API of Paguar-me to complete the purchase, to configure the settings you need to register (free) on the site https://dashboard.pagar.me/#/login  and get the APY_KEY and configure the application in Source\Config.php

```
define("PAGARME_API_KEY", "digite aqui sua api da pagarme");
```

You can use the website https://www.4devs.com.br/gerador_de_numero_cartao_credito to generate a credit card format valid for doing the tests

