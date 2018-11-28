{block name="title" prepend}{$LNG.lm_info}{/block}
{block name="content"}
<div id="page_contenu"><!-- La description du bâtiment -->
<h1>{$LNG.NOUVEAUTE_285}: {$LNG.tech.$elementID}</h1>

<!-- L'item de description détaillée -->
<div class="item_description">
    <!-- D'abord, l'image du bâtiment -->
    <div class="image">
        <img src="{$dpath}gebaeude/{$elementID}.{if $elementID < 200}jpg{elseif $elementID > 200 && $elementID < 300}gif{elseif $elementID > 300 && $elementID < 400}jpg{elseif $elementID > 400 && $elementID < 800}gif{elseif $elementID > 800 && $elementID < 900}jpg{else}gif{/if}" alt="Image du bâtiment : {$LNG.tech.$elementID}" />
        <div class="calque_img"></div>
        
        <!-- Pour lancer une démolition d'un niveau -->
                    {if $elementID > 100}<span class="rouge">{$LNG.NOUVEAUTE_639}</span>{else}
					<a class="rouge" onclick="javascript:ActionMethode.ouvrirPopUp('demolir_construction_bat_{$elementID}');" title="{$LNG.NOUVEAUTE_848}">{$LNG.NOUVEAUTE_847}</a>
					{/if}
        
                    </div>

    <!-- Puis, les informations -->
    <div class="information">
        <!-- La description complète du bâtiment -->
        <div class="description">{$LNG.longDescription.$elementID}</div>
{if $number == 1}
        <!-- Si le bâtiment a un effet, on l'affiche -->
                    <h2 class="titre_corps">{$LNG.NOUVEAUTE_640}</h2>
					
            <div class="effet">{$elementBonus}</div>
                {/if}
        <!-- On affiche les pré-requis pour débloquer le bâtiment -->
        <h2 class="titre_corps">{$LNG.NOUVEAUTE_641}</h2>
        <div class="pre_requis">
		{foreach from=$AllTech item=i key=k}
		<span class="vert">{$LNG.tech.{$i.requireID}}, lvl. {$planetinfo{$i.requireID}} <i>({$i.requireLevel})</i></span><br />
		{foreachelse}
		<span class="orange">{$LNG.ls_tech_8}</span>
		{/foreach}
		
		
		</div>

        <!-- Les centrales, les mines, les extracteurs, la caserne, l'usine, le laboratoire et l'avant poste des Antaris : on affiche leurs productions -->
 {if $elementID < 100}
<!-- La fenêtre pop-up qui permet de lancer une destruction de bâtiment -->
<div id="demolir_construction_bat_{$elementID}" class="popup_texte">
    <h1>{$LNG.NOUVEAUTE_849}</h1>
    <p>{$LNG.NOUVEAUTE_850} : {$LNG.tech.$elementID} ?</p>
    
    <div class="sous_partie">
        {$LNG.NOUVEAUTE_851} :
        <div class="sous_partie" style="padding-top : 0px;">
                    {foreach $destroyRessources as $ResType => $ResCount}- {$ResCount|number} unités de {$LNG.tech.{$ResType}}<br />{/foreach}
                          
                </div>
        {$LNG.NOUVEAUTE_852} : {$destroyTime|time}
    </div>
    <div class="centre"> 
        <form action="" method="post">
            <input style="margin-right : 8px;" type="button" value="{$LNG.NOUVEAUTE_289}" onclick="javascript:ActionMethode.fermerPopUp(); 
                    location.href='game.php?page=information&cmd=destroy&id={$elementID}';" />
            <input style="margin-left : 8px;" type="button" value="{$LNG.NOUVEAUTE_278}" onclick="javascript:ActionMethode.fermerPopUp();" />
        </form>
    </div> 
    </div>
{/if}	
            
{if !empty($productionTable.production)}
<!-- On affiche un tableau avec les productions du bâtiment -->
            <h2 class="titre_corps">{$LNG.NOUVEAUTE_642}</h2>
            <div class="tableau_production">
                {$LNG.NOUVEAUTE_643}
            </div>
{include file="shared.information.production.tpl"}
{elseif !empty($productionTable.storage)}
<!-- On affiche un tableau avec les productions du bâtiment -->
            <h2 class="titre_corps">{$LNG.NOUVEAUTE_644}</h2>
            <div class="tableau_production">
               {$LNG.NOUVEAUTE_643}
            </div>
{include file="shared.information.storage.tpl"}
{elseif !empty($FleetInfo)}
{include file="shared.information.shipInfo.tpl"}
{elseif !empty($gateData)}
{include file="shared.information.gate.tpl"}
{elseif !empty($MissileList)}
{include file="shared.information.missiles.tpl"}
{elseif !empty($ResearchList)}
{include file="shared.information.research.tpl"}
{else}
</div>
</div>

<a onclick="history.go(-2)" title="{$LNG.NOUVEAUTE_646}">{$LNG.NOUVEAUTE_646}</a>

</div>
    {/if}
{/block}