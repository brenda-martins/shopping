<?php

namespace source\controllers;

use Source\Controllers\Controller;
use Source\Models\User;
use Source\Facades\UserFacade;
use Source\Supports\Email;

class Auth extends Controller
{

    public function __construct($router)
    {
        parent::__construct($router);
    }


    public function login(array $data): void
    {
        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        $password = filter_var($data["password"], FILTER_DEFAULT);

        if (!$email || !$password) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe email e senha para logar."
            ]);
            return;
        }

        $user = (new User())->find("email = :e", "e={$email}")->fetch();
        if (!$user || !password_verify($password, $user->password)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Email e/ou senha inválidos."
            ]);
            return;
        }

        (new UserFacade())->logar($user);


        if ($user->admin) {
            $_SESSION["admin"] = $user->id;
        }



        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("web.index")
        ]);
    }


    /**
     * @param array $data
     */
    public function register(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos."
            ]);

            return;
        }

        $user = new User();
        $user->name = $data["name"];
        $user->email = $data["email"];
        $user->password = $data["password"];
        $user->contact = $data["contact"];
        $user->admin = 1;

        if (!$user->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $user->fail()->getMessage()
            ]);
            return;
        }

        $_SESSION["admin"] = $user->id;
        
        (new UserFacade())->logar($user);
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("web.index")
        ]);
    }


    /**
     * @param array $data
     */
    public function forget(array $data): void
    {
        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);

        if (!$email) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe seu E-MAIL para recuperar a senha"
            ]);
            return;
        }

        $user = (new User())->find("email = :email", "email={$email}")->fetch();
        if (!$user) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "o E-MAIL informado não existe na base de dados"
            ]);
            return;
        }

        $user->forget = (md5(uniqid(rand(), true)));
        $user->save();

        $_SESSION["forget"] = $user->id;

        $email = new Email();
        $email->add(
            "Recupere sua senha | " . site("name"),
            $this->view->render("emails/recover", [
                "user" => $user,
                "link" => $this->router->route("web.reset", [
                    "email" => $user->email,
                    "forget" => $user->forget
                ])
            ]),
            $user->name,
            $user->email
        )->send();

        //message("success", "Foi enviado um link de recuperação para seu email");

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("web.sendemail")
        ]);
    }

    /**
     * @param array $data
     * @return void
     */
    public function reset($data): void
    {

        if (empty($_SESSION["forget"]) || !$user = (new User())->findById($_SESSION["forget"])) {
            message("error", "Não foi possível processar sua requisição, tente novamente");
            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("web.forget")
            ]);
            return;
        }

        $password = filter_var($data["password"], FILTER_DEFAULT);
        $password_re = filter_var($data["password_re"], FILTER_DEFAULT);
        if (!$password || !$password_re) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe a senha e a confirmação"
            ]);
            return;
        }

        if ($password != $password_re) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "As senhas não conferem"
            ]);
            return;
        }

        $user->password = $password;
        $user->forget = null;

        if (!$user->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $user->fail()->getMessage()
            ]);
            return;
        }

        unset($_SESSION["forget"]);

        message("success", "Senha atualizada com sucesso, faça login para continuar");
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("web.login")
        ]);
    }
}
