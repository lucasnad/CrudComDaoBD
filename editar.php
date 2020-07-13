<?php
    require 'config.php';

    $info = [];
    $id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);

    if($id){
        //Indo ao BD onde tem o id que eu quero
        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();

        if($sql->rowCount()>0){
            $info = $sql->fetch( PDO::FETCH_ASSOC );
        }else{
            header("Location: index.php");
            exit;
        }
    }else {
        header("Location: index.php");
        exit;
    }

?>

<h2>Editar Usuário</h2>
<form method="POST" action="editar_action.php">

    <input type="hidden" name="id" value="<?=$info['id'];?>">
    <label>
        Nome:<br>
        <input type="text" name="nome" value="<?=$info['nome'];?>">
    </label><br><br>
    <label>
        E-mail:<br>
        <input type="email" name="email" value="<?=$info['email'];?>">
    </label><br><br>
    <input type="submit" value="Salvar">
</form>