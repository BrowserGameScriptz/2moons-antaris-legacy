{block name="title" prepend}{$LNG.NOUVEAUTE_29}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.NOUVEAUTE_29}</h1>
          <div id="div_bunker"><!-- Sous titre de l'onglet -->

<div name="bunker_historique">
    <!-- Image d'illustration du bunker à ressources -->
    <img name="illustration" src="https://cdngames.antaris-legacy.eu/media/image/lotto.jpg" />
    
    <!-- Paragraphe explicatif -->
    <p>
      {$LNG.NOUVEAUTE_28}
    </p>
	
	 {if empty($Message)} 
		<form method="post" action="?page=Lottery">
			<select size="1" name="tickets">
			<option value="1">{$LNG.NOUVEAUTE_30}</option>
			</select>
			<input class="buttonbau greenbau" type="submit" value="{$LNG.lm_lotto_8}" name="Buy">
		</form>
		{else}
			<form id="form_notification" method="post" action="?page=Lottery">{$Message}<br><a onclick="location.href='game.php?page=Lottery';">{$LNG.NOUVEAUTE_21}</a>	</form>
		{/if}
		
    <!-- S'il y a des enregistrements d'historique -->
	
	 
   {$user_lists}
			

			{$winners}
		
    
    <!-- On affiche la pagination de la page -->
    
    </div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}
