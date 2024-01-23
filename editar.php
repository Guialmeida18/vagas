<?php

use App\Session\Login;

// obriga o usuario estar logado
Login::reuquireLogin();
//Carrega o autoloader do Composer, que é responsável por carregar automaticamente as classes do projeto.
include __DIR__ . '/vendor/autoload.php';

//Define a constante TITLE com o valor 'Editar vaga'. Essa constante provavelmente é usada para definir o título da página.
define('TITLE', 'Editar vaga');

//Utiliza a classe 'Vaga' do namespace 'App\Entity'.
use \App\Entity\Vaga;

//validaçao do id, Essa parte verifica se o parâmetro 'id' está presente na URL e se é um número. Caso contrário, redireciona para 'index.php' com um parâmetro de status de erro.
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}
// consulta vaga, Usa o método estático getVaga da classe Vaga para obter uma instância da vaga com o ID fornecido na URL.
$obVaga = Vaga::getVaga($_GET['id']);

//validar a vaga, Verifica se a variável $obVaga é uma instância da classe Vaga. Se não for, redireciona para 'index.php' com um parâmetro de status de erro.
if (!$obVaga instanceof Vaga) {
    header('location: index.php?status=error');
}

//Se o formulário for submetido (verificando se os campos necessários estão definidos no array $_POST), atualiza os atributos da instância da vaga com os novos valores e chama o método atualizar().
if (isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])) {

    $obVaga->titulo = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo = $_POST['ativo'];
    $obVaga->atualizar();

    header('location: index.php?status=success');
    exit;
}
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/formulario.php';
include __DIR__ . '/includes/footer.php';