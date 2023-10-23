<?php
namespace Model;

use Model\DbModel;

class CategorieModel extends DbModel
{
    protected $table = 'Categorie';  
    
    public function getCategories()
    {
        return DbModel::Select('Select * from Categorie Order by DesignationCategorie');
    }




}


?>