<h1>Bienvenue {$Username} </h1>
{assign var="count" value=0}

<a href="/User/Deconnexion">Deconnexion</a>

<button><a href="/Admin/AdherentsList">Liste des adherents</a></button>
<button><a href="/Admin/ProducteursList">Liste des producteurs</a></button>
<button><a href="/Admin/ProductsList">Liste des produits</a></button>

<h2>Demandes en cours :</h2>

{foreach from=$Demandes item=demandeEnCours key=key}
    {if $demandeEnCours.EtatDemande === "Opened"}
        <div style="width:35%; background-color: rgb(197, 109, 109); display: grid; margin-bottom: 1rem">
            <p><strong>Demande numéro : </strong>{$demandeEnCours.IdDemande}</p>
            <p><strong>Auteur : </strong> {$demandeEnCours.NomPrenomProducteur}</p>
            <p><strong>Motif : </strong>{$demandeEnCours.MotifDemande}</p>
            <p><strong>Prix de vente proposé : </strong>{$demandeEnCours.PrixProposeDemande}</p>
            <div style="place-self:center; width: 50%; display: flex; flex-direction: row; justify-content:space-between;">
                <form method="post">
                    <input type="hidden" name="Id" value="{$demandeEnCours.IdDemande}">
                    <input type="hidden" name="IdProduitProducteur" value="{$demandeEnCours.IdProduitProducteurDemande}">
                    <input type="hidden" name="DesignationProduit" value="{$demandeEnCours.DesignationProduitDemande}">
                    <input type="hidden" name="IdProd" value="{$demandeEnCours.IdProducteurDemande}">
                    <input type="hidden" name="Objet" value="{$demandeEnCours.ObjetDemande}">
                    <input type="hidden" name="Prix" value="{$demandeEnCours.PrixProposeDemande}">
                    <input type="submit" name="Accept" value="Accept">
                    <input type="submit" name="Deny" value="Deny">
                </form>
            </div>
        </div>
        {assign var="count" value=$count+1}
    {/if}
{/foreach}
{if $count === 0}
    <h3>Vous n'avez aucune demande non traitée.</h3>
{/if}

<h2>Demandes archivées</h2>

{foreach from=$Demandes item=demandeTraitees key=k}
    {if $demandeTraitees.EtatDemande != "Opened"}
        <div style="width:35%; background-color: rgb(197, 109, 109); display: grid; margin-bottom: 1rem">
            <p><strong>Demande numéro : </strong>{$demandeTraitees.IdDemande}</p>
            <p><strong>Auteur : </strong> {$demandeTraitees.NomPrenomProducteur}</p>
            <p><strong>Objet : </strong>{$demandeTraitees.ObjetDemande}</p>
            <p><strong>Motif : </strong>{$demandeTraitees.MotifDemande}</p>
            <p><strong>Prix de vente proposé : </strong>{$demandeTraitees.PrixProposeDemande}</p>
            <p><strong>Etat : </strong>{$demandeTraitees.EtatDemande}</p>
        </div>
    {/if}
{/foreach}