<?php
namespace Panier\Models;

/** Class User **/
class User
{

    private $code_client;
    private $password;
    private $id;
    private $permissions;

    public function getCode_client()
    {
        return $this->code_client;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getPermissions()
    {
        return $this->permissions;
    }

    public function setCode_client(string $code_client)
    {
        $this->code_client = $code_client;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setPermissions(int $permissions)
    {
        $this->permissions = $permissions;
    }
}