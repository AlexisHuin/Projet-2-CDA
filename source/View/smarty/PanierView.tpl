{include file="../Partials/_HeaderView.tpl"}

<body>
    <h1>Panier</h1>
    <table border="1">
        <tr>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
        {foreach  form =$Panier key=k item=Panier.Produit}
            <option value="{$panier.IdPanier}"> {$panier.Produit} </option>
            <tr>
                <td>{$Panier.produit}</td>
                <td>{$Panier.prix}</td>
                <td>{$Panier.quantite}</td>
                <td>{$Panier.total}</td>
            </tr>
        {/foreach}
        <tr>
            <td colspan="3" align="right"><strong>Total</strong></td>
            <td>{$total}</td>
        </tr>
    </table>
    <br>
    <a href="checkout.php"><button>Passer la commande</button></a>
</body>
</html>





{include file="../Partials/_FooterView.tpl"}