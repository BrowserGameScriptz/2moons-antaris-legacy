{block name="title" prepend}{$LNG.ls_tporal_1}{/block}
{block name="content"}
<div id="page_contenu">
<h1>{$LNG.ls_tporal_1}</h1>
{if $tpanels == 1}
          <div id="portail_teleportation"><div id="espionner_portail" class="formulaire_mission categorie">
    
		{*<form action="game.php?page=Tportal&mode=missionSend" method="post" onsubmit="return CheckTarget()" id="form">*}
		
        <form id="form_espionner" method="post" action="javascript:ActionMethode.envoyerFormulaire('form_espionner', 'portail_teleportation', '?page=Tportal&mode=envoyerMission&onglet_page=espionner');">
        <h2>{$LNG.NOUVEAUTE_526}</h2>
        
        <!-- Description de la mission -->
        <div name="description_mission">{$LNG.NOUVEAUTE_527}</div>

        <!-- Conteneur pour saisir les coordonnées -->
        <div name="conteneur_coordonnees">
            {$LNG.NOUVEAUTE_528}<br /><br />

            <label for="systeme">{$LNG.NOUVEAUTE_529} : </label>
            <input type="text" id="systeme" name="systeme" size="6" maxlength="4" /><br />

            <label for="position">{$LNG.NOUVEAUTE_530} : </label>
            <input type="text" id="position" name="position" size="6" maxlength="4" />

            <div id="reponse_ajax">
                <span class="rouge">{$LNG.NOUVEAUTE_531}</span>
            </div>
        </div>

        <div name="conteneur_champ">
            <!-- Si la mission nécessite l'affichage des raccourcis pour les coordonnées -->
            

            <!-- Si la mission autorise l'affichage des ressources dans le formulaire -->
            

            <!-- Si la mission autorise l'affichage des appareils spécialisés dans le formulaire -->
            

            <!-- Si la mission autorise l'affichage des populations dans le formulaire -->
                    </div>

        <!-- On affiche le bouton de validation pour envoyer la mission -->
        <div name="submit_formulaire">
            <input type="submit" id="valid_form" name="valid_form" value="{$LNG.NOUVEAUTE_532}" />
        </div>
    </form>
    
    </div>	

</div>
{else}
<div id="portail_teleportation"><span class="rouge">{$LNG.NOUVEAUTE_533}</span></div>
{/if}
</div> 
{/block}
{block name="script" append}
<script type="text/javascript">
        $(document).ready(function(){
            PortailTeleportation.fret = {$capacity};
            PortailTeleportation.initialiserOnglet('espionner');
        });
</script>
{/block}