<?php

require 'config.php';
require 'dao/UsuarioDaoMysql.php';//Preciso de Usuario e de UsuarioDAO mas UsuarioDao ja importa Usuario

$usuarioDao = new UsuarioDaoMysql($pdo);
$lista = $usuarioDao->findAll();

?>
    <a href="adicionar.php">Adicionar usuário</a>

    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>E-MAIL</th>
            <th>AÇÕES</th>
        </tr>
        <?php foreach($lista as $usuario):?>
        
        <tr>
            <td> <?=$usuario->getId()?> </td>
            <td> <?=$usuario->getNome()?> </td>
            <td> <?=$usuario->getEmail()?> </td>
            <td>
                <a href="editar.php?id=<?=$usuario->getId()?>">[EDITAR]</a>
                <a href="excluir.php?id=<?=$usuario->getID()?>"onclick="confirm('Tem certeza que deseja excluir esse item?')">[EXCLUIR]</a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>