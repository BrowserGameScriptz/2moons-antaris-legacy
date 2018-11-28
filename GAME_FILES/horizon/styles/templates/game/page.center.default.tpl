{block name="title" prepend}{$LNG.lm_fleettable_5}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.lm_fleettable_5}</h1>
          <div id="centre_spatial"><!-- Template qui permet d'afficher le menu du centre spatial -->
<div name="menu_centre_spatial">
    <div name="contenu_texte">
        <h3>{$LNG.NOUVEAUTE_285} :</h3>
        <div class="description">
           {$LNG.NOUVEAUTE_589}
        </div>

        <!-- On affiche la liste des missions que l'on peut effectuer via le centre spatial -->
        <h3>{$LNG.NOUVEAUTE_590} :</h3>
        <div class="liste_mission">
		
		{if empty($Message)}
            <ul>
                            <li><a onclick="location.href='game.php?page=center&mode=mission&missionID=4';" title="{$LNG.NOUVEAUTE_525} : {$LNG.type_missionbis.4}">{$LNG.type_missionbis.4}</a></li>	
                            <li><a onclick="location.href='game.php?page=center&mode=mission&missionID=3';" title="{$LNG.NOUVEAUTE_525} : {$LNG.type_missionbis.3}">{$LNG.type_missionbis.3}</a></li>	
                            <li><a onclick="location.href='game.php?page=center&mode=mission&missionID=7';" title="{$LNG.NOUVEAUTE_525} : {$LNG.type_missionbis.7}">{$LNG.type_missionbis.7}</a></li>	
                            <li><a onclick="location.href='game.php?page=center&mode=mission&missionID=12';" title="{$LNG.NOUVEAUTE_525} : {$LNG.type_missionbis.12}">{$LNG.type_missionbis.12}</a></li>	
                            <li><a onclick="location.href='game.php?page=center&mode=mission&missionID=8';" title="{$LNG.NOUVEAUTE_525} : {$LNG.type_missionbis.8}">{$LNG.type_missionbis.8}</a></li>	
                            <li><a onclick="location.href='game.php?page=center&mode=mission&missionID=9';" title="{$LNG.NOUVEAUTE_525} : {$LNG.NOUVEAUTE_624}">{$LNG.NOUVEAUTE_624}</a></li>	
                            <li><a onclick="location.href='game.php?page=center&mode=mission&missionID=6';" title="{$LNG.NOUVEAUTE_525} : {$LNG.type_missionbis.6}">{$LNG.type_missionbis.6}</a></li>	
                            <li><a onclick="location.href='game.php?page=center&mode=mission&missionID=1';" title="{$LNG.NOUVEAUTE_525} : {$LNG.type_missionbis.1}">{$LNG.type_missionbis.1}</a></li>	
                        </ul>
						{else}
						{$Message}
						{/if}
        </div>
    </div>    
</div>

<div name="information_portail">
    {$LNG.NOUVEAUTE_591} 
</div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}