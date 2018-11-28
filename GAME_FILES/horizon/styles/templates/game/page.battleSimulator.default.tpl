{block name="title" prepend}{$LNG.NOUVEAUTE_828}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.NOUVEAUTE_828}</h1>


	<div id="centre_spatial">
	
	{if empty($Message)}
	<div id="" class="formulaire_mission categorie">
		<form action="?page=battleSimulator" method="post">
	
	 <h2>{$LNG.NOUVEAUTE_828}</h2>
	 <div name="conteneur_champ">
	 <h3>{$LNG.NOUVEAUTE_831}</h3>
			<div id="form_appareil">
				
				<div class="appareil">
				<img name="entite" src="https://cdngames.antaris-legacy.eu/media/files/avatar_defaut.jpg" />
					<div class="conteneur_label">
						<label for="psuedo">{$LNG.ti_userna} :</label>
					</div>
					{$DefenderUser} {$DefenderAlly}
				</div>
				
				<div class="appareil">
				<img name="entite" src="https://cdngames.antaris-legacy.eu/media/ingame/icon/planete.png" /> 
					<div class="conteneur_label">
						<label for="info_planete">{$LNG.NOUVEAUTE_835} :</label>
					</div>
					{$DefenderPlan}
				</div>
				
				<div class="appareil">
				<img name="entite" src="https://cdngames.antaris-legacy.eu/media/ingame/icon/trophee_1.png" />
					<div class="conteneur_label">
						<label for="points_def">{$LNG.NOUVEAUTE_836} :</label>
					</div>
					<span class="couleur_theme">{$DefenderRank}</span> pts
				</div>
				
				<div class="appareil">
				<img name="entite" src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/horloge.png" />
					<div class="conteneur_label">
						<label for="heure_raport">{$LNG.NOUVEAUTE_837} :</label>
					</div>
					{$DefenderTime}
				</div>

				
        </div>
		<div class="espace"></div>
        </div>
		
		
		
		<div name="conteneur_champ">
	 <h3>{$LNG.NOUVEAUTE_838}</h3>
			<div id="form_ressource">

				<div class="ressource">
					<img name="entite" src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/109.jpg" />
					<div class="conteneur_label">
						<label for="ressource_109">{$LNG.shortNames.109} :</label>
					</div>
					<input type="text" class="entier" id="ressource_109" name="battleinput[0][0][109]" data-appelation="{$LNG.shortNames.109}" maxlength="15" value="{if isset($battleinput.0.0.109)}{$battleinput.0.0.109}{else}0{/if}" />
				</div>
				
				<div class="ressource">
					<img name="entite" src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/109.jpg" />
					<div class="conteneur_label">
						<label for="ressource_109">{$LNG.shortNames.109} :</label>
					</div>
					<input type="text" class="entier" id="ressource_109" name="battleinput[0][1][109]" data-appelation="{$LNG.shortNames.109}" maxlength="15" value="{if isset($battleinput.0.1.109)}{$battleinput.0.1.109}{else}0{/if}" />
				</div>
				
				<div class="ressource">
					<img name="entite" src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/110.jpg" />
					<div class="conteneur_label">
						<label for="ressource_110">{$LNG.shortNames.110} :</label>
					</div>
					<input type="text" class="entier" id="ressource_110" name="battleinput[0][0][110]" data-appelation="{$LNG.shortNames.110}" maxlength="15" value="{if isset($battleinput.0.0.110)}{$battleinput.0.0.110}{else}0{/if}" />
				</div>
				
				<div class="ressource">
					<img name="entite" src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/110.jpg" />
					<div class="conteneur_label">
						<label for="ressource_110">{$LNG.shortNames.110} :</label>
					</div>
					<input type="text" class="entier" id="ressource_110" name="battleinput[0][1][110]" data-appelation="{$LNG.shortNames.110}" maxlength="15" value="{if isset($battleinput.0.1.110)}{$battleinput.0.1.110}{else}0{/if}" />
				</div>
				
				<div class="ressource">
					<img name="entite" src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/111.jpg" />
					<div class="conteneur_label">
						<label for="ressource_111">{$LNG.shortNames.111} :</label>
					</div>
					<input type="text" class="entier" id="ressource_111" name="battleinput[0][0][111]" data-appelation="{$LNG.shortNames.111}" maxlength="15" value="{if isset($battleinput.0.0.111)}{$battleinput.0.0.111}{else}0{/if}" />
				</div>
				
				<div class="ressource">
					<img name="entite" src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/111.jpg" />
					<div class="conteneur_label">
						<label for="ressource_111">{$LNG.shortNames.111} :</label>
					</div>
					<input type="text" class="entier" id="ressource_111" name="battleinput[0][1][111]" data-appelation="{$LNG.shortNames.111}" maxlength="15" value="{if isset($battleinput.0.1.111)}{$battleinput.0.1.111}{else}0{/if}" />
				</div>

				
        </div>
		<div class="espace"></div>
        </div>
		
		
		
		
		 <div name="conteneur_champ">
	 <h3>{$LNG.NOUVEAUTE_832}</h3>
			<div id="form_ressource">

				<div class="ressource">
					<img name="entite" src="https://cdngames.antaris-legacy.eu/media/ingame/image/metal.jpg" />
					<div class="conteneur_label">
						<label for="ressource_901">{$LNG.tech.901} :</label>
					</div>
					<input type="text" class="entier" id="ressource_901" name="battleinput[0][1][901]" data-appelation="{$LNG.tech.901}" maxlength="15" value="{if isset($battleinput.0.1.901)}{$battleinput.0.1.901}{else}0{/if}" />
				</div>
				
				<div class="ressource">
					<img name="entite" src="https://cdngames.antaris-legacy.eu/media/ingame/image/crystal.jpg" />
					<div class="conteneur_label">
						<label for="ressource_902">{$LNG.tech.902} :</label>
					</div>
					<input type="text" class="entier" id="ressource_902" name="battleinput[0][1][902]" data-appelation="{$LNG.tech.902}" maxlength="15" value="{if isset($battleinput.0.1.902)}{$battleinput.0.1.902}{else}0{/if}" />
				</div>
				
				<div class="ressource">
					<img name="entite" src="https://cdngames.antaris-legacy.eu/media/ingame/image/deuterium.jpg" />
					<div class="conteneur_label">
						<label for="ressource_903">{$LNG.tech.903} :</label>
					</div>
					<input type="text" class="entier" id="ressource_903" name="battleinput[0][1][903]" data-appelation="{$LNG.tech.903}" maxlength="15" value="{if isset($battleinput.0.1.903)}{$battleinput.0.1.903}{else}0{/if}" />
				</div>
				
				<div class="ressource">
					<img name="entite" src="https://cdngames.antaris-legacy.eu/media/ingame/image/elyrium.jpg" />
					<div class="conteneur_label">
						<label for="ressource_904">{$LNG.tech.904} :</label>
					</div>
					<input type="text" class="entier" id="ressource_904" name="battleinput[0][1][904]" data-appelation="{$LNG.tech.904}" maxlength="15" value="{if isset($battleinput.0.1.904)}{$battleinput.0.1.904}{else}0{/if}" />
				</div>

				
        </div>
		<div class="espace"></div>
        </div>
		
        <div name="conteneur_champ">
			<h3>{$LNG.NOUVEAUTE_830}</h3>
			<div id="form_population">
				{foreach $fleetList as $id}
				<div class="appareil">
					<img name="entite" src="{if $id > 300}https://cdngames.antaris-legacy.eu/media/ingame/population/{$id}.jpg{else}https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/{$id}.gif{/if}" />
					<div class="conteneur_label">
						<label for="appareil_{$id}">{$LNG.tech.{$id}} :</label>
					</div>
					<input type="text" class="entier" id="appareil_{$id}" name="battleinput[0][0][{$id}]" data-appelation="{$LNG.tech.{$id}}" maxlength="15" value="{if isset($battleinput.0.0.$id)}{$battleinput.0.0.$id}{else}0{/if}" />
					<img name="maximum" src="https://cdngames.antaris-legacy.eu/media/ingame/image/mission/drapeau_bleu.png" onclick="insererChampFret('battleinput[0][0][{$id}]', {if isset($battleinput.0.0.$id)}{$battleinput.0.0.$id}{else}0{/if});" />
				</div>
				
				<div class="appareil">
					<img name="entite" src="{if $id > 300}https://cdngames.antaris-legacy.eu/media/ingame/population/{$id}.jpg{else}https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/{$id}.gif{/if}" />
					<div class="conteneur_label">
						<label for="appareil_{$id}">{$LNG.tech.{$id}} :</label>
					</div>
					<input type="text" class="entier" id="appareil_{$id}" name="battleinput[0][1][{$id}]" data-appelation="{$LNG.tech.{$id}}" maxlength="15" value="{if isset($battleinput.0.1.$id)}{$battleinput.0.1.$id}{else}0{/if}" />
				</div>
				{/foreach}
				

				<div class="espace"></div>
			</div>
			
		</div>
		<div name="submit_formulaire">
					<input type="submit" id="valid_form" name="valid_form" value="{$LNG.NOUVEAUTE_829}" />
				</div>
				</div>
				</form>
				{else}
{$Message}
{/if}
	</div>
</div>                    <!-- Fin du corps -->

{/block}
{block name="script" append}
<script type="text/javascript">
	function insererChampFret(e,t){ 
		document.getElementsByName(e)[0].value = t;
	}
</script>
{/block}