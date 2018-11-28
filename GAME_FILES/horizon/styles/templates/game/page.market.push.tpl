{block name="title" prepend}{$LNG.ls_market_1}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.ls_market_1}</h1><div class="onglet">
              <ul>
                  <li><a href="?page=market">{$LNG.ls_market_2}</a></li>
                  <li><a href="?page=market&mode=echange">{$LNG.ls_market_3}</a></li>
				  <li><a href="?page=market&mode=converter" title="{$LNG.NOUVEAUTE_819}">{$LNG.NOUVEAUTE_819}</a></li>
                  <li><a href="?page=market&mode=push" title="Push">{$LNG.ls_market_4}</a></li>
                  <li><a href="?page=market&mode=multi" title="Push">{$LNG.ls_market_5}</a></li> 
              </ul>
          </div><div id="div_commerce"><div id="liste_push" class="categorie">
                <h2>{$LNG.ls_market_37}</h2>
                <table>
                    <tr>
                        <th class="pseudo">{$LNG.ls_market_7}</th>
                        <th class="statut">{$LNG.ls_market_38}</th>
                        <th>Actions</th>
                    </tr>
					{foreach $transportData as $RowId => $Row}
							<tr>
							<td class="pseudo">
								<img src="/media/files/{$Row.avatar}" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();" onclick="location.href='game.php?page=playerCard&id={$Row.infouser}';">
								<span class="joueur">{$Row.change_nick}</span>
								
							</td>
							<td class="statut">
							{if $Row.isInDeletion == 0}
								<b><span class="rouge">{$LNG.ls_market_50} :</span></b>
										  <span class="gris">{$LNG.ls_market_51}</span>
							{else}
								<span class="vert">{$LNG.ls_market_54}</span>
							{/if}
							</td>
							<td class="actions">
								<img src="design/image/jeu/icone/couleur/aide.png" onmouseover="montre('{$LNG.ls_market_52}.');" onmouseout="cache();" onclick="location.href='game.php?page=market&mode=detail&id={$RowId}';">
								<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/profil.png" onclick="location.href='game.php?page=playerCard&id={$Row.infouser}';" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();"/>
								<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/contact.png" onclick="location.href='game.php?page=messages&mode=write&id={$Row.infouser}';" onmouseover="montre('{$LNG.ls_click_2}');" onmouseout="cache();"/> 
							</td>
						</tr>
					{foreachelse}
					<tr><td colspan="3" style="text-align : center;" class="vert">{$LNG.ls_market_40}</td></tr>
					{/foreach}


					</table>
              </div><div class="legende_commerce gris">
              {$LNG.ls_market_39}
          </div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}
