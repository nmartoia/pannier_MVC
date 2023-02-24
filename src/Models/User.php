<?php
namespace Panier\Models;

/** Class User **/
class User {

    private $code_client;
    private $password;
    private $id;

    public function getCode_client() {
        return $this->code_client;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getId() {
        return $this->id;
    }

    public function setCode_client(String $code_client) {
        $this->code_client = $code_client;
    }

    public function setPassword(String $password) {
        $this->password = $password;
    }

    public function setId(Int $id) {
        $this->id = $id;
    }
}
