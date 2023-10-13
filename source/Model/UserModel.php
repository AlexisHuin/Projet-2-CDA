<?php
namespace Model;

use Model\DbModel;

class UserModel extends DbModel
{
    protected $table = 'user';  
    
    public function getUsers()
    {
        return DbModel::Find('Select * from ...',[]);
    }
}

?>
