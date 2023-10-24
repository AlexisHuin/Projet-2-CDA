<?php
namespace Model;

use Model\DbModel;

class AdherentModel extends DbModel
{
    protected string $table = 'Adherents';  
    protected string $id = 'IdAdherents';
    

    
    public function getAdherents() : object|array|string
    {
        return $this->Select('Select * from Adherents',[]);
    }

    public function getIdAdherent()
    {
        return $this->id;     
    }
}

?>
