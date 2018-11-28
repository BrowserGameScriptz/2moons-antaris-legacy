{block name="title" prepend}{$LNG.NOUVEAUTE_68}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.NOUVEAUTE_68}</h1><div class="onglet">
              <ul>
                <li><a href="?page=Bunker" title="{$LNG.ls_bunker_1}">{$LNG.ls_bunker_1}</a></li>
                  <li><a href="?page=Bunker&mode=historique" title="{$LNG.ls_bunker_2}">{$LNG.ls_bunker_2}</a></li>
              </ul>
          </div>
          <div id="div_bunker"><!-- Sous titre de l'onglet -->
<h2 class="titre_corps">{$LNG.ls_bunker_2}</h2>

<div name="bunker_historique">
    <!-- Image d'illustration du bunker à ressources -->
    <img name="illustration" src="https://cdngames.antaris-legacy.eu/media/image/bunker.jpg" />
    
    <!-- Paragraphe explicatif -->
    <p>
       {$LNG.ls_bunker_14}
    </p>
    
    <!-- S'il y a des enregistrements d'historique -->
	
	{if $messageList == ''}
	 <div style="margin : 20px auto 0px auto;">{$LNG.ls_bunker_15}.</div>
	 {/if}
	 
	 
        {if $messageList != ''}
    <table>
        <tr>
            <th class="logo"></th>
            <th class="date_operation">{$LNG.ls_bunker_16}</th>
            <th class="description">{$LNG.ls_bunker_17}</th>
        </tr>
        
        <!-- On parcours tous les enregistrements -->
		
		
		{foreach $messageList as $messageID => $messageRow}
                <tr>
            <td class="logo">{if $messageRow.accepted == 1}<img src="https://cdngames.antaris-legacy.eu/media/ingame/image/augmente.png" />{else}<img src="https://cdngames.antaris-legacy.eu/media/ingame/image/diminue.png" />{/if}</td>
            <td class="date_operation">{$messageRow.date}</td>
            <td class="description">{$messageRow.message}</td>
        </tr>
		{/foreach}
		
            </table> 
		
		{/if}
    
    <!-- On affiche la pagination de la page -->
    
    </div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}
