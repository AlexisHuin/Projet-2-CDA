<?php
namespace Model;

use Model\DbModel;

class UserModel extends DbModel
{
    protected $table = 'User';  
    
    public function getUsers()
    {
        return DbModel::Find('Select * from ...',[]);
    }
}

?>
