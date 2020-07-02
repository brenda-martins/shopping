# Loja Virtual 

Simple online store that I used to apply some of my knowledge

PS Online store was the simplest context I found, but the code used here can be used on any system (such as structured login or a simple crud)



# Reason

This project is part of my personal portfolio. My intention is to improve my programming logic, so i will be very happy with any feedback on the algorithm or code structure, after all we always have something to learn or something to improve...

# Some screens

![](https://github.com/brenda-martins/shopping/blob/master/images-project/home.png)
![](https://github.com/brenda-martins/shopping/blob/master/images-project/register.png)
![](https://github.com/brenda-martins/shopping/blob/master/images-project/login.png)
![](https://github.com/brenda-martins/shopping/blob/master/images-project/search.png)
![](https://github.com/brenda-martins/shopping/blob/master/images-project/cart.png)
[](https://github.com/brenda-martins/shopping/blob/master/images-project/area-administrativa.png)

# Functionalities

1. Login/Logout
2. Register/ Recover password
3. CRUD Products and Category
4. Add to cart
5. Search products

# Some technical information

1. Cloning the Repository

```
$ git clone  https://github.com/brenda-martins/shopping.git
$ cd shopping
```

2. Run the composer


```
$ composer install / composer update
```

3. Set your DB settings in Source/Config.php


```
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "shop",
    "username" => "user",
    "passwd" => "password",
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

