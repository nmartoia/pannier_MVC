<?php
namespace Panier\Models;

use Panier\Models\User;
/** Class UserManager **/
class UserManager {

    private $bdd;

    public function __construct() {
        $this->bdd = new \PDO('mysql:host='.HOST.';dbname=' . DATABASE . ';charset=utf8;' , USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getBdd()
    {
        return $this->bdd;
    }

    public function find($username) {
        $stmt = $this->bdd->prepare("SELECT * FROM users WHERE code_client = ?");
        $stmt->execute(array(
            $username
        ));
        $stmt->setFetchMode(\PDO::FETCH_CLASS,"Panier\Models\User");

        return $stmt->fetch();
    }
    public function username($userid) {
        $stmt = $this->bdd->prepare('SELECT code_client FROM users WHERE id = ?');
        $stmt->execute(array(
            $userid
        ));
        $ligne = $stmt->fetch();
        return  $ligne['username'];
    }
    public function all() {
        $stmt = $this->bdd->query('SELECT * FROM users');

        return $stmt->fetchAll(\PDO::FETCH_CLASS,"Panier\Models\User");
    }

    public function store($password) {
        $stmt = $this->bdd->prepare("INSERT INTO users(id , code_client , password , permissions) VALUES (?,?, ? ,?)");
        $stmt->execute(array(
            uniqid(),
            $_POST["username"],
            $password,
            "0"
        ));
    }
}
