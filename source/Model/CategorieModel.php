<?php
namespace Model;

use Model\DbModel;

class CategorieModel extends DbModel
{
    protected $table = 'Categorie';  
    
    public function getCategories() : object|array|string
    {
        return DbModel::Select('Select * from Categorie Order by DesignationCategorie');
    }
}


?>