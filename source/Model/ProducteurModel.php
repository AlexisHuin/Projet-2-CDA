<?php
namespace Model;

use Model\DbModel;

class ProducteurModel extends DbModel
{
    protected $table = 'Producteur'; 
    protected string $id = 'IdProducteur'; 
    
    public function getProducteur() : string|object|array
    {
        return DbModel::Find('Select * from ...',[]);
    }
}

?>
