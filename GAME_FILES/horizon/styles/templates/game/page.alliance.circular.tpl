{block name="title" prepend}{$LNG.NOUVEAUTE_81}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.NOUVEAUTE_81}</h1>
<div class="onglet">
<ul>		

	<li><a href="?page=alliance" title="{$LNG.ls_alliance_26}">{$LNG.ls_alliance_25}</a></li>
	{if $rights.ADMIN}<li><a href="?page=alliance&mode=admin" title="{$LNG.ls_alliance_27}">{$LNG.ls_alliance_27}</a></li>{/if}
	<li><a href="?page=alliance&mode=pactes" title="{$LNG.ls_alliance_29}">{$LNG.ls_alliance_28}</a></li>	
	{if $userID == 1}<li><a href="?page=alliance&mode=wars" title="{$LNG.NOUVEAUTE_689}">{$LNG.NOUVEAUTE_688} <span class="blanc">(0)</span></a></li>{/if}
	{if $rights.RANKS}<li><a href="?page=alliance&mode=ranksissue" title="{$LNG.ls_alliance_30}">{$LNG.ls_alliance_31}</a></li>		{/if}
	{if $rights.MANAGEAPPLY}<li><a href="?page=alliance&mode=recruitAlly" title="{$LNG.ls_alliance_33}t">{$LNG.ls_alliance_32}</a></li>	{/if}	
	{if $rights.MEMBERLIST}<li><a href="?page=alliance&mode=memberList" title="{$LNG.ls_alliance_35}">{$LNG.ls_alliance_34}</a></li>		{/if}
	{if $rights.ROUNDMAIL}<li><a href="?page=alliance&mode=circular" title="{$LNG.ls_alliance_37}">{$LNG.ls_alliance_36}</a></li>	{/if}
	{if $rights.ADMIN}<li><a href="?page=alliance&mode=leaveAlly" title="{$LNG.ls_alliance_38}">{$LNG.ls_alliance_39}</a></li>{else}<li><a href="?page=alliance&mode=close" title="{$LNG.ls_alliance_38}">{$LNG.ls_alliance_40}</a></li>	{/if}
	</ul></div><div id="div_alliance"><div id="page_messagerie"><div id="ecrire_message" class="categorie">
              <h2>{$LNG.ls_alliance_60}</h2>
              
              {if !empty($Message)}{$Message}{/if}
              <form name="message" id="message" method="post" action="game.php?page=alliance&mode=circular">
			  <input type="hidden" name="action" value="send">
                  <table>
                      <tr class="message_collectif">
                                  <td colspan="2">
                                     {$LNG.ls_alliance_61} "{$ally_name}"
                                      <span class="couleur_alliance">[{$ally_tag}]</span>.
                                  </td>
                              </tr>
                      <tr class="sujet">
                          <td colspan="2">
                              <label for="sujet">{$LNG.ls_alliance_62} : </label>
                              <input type="text" id="subject" name="subject" value="{$subject}" />
                          </td>
                      </tr>
                      
                      
                      <tr class="message">
                          <td colspan="2"><textarea id="text" name="text" rows="6">{$text}</textarea></td>
                      </tr>
                      <tr class="validation">
                          <td colspan="2">
                              <input type="submit" id="valid_form" name="valid_form" value="{$LNG.ls_alliance_63}" />
                          </td>
                      </tr>
                  </table>
              </form>
          </div></div></div></div>                    <!-- Fin du corps -->

{/block}