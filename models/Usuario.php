<?php

class Usuario{
    private $id;
    private $nome;
    private $email;

    public function getId(){
        return $this->id;
    }
    public function setId($i){
        $this->id = trim($i); //Trim remove espaços no inicio e no final da var, caso o BD comece a usar string
    }

    public function getNome(){
        return $this->nome;
    }
    public function setNome($n){  
        $this->nome = ucwords(trim($n));      
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($e){
        $this->email = strtolower(trim($e));
    }
}

//Implementação da interface para impor limites e ser profissional kkkk

interface UsuarioDAO{
    public function add(Usuario $u);
    public function findAll();
    public function findByEmail($email);
    public function findById($id);
    public function update(Usuario $u); 
    public function delete($id);
}