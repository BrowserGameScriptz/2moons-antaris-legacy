{block name="title" prepend}{$LNG.NOUVEAUTE_387}{/block}
{block name="content"}
<div id="page_contenu">      <h1>{$LNG.NOUVEAUTE_387}</h1><div class="onglet">
              <ul>
                  <li><a href="?page=CreateShip&mode=ships" title="{$LNG.NOUVEAUTE_379}">{$LNG.NOUVEAUTE_380}</a></li> 
                  <li><a href="?page=CreateShip" title="{$LNG.NOUVEAUTE_381}">{$LNG.NOUVEAUTE_382}</a></li> 
                  <li><a href="?page=CreateShip&mode=pieces" title="{$LNG.NOUVEAUTE_383}">{$LNG.NOUVEAUTE_384}</a></li> 
                  <li><a href="?page=CreateShip&mode=flotte" title="{$LNG.NOUVEAUTE_385}">{$LNG.NOUVEAUTE_386}</a></li>
              </ul>
          </div>
          <div id="div_vaisseau">
{if empty($Message)}
		  <script type="text/javascript">
    $(document).ready(function(){ 
        VaisseauCreation.initialiser(); 
    });
</script>
{/if}
<!-- Le message de chargement pour attendre que l'on charge les composants et les infrastructures en JSON -->


<!-- Le formulaire de création de modèle -->
<form style="display: block;" id="form_creation_vaisseau" method="post" action="game.php?page=CreateShip">
    <!-- Sous-titre : Créer un nouveau modèle -->
	
    <h2 class="titre_corps">{$LNG.NOUVEAUTE_806}</h2>
    <div class="previsualiser">
        <!-- Pour afficher l'image du modèle que l'on créé -->
        <img name="image_modele" src="https://cdngames.antaris-legacy.eu/design/image/defaut_vaisseau.jpg">
        <img name="image_calque" src="https://cdngames.antaris-legacy.eu/design/image/item_description_img.png">
        
        <!-- Tableau contenant tous les caractéristiques du modèle -->
        <table>
            <tbody><tr>
                <td colspan="6" name="nom" class="gris">
                    <span name="nom_modele">...</span>
                    [<span name="nom_infrastructrure">Chasseur</span> 
                      — Siège : <span name="siege_antaris"><span class="rouge">non</span></span> 
                      — Téléportation : <span name="systeme_teleportation"><span class="rouge">non</span></span>
                      — Hyperespace : <span name="hyperespace"><span class="rouge">non</span></span>]
                </td>
            </tr> 
            <tr>
                <td>{$LNG.tech.901} :</td>
                <td name="fer">500</td>
                <td>{$LNG.NOUVEAUTE_389} :</td>
                <td name="attaque">0</td>
                <td>{$LNG.NOUVEAUTE_391} :</td>
                <td name="vitesse">0%</td>
            </tr>
            <tr>
                <td>{$LNG.tech.902} :</td>
                <td name="or">250</td>
                <td>{$LNG.NOUVEAUTE_420} :</td>
                <td name="bouclier">0</td>
                <td>{$LNG.NOUVEAUTE_421} :</td>
                <td name="maniabilite">100%</td>
                
            </tr>
            <tr>
                <td>{$LNG.tech.903} :</td>
                <td name="cristal">100</td>
                <td>{$LNG.NOUVEAUTE_390} :</td>
                <td name="coque">0</td>
                <td>{$LNG.NOUVEAUTE_323} :</td>
                <td name="temps">2m 0s</td>
            </tr>
            <tr>
                <td>{$LNG.tech.904} : </td>
                <td name="elyrium">50</td>
                <td>{$LNG.NOUVEAUTE_393} :</td>
                <td name="fret">200</td>
                <td>{$LNG.NOUVEAUTE_422} :</td>
                <td name="drone">0 drones</td>
            </tr>
        </tbody></table>
        <div class="espace"></div>
    </div>
{if empty($Message)}
    <!-- On affiche tous les sous-onglet pour les composants de divers type -->
    <div class="onglet">
        <ul>
            <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('description');" title="">{$LNG.NOUVEAUTE_285}</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('attaque');" title="">{$LNG.NOUVEAUTE_423}</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('bouclier');" title="">{$LNG.NOUVEAUTE_424}</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('coque');" title="">{$LNG.NOUVEAUTE_425}</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('drone');" title="">{$LNG.NOUVEAUTE_426}</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('hangar');" title="">{$LNG.NOUVEAUTE_427}</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('vitesse');" title="">{$LNG.NOUVEAUTE_428}</a></li>
                        <li><a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('autre');" title="">{$LNG.NOUVEAUTE_429}</a></li>
                    </ul>
    </div>
{/if}
    <!-- Sous partie : indiquer le nom du modèle / choisir l'infrastructure et image -->
    <div name="sous_onglet_description" class="sous_onglet">
        <!-- Le titre de cet sous-onglet -->
		{if empty($Message)}
        <h2 class="titre_corps">{$LNG.NOUVEAUTE_430}</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table name="description">
                <!-- Le nom du modèle -->
                <tbody><tr>
                    <td>
                        <label for="nom">{$LNG.NOUVEAUTE_431} :</label>
                        — {$LNG.NOUVEAUTE_432}
                    </td>
                    <td><input onchange="javascript:VaisseauCreation.previsualiser();" onkeyup="javascript:VaisseauCreation.previsualiser();" name="nom" id="nom" type="text"></td>
                </tr>

                <!-- Le lien vers l'image -->
                <tr>
                    <td>
                        <label for="image">{$LNG.NOUVEAUTE_433} :</label>
                        — {$LNG.NOUVEAUTE_434}
                    </td>
                    <td>
                        <input name="image" id="image" onchange="javascript:VaisseauCreation.changerImage(); VaisseauCreation.previsualiser();" onkeyup="javascript:VaisseauCreation.changerImage(); VaisseauCreation.previsualiser();" type="text">
                        <a onclick="javascript:VaisseauCreation.ouvrirSousOnglet('liste_image');" title=""><img src="https://cdngames.antaris-legacy.eu/design/image/jeu/icone/couleur/image.png"></a>
                    </td>
                </tr>

                <!-- L'infrastructure du modèle -->
                <tr>
                    <td>
                        <label for="id_infrastructure">{$LNG.NOUVEAUTE_435} :</label>
                        — {$LNG.NOUVEAUTE_436}
                    </td>
                    <td>
                      <select name="id_infrastructure" id="id_infrastructure" onchange="VaisseauCreation.selectionnerInfrastructure();">
                                                            <option value="1">{$LNG.INFRASTRUCTURE.1}</option>
                                                            <option value="2">{$LNG.INFRASTRUCTURE.2}</option>
                                                            <option value="3">{$LNG.INFRASTRUCTURE.3}</option>
                                                            <option value="4">{$LNG.INFRASTRUCTURE.4}</option>
                                                            <option value="5">{$LNG.INFRASTRUCTURE.5}</option>
                                                            <option value="6">{$LNG.INFRASTRUCTURE.6}</option>
                                                            <option value="7">{$LNG.INFRASTRUCTURE.7}</option>
                                                            <option value="8">{$LNG.INFRASTRUCTURE.8}</option>
                                                            <option value="9">{$LNG.INFRASTRUCTURE.9}</option>
                                                    </select>
                    </td>
                </tr>
            </tbody></table>
        </div>{/if} 
    </div>
                       
    <!-- Sous partie : liste de toutes les images de modèle que l'on propose aux joueurs -->
    <div name="sous_onglet_liste_image" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">{$LNG.NOUVEAUTE_437}</h2>
        
        <i>{$LNG.NOUVEAUTE_438}</i>
        <div class="conteneur">
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/1.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/1.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/2.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/2.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/3.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/3.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/4.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/4.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/5.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/5.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/6.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/6.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/7.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/7.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/8.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/8.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/9.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/9.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/10.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/10.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/11.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/11.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/12.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/12.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/13.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/13.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/14.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/14.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/15.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/15.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/16.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/16.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/17.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/17.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/18.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/18.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/19.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/19.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/20.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/20.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/21.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/21.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/22.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/22.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/23.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/23.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/24.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/24.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/25.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/25.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/26.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/26.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/27.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/27.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/28.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/28.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/29.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/29.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/30.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/30.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/31.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/31.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/32.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/32.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/33.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/33.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/34.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/34.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/35.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/35.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/36.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/36.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/37.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/37.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/38.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/38.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/39.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/39.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/40.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/40.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/41.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/41.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/42.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/42.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/43.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/43.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/44.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/44.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/45.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/45.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/46.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/46.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/47.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/47.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/48.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/48.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/49.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/49.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/50.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/50.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/51.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/51.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/52.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/52.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/53.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/53.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/54.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/54.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/55.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/55.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/56.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/56.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/57.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/57.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/58.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/58.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/59.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/59.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                            <div class="choisir_image">
                   <img src="https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/60.jpg" onclick="javascript:VaisseauCreation.selectionnerImage('https://cdngames.antaris-legacy.eu/design/image/jeu/vaisseau/60.jpg');" onmouseover="montre('{$LNG.NOUVEAUTE_439}');" onmouseout="cache();">
                </div>
                        <div class="espace"></div>
        </div>
    </div>

            
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_attaque" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">{$LNG.NOUVEAUTE_440}</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                      <tbody><tr>
                        <td>
                            <label for="composant_1">
                                                               {$LNG.COMPOSANT.1}
                                :
                            </label>
                            <div class="unite"><span class="orange">100</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">50</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">20</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">0</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: inline-block;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_1', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_1', 'onkeyup');" class="composant entier" id="composant_1" name="composant_1" data-id_composant="1" value="0" type="text">
                                                    </td>
                        <td>
                            <span class="couleur_theme">10</span>                             d'attaque<br>
                            <span class="rouge">2</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_2">
                                                               {$LNG.COMPOSANT.2} 
                                  :
                            </label>
                            <div class="unite"><span class="orange">500</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">200</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">100</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">0</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: inline-block;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_2', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_2', 'onkeyup');" class="composant entier" id="composant_2" name="composant_2" data-id_composant="2" value="0" type="text">
                                                    </td>
                        <td>
                            <span class="couleur_theme">80</span>                             d'attaque<br>
                            <span class="rouge">5</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_3">
                                                               {$LNG.COMPOSANT.3}
                                :
                            </label>
                            <div class="unite"><span class="orange">1 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">500</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">250</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">50</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: inline-block;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_3', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_3', 'onkeyup');" class="composant entier" id="composant_3" name="composant_3" data-id_composant="3" value="0" type="text">
                                                    </td>
                        <td>
                            <span class="couleur_theme">250</span>                             d'attaque<br>
                            <span class="rouge">10</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_4">
                                                               {$LNG.COMPOSANT.4}
                                :
                            </label>
                            <div class="unite"><span class="orange">1 500</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">1 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">400</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">150</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_4', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_4', 'onkeyup');" class="composant entier" id="composant_4" name="composant_4" data-id_composant="4" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="4">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">600</span>                             d'attaque<br>
                            <span class="rouge">20</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_5">
                                                               {$LNG.COMPOSANT.5}
                                :
                            </label>
                            <div class="unite"><span class="orange">4 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">2 500</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">1 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">250</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_5', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_5', 'onkeyup');" class="composant entier" id="composant_5" name="composant_5" data-id_composant="5" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="5">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">2 000</span>                             d'attaque<br>
                            <span class="rouge">50</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_6">
                                                               {$LNG.COMPOSANT.6}
                                :
                            </label>
                            <div class="unite"><span class="orange">10 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">6 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">2 500</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">400</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_6', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_6', 'onkeyup');" class="composant entier" id="composant_6" name="composant_6" data-id_composant="6" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="6">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">7 500</span>                             d'attaque<br>
                            <span class="rouge">100</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_7">
                                                               {$LNG.COMPOSANT.7}
                                :
                            </label>
                            <div class="unite"><span class="orange">25 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">15 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">8 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">1 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_7', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_7', 'onkeyup');" class="composant entier" id="composant_7" name="composant_7" data-id_composant="7" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="7">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">25 000</span>                             d'attaque<br>
                            <span class="rouge">200</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_8">
                                                                {$LNG.COMPOSANT.8}
                                :
                            </label>
                            <div class="unite"><span class="orange">35 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">22 500</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">12 500</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">1 500</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_8', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_8', 'onkeyup');" class="composant entier" id="composant_8" name="composant_8" data-id_composant="8" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="8">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">47 500</span>                             d'attaque<br>
                            <span class="rouge">400</span> u. de fret
                        </td>
                    </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      </tbody></table>
        </div>
    </div>
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_bouclier" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">{$LNG.NOUVEAUTE_441}</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <tbody><tr>
                        <td>
                            <label for="composant_13">
                                                                {$LNG.COMPOSANT.13}
                                :
                            </label>
                            <div class="unite"><span class="orange">250</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">100</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">175</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">25</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: inline-block;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_13', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_13', 'onkeyup');" class="composant entier" id="composant_13" name="composant_13" data-id_composant="13" value="0" type="text">
                                                    </td>
                        <td>
                            <span class="couleur_theme">65</span>                             de bouclier<br>
                            <span class="rouge">4</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_14">
                                                                {$LNG.COMPOSANT.14}
                                :
                            </label>
                            <div class="unite"><span class="orange">400</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">200</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">425</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">100</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_14', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_14', 'onkeyup');" class="composant entier" id="composant_14" name="composant_14" data-id_composant="14" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="14">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">350</span>                             de bouclier<br>
                            <span class="rouge">8</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_15">
                                                                {$LNG.COMPOSANT.15}
                                :
                            </label>
                            <div class="unite"><span class="orange">1 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">650</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">950</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">250</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_15', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_15', 'onkeyup');" class="composant entier" id="composant_15" name="composant_15" data-id_composant="15" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="15">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">1 200</span>                             de bouclier<br>
                            <span class="rouge">14</span> u. de fret
                        </td>
                    </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </tbody></table>
        </div>
    </div>
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_coque" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">{$LNG.NOUVEAUTE_442}</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                      <tbody><tr>
                        <td>
                            <label for="composant_9">
                                                               {$LNG.COMPOSANT.9} 
                                :
                            </label>
                            <div class="unite"><span class="orange">250</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">100</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">10</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">20</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: inline-block;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_9', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_9', 'onkeyup');" class="composant entier" id="composant_9" name="composant_9" data-id_composant="9" value="0" type="text">
                                                    </td>
                        <td>
                            <span class="couleur_theme">60</span>                             de coque<br>
                            <span class="rouge">4</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_10">
                                                                {$LNG.COMPOSANT.10}
                                :
                            </label>
                            <div class="unite"><span class="orange">750</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">300</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">150</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">175</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_10', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_10', 'onkeyup');" class="composant entier" id="composant_10" name="composant_10" data-id_composant="10" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="10">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">450</span>                             de coque<br>
                            <span class="rouge">10</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_11">
                                                                {$LNG.COMPOSANT.11} 
                                :
                            </label>
                            <div class="unite"><span class="orange">1 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">400</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">250</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">350</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_11', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_11', 'onkeyup');" class="composant entier" id="composant_11" name="composant_11" data-id_composant="11" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="11">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">1 000</span>                             de coque<br>
                            <span class="rouge">15</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_12">
                                                                {$LNG.COMPOSANT.12}
                                :
                            </label>
                            <div class="unite"><span class="orange">2 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">800</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">500</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">500</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_12', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_12', 'onkeyup');" class="composant entier" id="composant_12" name="composant_12" data-id_composant="12" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="12">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">3 000</span>                             de coque<br>
                            <span class="rouge">30</span> u. de fret
                        </td>
                    </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              </tbody></table>
        </div>
    </div>
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_drone" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">{$LNG.NOUVEAUTE_443}</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <tbody><tr>
                        <td>
                            <label for="composant_29">
                                                               {$LNG.COMPOSANT.29}
                                  :
                            </label>
                            <div class="unite"><span class="orange">240 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">180 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">150 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">75 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_29', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_29', 'onkeyup');" class="composant entier" id="composant_29" name="composant_29" data-id_composant="29" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="29">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">1</span>                             drone(s)<br>
                            <span class="rouge">1 200</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_30">
                                                                {$LNG.COMPOSANT.30}
                                :
                            </label>
                            <div class="unite"><span class="orange">600 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">450 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">300 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">120 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_30', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_30', 'onkeyup');" class="composant entier" id="composant_30" name="composant_30" data-id_composant="30" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="30">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">4</span>                             drone(s)<br>
                            <span class="rouge">4 800</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_31">
                                                                {$LNG.COMPOSANT.31} 
                                                                    <span class="help rouge" onmouseover="montre('<b>Ce composant est bloqué :</b><br /><span class=\'vert\'>Avant-poste Antaris, au niveau 3 <i>(4)</i></span><br /><span class=\'vert\'>Siège des Antaris, au niveau 8 <i>(11)</i></span><br /><span class=\'vert\'>Maîtrise de l\'énergie, au niveau 20 <i>(20)</i></span><br /><span class=\'rouge\'>Connaissance des particules, au niveau 20 <i>(18)</i></span><br /><span class=\'vert\'>Connaissance des Antaris, au niveau 16 <i>(18)</i></span><br /><span class=\'rouge\'>Systèmes d\'armement, au niveau 20 <i>(19)</i></span><br />');" onmouseout="cache();">(B)</span>
                                :
                            </label>
                            <div class="unite"><span class="orange">1 050 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">600 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">412 500</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">210 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_31', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_31', 'onkeyup');" class="composant entier" id="composant_31" name="composant_31" data-id_composant="31" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="31">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">10</span>                             drone(s)<br>
                            <span class="rouge">12 000</span> u. de fret
                        </td>
                    </tr>
                                                                                                                                                                                                                        </tbody></table>
        </div>
    </div>
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_hangar" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">{$LNG.NOUVEAUTE_444}</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <tbody><tr>
                        <td>
                            <label for="composant_32">
                                                                {$LNG.COMPOSANT.32} 
                                :
                            </label>
                            <div class="unite"><span class="orange">20 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">15 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">4 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">6 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_32', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_32', 'onkeyup');" class="composant entier" id="composant_32" name="composant_32" data-id_composant="32" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="32">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">10</span>                             place(s)<br>
                            <span class="rouge">1 500</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_33">
                                                                {$LNG.COMPOSANT.33}
                                :
                            </label>
                            <div class="unite"><span class="orange">60 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">35 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">8 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">12 500</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_33', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_33', 'onkeyup');" class="composant entier" id="composant_33" name="composant_33" data-id_composant="33" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="33">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">5</span>                             place(s)<br>
                            <span class="rouge">9 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_34">
                                                                {$LNG.COMPOSANT.34}
                                :
                            </label>
                            <div class="unite"><span class="orange">135 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">75 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">20 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">30 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_34', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_34', 'onkeyup');" class="composant entier" id="composant_34" name="composant_34" data-id_composant="34" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="34">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">2</span>                             place(s)<br>
                            <span class="rouge">15 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_35">
                                                                {$LNG.COMPOSANT.35}
                                :
                            </label>
                            <div class="unite"><span class="orange">145 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">80 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">25 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">32 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_35', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_35', 'onkeyup');" class="composant entier" id="composant_35" name="composant_35" data-id_composant="35" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="35">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">2</span>                             place(s)<br>
                            <span class="rouge">60 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_36">
                                                                {$LNG.COMPOSANT.36}
                                :
                            </label>
                            <div class="unite"><span class="orange">220 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">120 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">42 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">40 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_36', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_36', 'onkeyup');" class="composant entier" id="composant_36" name="composant_36" data-id_composant="36" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="36">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">1</span>                             place(s)<br>
                            <span class="rouge">115 000</span> u. de fret
                        </td>
                    </tr>
                                              </tbody></table>
        </div>
    </div>
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_vitesse" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">{$LNG.NOUVEAUTE_445}</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <tbody><tr>
                        <td>
                            <label for="composant_16">
                                                                {$LNG.COMPOSANT.16} 
                                :
                            </label>
                            <div class="unite"><span class="orange">750</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">500</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">300</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">0</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: inline-block;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_16', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_16', 'onkeyup');" class="composant entier" id="composant_16" name="composant_16" data-id_composant="16" value="0" type="text">
                                                    </td>
                        <td>
                            <span class="couleur_theme">5</span>                             de poussée<br>
                            <span class="rouge">20</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_17">
                                                                {$LNG.COMPOSANT.17} 
                                :
                            </label>
                            <div class="unite"><span class="orange">1 500</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">1 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">600</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">0</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_17', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_17', 'onkeyup');" class="composant entier" id="composant_17" name="composant_17" data-id_composant="17" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="17">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">150</span>                             de poussée<br>
                            <span class="rouge">50</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_18">
                                                                {$LNG.COMPOSANT.18}
                                :
                            </label>
                            <div class="unite"><span class="orange">2 500</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">1 750</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">1 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">250</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_18', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_18', 'onkeyup');" class="composant entier" id="composant_18" name="composant_18" data-id_composant="18" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="18">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">300</span>                             de poussée<br>
                            <span class="rouge">100</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_19">
                                                                {$LNG.COMPOSANT.19}
                                :
                            </label>
                            <div class="unite"><span class="orange">6 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">4 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">2 500</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">300</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_19', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_19', 'onkeyup');" class="composant entier" id="composant_19" name="composant_19" data-id_composant="19" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="19">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">750</span>                             de poussée<br>
                            <span class="rouge">300</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_20">
                                                                {$LNG.COMPOSANT.20}
                                :
                            </label>
                            <div class="unite"><span class="orange">8 500</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">6 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">4 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">500</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_20', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_20', 'onkeyup');" class="composant entier" id="composant_20" name="composant_20" data-id_composant="20" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="20">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">1 650</span>                             de poussée<br>
                            <span class="rouge">750</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_21">
                                                                {$LNG.COMPOSANT.21}
                                :
                            </label>
                            <div class="unite"><span class="orange">12 500</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">10 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">7 500</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">1 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_21', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_21', 'onkeyup');" class="composant entier" id="composant_21" name="composant_21" data-id_composant="21" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="21">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">2 000</span>                             de poussée<br>
                            <span class="rouge">2 800</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_22">
                                                                {$LNG.COMPOSANT.22}
                                :
                            </label>
                            <div class="unite"><span class="orange">20 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">15 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">10 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">5 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_22', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_22', 'onkeyup');" class="composant entier" id="composant_22" name="composant_22" data-id_composant="22" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="22">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">4 000</span>                             de poussée<br>
                            <span class="rouge">8 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_23">
                                                                {$LNG.COMPOSANT.23}
                                :
                            </label>
                            <div class="unite"><span class="orange">45 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">30 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">20 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">30 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_23', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_23', 'onkeyup');" class="composant entier" id="composant_23" name="composant_23" data-id_composant="23" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="23">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">13 000</span>                             de poussée<br>
                            <span class="rouge">16 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_24">
                                <span class="help cyan" onmouseover="montre('Moteur ayant la technologie « Hyperespace ».');" onmouseout="cache();">[H+]</span>                                {$LNG.COMPOSANT.24}
                                :
                            </label>
                            <div class="unite"><span class="orange">130 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">100 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">75 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">75 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_24', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_24', 'onkeyup');" class="composant entier" id="composant_24" name="composant_24" data-id_composant="24" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="24">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">32 000</span>                             de poussée<br>
                            <span class="rouge">60 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_25">
                                <span class="help cyan" onmouseover="montre('Moteur ayant la technologie « Hyperespace ».');" onmouseout="cache();">[H+]</span>                                 {$LNG.COMPOSANT.25} 
                                :
                            </label>
                            <div class="unite"><span class="orange">160 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">125 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">120 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">90 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_25', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_25', 'onkeyup');" class="composant entier" id="composant_25" name="composant_25" data-id_composant="25" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="25">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">45 000</span>                             de poussée<br>
                            <span class="rouge">95 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_26">
                                <span class="help cyan" onmouseover="montre('Moteur ayant la technologie « Hyperespace ».');" onmouseout="cache();">[H+]</span>                                 {$LNG.COMPOSANT.26} 
                                                                    <span class="help rouge" onmouseover="montre('<b>Ce composant est bloqué :</b><br /><span class=\'vert\'>Maîtrise de l\'énergie, au niveau 20 <i>(20)</i></span><br /><span class=\'vert\'>Maîtrise du sub-espace, au niveau 18 <i>(18)</i></span><br /><span class=\'vert\'>Connaissance des Antaris, au niveau 16 <i>(18)</i></span><br /><span class=\'rouge\'>Hypernavigation, au niveau 18 <i>(16)</i></span><br /><span class=\'vert\'>Connaissance des particules, au niveau 18 <i>(18)</i></span><br />');" onmouseout="cache();">(B)</span>
                                :
                            </label>
                            <div class="unite"><span class="orange">250 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">215 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">155 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">125 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" onchange="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_26', 'onchange');" onkeyup="javascript:VaisseauCreation.previsualiser(); InputMethode.gererChamp('composant_26', 'onkeyup');" class="composant entier" id="composant_26" name="composant_26" data-id_composant="26" value="0" type="text"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="26">Incompatible</div>
                                                    </td>
                        <td>
                            <span class="couleur_theme">60 000</span>                             de poussée<br>
                            <span class="rouge">125 000</span> u. de fret
                        </td>
                    </tr>
                                                                                                                                                                                                                                                                                                                                                                                                  </tbody></table>
        </div>
    </div>
        <!-- Sous partie : pour afficher chaque sous-onglet -->
    <div name="sous_onglet_autre" class="sous_onglet" style="display : none;">
        <!-- Le titre de cet sous-onglet -->
        <h2 class="titre_corps">{$LNG.NOUVEAUTE_446}</h2>

        <div style="margin : 10px -20px 15px -20px;">
            <table>
                <!-- On liste l'ensemble des composants de cet onglet -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <tbody><tr>
                        <td>
                            <label for="composant_27">
                                                               {$LNG.COMPOSANT.27} 
                                :
                            </label>
                            <div class="unite"><span class="orange">2 000 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">3 000 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">2 500 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">800 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" value="0" onchange="javascript:VaisseauCreation.previsualiser();" onkeyup="javascript:VaisseauCreation.previsualiser();" class="composant" id="composant_27" name="composant_27" data-id_composant="27" type="checkbox"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="27">Incompatible</div>
                                                    </td>
                        <td>
                                                        +50% de bouclier<br>
                            <span class="rouge">40 000</span> u. de fret
                        </td>
                    </tr>
                                                                        <tr>
                        <td>
                            <label for="composant_28">
                                                               {$LNG.COMPOSANT.28} 
                                :
                            </label>
                            <div class="unite"><span class="orange">25 000</span> {$LNG.tech.901}</div>
                            <div class="unite"><span class="orange">50 000</span> {$LNG.tech.902}</div>
                            <div class="unite"><span class="orange">30 000</span> {$LNG.tech.903}</div>
                            <div class="unite"><span class="orange">20 000</span> {$LNG.tech.904}</div>
                        </td>
                        <td>
                                                            <input style="display: none;" value="0" onchange="javascript:VaisseauCreation.previsualiser();" onkeyup="javascript:VaisseauCreation.previsualiser();" class="composant" id="composant_28" name="composant_28" data-id_composant="28" type="checkbox"><div onmouseout="cache();" onmouseover="montre('Ce composant est incompatible avec cette infrastructure.');" class="incompatible rouge" data-association="28">Incompatible</div>
                                                    </td>
                        <td>
                                                        75% téléportation<br>
                            <span class="rouge">1 000</span> u. de fret
                        </td>
                    </tr>
                                                                                                                                                                                                                                                                                                                              </tbody></table>
        </div>
    </div>
        
    
    <!-- Sous-titre : pour vérifier la validité du formulaire -->
    <h2 class="titre_corps">Valider la création de ce modèle</h2>
	
    {if empty($Message)}<div id="msg_verifier_modele" class="gris">  <span class="rouge">{$LNG.NOUVEAUTE_447}</span></div>
    
    <!-- Pour valider la création de ce nouveau modèle -->
    <div id="bouton_formulaire">
        <input name="valid_creation" id="valid_creation" value="{$LNG.NOUVEAUTE_805}" type="submit">
    </div>
	{else}
	<div id="" class="gris">{$Message}<br><a onclick="location.href='game.php?page=CreateShip';">{$LNG.NOUVEAUTE_21}</a></div>
	{/if}

    <div class="espace"></div>
</form></div></div>  
{/block}       