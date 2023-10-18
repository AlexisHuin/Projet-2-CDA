<?php
namespace Model;

use Model\DbModel;

class ProducteurModel extends DbModel
{
    protected $table = 'Producteur';  
    
    public function getProducteur()
    {
        return DbModel::Find('Select * from ...',[]);
    }
}

?>
