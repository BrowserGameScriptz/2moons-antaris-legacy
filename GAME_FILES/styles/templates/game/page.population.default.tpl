{block name="title" prepend}{$LNG.ls_popu_1}{/block}
{block name="content"}
<script>
var formationBis = {$formationBis};
</script>
<div id="page_contenu">	<h1>{$LNG.ls_popu_1}</h1>
<div class="onglet">
<ul>		<li><a href="?page=population" title="{$LNG.NOUVEAUTE_467}">{$LNG.NOUVEAUTE_467}</a></li> 		<li><a href="?page=population&mode=flotte" title="{$LNG.NOUVEAUTE_468}">{$LNG.NOUVEAUTE_468}</a></li>	</ul></div>
        

	<div id="div_population" class="centre">   
{if !empty($Message)}
	<h2 class="titre_corps">{$LNG.NOUVEAUTE_343}</h2>
                    {$Message}
{/if}

<h2 class="titre_corps">{$LNG.ls_popu_2}</h2>
              <div class="explication_unite_formation">
                  <div class="production_caserne">
                      {$LNG.ls_popu_3} <b>{$formation}</b>&nbsp;<img src="https://cdngames.antaris-legacy.eu/media/ingame/population/ticket.png" onmouseover="montre('{$LNG.NOUVEAUTE_337}');" onmouseout="cache();" /> {$LNG.ls_popu_4} 
                      (<span style="font-size : 12px; font-style : italic;" class="gris">{$textbot}</span>). 
                  </div>

                  {$LNG.ls_popu_6}
              </div><h2 class="titre_corps">{$LNG.ls_popu_7}</h2>
              
			  <form action="game.php?page=population" method="post">
			  
			

			<!-- On débute l'item population -->
			{foreach $elementList as $ID => $Element}
			{if $ID != 309}
			<input type="hidden" id="totalos_{$ID}" value="{$Element.TotalCost}" name="totalos_{$ID}">
			{/if}
<div class="item_population">
    <!-- Fond de l'item -->
    <div class="fond">
        <!-- On affiche le nom de la population dans un lien qui redirige vers la description de celui-ci -->
        <h2 onclick="location.href='game.php?page=information&id={$ID}';">{$LNG.tech.{$ID}}</h2>
        
        <!-- On affiche le nomdre d'unité pour cette population -->
        <div class="nombre"><span class="orange">{$Element.amount}</span></span> units</div>
        
        <!-- Pour afficher l'image avec une information bulle quand on survole qui permet de connaître les caractéristiques et la description de la population -->
        <div class="image">
           
				<img src="https://cdngames.antaris-legacy.eu/media/ingame/population/{$ID}.jpg" alt="{$LNG.tech.{$ID}}" onmouseover="montre('<!-- Les informations sur la population : prix et description --><div class=\'description_bulle\'>    <!-- On affiche le nom de la population et le niveau -->    <h2>{$LNG.tech.{$ID}} (<span class=\'blanc\'>{$Element.amount}</span>)</h2>    <table>        <tr>            <td colspan=\'{if $ID == 306 || $ID == 307}2{else}1{/if}\'><h3>{$LNG.NOUVEAUTE_324} :</h3></td>            <td><h3>{$LNG.NOUVEAUTE_285} :</h3></td>        </tr>        <tr>            <!-- On affiche les caractèristiques (si c\'est des troupes combattantes, sinon on affiche un message) -->                            {if $ID == 306 || $ID == 307}<td>{else}<td style=\'font-weight : normal; text-align : left; width : 40%;\'>  {/if}               {if $ID == 306} {$LNG.fl_bonus_attack} :<br />                    {$LNG.fl_bonus_shield} :<br />                    {$LNG.NOUVEAUTE_340} :                </td>                <td>                     500<br />                     100<br />                     450    {elseif $ID == 307} {$LNG.fl_bonus_attack} :<br />                    {$LNG.fl_bonus_shield} :<br />                    {$LNG.NOUVEAUTE_340} :                </td>                <td>                     2,500<br />                     500<br />                     2,300   {else}  {$LNG.NOUVEAUTE_339}    {/if}            </td>                                <!-- On affiche la description de la population -->                <td style=\'font-weight : normal; text-align : justify; width : 60%; padding-left : 15px;\'>                   {$LNG.shortDescription.{$ID}}                </td>                    </tr>    </table><div>');" onmouseout="cache();">
				 
				 
        </div>
        
        <!-- Permet de savoir si la population est déboquée -->
		{if !$Element.techacc}
        <div class="action">
            <!-- Si les formations sont impossible pour cette population -->
                            {$LNG.ls_popu_8} « {$LNG.tech.{$ID}} ».
                
            <!-- On peut former la population -->
                    </div>
					{elseif $ID == 309}
					 <div class="action">
            <!-- Si les formations sont impossible pour cette population -->
                            {$LNG.ls_popu_9}
              
            <!-- Si la population est bloquée -->
                    </div>
                    
					{else}
					 <div class="action">
            <!-- Si les formations sont impossible pour cette population -->
                            <table>
                    <tr>
                        <td>{$LNG.ls_popu_10} :</td>
						 {foreach $Element.costRessources as $RessID => $RessAmount}
                        <td><b>{$RessAmount|number}</b> {$LNG.NOUVEAUTE_670}</td>
						{/foreach}
                    </tr>
                    <tr>
                        <td>{$LNG.ls_popu_11} :</td>
                        <td><input  type="text" class="" maxlenght="12" id="population_{$ID}" name="population_{$ID}"
                                    onchange="javascript:calculation({$ID});" 
                                    onkeyup="javascript:calculation({$ID});" 
                                    value="{$Element.Produced}" /> u. / h
                        </td>
                    </tr>
                    <tr>
                        <td>{$LNG.ls_popu_12} :</td>
                        <td><span id="total_{$ID}" name="total_{$ID}">{$Element.TotalCost}</span>
                              &nbsp;<img src="https://cdngames.antaris-legacy.eu/media/ingame/population/ticket.png" onmouseover="montre('{$LNG.NOUVEAUTE_337}');" onmouseout="cache();" />/ hour
                        </td>
                    </tr>
                </table>
                     </div> 
					{/if}
    </div>
</div>
{/foreach}
   <div class="espace"></div>    <h2 class="titre_corps">{$LNG.ls_popu_13}</h2>
                  <div id="msg_affectation_prod">
                      <span class="orange">{$LNG.ls_popu_14}.</span>
                  </div>
                  <div class="conteneur_submit">
                      <input type="submit" id="valid_forming" name="valid_forming" value="{$LNG.ls_bunker_13}" disabled >
                  </div>
                  <div class="espace"></div>
              </form></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}
