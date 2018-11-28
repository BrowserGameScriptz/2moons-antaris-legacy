{block name="content"}
 <div class="categorie" id="resulttable">
				<h2>{$LNG.NOUVEAUTE_50} : <span id="info_resultat"><span class="orange">{$LNG.NOUVEAUTE_57}</span> </span></h2>
				<div id="recherche_resultat">      <table class="joueur">
					<tbody><tr>
						<th>N°</th>
						<th class="nom">{$LNG.NOUVEAUTE_12}</th>
						<th>{$LNG.NOUVEAUTE_13}</th>
						<th>{$LNG.NOUVEAUTE_56}</th>
						<th class="fondateur">{$LNG.NOUVEAUTE_14}</th>
						<th></th>
					</tr>
					
					{foreach $searchList as $searchRow}
<tr class="{if $searchRow.allyid == $searchRow.Myally}its_me{/if}">
					<td class="classement">
						{if $searchRow.total_rank == 1}
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/trophee_1.png" />
						{elseif $searchRow.total_rank == 2}
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/trophee_2.png" />
						{elseif $searchRow.total_rank == 3}
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/trophee_3.png" />
						{else}{$searchRow.total_rank}{/if}
					</td>
					<td class="nom">
						<span class="nom">{$searchRow.allyname}</span>
						<a onclick="location.href='game.php?page=alliance&amp;mode=info&amp;id={$searchRow.allyid}';" title="{$LNG.NOUVEAUTE_15}" class="couleur_alliance">[{$searchRow.allytag}]</a>
					</td>
					<td class="valeur_champ">
						<span class="couleur_theme">{$searchRow.allypoints}</span> 
						<span style="font-size : 0.8em;">{$LNG.NOUVEAUTE_18}
					</span></td>
					<td class="recrutement">
					{if $searchRow.ally_request_notallow == 1}
					<span class="rouge">{$LNG.ls_answer_2}</span></td>
					{else}
					<span class="vert">{$LNG.ls_answer_1}</span></td>
					{/if}
					<td class="fondateur">
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/profil.png" onclick="location.href='game.php?page=playerCard&id={$searchRow.allyowners}';" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();">
						{$searchRow.allyowner}
					</td>
					<td class="actions">
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/rapport.png" onmouseover="montre('{$LNG.NOUVEAUTE_17}');" onmouseout="cache();" onclick="location.href='game.php?page=alliance&amp;mode=info&amp;id={$searchRow.allyid}';">
						
						{if $searchRow.ally_request_notallow == 0}<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/recrutement.png" onclick="location.href='game.php?page=alliance&mode=search&ally={$searchRow.allytag}';" onmouseover="montre('{$LNG.NOUVEAUTE_19}');" onmouseout="cache();" >{/if}
					</td>
				</tr>
				{/foreach}
				
				</tbody></table></div>
			  </div>   
{/block} 