<?php
class Pessoa{
    private $id;
    private $nome;
    private $numero;
    private $email;

    public function __get($atributo){
        return $this->$atributo;
    }
    public function __set($atributo,$valor){
        $this->$atributo=$valor;
    }

}