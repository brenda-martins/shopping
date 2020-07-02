<?php $v->layout("themes/_theme", ["title" => "Ecommerce"]); ?>



<main>
  <div class="container">
    <div class="msg-send-email">
      <h1 class="display-4">Olá, <?= $user->name; ?>!</h1>

      <p class="lead">Nós enviamos um link para você. Por favor, cheque seu emai para continuar com a recuperação da senha.</p>
      <hr style="margin-bottom: 4%">
      <p>Caso queira sair dessa página, clique no botão para redirecionarmos você a página principal. </p>
      <a class="btn btn-primary btn-lg" href="<?= $router->route("web.index"); ?>">Ir para página principal</a>
    </div>
  </div>
  </div>
</main>