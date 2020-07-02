<?php

namespace Source\Facades;

use Source\Models\User;

/**
 * Description of UserFacade
 *
 * @author usr
 */
class UserFacade {

    public function __construct() {
        if (!session_id()) {
            session_start();
        }

        $_SESSION["user"] = (!empty($_SESSION["user"]) ? $_SESSION["user"] : []);
    }

    public function logar(User $user): UserFacade {
        $_SESSION["user"]["id"] = $user->id;
        $_SESSION["user"]["name"] = $user->name;
        $_SESSION["user"]["email"] = $user->email;
        $_SESSION["user"]["password"] = $user->password;
        $_SESSION["user"]["contact"] = $user->contact;
        return $this;
    }
    
    public function logout(): void {
        session_destroy();
        //$_SESSION["user"] = [];
    }

}
