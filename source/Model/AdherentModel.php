<?php
namespace Model;

use Model\DbModel;

class AdherentModel extends DbModel
{
    protected $table = 'Adherents';  
    
    public function getAdherent() : object|array|string
    {
        return DbModel::Find('Select * from ...',[]);
    }
}

?>
