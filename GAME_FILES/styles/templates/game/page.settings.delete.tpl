{block name="title" prepend}{$LNG.lm_options}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.ls_settings_1}</h1><div id="page_profil">	<div class="onglet" style="margin-bottom : 0px; padding-bottom : 0px;">	<ul>			

<li><a href="?page=settings" title="{$LNG.ls_settings_3}">{$LNG.ls_settings_3}</a></li>			
<li><a href="?page=settings&mode=avatar" title="{$LNG.ls_settings_4}">{$LNG.ls_settings_4}</a></li>			
<li><a href="?page=settings&mode=signature" title="{$LNG.ls_settings_5}">{$LNG.ls_settings_5}</a></li>		
<li><a href="?page=settings&mode=design" title="{$LNG.ls_settings_57}">{$LNG.ls_settings_57}</a></li>	
</ul>
	<div class="onglet">		<ul>			
	
	<li><a href="?page=settings&mode=notification" title="{$LNG.NOUVEAUTE_165}">{$LNG.NOUVEAUTE_165}</a></li>			
	<li><a href="?page=settings&mode=vmode" title="{$LNG.ls_settings_7}">{$LNG.ls_settings_7}</a></li>			
	<li><a href="?page=settings&mode=delete" title="{$LNG.ls_settings_8}">{$LNG.ls_settings_8}</a></li>		
	
	</ul>		</div>
	<div id="div_profil_onglet"><div class="categorie">
						<h2>{$LNG.ls_settings_47}</h2>
						{$LNG.ls_settings_48}
					{if empty($Message)}	
						<form id="form_suppression" method="post" action="game.php?page=settings">
						<input type="hidden" name="mode" value="delete">
						{$LNG.ls_settings_49}
							<table style="margin-top : 10px;">
								<tr>
									<td><label for="mdp">{$LNG.ls_settings_50} :</label></td>
									<td><input type="password" id="mdp" name="mdp" size="16" maxlength="32" /></td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" name="valid_form" value="{$LNG.ls_settings_51}" /></td>
								</tr>
							</table>	</form>
							
					{else}
						<form id="form_suppression" method="post" action="game.php?page=settings;">{$Message}	<br><a onclick="location.href='game.php?page=settings&mode=delete';">{$LNG.NOUVEAUTE_21}</a>  </form>
					{/if}
					  </div>	</div></div></div>   </div>                  <!-- Fin du corps -->
            <div class="espace"></div>
{/block}