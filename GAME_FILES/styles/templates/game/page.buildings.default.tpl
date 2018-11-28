{block name="title" prepend}{$LNG.NOUVEAUTE_290}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.NOUVEAUTE_290}</h1><div class="onglet">
			<ul>
				<li><a onclick="location.href='game.php?page=buildings&cmdd=build';" title="{$LNG.NOUVEAUTE_291}">{$LNG.NOUVEAUTE_294}</a></li>
				<li><a onclick="location.href='game.php?page=buildings&cmdd=hangars';" title="{$LNG.NOUVEAUTE_292}">{$LNG.NOUVEAUTE_295}</a></li>
				<li><a onclick="location.href='game.php?page=buildings&cmdd=militar';" title="{$LNG.NOUVEAUTE_293}">{$LNG.NOUVEAUTE_296}</a></li>
			</ul>
		  </div>
		  
		  
		  {if !empty($Queue)}
		  <h2 class="titre_corps">{$LNG.NOUVEAUTE_297}</h2>
		  
		  
		  <div id="div_liste_construction">
		  {foreach $Queue as $List}
		{$ID = $List.element}
		  <table style="width : 65%;">
		  
		  <tr>
						<td style="text-align : left;">
							<span style="cursor : help;" onmouseover="montre('<div style=\'min-width : 250px;\'>                <b>{$LNG.NOUVEAUTE_298} - {$LNG.tech.{$ID}}</b> (<span class=\'orange\'>{$List.level}</span>) <b>:</b>                    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                               {foreach $List.costRessources as $RessID => $RessAmount} <li>{$LNG.tech.{$RessID}} : <span class=\'orange\'>{$RessAmount|number}</span> {$LNG.ls_bunker_9}</li>      {/foreach}                                            </ul>                <b>{$LNG.NOUVEAUTE_299} :</b>    <ul style=\'text-align : left; margin : 0px; padding : 5px 5px 5px 20px;\'>                        <li>{$LNG.NOUVEAUTE_301} : {$List.starttime}</li>        <li>{$LNG.NOUVEAUTE_300} : {$List.endtime2}</li>        <li>{$LNG.NOUVEAUTE_478} : <span class=\'orange\'>{$List.tottime}</span></li>        <li>{$LNG.NOUVEAUTE_302} : <span class=\'orange\'>{$List.accomplished}%</span></li>                            </ul></div>');" onmouseout="cache();">{$LNG.tech.{$ID}} (<span class="orange">{$List.level}</span>) :</span> 
						</td>
						<td style="text-align : right;">
							{$LNG.NOUVEAUTE_277}: 
							{if $List@first}
							<span id="progressbar" data-time="{$List.resttime}"><span id="time" data-time="{$List.time}"></span> - <a onclick="javascript:ActionMethode.ouvrirPopUp('annuler_construction_bat_{$ID}');" title="{$LNG.NOUVEAUTE_303}">{$LNG.NOUVEAUTE_278}</a> {if $List.destroy2 == "destroy"}<span class="orange">({$LNG.NOUVEAUTE_853})</span>{/if}</span> 

					
							 {else}
							 <span class="timer" data-time="{$List.endtime}">{$List.display}</span>
							 - <a onclick="location.href='game.php?page=buildings&mode=Remove&listid={$List@iteration}';" title="{$LNG.NOUVEAUTE_303}">{$LNG.NOUVEAUTE_278}</a> {if $List.destroy2 == "destroy"}<span class="orange">({$LNG.NOUVEAUTE_853})</span>{/if}
							
							 {/if}
						</td>
					</tr></table>
					
					{if $List@first}
					<div id="annuler_construction_bat_{$ID}" class="popup_texte">
							<h1>{$LNG.NOUVEAUTE_304} </h1> 
									
									<p>	{$LNG.NOUVEAUTE_305} : {$LNG.tech.{$ID}} ?<br>
									<span class="rouge">{$LNG.NOUVEAUTE_306}</span></p>
								<div class="sous_partie">
									{$LNG.NOUVEAUTE_282} :
									<div class="sous_partie" style="padding-top : 0px;">
									
									{foreach $List.costRessources as $RessID => $RessAmount}- {sprintf($LNG.NOUVEAUTE_479, {($RessAmount/100*75)|number}, $LNG.tech.{$RessID})}<br />{/foreach} 
									
									
									</div>
									{$LNG.NOUVEAUTE_283}
								</div>
								<div class="centre">
						
				<form action="" method="post">
										<input style="margin-right : 8px;" type="button" value="{$LNG.NOUVEAUTE_289}" onclick="location.href='game.php?page=buildings&mode=cancel';" />
										
										
										<input style="margin-left : 8px;" type="button" value="{$LNG.NOUVEAUTE_278}" onclick="javascript:ActionMethode.fermerPopUp();" />
									</form>
									
								</div></div>{/if}{/foreach}</div>
								
								
								{/if}
								
								
								
<div id="div_liste_batiment"><h2 class="titre_corps">{$LNG.NOUVEAUTE_288} : {$Tab}</h2>
								
								
								
								
								
					{foreach $BuildInfoList as $ID => $Element}			
								<!-- On débute l'item bâtiment -->
<div class="item">
    <!-- On affiche le nom du bâtiment dans un lien qui redirige vers la description de celui-ci -->
    <div class="titre">
        <a onclick="location.href='game.php?page=information&id={$ID}';"
           class="titre_contour">{$LNG.tech.{$ID}}</a>
    </div>
    
    <!-- Pour afficher l'image avec une information bulle quand on survole qui permet de connaître le prix et la description du bâtiment -->
    <div class="image">
        <img src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/{$ID}.jpg" alt="Image Building : {$LNG.tech.{$ID}}" 
             onmouseover="montre('<!-- Les informations sur le bâtiment : prix et description --><div class=\'description_bulle\'>    <!-- On affiche le nom du bâtiment et le niveau -->    <h2>{$LNG.tech.{$ID}} (<span class=\'blanc\'>{$Element.level}</span>)</h2>    <table>        <tr>            <td colspan=\'2\'><h3>{$LNG.NOUVEAUTE_284} (n°{$Element.level + 1}) :</h3></td>            <td><h3>{$LNG.NOUVEAUTE_285} :</h3></td>        </tr>        <tr>            <!-- On affiche le prix en ressource et énergie ainsi que le temps de construction -->            <td>  {foreach $Element.costRessources as $RessID => $RessAmount}              {$LNG.tech.{$RessID}} :<br />      {/foreach}                                                   <br />                {$LNG.fgf_time} :            </td>            <td>                {foreach $Element.costRessources as $RessID => $RessAmount}  <span class=\'{if $Element.costOverflow[$RessID] == 0}vert{else}rouge{/if}\'>{$RessAmount|number}</span><br />      {/foreach}                                                         <br />                {$Element.elementTime|time}            </td>                        <!-- On affiche la description du bâtiment -->            <td>{$LNG.shortDescription.{$ID}}</td>        </tr>        <tr>            <td colspan=\'3\' class=\'gris\' style=\'padding-top : 10px; text-align : center;\'>                {$LNG.NOUVEAUTE_286}            </td>        </tr>    </table><div>');" onmouseout="cache();" />
    </div>
    
    <!-- Permet de savoir si le bâtiment est constructible -->
    <div class="action">
         {if !$Element.techacc}
	
			   
		
			   <span class="rouge" onmouseover="montre('<b>{$LNG.NOUVEAUTE_307} :</b><div style=\'padding : 3px 0px 0px 15px;\'>{foreach $Element.AllTech as $elementID => $requireList}{foreach $requireList as $requireID => $NeedLevel}{if $NeedLevel.count > $NeedLevel.own}<span class=\'rouge\'>{$LNG.tech.{$requireID}}, {$LNG.NOUVEAUTE_311} {$NeedLevel.count} <i>({$NeedLevel.own})</i></span><br />{/if}{/foreach}{/foreach}</div>');" onmouseout="cache();" style="cursor : help;"><b>{$LNG.NOUVEAUTE_287}</b></span>
		
		 
		
		
		
   {elseif $Element.maxLevel == $Element.levelToBuild}
                    <span class="rouge">{$LNG.bd_maxlevel}</span>
		{elseif ($isBusy.research && ($ID == 6 || $ID == 31)) || ($isBusy.shipyard && ($ID == 15 || $ID == 21))}
						<span class="rouge">{$LNG.bd_working}</span>
					{else}
					{if $RoomIsOk}
							{if $CanBuildElement && $Element.buyable}
				<form action="game.php?page=buildings" method="post" class="build_form">
								<input type="hidden" name="cmd" value="insert">
								<input type="hidden" name="cmdd" value="{$mode}">
								<input type="hidden" name="building" value="{$ID}">
								<button type="submit" class="build_submit">{if $Element.level == 0}{$LNG.bd_build}{else}{$LNG.bd_build_next_level}{$Element.levelToBuild + 1}{/if}</button>
							</form>
							{elseif !$CanBuildElement}
							<span class="rouge"><b>{$LNG.NOUVEAUTE_310}</b></span>
							{elseif !$Element.buyable}
							<span class="orange"><b>{$LNG.NOUVEAUTE_309}</b></span>
							{else}
							<span class="rouge"><b>{$LNG.bd_build}</b></span>
							{/if}
						{else}
						<span class="rouge"><b>{$LNG.bd_no_more_fields}</b></span>
						{/if}
					{/if}
        	
    </div>
    
    <!-- On affiche le niveau actuel du bâtiment dans un rond orange -->
    <div class="nombre">{$Element.level}</div>
</div>


{/foreach}

<div class="espace"></div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}
{block name="script" append}
<script type="text/javascript">
	var developmentTab 	= "{$mode}";
</script>
{/block}