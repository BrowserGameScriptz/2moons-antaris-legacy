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
	
	</ul>	</div>
	<div id="div_profil_onglet"><div class="categorie">
                        <h2>{$LNG.NOUVEAUTE_192}</h2>
						{$LNG.NOUVEAUTE_193}<br /><br />
                        
                       {$LNG.NOUVEAUTE_194}
                  {if empty($Message)}      
                        <form id="form_notification" method="post" action="game.php?page=settings&mode=notification"><div class="param_notification">
                                  <input type="checkbox" value="1" id="notification_messagerie" name="notification_messagerie"  {if $notification_messagerie == 1}checked="checked"{/if} />
                                  <label for="notification_messagerie" style="font-weight : normal; margin-left : 10px;">{$LNG.NOUVEAUTE_195}</label>
                              </div><div class="param_notification">
                                  <input type="checkbox" value="1" id="notification_attaque_subie" name="notification_attaque_subie" {if $notification_attaque_subie == 1}checked="checked"{/if} />
                                  <label for="notification_attaque_subie" style="font-weight : normal; margin-left : 10px;">{$LNG.NOUVEAUTE_196}</label>
                              </div><div class="param_notification">
                                  <input type="checkbox" value="1" id="notification_tchat" name="notification_tchat" {if $notification_tchat == 1}checked="checked"{/if}  />
                                  <label for="notification_tchat" style="font-weight : normal; margin-left : 10px;">{$LNG.NOUVEAUTE_197}</label>
                              </div><div class="param_notification">
                                  <input type="checkbox" value="1" id="notification_connexion" name="notification_connexion" {if $notification_connexion == 1}checked="checked"{/if} />
                                  <label for="notification_connexion" style="font-weight : normal; margin-left : 10px;">{$LNG.NOUVEAUTE_198}</label>
                              </div><div class="param_notification">
                                  <input type="checkbox" value="1" id="notification_annonce" name="notification_annonce" {if $notification_annonce == 1}checked="checked"{/if} />
                                  <label for="notification_annonce" style="font-weight : normal; margin-left : 10px;">{$LNG.NOUVEAUTE_199}</label>
                              </div><div class="param_notification">
                                  <input type="checkbox" value="1" id="notification_champ_force" name="notification_champ_force" {if $notification_champ_force == 1}checked="checked"{/if} />
                                  <label for="notification_champ_force" style="font-weight : normal; margin-left : 10px;">{$LNG.NOUVEAUTE_200}</label>
                              </div>  <input type="submit" name="valid_notification" value="{$LNG.NOUVEAUTE_201}" style="margin-top : 15px;" />  </form>
							  
					{else}
					<form id="form_notification" method="post" action="game.php?page=settings&mode=notification">{$Message}	<br><a onclick="location.href='game.php?page=settings&mode=notification';">{$LNG.NOUVEAUTE_21}</a>  </form>
					{/if}
                      </div>	</div></div></div>       </div>              <!-- Fin du corps -->
            <div class="espace"></div>
{/block}