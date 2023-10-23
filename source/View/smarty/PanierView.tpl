{include file="../Partials/_HeaderView.tpl"}

        
{foreach from=Panier item=item key=key }

                <td><?php echo $item['IdProduit']; ?></td>
                <td><?php echo $item['IdUtilisateur']; ?></td>
                <td><?php echo $item['Quantite']; ?></td>
{/foreach}
           
       
 


{include file="../Partials/_FooterView.tpl"}