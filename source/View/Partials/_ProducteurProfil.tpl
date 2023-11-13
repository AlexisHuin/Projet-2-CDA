{if $SessionInfo['RoleUser'] === "Producteur"}
        <div class="adh">
                <form method="POST">
                        <h1>Espace Producteur</h1>
                        <h2>Mes coordonnées</h2>


                        {* * Affichage de la page pour modifié les coordonnées du producteur *}

                        {if str_replace('/User/Profile', '', $URI) === '?edit'}
                                <div>
                                        <label>Nom Prénom : <input name='NomPrenomProducteur' type="text"
                                                        value='{$Infos.NomPrenomProducteur}'></label>
                                        <label>Tel : <input name='PhoneProducteur' type="tel" value='{$Infos.PhoneProducteur}'></label>
                                </div>
                                <div>
                                        <label>Email : <input readonly type="email" value='{$Infos.MailProducteur}'></label>
                                        <label>Code Postal : <input name='CodePostalProducteur' type="text"
                                                        value='{$Infos.CodePostalProducteur}'></label><br>
                                        <label>GPS : <input name='CoordonneesGPSProducteur' type="text"
                                                        value='{$Infos.CoordonneesGPSProducteur}'></label>
                                        <label>Raison Sociale : <input name='RaisonSocialeProducteur' type="text"
                                                        value='{$Infos.RaisonSocialeProducteur}'></label>
                                </div>

                                <button style="margin: 0 0 1em 0;" type='submit' name='modification'>Confirmer</button>
                </div>
        {else}

                {* * affichage des Coordonées du producteur *}
                <div>
                        <p>Nom Prénom : {$Infos.NomPrenomProducteur}</p>
                        <p>Tel : {$Infos.PhoneProducteur}</p>
                        <p>Email : {$Infos.MailProducteur}</p>
                        <p>Code Postal : {$Infos.CodePostalProducteur}</p>
                        <p>GPS : {$Infos.CoordonneesGPSProducteur}</p>
                        <p>Raison Sociale : {$Infos.RaisonSocialeProducteur}</p>
                        <button style="margin: 0 0 1em 0;" type="button"><a
                                        style="text-decoration:none; width:100%; height:100%; color:white"
                                        href="/User/Profile?edit">Modifier</a></button>
                </div>
                <button style="margin: 0 0 1em 0;" type="button"><a style="text-decoration:none; width:100%; height:100%; color:white"
                                href="/User/AddProduct">Ajouter un produit</a></button>
                <button style="margin: 0 0 1em 0;" type="button"><a style="text-decoration:none; width:100%; height:100%; color:white"
                                href="/User/ProductList">Mes produits et bundles</a></button>

                <button style="margin: 0 0 1em 0;" type="button"><a style="text-decoration:none; width:100%; height:100%; color:white"
                                href="/Bundle">Ajouter un bundle</a></button>
                </div>
                </form>
        {/if}
{/if}
</div>