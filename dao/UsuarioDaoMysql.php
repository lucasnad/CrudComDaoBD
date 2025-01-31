<?php

require_once('models/Usuario.php');


class UsuarioDaoMysql implements UsuarioDAO{
    //precisa ter o PDO aqui para utilizar banco de dados
    private $pdo;

    public function __construct(PDO $driver)//Vou receber pelo construtor meu pdo
    {
        $this->pdo = $driver;
    }

    public function add(Usuario $u){
        $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:nome,:email)");
        $sql->bindValue(':nome',$u->getNome());
        $sql->bindValue(':email',$u->getEmail());
        $sql->execute();

        $u->setId( $this->pdo->lastInsertId() );

        return $u;//retornando usuario para poder exibir
    }

    public function findAll(){
        $usuarios = []; //array de objetos do BD
        
        $sql = $this->pdo->query("SELECT * FROM usuarios");//Verificando se tem alguem no BD 
        //importante ter $this pq se refere ao objeto atual
        if($sql->rowCount()>0){
            $data = $sql->fetchAll( PDO::FETCH_ASSOC );//Array de arrays

            foreach($data as $item){/*separando arrays e criando objetos*/
                $u = new Usuario();
                $u->setId($item['id']);
                $u->setNome($item['nome']);
                $u->setEmail($item['email']);

                $usuarios[] = $u;
            }
        }
        return $usuarios;
    }

    public function findByEmail($email){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(':email',$email);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch();

            $u = new Usuario();
            $u->setId($data['id']);
            $u->setEmail($data['email']);
            $u->setNome($data['nome']);
            
            return $u;
        }else{
            return false;
        }
    }

    public function findById($id){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(':id',$id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $u = new Usuario();
            //Pegando os dados que batem com esse id
            $data = $sql->fetch( PDO::FETCH_ASSOC );
            $u->setId($data['id']);
            $u->setNome($data['nome']);
            $u->setEmail($data['email']);

            return $u;

        }else{
            return false;
        }
    }
    public function update(Usuario $u){
        $sql = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id");
        $sql->bindValue('nome',$u->getNome());
        $sql->bindValue(':email',$u->getEmail());
        $sql->bindValue('id',$u->getId());
        $sql->execute();
    }
    public function delete($id){
        $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $sql->bindValue(':id',$id);
        $sql->execute();
    }
    
}

?>