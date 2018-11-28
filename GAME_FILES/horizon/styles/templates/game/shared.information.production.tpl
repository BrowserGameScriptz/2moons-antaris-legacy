<!-- Tableau en lui-même -->
            <table class="tableau_production">
			{foreach $productionTable.production as $elementLevel => $productionData}
                              <tr>
                      <td>Level <span class="orange">{$elementLevel}</span> :</td>
					  {foreach $productionData as $resourceID => $production}
					  {$productionDiff = $production - $productionTable.production.$CurrentLevel.$resourceID}
					  
                      <td><span class="orange">{$production|number}</span> {$LNG.tech.$resourceID} /h</td>
					  
					  {/foreach}
                  </tr>
				  {/foreach}
				  
                            
                        </table>
            </div>
    <div class="espace"></div>
</div>
    
<!-- Un lien qui permet de revenir à la page des bâtiments -->
<a onclick="history.go(-1)" title="Back to the building page">Back to the building page.</a>


<!-- La fenêtre pop-up qui permet de lancer une destruction de bâtiment -->
</div>                    <!-- Fin du corps -->
            <div class="espace"></div>