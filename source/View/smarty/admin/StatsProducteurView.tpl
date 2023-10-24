<h1 style="text-align: center;">Statistiques de vente des producteurs</h1>
<table style="margin: auto;" border="1" width="60%">
    <thead>
        <tr style="background:gray; color:white; font-weight:bold">
            <th style="width: 25%;">Id</th>
            <th style="width: 25%;">Nom et Prénom</th>
            <th style="width: 25%;">E-mail</th>
            <th style="width: 25%;">Total des ventes</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            {foreach from=$Liste item=producteur key=k}
                <td style="width: 25%;">{$producteur.IdProducteur}</td>
                <td style="width: 25%;">{$producteur.NomPrenomProducteur}</td>
                <td style="width: 25%;">{$producteur.MailProducteur}</td>
                <td style="width: 25%;">{$producteur.SommeVentesProducteur}</td>
            {/foreach}
        </tr>
    </tbody>
    <tfoot>
    </tfoot>
</table>

<a href="/Admin/Dashboard">Retour au Dashboard</a>