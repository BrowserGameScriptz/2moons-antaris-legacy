{block name="title" prepend}{$LNG.ls_popu_1}{/block}
{block name="content"}
<div id="page_contenu">	<h1>{$LNG.ls_popu_1}</h1>
<div class="onglet">
<ul>		<li><a href="?page=population" title="{$LNG.NOUVEAUTE_467}">{$LNG.NOUVEAUTE_467}</a></li> 		<li><a href="?page=population&mode=flotte" title="{$LNG.NOUVEAUTE_468}">{$LNG.NOUVEAUTE_468}</a></li>	</ul></div>



<div id="div_population" class="centre">    <div id="page_population_equipe">	<div class="categorie explication">		<h2>{$LNG.NOUVEAUTE_469} <img class="icone_creer" src="https://cdngames.antaris-legacy.eu/design/image/jeu/icone/blanc/aide.png" /></h2>		{$LNG.NOUVEAUTE_470}	</div>	


<div id="liste_equipe">	<div id="nouvelle_equipe" class="equipe">		<h2>{$LNG.NOUVEAUTE_471} <img class="icone_creer" src="https://cdngames.antaris-legacy.eu/design/image/jeu/icone/blanc/plus.png" /></h2>		<a onclick="javascript:Population.afficherFormulaireCreation();" class="centre">{$LNG.NOUVEAUTE_471} !</a>		


<form id="form_creer_equipe" action="javascript:Population.creerEquipe();">			<h3>{$LNG.ls_popu_1}</h3>		

	<div class="liste_population">				
									{foreach $population as $PopRow}
										<div class="item">
										<img src="https://cdngames.antaris-legacy.eu/media/ingame/population/{$PopRow.id}.jpg" />
										<div class="element">
											<label for="population_{$PopRow.id}">{$PopRow.name}</label>
											<input type="text" class="entier" id="population_{$PopRow.id}" name="population_{$PopRow.id}" value="0" />
										</div>
									</div>	
									{/foreach}
									</div>	



									<h3>{$LNG.NOUVEAUTE_473}</h3>			<div class="liste_appareil">		
									{foreach $appareil as $AppRow}
									<div class="item">
										<img src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/{$AppRow.id}.gif" />
										<div class="element">
											<label for="appareil_{$AppRow.id}">{$AppRow.name}</label>
											<input type="text" class="entier" id="appareil_{$AppRow.id}" name="appareil_{$AppRow.id}" value="0" />
										</div>
									</div>	
										{/foreach}

									</div>			<div class="centre">				<input type="submit" value="{$LNG.NOUVEAUTE_472}"/>			</div>		</form>	</div>	</div></div></div></div>                    <!-- Fin du corps -->
{/block}
