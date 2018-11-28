{block name="title" prepend}{$LNG.NOUVEAUTE_504}{/block}
{block name="content"}
<form action="game.php?page=messages" method="post">
<input type="hidden" name="mode" value="action">
<input type="hidden" name="ajax" value="1">
<input type="hidden" name="messcat" value="{$MessID}">
<input type="hidden" name="side" value="{$page}">
<div id="page_contenu"><h1>{$LNG.NOUVEAUTE_504}</h1>
          <div id="page_messagerie"><div id="affichage_onglet" class="categorie">
                 <h2>{$LNG.NOUVEAUTE_288} : <span class="{$LNG.mg_color.{$MessID}}">{$LNG.mg_type.{$MessID}}</span> ({$MessageCount})</h2>
                  <div class="etiquette">{$MessageCountBis}</div>

                  <div class="retour_page">
                      << <a href="?page=messages">{$LNG.NOUVEAUTE_509}</a>
                  </div>
                  <div class="action_onglet">
                      
                  </div>
                  <table class="liste_message">
                      <tr class="normal">
                          <th></th>
                          <th></th>
                          <th class="sujet_message">{$LNG.NOUVEAUTE_510}</th>
                          <th></th>
                          <th class="date_message">{$LNG.NOUVEAUTE_511}</th>
                          <th class="actions">{$LNG.NOUVEAUTE_512}</th>
                      </tr>
					  
					  {foreach $MessageList as $Message}
					  <tr id="titre_message_{$Message.id}" class="normal">
                      <td class="avatar">
                          {if $MessID == 1} <img src="/media/files/{$Message.avatar}" onmouseover="montre('{$LNG.ls_click_1}');" onmouseout="cache();" 
                               onclick="location.href='game.php?page=playerCard&id={$Message.from}';"  />{/if}
                      </td>
					  
                      <td class="conversation">
					  {if $MessID == 1}
                                   <img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/conversation.png" onmouseover="montre('{$LNG.NOUVEAUTE_515}.');" onmouseout="cache();"
                                         />
                             {/if}   </td>
                      <td class="sujet_message">
                          <span class="titre">
                              
                              {$LNG.ls_alliance_62} : <a onclick="javascript:Messagerie.afficherMessage('{$Message.id}', '{$MessID}', '{$page}');">{$Message.subject}</a>
                          </span><br />
                          {if $MessID == 2}<i>{$LNG.NOUVEAUTE_516}</i> <a onclick="location.href='game.php?page=playerCard&id={$Message.from}';">{$Message.from}</a>{elseif $MessID == 1}<i>{$LNG.NOUVEAUTE_516}</i> <a onclick="location.href='game.php?page=playerCard&id={$Message.from}';">{$Message.from}</a>{else}{$Message.from}{/if}
						  
                      </td>
                      <td class="checkbox">
					  {if $MessID != 999}<input name="messageID[{$Message.id}]" value="1" type="checkbox">{/if}
				</td>
                      <td class="date_message">{$Message.time}</td>    <td class="actions">
                          <img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/sauvegarder.png" onmouseover="montre('{$LNG.NOUVEAUTE_517}');" onmouseout="cache();"
                                        onclick="javascript:Messagerie.sauvegarderMessage('{$Message.id}', '{$MessID}', '{$page}');" />
                          <img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/corbeille.png" onmouseover="montre('{$LNG.NOUVEAUTE_518}');" onmouseout="cache();"
                               onclick="msgDel({$Message.id}, {$Message.type}); Message.getMessages({$Message.type}); return false;" />
                      </td></tr>
                  <tr id="contenu_message_{$Message.id}" class="contenu_message no_display">
                      <td colspan="1"></td>
                      <td colspan="6">
                          <div {if $MessID == 0}name="espionnage"{elseif $MessID == 1}class="bbcode"{elseif $MessID == 2}class="bbcode"{elseif $MessID == 3}name="attaque_spatial"{elseif $MessID == 6}name="attaque_portail"{/if} class="conteneur_message">{$Message.text}</div>
                         
						  {if $Message.type == 1 && $MessID != 999}
						   <div class="barre_action">
                             <a href="game.php?page=messages&mode=write&id={$Message.sender}" title="{$LNG.mg_answer_to} {strip_tags($Message.from)}">{$LNG.NOUVEAUTE_519}</a>
							 </div>
                              {/if}
                          
                      </td>
                  </tr>   
				  {foreachelse}
				  <tr class="normal"><td colspan="8" style="text-align : center;" class="vert">{$LNG.NOUVEAUTE_514}</td></tr>
{/foreach}



				  </table>    
				  {if $MessID != 999}
				  <div class="gestion_formulaire">    
                          <label for="action">{$LNG.NOUVEAUTE_512} : </label>
                         <select name="actionBottom">
				<option value="deletemarked">{$LNG.mg_delete_marked}</option>
				<option value="deleteunmarked">{$LNG.mg_delete_unmarked}</option>
				<option value="deletetypeall">{$LNG.mg_delete_type_all}</option>
				<option value="deleteall">{$LNG.mg_delete_all}</option>
			</select>
                          <input type="submit" id="valid_form" name="submitBottom" value="{$LNG.NOUVEAUTE_513}" />
                    </div>{/if}   </form>    
					  
					  
                  <div class="gestion_pagination">    </div>
              </div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}