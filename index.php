<?php

session_start();
require __DIR__ . "/vendor/autoload.php";

$router = new \CoffeeCode\Router\Router(site());
$router->namespace("Source\Controllers");


/*
  * WEB
  */
$router->group(null);
$router->get("/", "Web:index", "web.index");
$router->get("/login", "Web:login", "web.login");
$router->get("/logout", "Web:logout", "web.logout");
$router->get("/cadastrar", "Web:register", "web.register");
$router->get("/recuperar", "Web:forget", "web.forget");
$router->get("/recuperar/email", "Web:sendemail", "web.sendemail");
$router->get("/senha/{email}/{forget}", "Web:reset", "web.reset");
$router->post("/tree", "Web:tree", "web.tree");
$router->post("/search", "Web:search", "web.search");
$router->post("/categorias", "Web:search", "web.category");
$router->get("/produto/{id}", "Web:productDetail", "web.productdetail");
$router->get("/menu_categories/{id}", "Web:findByCategory", "web.menu.categories");
$router->get("/minhaconta", "Web:myAccount", "web.myaccout");


/*
* AUTH
 */
$router->group(null);
$router->post("/do", "Auth:login", "auth.login");
$router->post("/register", "Auth:register", "auth.register");
$router->post("/forget", "Auth:forget", "auth.forget");
$router->post("/reset", "Auth:reset", "auth.reset");


/*
* CART
*/
$router->group("/cart");
$router->get("/", "WebCart:index", "cart.index");
$router->get("/add/{id}", "WebCart:add", "cart.add");
$router->post("/add", "WebCart:more", "cart.more");
$router->post("/less", "WebCart:less", "cart.less");
$router->post("/remove", "WebCart:remove", "cart.remove");


/*
 * ADMIN
 */
$router->group("/admin");
$router->get("/", "Admin:index", "admin.index");
$router->get("/categoria", "Admin:category", "admin.category");
$router->post("/category/store", "AdminCategory:store", "category.store");
$router->post("/category/edit", "AdminCategory:edit", "category.edit");
$router->post("/category/remove", "AdminCategory:remove", "category.remove");
$router->get("/subcategoria", "Admin:subcategory", "admin.subcategory");
$router->post("/subcategory/store", "AdminSubcategory:store", "subcategory.store");
$router->get("/produto", "Admin:product", "admin.product");
$router->get("/produtos", "AdminProduct:manage", "product.manager");
$router->post("/product/store", "AdminProduct:store", "product.store");
$router->post("/product/edit", "AdminProduct:edit", "product.edit");
$router->post("/product/update", "AdminProduct:update", "product.update");
$router->post("/product/delete", "AdminProduct:delete", "product.delete");
$router->get("/logout", "Admin:logout", "admin.logout");


/*
  * PROCESS
  */
$router->dispatch();
if ($error = $router->error()) {
  var_dump($error);
}
