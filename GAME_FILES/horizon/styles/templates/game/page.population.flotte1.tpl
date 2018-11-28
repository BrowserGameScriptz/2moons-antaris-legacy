{block name="title" prepend}{$LNG.ls_popu_1}{/block}
{block name="content"}
<div id="page_contenu">	<h1>{$LNG.ls_popu_1}</h1>
<div class="onglet">
<ul>		<li><a href="?page=population" title="{$LNG.NOUVEAUTE_467}">{$LNG.NOUVEAUTE_467}</a></li> 		<li><a href="?page=population&mode=flotte" title="{$LNG.NOUVEAUTE_468}">{$LNG.NOUVEAUTE_468}</a></li>	</ul></div>



<div id="div_population" class="centre">    <div id="page_population_equipe">	<div class="categorie explication">		<h2>{$LNG.NOUVEAUTE_469} <img class="icone_creer" src="https://cdngames.antaris-legacy.eu/design/image/jeu/icone/blanc/aide.png" /></h2>		{$LNG.NOUVEAUTE_470}	</div>


	<div id="liste_equipe">
	
	{foreach $userComp as $fleetID => $xb}
	<div id="emballage_equipe_{$fleetID}" class="emballage_equipe">	<div id="equipe_{$fleetID}" class="equipe">		<h2>{$LNG.NOUVEAUTE_475} : 
								<span class="{$xb.couleur}" onclick="javascript:Population.modifierNomEquipe('{$fleetID}', '{$xb.manage_name}');" style="cursor : pointer;">{$xb.manage_name}</span>
								<img class="icone_equipe" src="https://cdngames.antaris-legacy.eu/design/image/jeu/icone/blanc/tag.png" />
								<img class="supprimer" src="https://cdngames.antaris-legacy.eu/design/image/jeu/icone/couleur/corbeille.png" onclick="javascript:Population.supprimerEquipe('{$fleetID}');" />
							</h2>		<h3>{$LNG.ls_popu_1}</h3>		<div class="liste_population">	

								{foreach $xb.FLEETLIST as $shipID => $Element}
								<div class="item">
												<img src="https://cdngames.antaris-legacy.eu/media/ingame/population/{$shipID}.jpg" />
												<div class="element reel" name="nom_population_{$shipID}">
													<a title="{$LNG.NOUVEAUTE_480}" onclick="javascript:Population.modifierElementEquipe('{$fleetID}', 'population', '{$shipID}');">
														<span class="couleur_theme">{$Element.fleetAmount|number}</span> u.<br />
														<span class="nom">{$LNG.tech.$shipID}</span>
													</a>
												</div>
												<img class="supprimer" src="design/image/jeu/icone/couleur/refuser.png" onclick="javascript:Population.supprimerElementEquipe('{$fleetID}', 'population', '{$shipID}');" />
											</div>	
											
										{if $Element@last}
											<div class="item ajouter_item" name="population">
										<img src="https://cdngames.antaris-legacy.eu/design/image/equipe_plus.png">
										<div class="element">
											<a title="{$LNG.NOUVEAUTE_481}" onclick="javascript:Population.afficherFormulaire('{$fleetID}', 'population');">{$LNG.NOUVEAUTE_482}</a>
											<form action="javascript:Population.ajouterElementEquipe('{$fleetID}', 'population');">
												<select><option value="2">Technicien</option><option value="3">Scientifique</option><option value="8">Archéologue</option><option value="9">Diplomate</option><option value="4">Soldat</option><option value="5">Soldat équipé</option><option value="6">Pilote</option><option value="7">Antaris</option>					</select>
												<input value="Ok" type="submit">
											</form>
										</div>
									</div>
									{/if}
							{foreachelse}<div class="item ajouter_item" name="population">
										<img src="https://cdngames.antaris-legacy.eu/design/image/equipe_plus.png">
										<div class="element">
											<a title="{$LNG.NOUVEAUTE_481}" onclick="javascript:Population.afficherFormulaire('{$fleetID}', 'population');">{$LNG.NOUVEAUTE_482}</a>
											<form action="javascript:Population.ajouterElementEquipe('{$fleetID}', 'population');">
												<select><option value="2">Technicien</option><option value="3">Scientifique</option><option value="8">Archéologue</option><option value="9">Diplomate</option><option value="4">Soldat</option><option value="5">Soldat équipé</option><option value="6">Pilote</option><option value="7">Antaris</option>					</select>
												<input value="Ok" type="submit">
											</form>
										</div>
									</div>{/foreach}

											</div>		
											
											
											<h3>{$LNG.NOUVEAUTE_473}</h3>		<div class="liste_appareil">		
											
											{foreach $xb.APPAREILLIST as $shipID => $Element}
											<div class="item">
												<img src="https://cdngames.antaris-legacy.eu/theme/gow/gebaeude/{$shipID}.gif" />
												<div class="element reel" name="nom_appareil_{$shipID}">
													<a title="{$LNG.NOUVEAUTE_480}" onclick="javascript:Population.modifierElementEquipe('{$fleetID}', 'appareil', '{$shipID}');">
														<span class="couleur_theme">{$Element.fleetAmount|number}</span> u.<br />
														<span class="nom">{$LNG.tech.$shipID}</span>
													</a>
												</div>
												<img class="supprimer" src="design/image/jeu/icone/couleur/refuser.png" onclick="javascript:Population.supprimerElementEquipe('{$fleetID}', 'appareil', '{$shipID}');" />
											</div>	
											{if $Element@last}
											<div class="item ajouter_item" name="appareil">
										<img src="https://cdngames.antaris-legacy.eu/design/image/equipe_plus.png">
										<div class="element">
											<a title="{$LNG.NOUVEAUTE_481}" onclick="javascript:Population.afficherFormulaire('{$fleetID}', 'appareil');">{$LNG.NOUVEAUTE_482}</a>
											<form action="javascript:Population.ajouterElementEquipe('{$fleetID}', 'appareil');">
												<select><option value="1">Petit transporteur</option><option value="2">Grand transporteur</option><option value="5">Speeder</option>					</select>
												<input value="Ok" type="submit">
											</form>
										</div>
									</div>
									{/if}{foreachelse}<div class="item ajouter_item" name="appareil">
										<img src="https://cdngames.antaris-legacy.eu/design/image/equipe_plus.png">
										<div class="element">
											<a title="{$LNG.NOUVEAUTE_481}" onclick="javascript:Population.afficherFormulaire('{$fleetID}', 'appareil');">{$LNG.NOUVEAUTE_482}</a>
											<form action="javascript:Population.ajouterElementEquipe('{$fleetID}', 'appareil');">
												<select><option value="1">Petit transporteur</option><option value="2">Grand transporteur</option><option value="5">Speeder</option>					</select>
												<input value="Ok" type="submit">
											</form>
										</div>
									</div>{/foreach}

											</div>		<div class="option">			<a class="modifier_couleur" title="{$LNG.NOUVEAUTE_474}" onclick="javascript:Population.modifierCouleurEquipe('{$fleetID}');">{$LNG.NOUVEAUTE_474}</a>		</div>	</div></div>	
											{/foreach}
											
											
											<div id="nouvelle_equipe" class="equipe">		<h2>{$LNG.NOUVEAUTE_471} <img class="icone_creer" src="https://cdngames.antaris-legacy.eu/design/image/jeu/icone/blanc/plus.png" /></h2>		<a onclick="javascript:Population.afficherFormulaireCreation();" class="centre">{$LNG.NOUVEAUTE_471} !</a>	


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
