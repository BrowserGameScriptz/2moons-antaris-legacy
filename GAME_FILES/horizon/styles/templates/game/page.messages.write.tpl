{block name="title" prepend}{$LNG.NOUVEAUTE_504}{/block}
{block name="content"}
<div id="page_contenu">      <h1>{$LNG.NOUVEAUTE_504}</h1>
          <div id="page_messagerie"><div class="retour_page">
                  &lt;&lt; <a href="?page=messages">{$LNG.NOUVEAUTE_509}</a>
              </div>
			  <div class="action_onglet">
                  <a onclick="location.href='game.php?page=messages&mode=view&messcat=1';">{$LNG.NOUVEAUTE_520}</a> &gt;&gt;
              </div>
			  <h2 class="titre_corps">{$LNG.NOUVEAUTE_288} : <span class="orange">{$LNG.NOUVEAUTE_521}</span></h2><div id="ecrire_message" class="categorie">
              <h2>{$LNG.NOUVEAUTE_522}</h2>
			  <form id="form_ecrire_message" action="game.php?page=messages" method="post">
			  <input type="hidden" name="mode" value="write">
			  <input type="hidden" name="id" value="{$id}">
                  <table>
                      <tbody><tr class="message_prive">
                                  <td colspan="2">
                                      <label for="pseudo">{$LNG.lm_achat_problem_4} :</label>
                                      <input id="pseudo" name="pseudo" value="{$OwnerRecord.username}" type="text" disabled>
                                     
                                  </td>
                              </tr>
                      <tr class="sujet">
                          <td colspan="2">
                              <label for="sujet">{$LNG.ls_alliance_62} : </label>
                              <input id="subject" name="subject" value="{if !empty($subject)}{$subject}{else}{$LNG.mg_no_subject}{/if}" type="text">
                          </td>
                      </tr>

                      <tr class="message">
                          <td colspan="2"><textarea placeholder="{$LNG.NOUVEAUTE_523}" id="texte" name="texte" rows="6"></textarea></td>
                      </tr>
                      <tr class="validation">
                          <td colspan="2">
                             <input name="valid_form" value="{$LNG.ls_alliance_63}" type="submit">
                          </td>
                      </tr>
                  </tbody></table>
              </form>
			  
			  
             </div></div>     </div>               <!-- Fin du corps -->

{/block}
