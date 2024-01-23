<?php
require __DIR__ . "/vendor/autoload.php";

use \App\Session\Login;
use \App\Entity\Usuario;

// obriga o usuário não estar logado
Login::requireLogout();

// mensagem de alerta do formulário
$alertaLogin = '';
$alertaCadastro = '';

// validação do post
if (isset($_POST['acao'])){
    switch ($_POST['acao']){
        case 'logar':
            // busca usuário por email
            $obUsuarios = Usuario::getUsuarioPorEmail($_POST['email']);

            // valida a instância e senha
            if (!$obUsuarios instanceof Usuario || !password_verify($_POST['senha'], $obUsuarios->senha)){
                $alertaLogin = 'Email ou senha inválido';
                break;
            }

            // loga o usuário
            Login::Login($obUsuarios);
            break;

        case 'cadastrar':
            // validação dos campos obrigatórios
            if (isset($_POST['nome'], $_POST['email'], $_POST['senha'])){
                $obUsuarios = Usuario::getUsuarioPorEmail($_POST['email']);

                if ($obUsuarios instanceof Usuario){
                    $alertaCadastro = 'O email já está registrado';
                } else {
                    $novoUsuario = new Usuario;
                    $novoUsuario->nome = $_POST['nome'];
                    $novoUsuario->email = $_POST['email'];
                    $novoUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

                    if ($novoUsuario->cadastrar()) {
                        // cadastro bem-sucedido
                        $alertaCadastro = 'Cadastro realizado com sucesso';
                    } else {
                        // erro durante o cadastro
                        $alertaCadastro = 'Erro durante o cadastro. Tente novamente mais tarde.';
                    }
                }
            }
            break;
    }
}

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/formulario-login.php';
include __DIR__ . '/includes/footer.php';