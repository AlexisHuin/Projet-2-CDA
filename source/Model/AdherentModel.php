<?php
namespace Model;

use Model\DbModel;

class AdherentModel extends DbModel
{
    protected $table = 'Adherents';  
    
    public function getAdherent()
    {
        return DbModel::Find('Select * from ...',[]);
    }
}

?>
