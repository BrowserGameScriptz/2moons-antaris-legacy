{block name="title" prepend}{$LNG.lm_galaxy}{/block}
{block name="content"}
<div id="page_contenu">      
<script type="text/javascript">
var errormest = "{$LNG.fleet_ajax_13}";
</script>
<!-- Titre de la page -->
<h1>{$LNG.lm_galaxy}</h1>

<!-- L'élément HTML qui contient tous les éléments des capteurs -->
<div id="capteur_intrastellaire">
    <!-- Formulaire pour changer de système solaire -->
	<form action="javascript:Capteur.changerSysteme('input');" method="post" id="form_capteur">
	<input type="hidden" id="auto" value="dr">
	
        <!-- Bouton pour afficher le système précédent -->
        <div class="conteneur_bouton precedent">
            <input class="neutre" value="<< {$LNG.ls_galaxy_1}" onclick="javascript:Capteur.changerSysteme('precedent');" type="button">
		</div>
      
        <!-- Changer de système manuellement -->
        <div class="conteneur_champ">
            <label for="manuellement_systeme">{$LNG.gl_solar_system} : </label>
			<input type="text" id="manuellement_systeme" name="systeme" class="entier" size="5" maxlenght="7" value="{$system}" />
            <input name="valid_form" value="{$LNG.ls_galaxy_3} !" type="submit">
        </div>
      
        <!-- Bouton pour afficher le système suivant -->
        <div class="conteneur_bouton suivant">
            <input class="neutre" value="{$LNG.ls_galaxy_2} >>" onclick="javascript:Capteur.changerSysteme('suivant');" type="button">
		</div>
        <div class="espace"></div>
    </form>
    
    <!-- Le conteneur de la map -->
    <div class="map">
        <!-- Background des capteurs intrastellaires -->
        <img class="background" onclick="Capteur.annulerFromage();" src="https://cdngames.antaris-legacy.eu/design/image/transparent.png" usemap="#map_capteur"/>
        <!-- Image du soleil pour ce système solaire -->
        <img name="soleil" src="https://cdngames.antaris-legacy.eu/design/image/theme/defaut/capteur/soleil.png" />
        <!-- Image de chargement lorsque l'on change de système -->
        <img name="chargement_systeme" src="https://cdngames.antaris-legacy.eu/design/image/chargement2.gif" />

        <!-- La MAP -->
        <map name="map_capteur"></map>
		

        <!-- Barre d'information du haut -->
        <div class="barre_information haut">
            <img name="aide_legende" src="https://cdngames.antaris-legacy.eu/design/image/jeu/icone/couleur/aide.png" onclick="javascript:Capteur.afficherFenetreLegende();" onmouseout="cache();" onmouseover="montre('{$LNG.ls_galaxy_6}')">
           <table>
                <tbody><tr>
                    <td name="systeme">{$LNG.gl_solar_system} : {$system}</td>
                    <td id="selected_position" name="position"></td>
                    <td id="selected_planetname" name="nom_planete"></td>
                </tr>
            </tbody></table>
        </div>
      
        <!-- Barre d'information du bas -->
        <div class="barre_information bas">
            <table>
                <tbody><tr>
                    <td id="selected_username" name="pseudo_joueur"></td>
                    <td id="selected_pointuser" name="point_joueur"></td>
                    <td id="selected_rankuser" name="classement_joueur"></td>
                </tr>
           </table>
        </div>
    </div>
    
    <span class="gris">
       {$LNG.ls_galaxy_5}
    </span>
</div></div>                    
{/block}
{block name="script" append}
<script type="text/javascript">
    $(document).ready(function(){
        Capteur.initialiser({$system});
    });
</script>
{/block}