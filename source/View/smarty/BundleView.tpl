{include file="../Partials/_HeaderView.tpl"}

<h1 style="width: 50%;margin:auto">Ajouter un bundle</h1>
<p style="width: 50%;margin:auto">Pour la création de bundle : <br>
    Ajouter un input avec un eventlistener sur l'input (entrée d'information au clavier) ouvrant un dropdown sous
    l'input contenant les produits relatifs à la saisie 
    à coté de l'input, ajouter un input permettant d'ajouter un produit par rapport à la quantité du producteur (ex :
    peut pas ajouter 50 si il n'en a que 20) <br>
    En dessous, bouton "+" pour ajouter dynamiquement de nouveau champs de saisie, limités à 5. <br>
    La création dynamique doit se faire en JS. Pareil pour le check du nombre de champs. <br>
    Pour l'interprétation des données une fois le bundle envoyé, Faire une boucle for sur les quantités et produits
    données afin de les associer entre eux (produit 1 -> quantite 1) <br>
    Concaténer l'ensemble des ID produits dans l'ordre, idem pour les quantités et ajouter en base</p>

<form method="POST">
    <label for="DesignationBundle">Nom de votre bundle</label>
    <input type="text" name="DesignationBundle" required>
    <label for="IdProduitsBundle">Liste de vos produits disponibles</label>
    <input type="text" name="IdProduitsBundle" id="IdProduitsBundle" placeholder="Rechercher">

</form>


{* <h1 style="width: 50%;margin:auto">Liste des bundles</h1>

<p style="width: 50%;margin:auto"> Ici je dois listé mon bundles, produit par produit avec une boucle, de type
    designation, quantité, et le montant total pour chaques</p> *}



{include file="../Partials/_FooterView.tpl"}