<?php

namespace source\Models;

use CoffeeCode\DataLayer\DataLayer;
use PDO;
use PDOException;
use Source\Models\Conexao;

/**
 * Description of Product
 *
 * @author Brenda Martins
 */
class Product extends DataLayer
{


    public function __construct()
    {
        parent::__construct("products", [
            "category",
            "name",
            "price",
            "productDescription",
            "image1",
            "image2",
            "image3",
        ]);
    }


    /**
     * @return null|array
     */
    public function findAll(): ?array
    {
        try {
            $con = Conexao::getCon();
            $sql = 'SELECT p.id, 
                           p.name, 
                           c.name as category, 
                           p.price, 
                           p.productDescription,
                           p.image1, 
                           p.image2, 
                           p.image3,
                           DATE_FORMAT(p.created_at, "%d/%m/%Y %H:%i:%s") as created_at,
                           DATE_FORMAT(p.updated_at, "%d/%m/%Y %H:%i:%s") as updated_at,
                           shippingCharge, 
                           productAvailability
                    FROM products p, categories c 
                    WHERE p.category = c.id;';

            $sql = $con->prepare($sql);
            $sql->execute();

            if (!$sql->rowCount()) {
                return null;
            }

            return $sql->fetchAll(PDO::FETCH_CLASS, static::class);
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }


    /**
     * @param string
     * @return null|array
     */
    public function search(string $data): ?array
    {

        try {
            $con = Conexao::getCon();
            $sql = "SELECT p.id, 
                          c.name as category, 
                          p.name as product, 
                          p.price, 
                          p.productDescription, 
                          p.image1,
                          p.image2, 
                          p.image3, 
                          p.created_at, 
                          p.updated_at, 
                          p.shippingCharge, 
                          p.productAvailability
                    FROM products p, categories c
                    WHERE p.category = c.id 
                    AND p.name LIKE '%{$data}%';";
            $sql = $con->prepare($sql);
            $sql->execute();

            if (!$sql->rowCount()) {
                return null;
            }

            return $sql->fetchAll(PDO::FETCH_CLASS, static::class);
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }


    /**
     * @param string
     * @return null|array
     */
    public function findByCategory(string $category): ?array
    {
        try {
            $con = Conexao::getCon();
            $sql = "SELECT p.id, 
                           p.category as id_category, 
                           c.name as category,
                           s.name as subCategory, 
                           p.name as product, 
                           p.price,
                           p.productDescription, 
                           p.image1, 
                           p.image2, 
                           p.image3,
                           p.created_at, 
                           p.updated_at, 
                           p.priceBeforeDiscount,
                           p.shippingCharge, 
                           p.productAvailability
                    FROM products p, 
                         category c, 
                         subcategory s
                    WHERE p.category = c.id 
                    AND p.subcategory = s.id
                    AND p.category = :category";
            $sql = $con->prepare($sql);
            $sql->bindValue(":category", $category);
            $sql->execute();
            if (!$sql->rowCount()) {
                return null;
            }

            return $sql->fetchAll(PDO::FETCH_CLASS, static::class);
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }



    /**
     * @return null|array
     */
    public function recentPosted(): ?array
    {

        try {
            $con = Conexao::getCon();
            $sql = "SELECT p.id, 
                           p.category as id_category, 
                           c.name as category,
                           s.name as subCategory, 
                           p.name as product, 
                           p.price,
                           p.productDescription, 
                           p.image1, 
                           p.image2, 
                           p.image3,
                           p.created_at, 
                           p.updated_at, 
                           p.priceBeforeDiscount,
                           p.shippingCharge, 
                           p.productAvailability
                    FROM products p, 
                         category c, 
                         subcategory s
                    WHERE p.category = c.id 
                    AND p.subcategory = s.id
                    ORDER BY p.id 
                    DESC LIMIT 5";
            $sql = $con->prepare($sql);
            $sql->execute();
            if (!$sql->rowCount() > 0) {
                return null;
            }

            return $sql->fetchAll(PDO::FETCH_CLASS, static::class);
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }


    /**
     * @param int
     * @return null|int
     */
    public function findCategory(int $id_product): ?int
    {

        try {
            $con = Conexao::getCon();
            $sql = "SELECT p.category  
                    FROM products p
                     WHERE p.id = :id_product;";
            $sql = $con->prepare($sql);
            $sql->bindValue(":id_product", $id_product);
            $sql->execute();
            if (!$sql->rowCount()) {
                return null;
            }
            $category = $sql->fetch();
            return $category["category"];
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * @param int
     * @return null|Product
     */
    public function findProduct(int $id_product): ?Product
    {
        try {
            $con = Conexao::getCon();
            $sql = "SELECT p.id, 
                           p.category as id_category, 
                           c.name as category,
                           p.name as product, 
                           p.price,
                           p.productDescription, 
                           p.image1, 
                           p.image2, 
                           p.image3,
                           p.created_at, 
                           p.updated_at, 
                           p.shippingCharge, 
                           p.productAvailability
                    FROM products p, 
                         categories c
                    WHERE p.category = c.id 
                    AND p.id = :id_product";
            $sql = $con->prepare($sql);
            $sql->bindValue(":id_product", $id_product);
            $sql->execute();

            if (!$sql->rowCount()) {
                return null;
            }
            return $sql->fetchObject(static::class);
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    public function findByNameCategory(string $name_category): ?array
    {
        try {
            $con = Conexao::getCon();
            $sql = "SELECT  p.id, 
                            p.category as id_category, 
                            c.name as category,
                            s.name as subCategory, 
                            p.name as product, 
                            p.price,
                            p.productDescription, 
                            p.image1, 
                            p.image2, 
                            p.image3,
                            p.created_at, 
                            p.updated_at, 
                            p.priceBeforeDiscount,
                            p.shippingCharge, 
                            p.productAvailability
                    FROM products p, 
                         category c, 
                         subcategory s
                    WHERE p.category = c.id 
                    AND p.subcategory = s.id
                    AND c.name = :category";
            $sql = $con->prepare($sql);
            $sql->bindValue(":category", $name_category);
            $sql->execute();

            if (!$sql->rowCount()) {
                return null;
            }

            return $sql->fetchAll(PDO::FETCH_CLASS, static::class);
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }
}
