{block name="title" prepend}{$LNG.ls_tmanag_1}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.ls_tmanag_1}</h1><div id="page_tour_gestion">	<div class="onglet">
				<ul>
					<li><a href="?page=Tower" title="{$LNG.ls_tmanag_2}">{$LNG.ls_tmanag_2}</a></li>
					{if $headquarters_antaris >= 1}<li><a href="?page=Tower&mode=siege" title="{$LNG.ls_tmanag_3}">{$LNG.ls_tmanag_3}</a></li>{/if}
					{if $antaris_headpost >= 1}<li><a href="?page=Tower&mode=outpost" title="{$LNG.ls_tmanag_4}">{$LNG.ls_tmanag_4}</a></li>{/if}
					<li><a href="?page=Tower&mode=portal" title="{$LNG.ls_tmanag_5}">{$LNG.ls_tmanag_5}</a></li>
					<li><a href="?page=Tower&mode=construct" title="{$LNG.ls_tmanag_6}">{$LNG.ls_tmanag_6}</a></li>
				</ul>
			</div>	<div id="onglet_tour_gestion"><div id="general_planete" class="categorie">	
			
				{if $Lose == 1}
						<h2>{$LNG.ls_tmanag_51} ?</h2>
                        <div class="abandonner_planete">
                           {$LNG.ls_tmanag_52}.<br><br>
						</div>
				{/if}
                        {if empty($Message)}
			<form method="post" action="game.php?page=Tower">
			<input type="hidden" name="mode" value="delete">
							<label for="mdp">{$LNG.ls_tmanag_53} : </label>
							<input id="password" name="password" maxlength="32" type="password" autocomplete="off">
							 <input value="{$LNG.ls_tmanag_54}" type="submit">
							 </form>
							  {else}
							  
							  {if $Lose == 1}
			<form id="form_notification" method="post" action="?page=Tower&mode=delete">{$Message}<br><a onclick="location.href='game.php?page=Tower&mode=delete';">{$LNG.NOUVEAUTE_21}</a>	</form>
							  {else}
							  <h2>{$LNG.NOUVEAUTE_357}</h2>
								<span class="vert">{$LNG.NOUVEAUTE_358}</span><br>
								{$LNG.NOUVEAUTE_359}.
							  {/if}
							  {/if}
					  </div></div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}