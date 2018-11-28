{block name="title" prepend}{$LNG.ls_tporal_1}{/block}
{block name="content"}

<div id="page_contenu"><h1>{$LNG.ls_tporal_1}</h1>
          <div id="portail_teleportation"><div id="baser_portail" class="formulaire_mission categorie">
    
        <form id="form_baser" method="post" action="javascript:ActionMethode.envoyerFormulaire('form_baser', 'portail_teleportation', '?page=Tportal&mode=envoyerMission&onglet_page=baser');">
        <h2>{$LNG.NOUVEAUTE_569}</h2>
        
        <!-- Description de la mission -->
        <div name="description_mission">{$LNG.NOUVEAUTE_570}</div>

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
                             <h3>{$LNG.NOUVEAUTE_571} ({$GetAll99})</h3>
                 <div id="liste_planete">
				 {foreach $colonyList as $ColonyRow}
                                            <div class="planete" data-systeme="{$ColonyRow.system}" data-position="{$ColonyRow.planet}">
                          <img src="https://cdngames.antaris-legacy.eu/media/ingame/planet/{$ColonyRow.image}.jpg" /> 
                           {$ColonyRow.name} [{$ColonyRow.system}:{$ColonyRow.planet}]
                      </div>
					  {foreachelse}
                       {$LNG.fl_no_colony}
                      {/foreach}
                                       </diV>
            

            <!-- Si la mission autorise l'affichage des ressources dans le formulaire -->
                             <h3>{$LNG.NOUVEAUTE_572}</h3>
                 <div id="form_ressource">
                     <div id="msg_fret"></div>

                                          <div class="ressource">
                          <img name="entite" src="https://cdngames.antaris-legacy.eu/media/ingame/image/metal.jpg" />
                          <div class="conteneur_label">
                              <label for="ressource_fer">{$LNG.tech.901} :</label>
                          </div>
                          <input type="text" class="entier" id="ressource_fer" name="ressource_fer" maxlength="15" value="" />
                          <img name="maximum" src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/drapeau_bleu.png" 
                               onclick="javascript:PortailTeleportation.insererChamp('ressource_fer', {$metal});" />
                      </div>
                                          <div class="ressource">
                          <img name="entite" src="https://cdngames.antaris-legacy.eu/media/ingame/image/crystal.jpg" />
                          <div class="conteneur_label">
                              <label for="ressource_oro">{$LNG.tech.902} :</label>
                          </div>
                          <input type="text" class="entier" id="ressource_oro" name="ressource_oro" maxlength="15" value="" />
                          <img name="maximum" src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/drapeau_bleu.png" 
                               onclick="javascript:PortailTeleportation.insererChamp('ressource_oro', {$crystal});" />
                      </div>
                                          <div class="ressource">
                          <img name="entite" src="https://cdngames.antaris-legacy.eu/media/ingame/image/deuterium.jpg" />
                          <div class="conteneur_label">
                              <label for="ressource_cristal">{$LNG.tech.903} :</label>
                          </div>
                          <input type="text" class="entier" id="ressource_cristal" name="ressource_cristal" maxlength="15" value="" />
                          <img name="maximum" src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/drapeau_bleu.png" 
                               onclick="javascript:PortailTeleportation.insererChamp('ressource_cristal', {$deuterium});" />
                      </div>
                                          <div class="ressource">
                          <img name="entite" src="https://cdngames.antaris-legacy.eu/media/ingame/image/elyrium.jpg" />
                          <div class="conteneur_label">
                              <label for="ressource_elyrium">{$LNG.tech.904} :</label>
                          </div>
                          <input type="text" class="entier" id="ressource_elyrium" name="ressource_elyrium" maxlength="15" value="" />
                          <img name="maximum" src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/drapeau_bleu.png" 
                               onclick="javascript:PortailTeleportation.insererChamp('ressource_elyrium', {$elyrium});" />
                      </div>
                     
                     <div class="espace"></div>
                 </div>
            

            <!-- Si la mission autorise l'affichage des appareils spécialisés dans le formulaire -->
                             <h3>{$LNG.ls_tech_4}</h3>
                 <div id="form_appareil">
						{foreach $FleetsOnPlanet as $FleetRow}
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
					{foreach $PopulationOnPlanet as $PopRow}
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


    <!-- Appel important à la fonction javascript qui initialise l'onglet -->
</div></div>

{/block}
{block name="script" append}
<script type="text/javascript">
        $(document).ready(function(){
            PortailTeleportation.fret = {$capacity};
            PortailTeleportation.initialiserOnglet('baser');
        });
</script>
{/block}