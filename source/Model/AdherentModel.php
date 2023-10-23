<?php
namespace Model;

use Model\DbModel;

class AdherentModel extends DbModel
{
    protected string $table = 'Adherents';  
    protected string $id = 'IdAdherents';
    
    public function getAdherent() : object|array|string
    {
        return DbModel::Find('Select * from ...',[]);
    }

    public function getIdAdherent()
    {
        return $this->id;     
    }
}

?>
