<?php
require __DIR__ . "/vendor/autoload.php";

use \App\Session\Login;
use \App\Entity\Usuario;

// desloga o usuario
Login::logout();

