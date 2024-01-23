<?php

namespace App\Session;

class Login
{
    // método responsável por iniciar a sessão
    public static function init()
    {
        // verifica o status da sessão
        if (session_status() !== PHP_SESSION_ACTIVE) {
            // inicia a sessão
            session_start();
        }
    }

    // método responsável por retornar dados do usuário logado
    public static function getUsuatioLogado()
    {
        self::init();
        // retorna dados do usuário
        return self::isLogged() ? $_SESSION['usuario'] : null;
    }

    // método responsável por logar o usuário
    public static function Login($obUsuario, $redirect = 'index.php')
    {
        // inicia a sessão
        self::init();
        // sessão de usuário
        $_SESSION['usuario'] = [
            'id' => $obUsuario->id,
            'nome' => $obUsuario->nome,
            'email' => $obUsuario->email
        ];
        // redireciona o usuário
        header("location: $redirect");
        exit;
    }

    // método responsável por deslogar o usuário
    public static function logout($redirect = 'login.php')
    {
        // inicia a sessão
        self::init();
        // remove a sessão de usuário
        unset($_SESSION['usuario']);
        // redireciona o usuário
        header("location: $redirect");
        exit;
    }

    // método responsável por verificar se o usuário está logado
    public static function isLogged()
    {
        self::init();
        // validação da sessão
        return isset($_SESSION['usuario']['id']);
    }

    // método responsável por obrigar o usuário a estar logado para acessar
    public static function requireLogin()
    {
        if (!self::isLogged()) {
            header('location: login.php');
            exit();
        }
    }

    // método responsável por obrigar o usuário a estar deslogado para acessar
    public static function requireLogout()
    {
        if (self::isLogged()) {
            header('location: index.php');
            exit();
        }
    }
}