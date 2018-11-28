<div id="statistique_resultat">      <table class="alliance">
					<tbody><tr>
						<th>N°</th>
						<th class="nom">{$LNG.NOUVEAUTE_12}</th>
						<th>{$LNG.NOUVEAUTE_13}</th>
						<th>{$LNG.ls_alliance_32}</th>
						<th class="fondateur">{$LNG.NOUVEAUTE_14}</th>
						<th></th>
					</tr>
					
					{foreach name=RangeList item=RangeInfo from=$RangeList}

					<tr {if $RangeInfo.id == $CUser_ally}class="its_me"{/if}>
					<td class="classement">
						{if $RangeInfo.rank == 1}
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/trophee_1.png" />
						{elseif $RangeInfo.rank == 2}
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/trophee_2.png" />
						{elseif $RangeInfo.rank == 3}
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/trophee_3.png" />
						{else}{$RangeInfo.rank}{/if}
					</td>
					<td class="nom">
						<span class="nom">{$RangeInfo.name}</span>
						<a onclick="parent.location = 'game.php?page=alliance&amp;mode=info&amp;id={$RangeInfo.id}';return false;" title="{$LNG.NOUVEAUTE_15}" class="couleur_alliance">[{$RangeInfo.tag}]</a>
					</td>
					<td class="valeur_champ">
						<span class="couleur_theme">{$RangeInfo.points}</span> 
						<span style="font-size : 0.8em;">{$LNG.NOUVEAUTE_18}
					</span></td>
					<td class="recrutement"><span class="{if $RangeInfo.ally_request_notallow == 1}rouge{else}vert{/if}">{if $RangeInfo.ally_request_notallow == 1}{$LNG.ls_answer_2}{else}{$LNG.ls_answer_1}{/if}</span></td>
					<td class="fondateur">
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/profil.png" onclick="location.href='game.php?page=playerCard&id={$RangeInfo.ally_owner}';" onmouseover="montre('{$LNG.NOUVEAUTE_16}');" onmouseout="cache();" >
						{$RangeInfo.usernale}
					</td>
					<td class="actions">
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/rapport.png" onclick="location.href='game.php?page=alliance&amp;mode=info&amp;id={$RangeInfo.id}';" onmouseover="montre('{$LNG.NOUVEAUTE_17}');" onmouseout="cache();" >
						
						{if $RangeInfo.ally_request_notallow == 0}<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/recrutement.png" onclick="location.href='game.php?page=alliance&mode=search&ally={$RangeInfo.tag}';" onmouseover="montre('{$LNG.NOUVEAUTE_19}');" onmouseout="cache();" >{/if}
						
					</td>
				</tr>
				{/foreach}
			</table>	</div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
			
			