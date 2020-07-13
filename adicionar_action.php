<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$name = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);

if($name && $email){
    //Verificando se o email ja existe
    if($usuarioDao->findByEmail($email) === false){
        $novoUsuario = new Usuario();
        $novoUsuario->setNome($name);
        $novoUsuario->setEmail($email);

        $usuarioDao->add( $novoUsuario );

        header("Location: index.php");
        exit;
    }else{
        header("Location: adicionar.php");
        exit;
    }
}else{
    header("Location: adicionar.php");
    exit;
}