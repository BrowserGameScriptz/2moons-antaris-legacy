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
          </div><div id="div_commerce"><div id="liste_pacte" class="categorie">
		  {if !empty($Message)}<div style="margin : 2px 0px 22px 0px;" class="{$MsgColor}">{$Message}</div>{/if}
            <h2>{$LNG.ls_market_6}</h2>
            
            <table class="joueur">
                <tr>
                    <th>N°</th>
                    <th class="pseudo">{$LNG.ls_market_7}</th>
                    <th class="statut_pacte">{$LNG.ls_market_8}</th>
                    <th>{$LNG.ls_market_20}</th>
                    <th>{$LNG.ls_market_21}</th>
                </tr> 

				<tr class="sous_titre"><td colspan="5"><h3>{$LNG.ls_market_9} :</h3></td></tr>
				{foreach $myBuddyList as $myBuddyID => $myBuddyRow}
<tr>
                        <td class="classement">
                            {$myBuddyRow.rank}
                        </td>
                        <td class="pseudo">
                           <img src="/media/files/{$myBuddyRow.avatar}" onclick="location.href='game.php?page=PlayerCard&id={$myBuddyRow.id}';" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();" 
							   />
                            <span class="joueur">{$myBuddyRow.username}</span> {if {$myBuddyRow.ally_name}} <a onclick="location.href='game.php?page=alliance&amp;mode=info&amp;id={$myBuddyRow.ally_id}';" title="{$LNG.NOUVEAUTE_15}" class="couleur_alliance">[{$myBuddyRow.ally_tag}]</a>{/if}
                            
                        </td>
                        <td class="statut_pacte">
                            <b>{$LNG.ls_market_10} </b> {$myBuddyRow.signtime}
                        </td>
                        <td class="statut">
                            <span class="orange">{$LNG.NOUVEAUTE_163}</span>
                        </td>
						{if $myBuddyRow.sender == $userID}
                        <td class="actions">
                            <img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/profil.png" onclick="location.href='game.php?page=playerCard&id={$myBuddyRow.id}';" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();"/>
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/contact.png" onclick="location.href='game.php?page=messages&mode=write&id={$myBuddyRow.id}';" onmouseover="montre('{$LNG.ls_click_2}');" onmouseout="cache();" /> 
                        </td>
						{else}
						<td class="actions">
                            <img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/accepter.png" onmouseover="montre('{$LNG.NOUVEAUTE_211}');" onmouseout="cache();" onclick="location.href='game.php?page=market&amp;action=accept&amp;id={$myBuddyID}';"> 
                           <img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/refuser.png" onmouseover="montre('{$LNG.NOUVEAUTE_212}');" onmouseout="cache();" onclick="location.href='game.php?page=market&amp;action=delete&amp;id={$myBuddyID}';">
                           <img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/profil.png" onclick="location.href='game.php?page=playerCard&id={$myBuddyRow.id}';" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();"/>
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/contact.png" onclick="location.href='game.php?page=messages&mode=write&id={$myBuddyRow.id}';" onmouseover="montre('{$LNG.ls_click_2}');" onmouseout="cache();" /> 
                        </td>
						{/if}
						
                    </tr>
{foreachelse}
<tr class="message_pas_pacte"><td colspan="5">{$LNG.ls_market_11}</td></tr>
					{/foreach}

				<tr class="sous_titre"><td colspan="5"><h3>{$LNG.ls_market_12} :</h3></td></tr>
				{foreach $myBuddyList1 as $myBuddyID => $myBuddyRow}
<tr>
                        <td class="classement">
                            {$myBuddyRow.rank}
                        </td>
                        <td class="pseudo">
                           <img src="/media/files/{$myBuddyRow.avatar}" onclick="location.href='game.php?page=PlayerCard&id={$myBuddyRow.id}';" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();" 
							   />
                            <span class="joueur">{$myBuddyRow.username}</span> 
                           {if {$myBuddyRow.ally_name}} <a onclick="location.href='game.php?page=alliance&amp;mode=info&amp;id={$myBuddyRow.ally_id}';" title="{$LNG.NOUVEAUTE_15}" class="couleur_alliance">[{$myBuddyRow.ally_tag}]</a>{/if}
							
							
                        </td>
                        <td class="statut_pacte">
                            <b>{$LNG.ls_market_13} </b> {$myBuddyRow.signtime}
                        </td>
                        <td class="statut">
                            {if $myBuddyRow.onlinetime < 15}
						<span class="vert">{$LNG.bu_connected}</span>
						{elseif $myBuddyRow.onlinetime >= 15 && $myBuddyRow.onlinetime <= 60}
                        <span class="orange">{$myBuddyRow.onlinetime} minutes</span>
						{else}
						<span class="rouge">{$LNG.bu_disconnected}</span>
						{/if}
                        </td>
                        <td class="actions">
                       <img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/rompre.png" onmouseover="montre('{$LNG.NOUVEAUTE_213}');" onmouseout="cache();" onclick="location.href='game.php?page=market&amp;action=end&amp;id={$myBuddyID}';">
                            <img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/profil.png" onclick="location.href='game.php?page=playerCard&id={$myBuddyRow.id}';" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();"/>
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/contact.png" onclick="location.href='game.php?page=messages&mode=write&id={$myBuddyRow.id}';" onmouseover="montre('{$LNG.ls_click_2}');" onmouseout="cache();" /> 
                        </td>
                    </tr>
{foreachelse}
<tr class="message_pas_pacte"><td colspan="5">{$LNG.ls_market_14}</td></tr>
					{/foreach}
				 

				<tr class="sous_titre"><td colspan="5"><h3>{$LNG.ls_market_15} :</h3></td></tr>
				
				{foreach $myBuddyList2 as $myBuddyID => $myBuddyRow}
<tr>
                        <td class="classement">
                            {$myBuddyRow.rank}
                        </td>
                        <td class="pseudo">
                           <img src="/media/files/{$myBuddyRow.avatar}" onclick="location.href='game.php?page=PlayerCard&id={$myBuddyRow.id}';" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();" 
							   />
                            <span class="joueur">{$myBuddyRow.username}</span> {if {$myBuddyRow.ally_name}} <a onclick="location.href='game.php?page=alliance&amp;mode=info&amp;id={$myBuddyRow.ally_id}';" title="{$LNG.NOUVEAUTE_15}" class="couleur_alliance">[{$myBuddyRow.ally_tag}]</a>{/if}
                            
                        </td>
                        <td class="statut_pacte">
                            <b>{$LNG.ls_market_16} </b> {$myBuddyRow.signtime}
                        </td>
                        <td class="statut">
						 <span class="orange">{$LNG.NOUVEAUTE_163}</span>
                        </td>
                        <td class="actions">
                            
                            <img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/profil.png" onclick="location.href='game.php?page=playerCard&id={$myBuddyRow.id}';" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();"/>
						<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/contact.png" onclick="location.href='game.php?page=messages&mode=write&id={$myBuddyRow.id}';" onmouseover="montre('{$LNG.ls_click_2}');" onmouseout="cache();" /> 
                        </td>
                    </tr>
{foreachelse}
<tr class="message_pas_pacte"><td colspan="5">{$LNG.ls_market_17}</td></tr>
					{/foreach}
				
				
				</table>
          </div><div id="liste_pacte_automatique" class="categorie">
                <h2>{$LNG.ls_market_18}</h2>
				
				{foreach $multiData as $messageID => $xb}
				<div class="pacte_automatique">
                         <img src="/media/files/{$xb.avatar}" onclick="location.href='game.php?page=PlayerCard&id={$messageID}';" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();">
                         <span class="joueur">{$xb.change_nick}</span>
                         <a onclick="location.href='game.php?page=alliance&amp;mode=info&amp;id={$xb.allyid}';" onmouseover="montre('{$LNG.ls_click_3}');" onmouseout="cache();" class="couleur_alliance">{$xb.nickname_ally}</a>
                  </div>
				 {/foreach}
						  </div>
              <div class="legende_commerce gris">	
                  {$LNG.ls_market_19}
              </div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}
