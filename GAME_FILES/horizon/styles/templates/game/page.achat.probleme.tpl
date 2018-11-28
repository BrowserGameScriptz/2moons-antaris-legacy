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
            {$LNG.lm_achat_problem_2}.
			
			<form id="choisir_methode" action="?page=achat&mode=probleme" method="post">
                  <label for="methode">{$LNG.NOUVEAUTE_242} :</label>
                  <select onchange="window.open(this.options[this.selectedIndex].value,'_top')">
				  <option value="" disabled="disabled" selected="selected">{$LNG.NOUVEAUTE_243}</option>
                      <option value="?page=Achat&mode=problemea">Xsolla</option>
                      <option value="?page=Achat&mode=problemep">Paypal</option>
                      <option value="?page=Achat&mode=problemepp">PaysafeCard</option>
                  </select>
              </form>	</div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
			
	

			
{/block}

