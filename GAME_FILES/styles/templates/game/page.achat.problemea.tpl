{block name="title" prepend}{$LNG.lm_achat_problem_1}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.lm_achat_problem_1}</h1><div class="onglet">
            <ul>
               <li><a href="?page=Achat" title="{$LNG.lm_achat_exchange}">{$LNG.lm_achat_exchange}</a></li>
              <li><a href="?page=Achat&mode=allopass" title="{$LNG.lm_achat_allo}">{$LNG.lm_achat_allo}</a></li>
              <li><a href="?page=Achat&mode=paypal" title="{$LNG.lm_achat_paypal}">{$LNG.lm_achat_paypal}</a></li>
			   <li><a href="?page=Achat&mode=paysafe" title="{$LNG.lm_achat_paysafe}">{$LNG.lm_achat_paysafe}</a></li>
              <li><a href="?page=Achat&mode=historique" title="{$LNG.lm_achat_history}">{$LNG.lm_achat_history}</a></li>  
            </ul>
          </div><div id="div_achat"><div id="achat_probleme" class="categorie">
            <h2>{$LNG.lm_achat_problem_1}</h2>
			{if empty($Message)}
            {$LNG.lm_achat_problem_10}
			
			<form method="post">         
                          <table>
                            <tbody><tr>
                              <td><b>{$LNG.lm_achat_problem_4} :</b></td>
                              <td>{$pusername} (<i>#{$paid}</i>)</td>
                            </tr>
                            <tr>
                                <td><label for="code_allopass">{$LNG.lm_achat_problem_11}</label> <i>{$LNG.lm_achat_problem_12}</i> <b>:</b></td>
                                <td><input id="code_allopass" name="code_allopass" maxlength="9" size="12" type="text"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input id="valid_form" name="valid_form" value="{$LNG.lm_achat_problem_9}" type="submit">
                                </td>
                            </tr>
                          </tbody></table>
                      </form>

			{else}
			
                <div class="sous_partie" style="padding-bottom : 15px;">
                    &lt;&lt; <a href="?page=Achat&mode=problemea">{$LNG.NOUVEAUTE_237}</a><br>
                </div>
               {$Message}
        
			{/if}

					  </div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}