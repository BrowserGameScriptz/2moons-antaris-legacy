{block name="title" prepend}{$LNG.ls_market_1}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.ls_market_1}</h1><div class="onglet">
             <ul>
                  <li><a href="?page=market">{$LNG.ls_market_2}</a></li>
                  <li><a href="?page=market&mode=echange">{$LNG.ls_market_3}</a></li>
				  <li><a href="?page=market&mode=converter" title="{$LNG.NOUVEAUTE_819}">{$LNG.NOUVEAUTE_819}</a></li>
                  <li><a href="?page=market&mode=push" title="Push">{$LNG.ls_market_4}</a></li>
                  <li><a href="?page=market&mode=multi" title="Push">{$LNG.ls_market_5}</a></li> 
              </ul>
          </div><div id="div_commerce"><div id="commerce_convertisseur">
    <!-- La partie formulaire de convertisseur -->
    <div name="formulaire" class="categorie">
        <h2>{$LNG.NOUVEAUTE_820}</h2>
        {$LNG.NOUVEAUTE_821}
        
        <!-- Le formulaire a été envoyé et il y a une erreur de saisie -->
                
        <form id="form_convertisseur" action="?page=market&mode=converter" method="post">
            <table>
                <tr>
                    <td><label for="entite">{$LNG.NOUVEAUTE_822} :</label></td>
                    <td>
                        <select id="entite" name="entite">
                            <!-- On parcours toutes les ressources du jeu -->
                             
							 {foreach $resourceList as $OwnRow}    
                            <option value="ressource_{$OwnRow.id}" >
                                {$LNG.tech.{$OwnRow.id}}
                            </option>
							{/foreach}
                                                        <!-- On parcours tous les appareils spécialisés du jeu -->
                             
							 {foreach $SpecialiList as $OwnRow}   
                            <option value="appareil_{$OwnRow.id}" >
                               {$LNG.tech.{$OwnRow.id}}
                            </option>
                             {/foreach}
                            
                                                        <!-- On parcours toutes les populations du jeu (sauf les Antaris) -->
                                   {foreach $PopulataList as $OwnRow}  
                                                                                                                      <option value="population_{$OwnRow.id}" >
                                  {$LNG.tech.{$OwnRow.id}}
                              </option>{/foreach}
                                                                                                                                            </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="quantite">{$LNG.NOUVEAUTE_823} :</label></td>
                    <td><input type="text" class="entier" id="quantite" name="quantite" maxlength="12" value="{$valueInput}" /></td>
                </tr>
            </table>

            <input type="submit" value="{$LNG.NOUVEAUTE_824}" />
        </form>
    </div>
 
    
     <!-- La partie résultat du convertisseur -->
	 {if $ShowSummary == 1}
        <div name="resultat" class="categorie">
        <h2>{$LNG.NOUVEAUTE_825}</h2>
        {$HiddenText} :
        
        <h3>{$LNG.NOUVEAUTE_572} :</h3>
        <div name="ressource" class="liste_entite">
        <!--
         
            --><div class="entite">
                <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/metal.jpg"><!--
                --><div class="nom">{$LNG.tech.901} :</div><!--
                --><div class="nombre"><span class="orange">{$var901}</span> u.</div>
            </div><!--
         
            --><div class="entite">
                <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/crystal.jpg"><!--
                --><div class="nom">{$LNG.tech.902} :</div><!--
                --><div class="nombre"><span class="orange">{$var902}</span> u.</div>
            </div><!--
         
            --><div class="entite">
                <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/deuterium.jpg"><!--
                --><div class="nom">{$LNG.tech.903} :</div><!--
                --><div class="nombre"><span class="orange">{$var903}</span> u.</div>
            </div><!--
         
            --><div class="entite">
                <img src="https://cdngames.antaris-legacy.eu/media/ingame/image/elyrium.jpg"><!--
                --><div class="nom">{$LNG.tech.904} :</div><!--
                --><div class="nombre"><span class="orange">{$var904}</span> u.</div>
            </div><!--
        -->
        </div>
        
        <h3>{$LNG.ls_tech_4} :</h3>
        <div name="appareil" class="liste_entite">
        <!--
         
            --><div class="entite">
                <img src="styles/theme/gow/gebaeude/202.gif"><!--
                --><div class="nom">{$LNG.tech.202} :</div><!--
                --><div class="nombre"><span class="orange">{$var202}</span> u.</div>
            </div><!--
         
            --><div class="entite">
                <img src="styles/theme/gow/gebaeude/203.gif"><!--
                --><div class="nom">{$LNG.tech.203} :</div><!--
                --><div class="nombre"><span class="orange">{$var203}</span> u.</div>
            </div><!--
         
            --><div class="entite">
                <img src="styles/theme/gow/gebaeude/210.gif"><!--
                --><div class="nom">{$LNG.tech.210} :</div><!--
                --><div class="nombre"><span class="orange">{$var210}</span> u.</div>
            </div><!--
         
            --><div class="entite">
                <img src="styles/theme/gow/gebaeude/224.gif"><!--
                --><div class="nom">{$LNG.tech.224} :</div><!--
                --><div class="nombre"><span class="orange">{$var224}</span> u.</div>
            </div><!--
         
            --><div class="entite">
                <img src="styles/theme/gow/gebaeude/225.gif"><!--
                --><div class="nom">{$LNG.tech.225} :</div><!--
                --><div class="nombre"><span class="orange">{$var225}</span> u.</div>
            </div><!--
         
            --><div class="entite">
                <img src="styles/theme/gow/gebaeude/226.gif"><!--
                --><div class="nom">{$LNG.tech.226} :</div><!--
                --><div class="nombre"><span class="orange">{$var226}</span> u.</div>
            </div><!--
         
            --><div class="entite">
                <img src="styles/theme/gow/gebaeude/221.gif"><!--
                --><div class="nom">{$LNG.tech.221} :</div><!--
                --><div class="nombre"><span class="orange">{$var221}</span> u.</div>
            </div><!--
         
            --><div class="entite">
                <img src="styles/theme/gow/gebaeude/222.gif"><!--
                --><div class="nom">{$LNG.tech.222} :</div><!--
                --><div class="nombre"><span class="orange">{$var222}</span> u.</div>
            </div><!--
        -->
        </div>
        
        <h3>{$LNG.lm_population} :</h3>
        <div name="population" class="liste_entite">
        <!--
         
                   
                    --><div class="entite">
                <img src="https://cdngames.antaris-legacy.eu/media/ingame/population/302.jpg"><!--
                --><div class="nom">{$LNG.tech.302} :</div><!--
                --><div class="nombre"><span class="orange">{$var302}</span> u.</div>
            </div><!--
                 
                    --><div class="entite">
                <img src="https://cdngames.antaris-legacy.eu/media/ingame/population/303.jpg"><!--
                --><div class="nom">{$LNG.tech.303} :</div><!--
                --><div class="nombre"><span class="orange">{$var303}</span> u.</div>
            </div><!--
                 
                    --><div class="entite">
                <img src="https://cdngames.antaris-legacy.eu/media/ingame/population/304.jpg"><!--
                --><div class="nom">{$LNG.tech.304} :</div><!--
                --><div class="nombre"><span class="orange">{$var304}</span> u.</div>
            </div><!--
                 
                    --><div class="entite">
                <img src="https://cdngames.antaris-legacy.eu/media/ingame/population/305.jpg"><!--
                --><div class="nom">{$LNG.tech.305} :</div><!--
                --><div class="nombre"><span class="orange">{$var305}</span> u.</div>
            </div><!--
                 
                    --><div class="entite">
                <img src="https://cdngames.antaris-legacy.eu/media/ingame/population/306.jpg"><!--
                --><div class="nom">{$LNG.tech.306} :</div><!--
                --><div class="nombre"><span class="orange">{$var306}</span> u.</div>
            </div><!--
                 
                    --><div class="entite">
                <img src="https://cdngames.antaris-legacy.eu/media/ingame/population/307.jpg"><!--
                --><div class="nom">{$LNG.tech.307} :</div><!--
                --><div class="nombre"><span class="orange">{$var307}</span> u.</div>
            </div><!--
                 
                    --><div class="entite">
                <img src="https://cdngames.antaris-legacy.eu/media/ingame/population/308.jpg"><!--
                --><div class="nom">{$LNG.tech.308} :</div><!--
                --><div class="nombre"><span class="orange">{$var308}</span> u.</div>
            </div><!--
                 
                -->
        </div>
        </div>
		
		{/if}
    </div></div></div>                    <!-- Fin du corps -->
{/block}
