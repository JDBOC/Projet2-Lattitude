<?php
namespace App\Model;

class UserManager extends \App\Model\AbstractManager
{
    const TABLE = 'users';
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
    /*enregistrement dans la BDD*/
    public function addUser($firstname, $lastname, $email, $password)
    {
    	
    	  $pass_Crypt = password_hash($password, PASSWORD_DEFAULT);
    	
        $insert = 'INSERT INTO users (firstname, lastname, email, password)
        VALUES (:firstname, :lastname, :email, :password)';
        
        $prep = $this->pdo->prepare($insert);
        
        $prep->bindValue('firstname', $firstname, \PDO::PARAM_STR);
        $prep->bindValue('lastname', $lastname, \PDO::PARAM_STR);
        $prep->bindValue('email', $email, \PDO::PARAM_STR);
        $prep->bindValue('password', $pass_Crypt, \PDO::PARAM_STR);
        
        $prep->execute();
    }
    public function UserOK ($email) {
         //  Récupération de l'utilisateur et de son pass hashé
         
         
             // prepared request
             $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE email=:email");
             $statement->bindValue('email', $email, \PDO::PARAM_STR);
             $statement->execute();
     
             return $statement->fetch();
         

    }
}
