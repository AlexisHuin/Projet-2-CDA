{include file="../Partials/_HeaderView.tpl"}


<form method="post" action="">
    <div class="products">
        {foreach key=key item=product from=$AllProduits}
            {include file="../Partials/_CardView.tpl"}
        {/foreach}
    </div>
    <Button type="submit" name="update">Modifier</Button>
    <button type="submit" name="delete">Supprimer</button>
</form>


{include file="../Partials/_FooterView.tpl"}