{block name="title" prepend}{if $mode == "defense"}{$LNG.lm_defenses}{elseif $mode == "orbit"}{$LNG.lm_defenses}{else}{$LNG.NOUVEAUTE_320}{/if}{/block}
{block name="content"}
<div id="page_contenu">	

{if $inmode == 1}
<h1>{$LNG.NOUVEAUTE_320}</h1><div class="onglet">	<ul>		
<li><a onclick="location.href='game.php?page=shipyard&mode=fleet';" title="{$LNG.NOUVEAUTE_312}">{$LNG.NOUVEAUTE_316}</a></li>		
<li><a onclick="location.href='game.php?page=shipyard&mode=recy';" title="{$LNG.NOUVEAUTE_313}">{$LNG.NOUVEAUTE_317}</a></li>	
{*<li><a onclick="location.href='game.php?page=shipyard&mode=combat';" title="{$LNG.NOUVEAUTE_314}">{$LNG.NOUVEAUTE_318}</a></li>*}	
<li><a onclick="location.href='game.php?page=shipyard&mode=energy';" title="{$LNG.NOUVEAUTE_315}">{$LNG.NOUVEAUTE_319}</a></li>	
</ul>
</div>
{else}
<h1>{$LNG.NOUVEAUTE_328}</h1><div class="onglet">	<ul>		
<li><a onclick="location.href='game.php?page=defense&mode=defense';" title="{$LNG.NOUVEAUTE_329}">{$LNG.NOUVEAUTE_331}</a></li>				
<li><a onclick="location.href='game.php?page=defense&mode=orbit';" title="{$LNG.NOUVEAUTE_330}">{$LNG.NOUVEAUTE_332}</a></li>	
</ul>
</div>
{/if}


<h2 class="titre_corps">{if $mode == "defense"}{$LNG.NOUVEAUTE_333}{elseif $mode == "orbit"}{$LNG.NOUVEAUTE_333}{else}{$LNG.NOUVEAUTE_321}{/if}</h2>


{if !empty($BuildList)}
<table style="width:760px">
	<tr>
		<td class="transparent">
			
			<form action="#" method="post">
			<input type="hidden" name="action" value="delete">
			<table>
			
			<tr>
				<td><select width="300" style="width: 695px" name="auftr[]" id="auftr" size="3" multiple><option>&nbsp;</option></select></td>
			</tr>
			
			</table>
			</form>
			
		</td>
	</tr>
</table>
<br>
{else}
<div id="div_liste_construction" class="centre"><i>{if $mode == "defense"}{$LNG.NOUVEAUTE_334}{elseif $mode == "orbit"}{$LNG.NOUVEAUTE_334}{else}{$LNG.NOUVEAUTE_322}{/if}</i></div>
{/if}








<div id="div_liste_appareil" class="centre"><h2 class="titre_corps"></h2><!-- On débute l'item appareil -->

{foreach $elementList as $ID => $Element}
{if $mode == "fleet"}<form action="game.php?page=shipyard&amp;mode={$mode}" method="post">{elseif $mode == "recy"}<form action="game.php?page=shipyard&amp;mode={$mode}" method="post">{elseif $mode == "energy"}<form action="game.php?page=shipyard&amp;mode={$mode}" method="post">{else}<form action="game.php?page=defense" method="post">{/if}
<div class="item grand">
    <!-- On affiche le nom de l'appareil dans un lien qui redirige vers la description de celui-ci -->
    <div class="titre">
        <a onclick="location.href='game.php?page=information&id={$ID}';" 
           class="titre_contour">{$LNG.tech.{$ID}}</a>
    </div>
    
    <!-- Pour afficher l'image avec une information bulle quand on survole qui permet de connaître le prix et la description de l'appareil -->
    <div class="image">
        <img src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/{$ID}.gif" alt="Picture of : {$LNG.tech.{$ID}}" 
             onmouseover="montre('<!-- Les informations sur l\'appareil : prix et description --><div class=\'description_bulle\'>    <!-- On affiche le nom de l\'appareil -->    <h2>{$LNG.tech.{$ID}} (<span class=\'blanc\'>{$Element.available|number}</span>)</h2>    <table>        <tr>            <td colspan=\'2\'><h3>{$LNG.NOUVEAUTE_324} :</h3></td>            <td><h3>{$LNG.NOUVEAUTE_285} :</h3></td>        </tr>        <tr>            <!-- On affiche le prix en ressource, les caractèristiques ainsi que le temps de construction -->            <td> {foreach $Element.costRessources as $RessID => $RessAmount}               {$LNG.tech.{$RessID}} :<br />    {/foreach}                                       {$LNG.NOUVEAUTE_323} :<br /><br />                                                                                                         </td>            <td>              {foreach $Element.costRessources as $RessID => $RessAmount}   <span class=\'{if $Element.costOverflow[$RessID] == 0}vert{else}rouge{/if}\'>{$RessAmount|number}</span><br />  {/foreach}                                           {if $Element.UnitsSecond == 0}{$Element.elementTime|time}{else}{pretty_number($Element.UnitsSecond)} u/s{/if}<br /><br />                                                                                                       </td>                        <!-- On affiche la description de l\'appareil -->            <td>{$LNG.shortDescription.{$ID}}</td>        </tr>        <tr>            <td colspan=\'3\' class=\'gris\' style=\'padding-top : 10px; text-align : center;\'>                {$Element.maxBuildableS}            </td>        </tr>    </table><div>');" onmouseout="cache();" />
    </div>
    
    <!-- Permet de savoir si l'appareil est constructible -->
   


   <div class="action">
     {if !$Element.techacc}
	
			   
		
			   <span class="rouge" onmouseover="montre('<b>{if $mode == "defense"}{$LNG.NOUVEAUTE_335}{elseif $mode == "orbit"}{$LNG.NOUVEAUTE_335}{else}{$LNG.NOUVEAUTE_326}{/if} :</b><div style=\'padding : 3px 0px 0px 15px;\'>{foreach $Element.AllTech as $elementID => $requireList}{foreach $requireList as $requireID => $NeedLevel}{if $NeedLevel.count > $NeedLevel.own}<span class=\'rouge\'>{$LNG.tech.{$requireID}}, {$LNG.NOUVEAUTE_311} {$NeedLevel.count} <i>({$NeedLevel.own})</i></span><br />{/if}{/foreach}{/foreach}</div>');" onmouseout="cache();" style="cursor : help;"><b>{$LNG.NOUVEAUTE_287}</b></span>
		
		 
		
		
		
   {elseif $Element.AlreadyBuild}
                    <span class="rouge" style="cursor : help;"><b>{$LNG.NOUVEAUTE_287}</b></span>
					
			 {elseif !$Element.buyable}
                    <span class="orange" style="cursor : help;"><b>{$LNG.NOUVEAUTE_309}</b></span>		
					
					
        	{elseif $NotBuilding && $Element.buyable}
					
					 
                <input class="entier" size="{$maxlength}" maxlength="{$maxlength}" id="input_{$ID}" name="fmenge[{$ID}]" value="0" type="text" tabindex="{$smarty.foreach.FleetList.iteration}">
                <input value="Max." type="button" onclick="$('#input_{$ID}').val('{$Element.maxBuildable}')">
				
				
				
				
					
					
					{/if}
    </div>
	
	
	
	
    
    <!-- On affiche le nomdre d'unité pour cet appareil dans un degradé noir -->
    <div class="nombre">{$Element.available|number} <span style="font-size:0.84em;font-weight:normal;">{$LNG.lm_achat_units}</span></div>
</div>
</form>
{/foreach}
<div class="espace"></div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
			

<script type="text/javascript">
data			= {$BuildList|json};
bd_operating	= '{$LNG.bd_operating}';
bd_available	= '{$LNG.bd_available}';
</script>
{/block}