<?php
namespace Model;

use Model\DbModel;

class AdherentModel extends DbModel
{
    protected string $table = 'Adherent';  
    protected string $id = 'IdAdherent';
    

    
    public function getAdherent() : object|array|string
    {
        return $this->Select('Select * from Adherent',[]);
    }

    public function getIdAdherent()
    {
        return $this->id;     
    }

    
}

?>
