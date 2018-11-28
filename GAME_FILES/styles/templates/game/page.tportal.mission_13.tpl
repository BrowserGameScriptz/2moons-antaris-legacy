{block name="title" prepend}{$LNG.lm_tportal}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.lm_tportal}</h1>
          <div id="portail_teleportation"><div id="attaquer_portail" class="formulaire_mission categorie">
		
		<form id="form_attaquer" method="post" action="javascript:ActionMethode.envoyerFormulaire('form_attaquer', 'portail_teleportation', '?page=Tportal&mode=envoyerMission&onglet_page=attaquer');">
        <h2>{$LNG.NOUVEAUTE_581}</h2>
        
        <!-- Description de la mission -->
        <div name="description_mission">{$LNG.NOUVEAUTE_582}</div>

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
                             <h3>{$LNG.ls_tech_4}</h3>
                 <div id="form_appareil">

                                         {foreach $FleetsOnPlanetb as $FleetRow}
                                          <div class="appareil">
                         <img name="entite" src="styles/theme/gow/gebaeude/{$FleetRow.id}.gif" />
                         <div class="conteneur_label">
                              <label for="appareil_{$FleetRow.id}">{$LNG.tech.{$FleetRow.id}} :</label>
                         </div>
                         <input type="text" class="entier" id="appareil_{$FleetRow.id}" name="appareil_{$FleetRow.id}" maxlength="15" value="0" />
                         <img name="maximum" src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/drapeau_bleu.png" 
                              onclick="javascript:PortailTeleportation.insererChamp('appareil_{$FleetRow.id}', {$FleetRow.count});" />
                     </div>
                     {/foreach}
                                          
                     
                     <div class="espace"></div>
                 </div>
            

            <!-- Si la mission autorise l'affichage des populations dans le formulaire -->
                             <h3>{$LNG.ls_tech_6}</h3>
                 <div id="form_population">

                                          {foreach $PopulationOnPlanetb as $PopRow}
                     <div class="population">
                         <img name="entite" src="styles/theme/gow/gebaeude/{$PopRow.id}.jpg" />
                         <div class="conteneur_label">
                              <label for="population_{$PopRow.id}">{$LNG.tech.{$PopRow.id}} :</label>
                         </div>
                         <input type="text" class="entier" id="population_{$PopRow.id}" name="population_{$PopRow.id}" maxlength="15" value="0" />
                         <img name="maximum" src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/drapeau_bleu.png" 
                              onclick="javascript:PortailTeleportation.insererChamp('population_{$PopRow.id}', {$PopRow.count});" />
                     </div>
                     {/foreach}
                                       
                     <div class="espace"></div>
                 </div>
                    </div>

        <!-- On affiche le bouton de validation pour envoyer la mission -->
        <div name="submit_formulaire">
            <input type="submit" id="valid_form" name="valid_form" value="{$LNG.NOUVEAUTE_532}" />
        </div>
    </form>
    
    </div>	


</div></div>
{/block}
{block name="script" append}
<script type="text/javascript">
        $(document).ready(function(){
            PortailTeleportation.fret = {$capacity1};
            PortailTeleportation.initialiserOnglet('attaquer');
        });
</script>
{/block}