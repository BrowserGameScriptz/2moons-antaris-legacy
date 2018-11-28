{block name="title" prepend}{$LNG.NOUVEAUTE_81}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.NOUVEAUTE_81}</h1>
<div class="onglet">
<ul>		

	<li><a href="?page=alliance" title="{$LNG.ls_alliance_26}">{$LNG.ls_alliance_25}</a></li>
	{if $rights.ADMIN}<li><a href="?page=alliance&mode=admin" title="{$LNG.ls_alliance_27}">{$LNG.ls_alliance_27}</a></li>{/if}
	<li><a href="?page=alliance&mode=pactes" title="{$LNG.ls_alliance_29}">{$LNG.ls_alliance_28}</a></li>	
	<li><a href="?page=alliance&mode=wars" title="{$LNG.NOUVEAUTE_689}">{$LNG.NOUVEAUTE_688} <span class="blanc">(0)</span></a></li>
	{if $rights.RANKS}<li><a href="?page=alliance&mode=ranksissue" title="{$LNG.ls_alliance_30}">{$LNG.ls_alliance_31}</a></li>		{/if}
	{if $rights.MANAGEAPPLY}<li><a href="?page=alliance&mode=recruitAlly" title="{$LNG.ls_alliance_33}t">{$LNG.ls_alliance_32}</a></li>	{/if}	
	{if $rights.MEMBERLIST}<li><a href="?page=alliance&mode=memberList" title="{$LNG.ls_alliance_35}">{$LNG.ls_alliance_34}</a></li>		{/if}
	{if $rights.ROUNDMAIL}<li><a href="?page=alliance&mode=circular" title="{$LNG.ls_alliance_37}">{$LNG.ls_alliance_36}</a></li>	{/if}
	{if $rights.ADMIN}<li><a href="?page=alliance&mode=leaveAlly" title="{$LNG.ls_alliance_38}">{$LNG.ls_alliance_39}</a></li>{else}<li><a href="?page=alliance&mode=close" title="{$LNG.ls_alliance_38}">{$LNG.ls_alliance_40}</a></li>	{/if}
	</ul></div>
<div id="div_alliance"><div id="onglet_guerre"><div class="categorie">
                <h2>{$LNG.NOUVEAUTE_690}</h2>
                <table class="liste_guerre">
                  <tr>
                      <th>{$LNG.NOUVEAUTE_691}</th>
                      <th>{$LNG.NOUVEAUTE_692}</th>
                      <th>{$LNG.NOUVEAUTE_693}</th>
                      <th>{$LNG.ls_achivement_7}</th>
                  </tr>
				  
				  <tr>
                      <td><span class="couleur_alliance">[STAFF] [STAFF] [STAFF] [STAFF]</span></td>
                      <td><span class="couleur_alliance">[Google] [Google] [Google] [Google]</span></td>
                      <td>07/10/2016 à 11h30</td>
                      <td><span class="vert">Active</span></td>
                  </tr>
				  


				  </table>
              </div></div></div></div> 

{/block}