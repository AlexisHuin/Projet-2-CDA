<a href="/Admin/ProductsList">Revenir à la liste des produits</a>

<form method="post">
    <input type="text" name="Produit" placeholder="Designation du produit">
    <select name="Saison">
        {foreach from=$Saisons item=Saison key=k}
            <option value="{$Saison.IdSaison}">{ucfirst($Saison.NomSaison)}</option>
        {/foreach}
    </select>
    <select name="Categorie">
        {foreach from=$Categories item=Categorie key=k}
            <option value="{$Categorie.IdCategorie}">{$Categorie.DesignationCategorie}</option>
        {/foreach}
    </select>
    <input type="submit" value="Ajouter le produit" name="Add">
</form>