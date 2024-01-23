<?php
//Carrega o autoloader do Composer, que é responsável por carregar automaticamente as classes do projeto.
include __DIR__.'/vendor/autoload.php';


use App\Session\Login;
//Utiliza a classe 'Vaga' do namespace 'App\Entity'.
use \App\Entity\Vaga;
//obrigar o usuario estar logado
Login::requireLogin();




//Chama o método estático 'getVagas()' da classe 'Vaga' e armazena o resultado na variável $vagas.
$vagas = Vaga::getVagas();

//nclui o arquivo 'header.php', que pode conter o cabeçalho HTML do projeto.
include __DIR__.'/includes/header.php';

//nclui o arquivo 'listagem.php', que pode conter o código responsável por exibir a lista de vagas.
include __DIR__.'/includes/listagem.php';

//Inclui o arquivo 'footer.php', que pode conter o rodapé HTML do projeto.
include __DIR__.'/includes/footer.php';