<?php
namespace Model;
use Model\DbModel;

class FactureModel extends DbModel
{
    public string $table = "Facture";
    public string $id = "IdFacture";
    public string $idAdherent = "IdAdherentFacture";
    public string $datePrelevement = "DatePrelevementFacture";
}
