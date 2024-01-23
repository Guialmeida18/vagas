<?php

use App\Session\Login;

// obriga o usuario estar logado
Login::reuquireLogin();
//Carrega o autoloader do Composer, que é responsável por carregar automaticamente as classes do projeto.
include __DIR__ . '/vendor/autoload.php';

//Utiliza a classe 'Vaga' do namespace 'App\Entity'.
use \App\Entity\Vaga;

//Verifica se o 'id' da vaga foi passado na URL e se é numérico. Se não, redireciona o usuário para a página inicial com um status de erro.
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}
// consulta vaga, Chama o método estático 'getVaga()' da classe 'Vaga' passando o 'id' da vaga.
$obVaga = Vaga::getVaga($_GET['id']);

//validar a vaga, Verifica se a variável '$obVaga' contém uma instância da classe 'Vaga'. Se não, redireciona o usuário para a página inicial com um status de erro.
if (!$obVaga instanceof Vaga) {
    header('location: index.php?status=error');
}

//Verifica se o botão 'excluir' foi clicado no formulário de confirmação de exclusão.
if (isset($_POST['excluir'])) {

    //Chama o método 'excluir()' da classe 'Vaga' para excluir a vaga.
    $obVaga->excluir();

    //Redireciona o usuário para a página inicial com um status de sucesso, indicando que a vaga foi excluída com sucesso.
    header('location: index.php?status=success');
    exit;

}
// Inclui o arquivo 'header.php', que pode conter o cabeçalho HTML do projeto.
include __DIR__ . '/includes/header.php';

//Inclui o arquivo 'confirmar-exclusao.php', que pode conter o código responsável por exibir a confirmação de exclusão da vaga.
include __DIR__ . '/includes/confirmar-exclusao.php';

//Inclui o arquivo 'footer.php', que pode conter o rodapé HTML do projeto.
include __DIR__ . '/includes/footer.php';