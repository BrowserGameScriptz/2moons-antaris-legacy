{block name="title" prepend}{$LNG.NOUVEAUTE_504}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.NOUVEAUTE_504}</h1>
          <div id="page_messagerie"><div id="boite_reception" class="categorie">
                  <h2>{$LNG.NOUVEAUTE_505}</h2>
                  <table>
                    <tr>
                        <th class="nom_onglet">{$LNG.NOUVEAUTE_506}</th>
                        <th class="nouveau"></th>
                        <th class="nb_message">{$LNG.NOUVEAUTE_507}</th>
                    </tr>
					
					{foreach $CategoryList as $CategoryID => $CategoryRow}
					<tr>
                    <td class="nom_onglet">
                        <img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/{$CategoryID}.png" />
						<a href="game.php?page=messages&mode=view&messcat={$CategoryID}"  class="{$CategoryRow.color}">{$LNG.mg_type.{$CategoryID}}</a>
                    </td>
                    <td class="nouveau">{if $CategoryRow.unread > 0}<img src="https://cdngames.antaris-legacy.eu/media/ingame/icon/nouveau.png"></img>{/if}</td>
                    <td class="nb_message {$CategoryRow.color}">
                        {$CategoryRow.unread} / 
                        {$CategoryRow.total}</td>
                  </tr>   
				{/foreach}

					

				  </table>
                  <a class="nouveau" onclick="javascript:ActionMethode.ouvrirPagePrincipale('messagerie.php', 'onglet_page=ecrire_message');">Ecrire un message</a>
              </div></div></div>     
{/block}
