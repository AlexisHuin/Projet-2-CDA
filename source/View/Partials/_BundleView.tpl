<div class="cardBundle">
<label class="label_card " >Nom</label>
<label style="justify-content: center;">{$product['DesignationProduitProducteur']}</label>
<label class="label_card " >Quantité</label>
<label data-label="{$product['QuantiteProduitProducteur']}" id="quantiteBundle" style="padding-bottom: 1em;">{$product['QuantiteProduitProducteur']}</label>
<img id="svgBundle"  src="" alt="">
<label class="label_card "  id="prixBundle">Prix/U</label>

<label  id="prixArticleBundle"   style="padding-bottom: 3em; flex: 1; justify-content:center">{$product['PrixProduitProducteur']} €</label>
<input type="text" name='PrixBundle[]' value='{$product['PrixProduitProducteur']}' hidden>
<img id="imgProduitProd" style="width: 50%;" src="{$product['ImageProduitProducteur']}" alt="">
<input name="IdProduitProducteur[]" value="{$product['IdProduitProducteur']}" type="hidden">
<button class="addButtonLeft"  value="{$product['IdProduitProducteur']}">Ajouter</button>
</div>