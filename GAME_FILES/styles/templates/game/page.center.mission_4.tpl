{block name="title" prepend}{$LNG.lm_fleettable_5}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.lm_fleettable_5}</h1>
          <div id="centre_spatial"><div id="baser_centre_spatial" class="formulaire_mission categorie">
    
        <form id="form_baser" method="post" action="javascript:ActionMethode.envoyerFormulaire('form_baser', 'centre_spatial', '?page=center&mode=envoyerMission&onglet_page=baser');">
        <h2>{$LNG.NOUVEAUTE_629}</h2>
        
        <!-- Description de la mission -->
        <div name="description_mission">{$LNG.NOUVEAUTE_630}</div>

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

        <!-- Conteneur qui contiendra tous les champs du formulaire pour la mission -->
        <div name="conteneur_champ">
            <!-- Si la mission nécessite l'affichage des raccourcis pour les coordonnées -->
                             <h3>{$LNG.NOUVEAUTE_571} ({$GetAll99})</h3>
                 <div id="liste_planete">
                                            {foreach $colonyList as $ColonyRow}
                                            <div class="planete" data-systeme="{$ColonyRow.system}" data-position="{$ColonyRow.planet}">
                          <img src="https://cdngames.antaris-legacy.eu/media/ingame/planet/{$ColonyRow.image}.jpg" /> 
                          {$ColonyRow.name} [{$ColonyRow.system}:{$ColonyRow.planet}]
                      </div>
				{/foreach}
                                       </div>
            
            
            <!-- SI la mission est de « recycler » ou de « baser des vaisseaux ruines » ALORS on affiche la liste des vaisseaux ruines -->
                            <h3 data-gerer_partie="false">{$LNG.NOUVEAUTE_380} (<a onclick="CentreSpatial.selectionnerFlotteEntiere();">{$LNG.NOUVEAUTE_604}</a>)</h3>
                <div id="form_vaisseau">
				{if $ownFleetCount > 0}
                    <!-- Il faut au moins un vaisseau sur la planète -->
                                        <table>
                        <tr>
                            <th class="nom_modele">{$LNG.NOUVEAUTE_431} :</th>
                            <th class="caracteristique">{$LNG.NOUVEAUTE_389} :</th>
                            <th class="caracteristique">{$LNG.NOUVEAUTE_420} :</th>
                            <th class="caracteristique">{$LNG.NOUVEAUTE_340} :</th>
                            <th class="vitesse">{$LNG.NOUVEAUTE_391} :</th>
                            <th class="fret">{$LNG.NOUVEAUTE_393} :</th>
                            <th class="champ_vaisseau">{$LNG.lm_lotto_3} :</th>
                        </tr>
                        
                        <!-- On parcours tous les modèles de vaisseau présent sur la planète -->
                                                    
                                                                                             
                            {foreach $OwnShipsOnPlanet as $OwnRow}                                                        
                            <tr name="vaisseau"
                                data-id_vaisseau="{$OwnRow.id}"
                                data-id_infrastructure="{$OwnRow.infra}"
                                data-fret="{$OwnRow.fret2}"
                                data-nombre="{$OwnRow.count}">
                              
                                <!-- Nom du modèle -->
                                <td class="nom_modele">
                                    <img name="entite" src="{$OwnRow.image}" />
                                    <label for="vaisseau_{$OwnRow.id}">{$OwnRow.nom}</label>
                                </td>

                                <!-- Caractéristiques d'attaque et de défense du modèle -->
                                <td class="caracteristique rouge">{$OwnRow.shipAttack}</td>
                                <td class="caracteristique violet">{$OwnRow.shipBouclier}</td>
                                <td class="caracteristique cyan">{$OwnRow.shipCoque}</td>

                                <!-- La vitesse et le fret du modèle -->
                                <td class="vitesse">
                                    <span onmouseover="montre('Hyperespace : <span class=\'rouge\'>Non</span>');" onmouseout="cache();" 
                                          class="orange" style="cursor : help;">{$OwnRow.speed}</span> %
                                </td>
                                <td class="fret"><span class="orange">{$OwnRow.fret}</span> u.</td>
                                
                                <!-- Le champ du formulaire -->
                                <td class="champ_vaisseau">
                                    <input type="text" class="entier" id="vaisseau_{$OwnRow.id}" name="vaisseau_{$OwnRow.id}" value="0" />
                                    <img name="maximum" src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/drapeau_bleu.png"
                                         onclick="javascript:CentreSpatial.insererChamp('vaisseau_{$OwnRow.id}', {$OwnRow.count});" 
                                         onmouseover="montre('{$OwnRow.text}');" onmouseout="cache();" />
                                </td>
                            </tr>
                            {/foreach}
                                            </table>

                    <!-- Le joueur ne possède pas de vaisseaux sur cette planète -->
                                    </div>

                                    <!-- Affiche l'équipage nécessaire pour faire décoller cette flotte -->
                    <h3>{$LNG.NOUVEAUTE_620}</h3>
                    <div id="liste_equipage">
                        <table>
                            <tr>
                                <td><img src="design/image/jeu/icone/couleur/profil_3.png" /> {$LNG.tech.302} :</td>
                                <td><span name="technicien" class="orange">0</span> u</td>
                                <td><img src="design/image/jeu/icone/couleur/profil_3.png" /> {$LNG.tech.303} :</td>
                                <td><span name="scientifique" class="orange">0</span> u</td>
                                <td><img src="design/image/jeu/icone/couleur/profil_3.png" /> {$LNG.tech.306} :</td>
                                <td><span name="soldat" class="orange">0</span> u</td>
                            </tr>
                            <tr>
                                <td><img src="design/image/jeu/icone/couleur/profil_3.png" /> {$LNG.tech.308} :</td>
                                <td><span name="pilote" class="orange">0</span> u</td>
                                <td><img src="design/image/jeu/icone/couleur/profil_3.png" /> {$LNG.tech.309} :</td>
                                <td><span name="antaris" class="orange">0</span> u</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Paramètres et détails sur le vol -->
                    <h3>{$LNG.NOUVEAUTE_605}</h3>
                     <div id="liste_parametre">  
                        <table>
                            <!-- Détail sur le fret et la vitesse globale de la flotte -->
                            <tr>
                                <td><img src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/boite.png"> {$LNG.NOUVEAUTE_393} :</td>
                                <td><span name="fret_restant" id="fret_restant" class="orange">0</span> u</td>
                                <td><img src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/vitesse.png"> {$LNG.NOUVEAUTE_391} :</td>
                                <td><span name="vitesse" class="orange">100</span> %</td>
                                <td></td>
                                <td></td>
                            </tr>
                            
                             <!-- Détails sur le plan de vol pour le sens « aller » -->
                            <tr>
                                <td><img src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/horloge.png"> {$LNG.NOUVEAUTE_323} :</td>
                                <td><span name="temps_trajet_aller" class="cyan" style="cursor: help;">0s</span></td>
                                <td><img src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/funnel.png"> {$LNG.NOUVEAUTE_598} :</td>
                                <td><span name="carburant_aller" class="cyan" style="cursor: help;">0</span> u</td>
                                <td><img src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/parametre.png"> {$LNG.NOUVEAUTE_428} :</td>
                                <td><span name="reacteur_aller" class="cyan" onclick="javascript:CentreSpatial.changerVitesseManuelle('aller');" style="cursor: pointer;">100</span> %</td>
                            </tr>
                                                        
                                                    </table>
                    </div>

                    <!-- Pour afficher les informations sur les soutes/hangars de la flotte -->
                    <h3>{$LNG.NOUVEAUTE_496}</h3>
                    <div id="information_hangar">
                        <div name="explication">{$LNG.NOUVEAUTE_621}</div>
                        <ul name="liste" style="display : none;"></ul>
                    </div>


                    <!-- Si la mission autorise l'affichage des ressources dans le formulaire -->
                                             <h3>{$LNG.NOUVEAUTE_572}</h3>
                         <div id="form_ressource">
                             <div id="msg_fret"></div>
									{foreach $ResourceOnPlanet as $ResRow}
                                                          <div class="ressource">
                                  <img name="entite" src="https://cdngames.antaris-legacy.eu/media/ingame/image/{$ResRow.image}.jpg" />
                                  <div class="conteneur_label">
                                      <label for="ressource_{$ResRow.resTag}">{$LNG.tech.{$ResRow.id}} :</label>
                                  </div>
                                  <input type="text" class="entier" id="ressource_{$ResRow.resTag}" name="ressource_{$ResRow.resTag}" maxlength="15" value="0" />
                                  <img name="maximum" src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/drapeau_bleu.png" 
                                       onclick="javascript:CentreSpatial.insererChampFret('ressource_{$ResRow.resTag}', {$ResRow.amount});" />
                              </div>
                              {/foreach}         
                             
                             <div class="espace"></div>
                         </div>
                    

                    <!-- Si la mission autorise l'affichage des appareils spécialisés dans le formulaire -->
                                             <h3>{$LNG.ls_tech_4}</h3>
                         <div id="form_appareil">
								{foreach $SpecializedOnPlanet as $specialRow}
                                                          <div class="appareil">
                                 <img name="entite" src="styles/theme/gow/gebaeude/{$specialRow.id}.gif" />
                                 <div class="conteneur_label">
                                      <label for="appareil_{$specialRow.id}">{$LNG.tech.{$specialRow.id}} :</label>
                                 </div>
                                 <input type="text" class="entier" id="appareil_{$specialRow.id}" name="appareil_{$specialRow.id}" 
                                        data-appelation="{$LNG.tech.{$specialRow.id}}" maxlength="15" value="0" />
                                 <img name="maximum" src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/drapeau_bleu.png" 
                                      onclick="javascript:CentreSpatial.insererChampFret('appareil_{$specialRow.id}', {$specialRow.amount});" />
                             </div>
                                {/foreach}              
                                                         
                             <div class="espace"></div>
                         </div>
                    

                    <!-- Si la mission autorise l'affichage des populations dans le formulaire -->
                                             <h3>{$LNG.ls_tech_6}</h3>
                         <div id="form_population">
								{foreach $PopulationOnPlanet as $popRow}
                                                          <div class="population">
                                 <img name="entite" src="styles/theme/gow/gebaeude/{$popRow.id}.jpg" />
                                 <div class="conteneur_label">
                                      <label for="population_{$popRow.id}">{$LNG.tech.{$popRow.id}} :</label>
                                 </div>
                                 <input type="text" class="entier" id="population_{$popRow.id}" name="population_{$popRow.id}" 
                                        data-appelation="{$LNG.tech.{$popRow.id}}" maxlength="15" value="0" />
                                 <img name="maximum" src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/drapeau_bleu.png" 
                                      onclick="javascript:CentreSpatial.insererChampFret('population_{$popRow.id}', {$popRow.amount});" />
                             </div>
                                {/foreach}                          
                             <div class="espace"></div>
                         </div>
                    
                
                         {else}
				<span class="rouge">{$LNG.NOUVEAUTE_631}</span></div>
				{/if}       
            
                    </div>

        <!-- On affiche le bouton de validation pour envoyer la mission et on créé les champs « reacteur_aller », « reacteur_retour » et « securite_cle » -->
        <div name="submit_formulaire">
            <input type="hidden" name="reacteur_aller"  value="100" />
            <input type="hidden" name="reacteur_retour" value="100" />
            <input type="submit" id="valid_form" name="valid_form" value="{$LNG.NOUVEAUTE_532}" />
        </div>
            
        <!-- Quelques petites explications sur les calculs pour l'équipage et le fret -->
        <div style="text-align : center; color : grey; margin-top : 15px; font-style : italic;">
           {$LNG.NOUVEAUTE_596}<br />
        </div>
    </form>
    
    </div>	


    <!-- Appel important à la fonction javascript qui initialise l'onglet -->
    <script type="text/javascript">
        $(document).ready(function(){
            CentreSpatial.initialiserOnglet('baser');
        });
    </script>
</div></div>                    <!-- Fin du corps -->
{/block}