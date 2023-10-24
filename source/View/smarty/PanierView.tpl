{include file="../Partials/_HeaderView.tpl"}


{$quantité = $_POST['quantité'] ?? 0}
{if isset($_POST.ajouteraupanier)}
    {$produit = $_POST.ajouteraupanier}
    {$panierController->ajouterAuPanier($produit, $quantité)}
{/if}

{$totalPanier = $panierController->getTotalPanier()}
        
       
 


{include file="../Partials/_FooterView.tpl"}