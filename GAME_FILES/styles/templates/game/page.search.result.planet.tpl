{block name="content"}
 <div class="categorie" id="resulttable">
				<h2>{$LNG.NOUVEAUTE_50} : <span id="info_resultat"><span class="orange">{$LNG.NOUVEAUTE_54}</span></span></h2>
				<div id="recherche_resultat">      <table class="joueur">
					<tbody><tr>
						
						<th>N°</th>
						<th class="pm">{$LNG.NOUVEAUTE_53}</th>
						<th class="pseudo">{$LNG.NOUVEAUTE_52}</th>
						<th>+/-</th>
						<th>{$LNG.NOUVEAUTE_13}</th>
						<th></th>
					</tr>
					
					{foreach $searchList as $searchRow}
<tr class="">
					<td class="classement">
						{if $searchRow.rank == 1}
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/trophee_1.png" />
						{elseif $searchRow.rank == 2}
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/trophee_2.png" />
						{elseif $searchRow.rank == 3}
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/trophee_3.png" />
						{else}{$searchRow.rank}{/if}
					</td>
					<td class="pm">
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/planete.png" onmouseover="montre('{$searchRow.showdiapla}');" onmouseout="cache();" onclick="location.href='game.php?page=galaxy&amp;galaxy={$searchRow.galaxy}&amp;system={$searchRow.system}';" >
						{$searchRow.planetname} {if $searchRow.planetcloak > $searchRow.timer}[***:**] 
		{else}[{$searchRow.system}:{$searchRow.planet}]{/if}
					</td>
					<td class="pseudo">
						<img src="/media/files/{$searchRow.avatar}" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();" onclick="location.href='game.php?page=playerCard&id={$searchRow.userid}';">
						<span class="joueur">{$searchRow.username}</span>
						
						{if $searchRow.allyid != 0}<a onclick="location.href='game.php?page=alliance&amp;mode=info&amp;id={$searchRow.allyid}';" title="{$LNG.NOUVEAUTE_15}" class="couleur_alliance">[{$searchRow.allytag}]</a>{/if}
					</td>
					<td class="progression"><span class="vert">+2</span></td>
					<td class="points">
						<span class="couleur_theme">{$searchRow.total_points}</span> 
						<span style="font-size : 0.8em;">pts</span>
					</td>
					<td class="actions">
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/profil.png" onclick="location.href='game.php?page=playerCard&id={$searchRow.userid}';" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();"
							  />
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/contact.png" onclick="location.href='game.php?page=messages&mode=write&id={$searchRow.userid}';" onmouseover="montre('{$LNG.ls_click_2}');" onmouseout="cache();"
							  />   
					</td>
				</tr>
				{/foreach}
				
				</tbody></table></div>
			  </div>   
{/block}