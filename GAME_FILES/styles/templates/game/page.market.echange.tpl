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
          </div><div id="div_commerce"><div id="liste_echange" class="categorie">
            <h2>{$LNG.ls_market_32} ({$GeTransportCount})</h2>
            <table>
                <tr class="normal">
                    <th>{$LNG.ls_achivement_7}</th>
                    <th class="pseudo">{$LNG.ls_market_7}</th>
                    <th class="date_echange">{$LNG.lm_redeem_14}</th>
                    <th class="valeur_echange">{$LNG.ls_market_33}</th>
                    <th></th>
                </tr>
				
				<tr class="normal"> 
				{foreach $transportData as $RowId => $Row}
						<tr class="normal">
                      <td class="statut">
                          <span class="badge_commerce {$Row.status}">{$Row.statusbis}</span>
                      </td>
                      <td class="pseudo">
                          <img src="/media/files/{$Row.avatar}" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();" onclick="location.href='game.php?page=playerCard&id={$Row.infouser}';">
                            <span class="joueur {$Row.strongest}">{$Row.change_nick}</span>
                            
                      </td>
                      <td class="date_echange">
                          {$Row.timeoftransport}
                      </td>
                      <td class="valeur_echange">
                          <span class="couleur_theme">{$Row.PushValue}</span> 
                          <span style="font-size : 0.9em;">{$LNG.lm_achat_units}</span>
                      </td>
                      <td class="actions">
                          <img src="design/image/jeu/icone/couleur/aide.png" onmouseover="montre('{$LNG.NOUVEAUTE_160}');" onmouseout="cache();" onclick="javascript:Commerce.afficherDetailEchange('{$RowId}');">
                      </td>
                    </tr>
                    <tr id="detail_echange_{$RowId}" class="detail_echange no_display">
                      <td colspan="5"> <div class="item_echange">
                          <h3>{$LNG.NOUVEAUTE_572} :</h3> {foreach $Row.ResourceSendArray as $ResId => $Count}- {$LNG.tech.$ResId} : <span class="couleur_theme">{$Count}</span><br>{foreachelse}<i>{$LNG.NOUVEAUTE_766}</i>{/foreach}</div>
                        <div class="item_echange">
                          <h3>{$LNG.ls_tech_4} :</h3>{foreach $Row.SDevicesSendArray as $DevId => $Count}- {$LNG.tech.$DevId} : <span class="couleur_theme">{$Count}</span><br>{foreachelse}<i>{$LNG.NOUVEAUTE_768}</i>{/foreach}</div>
                        <div class="item_echange">
                          <h3>{$LNG.ls_tech_6} :</h3>{foreach $Row.PopulatiSendArray as $PopId => $Count}- {$LNG.tech.$PopId} : <span class="couleur_theme">{$Count}</span><br>{foreachelse}<i>{$LNG.NOUVEAUTE_767}</i>{/foreach}</div></td>
                    </tr>
				{foreachelse}
				<td colspan="5" style="text-align : center;" class="vert">{$LNG.ls_market_34}</td>
				{/foreach}
				
				</tr>  </table></div>
          <div class="legende_commerce gris">
              <b>{$LNG.lm_title_6} :</b><br />
              - {$LNG.ls_market_35}<br /> 
              - {$LNG.ls_market_36}
          </div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}
