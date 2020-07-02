<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;
use PDO;
use PDOException;

/**
 * Description of Category
 *
 * @author usr
 */
class Category extends DataLayer
{

    public function __construct()
    {
        parent::__construct("categories", ["name"]);
    }

    /**
     * @return bool
     */
    public function save(): bool
    {

        if (!$this->validateCategory() || !parent::save()) {
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */

    public function validateCategory(): bool
    {
        if (empty($this->name)) {
            $this->fail = new Exception("Informe uma categoria válida");
            return false;
        }

        $category = null;
        if (!$this->id) {
            $category = $this->find("name = :name", "name={$this->name}")->count();
        } else {
            $category = $this->find("name = :name AND id != :id", "name={$this->name}&id={$this->id}")->count();
        }

        if ($category) {
            $this->fail = new exception("A categoria informada já existe");
            return false;
        }

        return true;
    }

    /**
     * @param int $id
     * @return null|array
     */

    public function resursiveCategories(int $id): ?array
    {
        try {
            $con = Conexao::getCon();
            $sql = 'WITH RECURSIVE cte (id, name, parent) AS (
                SELECT     id,
                           name,
                           parent
                FROM       categories
                WHERE      parent = :parent
                UNION ALl
                SELECT     p.id,
                           p.name,
                           p.parent
                FROM       categories p
                INNER JOIN cte
                        ON p.parent = cte.id
              )
              SELECT * FROM cte
              UNION SELECT id, name, parent FROM categories WHERE id = :parent;';

            $sql = $con->prepare($sql);
            $sql->bindValue(":parent", $id);
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
