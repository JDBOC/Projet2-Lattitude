<?php
namespace App\Model;

class UserManager extends \App\Model\AbstractManager
{
    /*enregistrement dans la BDD*/
    public function addUser($lastname, $firstname, $email, $password)
    {
        $insert = 'INSERT INTO users (firstname, lastname, email, password)
        VALUES (:firstname, :lastname, :email, :password)';
        
        $prep = $this->pdo->prepare($insert);
        
        $prep->bindValue('firstname', $firstname, \PDO::PARAM_STR);
        $prep->bindValue('lastname', $lastname, \PDO::PARAM_STR);
        $prep->bindValue('email', $email, \PDO::PARAM_STR);
        $prep->bindValue('password', $password, \PDO::PARAM_STR);
        
        $prep->execute();
    }
}
