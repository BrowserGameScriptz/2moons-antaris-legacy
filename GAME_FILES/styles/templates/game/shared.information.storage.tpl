<!-- Tableau en lui-même -->
            <table class="tableau_production">
                            {foreach $productionTable.storage as $elementLevel => $productionData}
                              <tr>
                      <td>Level <span class="orange">{$elementLevel}</span> :</td>
					  {foreach $productionData as $resourceID => $storage}
					  {$storageDiff = $storage - $productionTable.storage.$CurrentLevel.$resourceID}
					 
                      <td><span class="orange">{$storage|number}</span> {$LNG.tech.$resourceID} /h</td>
					  
					  {/foreach}
                  </tr>
				  {/foreach}
                        </table>
            </div>
    <div class="espace"></div>
</div>
    
<!-- Un lien qui permet de revenir à la page des bâtiments -->
<a onclick="history.go(-1)" title="Back to the building page">Back to the building page.</a>

</div>     