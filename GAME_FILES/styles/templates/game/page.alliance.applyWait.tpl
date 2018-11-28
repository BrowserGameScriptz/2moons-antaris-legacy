{block name="title" prepend}{$LNG.NOUVEAUTE_81}{/block}
{block name="content"}

<div id="page_contenu"><h1>{$LNG.NOUVEAUTE_81}</h1><div id="div_alliance"><div class="categorie">	<h2>{$LNG.ls_alliance_21}</h2>	<div class="sous_partie">{$LNG.ls_alliance_22} : {$ally_name}
							<span class="couleur_alliance">[{$ally_tag}]</span>.<br />		{$LNG.ls_alliance_23} {$datess}, {$LNG.ls_alliance_24}.	</div>	<form action="game.php?page=alliance&amp;mode=cancelApply" method="post">
							<input type="submit" id="valid_form_suppr_recrut" name="valid_form_suppr_recrut" value="{$LNG.ls_alliance_24}" />
						</form></div></div>                <!-- Fin du corps -->
            </div>
            <div class="espace"></div>
{/block}