<?php

namespace Source\Models;

use Exception;
use Source\Models\Conexao;
use CoffeeCode\DataLayer\DataLayer;
/**
 * Description of User
 *
 * @author usr
 */
class User extends DataLayer
{

    public function __construct()
    {
        parent::__construct("users", ["name", "email", "contact", "password"]);
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->validateEmail() || !$this->validatePassword() || !parent::save()) {
            return false;
        }

        return true;
    }


    /**
     * @return bool
     */
    protected function validateEmail(): bool
    {
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = new Exception("Informe um email válido.");
            return false;
        }

        $userByEmail = null;
        if (!$this->id) {
            $userByEmail = $this->find("email = :email", "email={$this->email}")->count();
        } else {
            $userByEmail = $this->find("email = :email AND id != :id", "email={$this->email}&id={$this->id}")->count();
        }

        if ($userByEmail) {
            $this->fail = new Exception("O email informado já está em uso.");
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    protected function validatePassword(): bool
    {
        if (empty($this->password) || strlen($this->password) < 5) {
            $this->fail = new Exception("Informe uma senha com pelo menos 5 caracteres");
            return false;
        }

        if (password_get_info($this->password)["algo"]) {
            return true;
        }

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return true;
    }
}
