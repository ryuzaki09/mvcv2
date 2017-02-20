<?php

namespace src\Models;
use System\mvc\Model;

class User extends Model {

    const USER_TYPE_1 = "Administrator";
    const USER_TYPE_2 = "User";

    private $table = "Users";

    public function __construct()
    {
        parent::__construct();
    }


    public function getRoles()
    {
        return array(self::USER_TYPE_1, self::USER_TYPE_2);

    }

    public function getAllUsers()
    {
        $this->from($this->table);
        $this->execute();
        return $this->fetchAll();
    }
    
    public function addUser(array $data)
    {
        $this->set($data);
        return $this->insertData($this->table);
    }

    public function findDuplicateUser($email, $username, $id="")
    {
        $this->query("SELECT id FROM ".$this->table." WHERE (email='$email' OR username='$username') $id");
        $this->execute();
        return $this->fetchOne();
    }

    public function updateUser(array $data, $where_clause, $where_value)
    {
        $this->set($data);
        return $this->update($this->table, $where_clause, $where_value);
    }


}
