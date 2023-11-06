{include file="../Partials/_HeaderView.tpl"}

<div class="panier">
    {if $produits}
        <div class="produits-container">
            {foreach $produits as $p}
                <div class="card_row5">
                    <p>Nom: {$p["DesignationProduit"]}</p>
                    <p>Prix: <span class="prix" id="{$p["IdProduit"]}">{$p["PrixProduitProducteur"]}</span>€</p>
                    <form action="/panier/modifier" method="post">
                        <input type="hidden" name="IdProduit" value="{$p["IdProduit"]}">
                        Quantité:
                        <select name="Quantite" onchange="this.form.submit()">
                            {for $number=1 to 10}
                                <option name="Quantite" value="{$number}" {if $number == $p["Quantite"]}selected
                                    id="Quantite-{$p["IdProduit"]}" {/if}>{$number}</option>
                            {/for}
                        </select>
                    </form>
                    <form action="/panier/supprimer" method="post">
                        <input type="hidden" name="IdProduit" value="{$p["IdProduit"]}">
                        <p onclick="this.closest('form').submit()" id="supp" style="cursor: pointer;">Supprimer ce produit
                        </p>
                        <input type="submit" value="h" style="display:none;">
                    </form>
                </div>
            {/foreach}
        </div>
        <p>Prix total: <span id="prix-total"></span>€</p>
        <button class="button-delete"><a href="/panier/vider" classe="balisea">Vider le panier</a></button>
        <button class="button-confirm"><a href="/panier/valider" classe="balisea">Valider le panier</a></button>
        <script>
            const prix = document.querySelectorAll(".prix");
            let prixTotal = 0;

            for (const div of prix) {
                const id = div.id;
                const quantite = document.querySelector("#quantite-" + id);
                const quantiteEnNombre = Number(quantite.textContent);
                const prixEnNombre = Number(div.textContent);
                const prixTotalArticle = quantiteEnNombre * prixEnNombre;
                prixTotal += prixTotalArticle;
            }

            document.querySelector("#prix-total").textContent = prixTotal;
        </script>
    {else}
        <p>Le panier est vide!</p>
    {/if}
</div>
{include file="../Partials/_FooterView.tpl"}