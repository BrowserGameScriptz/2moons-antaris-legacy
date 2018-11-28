{block name="title" prepend}{$LNG.lm_technology}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.ls_tech_1}</h1><div class="onglet" style="margin-bottom : 0px; padding-bottom : 0px;">
			<ul>
				<li><a href="?page=techtree&mode=buildings" title="{$LNG.ls_tech_2}">{$LNG.ls_tech_2}</a></li>
				<li><a href="?page=techtree&mode=research" title="{$LNG.ls_tech_3}">{$LNG.ls_tech_3}</a></li>
				<li><a href="?page=techtree&mode=ships" title="{$LNG.ls_tech_4}">{$LNG.ls_tech_4}</a></li>
				<li><a href="?page=techtree&mode=defense" title="{$LNG.ls_tech_5}">{$LNG.ls_tech_5}</a></li>
				<li><a href="?page=techtree&mode=population" title="{$LNG.ls_tech_6}">{$LNG.ls_tech_6}</a></li>
			</ul>
		  </div>
		  <div class="onglet">
			<ul>
				<li><a href="?page=techtree&mode=infra" title="{$LNG.NOUVEAUTE_490}">{$LNG.NOUVEAUTE_491}</a></li>
				<li><a href="?page=techtree&mode=compo"  title="{$LNG.NOUVEAUTE_492}">{$LNG.NOUVEAUTE_493}</a></li>
			</ul>
		  </div>
		 <div class="sous_partie">
		{$LNG.ls_tech_7}
		  </div>
		  
		  <div id="div_liste_requis">
		  
		  {foreach $TechTreeList as $elementID => $requireList}
{if !is_array($requireList)}
<h2 class="titre_corps">{$LNG.ls_tech_1} : {$LNG.tech.$requireList}</h2>
{else}
		  
		 
			  <table style="width : 78%;">
			   {if $elementID == 1201}<tr><td colspan="2"><h3>{$LNG.NOUVEAUTE_423} :</h3></td></tr>{elseif $elementID == 1209}<tr><td colspan="2"><h3>{$LNG.NOUVEAUTE_425} :</h3></td></tr>{elseif $elementID == 1213}<tr><td colspan="2"><h3>{$LNG.NOUVEAUTE_424} :</h3></td></tr>{elseif $elementID == 1216}<tr><td colspan="2"><h3>{$LNG.NOUVEAUTE_428} :</h3></td></tr>{elseif $elementID == 1227}<tr><td colspan="2"><h3>{$LNG.NOUVEAUTE_494} :</h3></td></tr>{elseif $elementID == 1229}<tr><td colspan="2"><h3>{$LNG.NOUVEAUTE_495} :</h3></td></tr>{elseif $elementID == 1232}<tr><td colspan="2"><h3>{$LNG.NOUVEAUTE_496} :</h3></td></tr>{/if}
			 <tr>
					<td style="width : 47%; padding-left : 25px; padding-bottom : 15px;">{$LNG.tech.$elementID} : {*<br><span class="gris"> &gt;= Chasseur</span>*}</td>
					{if $requireList}
		
					<td style="width : 53%; padding-right : 25px; padding-bottom : 15px;">
					{foreach $requireList as $requireID => $NeedLevel}
					<span class="{if $NeedLevel.own < $NeedLevel.count}rouge{else}vert{/if}">{$LNG.tech.$requireID} ({$LNG.tt_lvl} {min($NeedLevel.count, $NeedLevel.own)}/{$NeedLevel.count}) </span>{if !$NeedLevel@last}<br>{/if}{/foreach}</td>
					{else}
					<td style="width : 53%; padding-right : 25px; padding-bottom : 15px;"><span class="orange">{$LNG.ls_tech_8}</span></td>
		
	{/if}
				  </tr>{/if}{/foreach}</table></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}