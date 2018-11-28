{block name="title" prepend}{$LNG.lm_fleettable_5}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.lm_fleettable_5}</h1>
          <div id="centre_spatial"><div id="espionner_centre_spatial" class="formulaire_mission categorie">
    
        <form id="form_espionner" method="post" action="javascript:ActionMethode.envoyerFormulaire('form_espionner', 'centre_spatial', '?page=center&mode=envoyerMission&onglet_page=espionner');">
        <h2>{$LNG.NOUVEAUTE_526}</h2>
        
        <!-- Description de la mission -->
        <div name="description_mission">{$LNG.NOUVEAUTE_592}</div>

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
            
            
            <!-- SI la mission est de « recycler » ou de « baser des vaisseaux ruines » ALORS on affiche la liste des vaisseaux ruines -->
                                            <h3 data-gerer_partie="false">{$LNG.NOUVEAUTE_593}</h3>
                <div id="form_sonde_spatiale">
                    <table>
                    <tr>
                        <th class="nom_modele">{$LNG.NOUVEAUTE_594} :</th>
                        <th class="caracteristique">{$LNG.NOUVEAUTE_595} :</th>
                        <th class="caracteristique">{$LNG.NOUVEAUTE_392} :</th>
                        <th class="vitesse">{$LNG.NOUVEAUTE_391} :</th>
                        <th class="champ_vaisseau">{$LNG.lm_lotto_3} :</th>
                    </tr>
                    <tr name="sonde">
                        <!-- Nom de la sonde spatiale -->
                        <td class="nom_modele">
                            <img name="entite" src="styles/theme/gow/gebaeude/224.gif" />
                            <label for="appareil_4">{$LNG.tech.224}</label>
                        </td>

                        <!-- Quelques informations sur la sonde spatiale -->
                        <td class="caracteristique"><span class="orange">{$planetSpies}</span> unité(s)</td>
                        <td class="caracteristique"><span class="vert">Oui</span></td>
                        <td class="vitesse"><span class="orange">100,00</span>%</td>

                        <!-- Le champ du formulaire -->
                        <td class="champ_vaisseau">
                            <input type="text" class="entier" id="appareil_4" name="appareil_4" value="1" disabled="disabled" />
                        </td>
                    </tr>
                    </table>
                </div>
                        
                <!-- On affiche le tableau de configuration de vol ainsi que les informations -->
                <h3>{$LNG.NOUVEAUTE_605}</h3>
                    <div id="liste_parametre">    
                        <table>
                            <!-- Détails sur le plan de vol pour le sens « aller » -->
                            <tr>
                                <td><img src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/horloge.png"> {$LNG.NOUVEAUTE_323} :</td>
                                <td><span name="temps_trajet_aller" class="cyan" style="cursor: help;">0s</span></td>
                                <td><img src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/funnel.png"> {$LNG.NOUVEAUTE_598} :</td>
                                <td><span name="carburant_aller" class="cyan" style="cursor: help;">0</span> u</td>
                                <td><img src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/parametre.png"> {$LNG.NOUVEAUTE_428} :</td>
                                <td><span name="reacteur_aller" class="cyan" onclick="javascript:CentreSpatial.changerVitesseManuelle('aller');" style="cursor: pointer;">100</span> %</td>
                            </tr>
                              <!-- Détails sur le plan de vol pour le sens « retour » -->
                            <tr>
                                <td><img src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/horloge.png"> {$LNG.NOUVEAUTE_323} :</td>
                                <td><span name="temps_trajet_retour" class="rouge" style="cursor: help;">0s</span></td>
                                <td><img src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/funnel.png"> {$LNG.NOUVEAUTE_598} :</td>
                                <td><span name="carburant_retour" class="rouge" style="cursor: help;">0</span> u</td>
                                <td><img src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/parametre.png"> {$LNG.NOUVEAUTE_428} :</td>
                                <td><span name="reacteur_retour" class="rouge" onclick="javascript:CentreSpatial.changerVitesseManuelle('retour');" style="cursor: pointer;">100</span> %</td>
                            </tr>   
                        </table>
                    </div>
                
               
            <!-- SINON, pour toutes les autres missions, on affiche les vaisseaux du joueurs pour qu'il puisse créer sa flotte -->
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
            CentreSpatial.initialiserOnglet('espionner');
        });
    </script>
</div></div>                    <!-- Fin du corps -->
{/block}