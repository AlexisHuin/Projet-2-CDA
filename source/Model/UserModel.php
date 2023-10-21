<?php
namespace Model;

use Model\DbModel;

class UserModel extends DbModel
{
    protected $table = 'User';  
    protected string $id = 'IdUser';
    
    public function getUsers() : string|object|array
    {
        return DbModel::Find('Select * from ...',[]);
    }
}

?>
