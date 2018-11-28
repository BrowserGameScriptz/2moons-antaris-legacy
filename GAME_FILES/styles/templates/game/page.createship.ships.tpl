{block name="title" prepend}{$LNG.NOUVEAUTE_387}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.NOUVEAUTE_387}</h1><div class="onglet">
              <ul>
                 <li><a href="?page=CreateShip&mode=ships" title="{$LNG.NOUVEAUTE_379}">{$LNG.NOUVEAUTE_380}</a></li> 
                  <li><a href="?page=CreateShip" title="{$LNG.NOUVEAUTE_381}">{$LNG.NOUVEAUTE_382}</a></li> 
                  <li><a href="?page=CreateShip&mode=pieces" title="{$LNG.NOUVEAUTE_383}">{$LNG.NOUVEAUTE_384}</a></li> 
                   <li><a href="?page=CreateShip&mode=flotte" title="{$LNG.NOUVEAUTE_385}">{$LNG.NOUVEAUTE_386}</a></li>
              </ul>
          </div>
          <div id="div_vaisseau"><h2 class="titre_corps">{$LNG.NOUVEAUTE_397}</h2>
		  
		  
		  {if !empty($BuildList)}
<table style="width:760px">
	<tr>
		<td class="transparent">
			
			<form action="game.php?page=shipyard&amp;mode=" method="post">
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
<div id="div_liste_construction" class="centre"><i>{$LNG.NOUVEAUTE_398}</i></div>
{/if}
		  
		  
		  
		  
		  <div id="div_liste_vaisseau" class="centre"><h2 class="titre_corps">{$LNG.NOUVEAUTE_380}</h2><!-- On débute l'item vaisseau -->
		  

		   {foreach $shipData as $varId => $xb}
		   <form action="game.php?page=CreateShip&amp;mode=ships" method="post">
<div class="item grand">
    <!-- On affiche le nom du vaisseau dans un lien qui redirige vers la description de celui-ci -->
    <div class="titre">
        <a onclick="return false;"  
           class="titre_contour">{$xb.nom}</a>
    </div>
 

    <!-- Pour afficher l'image avec une information bulle quand on survole qui permet de connaître le prix et la description du vaisseau -->
    <div class="image">
        <img src="{$xb.image}" alt="{$LNG.NOUVEAUTE_811} : {$xb.nom}" 
             onmouseover="montre('<!-- Les informations sur le vaisseau : prix, infrastructure et composants --><div class=\'description_bulle\'>    <!-- On affiche le nom du vaisseau et le nombre -->    <h2>{$xb.nom} (<span class=\'blanc\'>0</span>)</h2>    <table>        <tr>            <td colspan=\'2\'><h3>{$LNG.NOUVEAUTE_324} :</h3></td>            <td><h3>{$LNG.NOUVEAUTE_388}:</h3></td>        </tr>        <tr>            <!-- On affiche le prix en ressource, les caractèristiques ainsi que le temps de construction -->            <td>                {$LNG.tech.901} :<br />                {$LNG.tech.902} :<br />                {$LNG.tech.903} :<br />                {$LNG.tech.904} :<br />                                {$LNG.NOUVEAUTE_323} :<br /><br />                                {$LNG.NOUVEAUTE_389} :<br />    {$LNG.NOUVEAUTE_420} <br />                            {$LNG.NOUVEAUTE_390} :<br />                {$LNG.NOUVEAUTE_391} :<br />{$LNG.NOUVEAUTE_392} :<br />                {$LNG.NOUVEAUTE_393} :<br />            </td>            <td>                {$xb.cost901}<br />                 {$xb.cost902}<br />                 {$xb.cost903}<br />                 {$xb.cost904}<br />                                {$xb.constructionTime}s<br /><br />                                 {$xb.shipAttack}<br />                                 {$xb.shipBouclier}<br />     {$xb.shipCoque}<br />              {$xb.speedpercent}%<br /><span class=\'rouge\'>Non</span><br />                      {$xb.shipFret}<br />            </td>                        <!-- On affiche l\'infrastructure du vaisseau et la liste des composants nécessaires -->            <td>                <b>{$LNG.NOUVEAUTE_394} :</b> <span class=\'couleur_theme\'>{$xb.shipType}</span><br />                <b>{$LNG.NOUVEAUTE_395} :</b>                <div style=\'padding-left : 15px;\'>                                       {foreach from=$xb.AllComposant item=i key=k} - {$i}<br />  {/foreach} </div>            </td>        </tr>        <tr>            <td colspan=\'3\' class=\'gris\' style=\'padding-top : 10px; text-align : center;\'>                {$xb.maxBuildable}            </td>        </tr>    </table><div>');" onmouseout="cache();" />
    </div>
    
    <!-- Permet de savoir si le vaisseau est constructible -->
    <div class="action">
        {if $xb.AllTechB != 0}
			<span class="rouge" onmouseover="montre('<b>Pour débloquer ce vaisseau :</b><div style=\'padding : 3px 0px 0px 15px;\'>{foreach $xb.AllTech as $elementID => $requireList}{foreach $requireList as $requireID => $NeedLevel}<span class=\'rouge\'>{$LNG.tech.{$requireID}}, {$LNG.NOUVEAUTE_311} {$NeedLevel.count} <i>({$NeedLevel.own})</i></span><br />{/foreach}{/foreach}</div>');" onmouseout="cache();" style="cursor : help;"><b>{$LNG.NOUVEAUTE_287}</b></span>
        {elseif !$xb.buyable}
			<span class="orange" style="cursor : help;"><b>{$LNG.NOUVEAUTE_309}</b></span>		
		{elseif $xb.buyable}
			<input class="entier" size="{$maxlength}" maxlength="{$maxlength}" id="input_{$varId}" name="fmenge[{$varId}]" value="0" type="text" tabindex="{$smarty.foreach.FleetList.iteration}">
			<input value="Max." type="button" onclick="$('#input_{$varId}').val('{$xb.maxBuildableB}')">
		{/if}	
    </div>
    
    <!-- On affiche le nomdre d'unité pour ce vaisseau dans un degradé noir -->
    <div class="nombre">{$xb.getShipCount}</div>
</div>
</form>
{/foreach}

<div class="espace"></div>

              <span class="gris" style="display : block; margin-top : 10px;">
                  {$LNG.NOUVEAUTE_396}
              </span></div></div></div>    
<script type="text/javascript">
data			= {$BuildList|json};
bd_operating	= '{$LNG.bd_operating}';
bd_available	= '{$LNG.bd_available}';
</script>
{/block}
