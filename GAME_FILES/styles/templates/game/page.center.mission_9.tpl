{block name="title" prepend}{$LNG.lm_fleettable_5}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.lm_fleettable_5}</h1>
          <div id="centre_spatial"><div id="recycler_centre_spatial" class="formulaire_mission categorie">
    
        <form id="form_baser_vr" method="post" action="javascript:ActionMethode.envoyerFormulaire('form_baser_vr', 'centre_spatial', '?page=center&mode=envoyerMission&onglet_page=baser_vr');">
        <h2>{$LNG.NOUVEAUTE_625}</h2>
        
        <!-- Description de la mission -->
        <div name="description_mission">{$LNG.NOUVEAUTE_626}</div>

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
                            <h3 data-gerer_partie="false">{$LNG.NOUVEAUTE_603} (<a onclick="CentreSpatial.selectionnerFlotteEntiere();">{$LNG.NOUVEAUTE_604}</a>)</h3>
                <div id="form_recycleur">
                    <!-- Il faut au moins un vaisseau ruine sur la planète -->
					{if $RecyclersCount > 0}
                                        <table>
                        <tbody><tr>
                            <th class="nom_modele">{$LNG.NOUVEAUTE_431} :</th>
                            <th class="caracteristique">{$LNG.NOUVEAUTE_392} :</th>
                            <th class="vitesse">{$LNG.NOUVEAUTE_391} :</th>
                            <th class="fret">{$LNG.NOUVEAUTE_393} :</th>
                            <th class="champ_vaisseau">{$LNG.lm_lotto_3} :</th>
                        </tr>
                        <!-- On parcours tous les modèles présents sur la planète -->
						{foreach $RecyclersOnPlanet as $RecyRow}
                                                    <tr name="appareil" data-id_appareil="{$RecyRow.id}" data-fret="{$RecyRow.fret}" data-nombre="{$RecyRow.count}">
                                <!-- Nom du modèle -->
                                <td class="nom_modele">
                                    <img name="entite" src="styles/theme/gow/gebaeude/{$RecyRow.id}.gif">
                                    <label for="appareil_{$RecyRow.id}">{$LNG.tech.{$RecyRow.id}}</label>
                                </td>

                                <!-- Hyperespace, vitesse du vaisseau ruine et fret -->
                                <td class="caracteristique">{if $RecyRow.Hyper == 0}<span class="rouge">{$LNG.ls_answer_2}</span>{else}<span class="vert">{$LNG.ls_answer_1}</span>{/if}</td>
                                <td class="vitesse"><span class="orange">{$RecyRow.speed}</span>%</td>
                                <td class="fret"><span class="orange">{$RecyRow.fret}</span> u.</td>
                                
                                <!-- Le champ du formulaire -->
                                <td class="champ_vaisseau">
                                    <input class="entier" id="appareil_{$RecyRow.id}" name="appareil_{$RecyRow.id}" value="0" type="text">
                                    <img name="maximum" src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/drapeau_bleu.png" onclick="javascript:CentreSpatial.insererChamp('appareil_{$RecyRow.id}', {$RecyRow.count});" onmouseover="montre('{$RecyRow.text}');" onmouseout="cache();">
                                </td>
                            </tr>
                              {/foreach}              </tbody></table>

                    <!-- Le joueur ne possède pas de vaisseaux ruines sur cette planète -->
                                    </div>
                
                
                <!-- On affiche le tableau de configuration de vol ainsi que les informations -->
                                    <h3>{$LNG.NOUVEAUTE_605}<img class="switch" src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/joystick.png" onclick="javascript:CentreSpatial.switchPartie(&quot;liste_parametre&quot;);" onmouseover="montre('Afficher/cacher cette partie du formulaire.');" onmouseout="cache();"></h3>
                    <div id="liste_parametre">    
                        <table>
                            <!-- Détail sur le fret et la vitesse globale de la flotte -->
                            <tbody><tr>
                                <td><img src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/boite.png"> {$LNG.NOUVEAUTE_393} :</td>
                                <td><span name="fret_restant" class="orange">0</span> u</td>
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
                             
                                                    </tbody></table>
                    </div>
                                
                
            <!-- SI la mission est « espionner » ALORS on affiche uniquement la sonde spatiale -->
				{else}
				<span class="rouge">{$LNG.NOUVEAUTE_602}</span></div>
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
            CentreSpatial.initialiserOnglet('baser_vr');
        });
    </script>
</div></div>                    <!-- Fin du corps -->
{/block}