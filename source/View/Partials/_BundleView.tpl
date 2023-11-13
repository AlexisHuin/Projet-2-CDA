<div class="cardBundle">
<label>Nom</label>
<p style="justify-content: center;">{$product['DesignationProduitProducteur']}</p>
<label  >Quantité</label>
<p id="quantiteBundle" style="padding-bottom: 1em;">{$product['QuantiteProduitProducteur']}</p>
<img id="svgBundle"  src="" alt="">
<label id="prixBundle">Prix/U</label>

<p id="prixArticleBundle"   style="padding-bottom: 3em; flex: 1; justify-content:center">{$product['PrixProduitProducteur']} €</p>
<input type="text" name='PrixBundle[]' value='{$product['PrixProduitProducteur']}' hidden>
<img id="imgProduitProd" style="width: 50%;" src="{$product['ImageProduitProducteur']}" alt="">
<input name="IdProduitProducteur[]" value="{$product['IdProduitProducteur']}" type="hidden">
<button class="addButtonLeft"  value="{$product['IdProduitProducteur']}">Ajouter</button>
</div>