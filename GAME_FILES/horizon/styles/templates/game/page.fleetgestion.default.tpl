{block name="title" prepend}{$LNG.NOUVEAUTE_387}{/block}
{block name="content"}
<div id="page_contenu">	<h1>{$LNG.NOUVEAUTE_387}</h1>
<div class="onglet">
<ul>
                  <li><a href="?page=CreateShip&mode=ships" title="{$LNG.NOUVEAUTE_379}">{$LNG.NOUVEAUTE_380}</a></li> 
                  <li><a href="?page=CreateShip" title="{$LNG.NOUVEAUTE_381}">{$LNG.NOUVEAUTE_382}</a></li> 
                  <li><a href="?page=CreateShip&mode=pieces" title="{$LNG.NOUVEAUTE_383}">{$LNG.NOUVEAUTE_384}</a></li> 
                 <li><a href="?page=CreateShip&mode=flotte" title="{$LNG.NOUVEAUTE_385}">{$LNG.NOUVEAUTE_386}</a></li>
              </ul></div>



<div id="div_population" class="centre">    <div id="page_population_equipe">	<div class="categorie explication">		<h2>{$LNG.lm_fleettable_6} <img class="icone_creer" src="https://cdngames.antaris-legacy.eu/design/image/jeu/icone/blanc/aide.png" /></h2>		{$LNG.lm_fleettable_7}	</div>	

<div id="liste_equipe">	<div id="nouvelle_equipe" class="equipe">		<h2>{$LNG.NOUVEAUTE_483} <img class="icone_creer" src="https://cdngames.antaris-legacy.eu/design/image/jeu/icone/blanc/plus.png" /></h2>		<a onclick="javascript:VaisseauEquipe.afficherFormulaireCreation();" class="centre">{$LNG.NOUVEAUTE_483} !</a>		


<form id="form_creer_equipe" action="javascript:VaisseauEquipe.creerEquipe();">			<h3>{$LNG.NOUVEAUTE_485}</h3>		

	<div class="liste_vaisseau">				
									{foreach $population as $PopRow}
										<div class="item">
										<img src="{$PopRow.image}" />
										<div class="element">
											<label for="vaisseau_{$PopRow.id}">{$PopRow.name}</label>
											<input type="text" class="entier" id="vaisseau_{$PopRow.id}" name="vaisseau[{$PopRow.id}]" value="0" />
										</div>
									</div>	
									{/foreach}
									</div>	



									<h3>{$LNG.NOUVEAUTE_473}</h3>			<div class="liste_appareil">		
									{foreach $appareil as $AppRow}
									<div class="item">
										<img src="/styles/theme/gow/gebaeude/{$AppRow.id}.gif" />
										<div class="element">
											<label for="appareil_{$AppRow.id}">{$AppRow.name}</label>
											<input type="text" class="entier" id="appareil_{$AppRow.id}" name="appareil_{$AppRow.id}" value="0" />
										</div>
									</div>	
										{/foreach}

									</div>			<div class="centre">				<input type="submit" value="{$LNG.NOUVEAUTE_484}"/>			</div>		</form>	</div>	</div></div></div></div>                    <!-- Fin du corps -->
{/block}
