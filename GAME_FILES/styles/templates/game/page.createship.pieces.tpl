{block name="title" prepend}{$LNG.NOUVEAUTE_387}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.NOUVEAUTE_387}</h1><div class="onglet">
              <ul>
                  <li><a href="?page=CreateShip&mode=ships" title="{$LNG.NOUVEAUTE_379}">{$LNG.NOUVEAUTE_380}</a></li> 
                  <li><a href="?page=CreateShip" title="{$LNG.NOUVEAUTE_381}">{$LNG.NOUVEAUTE_382}</a></li> 
                  <li><a href="?page=CreateShip&mode=pieces" title="{$LNG.NOUVEAUTE_383}">{$LNG.NOUVEAUTE_384}</a></li> 
                 <li><a href="?page=CreateShip&mode=flotte" title="{$LNG.NOUVEAUTE_385}">{$LNG.NOUVEAUTE_386}</a></li>
              </ul>
          </div>
          <div id="div_vaisseau"><!-- Cette page affiche la liste des pièces pour les vaisseaux -->
<div id="vaisseau_liste_piece">
    <div class="sous_partie">
        {$LNG.NOUVEAUTE_399}
    </div>
  
    <!-- Sous titre que l'on affiche -->
    <h2 class="titre_corps">{$LNG.NOUVEAUTE_400}</h2>
    
    <!-- Deux onglets différents pour afficher soit la liste des infrastructures, soit la liste des composants -->
    <div class="onglet">
        <ul>
            <li><a onclick="javascript:BaseSpatiale.ouvrirListePiece('liste_infrastructure');" title="">{$LNG.NOUVEAUTE_401}</a></li>
            <li><a onclick="javascript:BaseSpatiale.ouvrirListePiece('liste_composant');" title="">{$LNG.NOUVEAUTE_402}</a></li>
        </ul>
    </div>
    
    <!-- La liste des infrastructures proposés sur le jeu -->
    <div name="liste_infrastructure" class="liste_piece categorie">
        <h2>{$LNG.NOUVEAUTE_403}</h2>
        
        <table>
            <tr>
              <th>{$LNG.NOUVEAUTE_404}</th>
              <th>{$LNG.NOUVEAUTE_405}</th>
              <th>{$LNG.NOUVEAUTE_406}</th>
              <th>{$LNG.NOUVEAUTE_407}</th>
            </tr>
            
            <!-- On parcours tous les infrasructures existantes -->
			
			 {foreach $infrastructureData as $id => $xb}
                        <tr>
                <td>
                    <div name="nom">{$xb.nom} :</div>
                    &mdash; <span class="vert">{$xb.fret}</span> de fret
                </td>
                
                <td>
                  <!-- Pour afficher le coût de l'infrastructure -->
                                                               &mdash; <span class="orange">{$xb.cost901}</span> {$LNG.tech.901}<br />                                                               &mdash; <span class="orange">{$xb.cost902}</span> {$LNG.tech.902}<br />                                                               &mdash; <span class="orange">{$xb.cost903}</span> {$LNG.tech.903}<br />                                                               &mdash; <span class="orange">{$xb.cost904}</span> {$LNG.tech.904}<br />                                  </td>
                
                <td>
                  <!-- Pour afficher l'équipage nécessaire -->
                                
								{if $xb.soldier > 0}&mdash; <span class="orange">{$xb.soldier}</span> {$LNG.tech.306}<br />{/if}
								{if $xb.technician > 0}&mdash; <span class="orange">{$xb.technician}</span> {$LNG.tech.302}<br />{/if}
								{if $xb.scientist > 0}&mdash; <span class="orange">{$xb.scientist}</span> {$LNG.tech.303}<br />{/if}
								{if $xb.pilots > 0}&mdash; <span class="orange">{$xb.pilots}</span> {$LNG.tech.308}<br />  {/if}
                                </td>
                
                <td>
                    &mdash; <span class="orange">{$xb.mouvement}</span>% {$LNG.NOUVEAUTE_411}<br />
                    &mdash; <span class="orange">{$xb.poids}</span> {$LNG.NOUVEAUTE_412}
                </td>
            </tr>
			{/foreach}
                    </table>
    </div>
  
    <!-- La liste des composants proposés sur le jeu -->
    <div name="liste_composant" class="liste_piece categorie">
        <h2>{$LNG.NOUVEAUTE_408}</h2>
        
        <table>
		 
		
            <tr>
              <th>{$LNG.NOUVEAUTE_409}</th>
              <th style="width : 302px;">{$LNG.NOUVEAUTE_410}</th>
              <th style="min-width : 140px;">{$LNG.NOUVEAUTE_407}</th>
            </tr>
            
            <!-- On parcours tous les composants existants -->
			{foreach $composantData as $id => $xb}
                        <tr>
                <td>
                    <div name="nom">{$xb.nom} :</div>
                </td>
                
                <td>
                  <!-- Pour afficher le coût du composant -->
                                                 {if $xb.cost901 > 0}<div name="ressource">&mdash; <span class="orange">{$xb.cost901}</span> {$LNG.tech.901}</div>{/if}  
												 {if $xb.cost902 > 0}<div name="ressource">&mdash; <span class="orange">{$xb.cost902}</span> {$LNG.tech.902}</div> {/if}   
												{if $xb.cost903 > 0}<div name="ressource">&mdash; <span class="orange">{$xb.cost903}</span> {$LNG.tech.903}</div>{/if} 
												{if $xb.cost904 > 0}<div name="ressource">&mdash; <span class="orange">{$xb.cost904}</span> {$LNG.tech.904}</div>{/if} 
												{if $xb.cost221 > 0}<div name="ressource">&mdash; <span class="orange">{$xb.cost221}</span> réacteur à l'elyrium</div>{/if} 
								</td>
                
                <td>
                  <!-- Caractéristiques du composant -->
                                        &mdash; <span class="vert">{$xb.valeur}</span> 
                      {$xb.type}<br />
                                    &mdash; <span class="rouge">{$xb.fret}</span> de fret
                </td>
            </tr>
			
			{/foreach}
                    </table>
    </div>
</div></div></div>   
{/block}
