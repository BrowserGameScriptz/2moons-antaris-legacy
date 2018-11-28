{block name="title" prepend}{$LNG.NOUVEAUTE_214} {/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.NOUVEAUTE_214}</h1><div class="onglet">
            <ul>
              <li><a href="?page=Achat" title="{$LNG.lm_achat_exchange}">{$LNG.lm_achat_exchange}</a></li>
              <li><a href="?page=Achat&mode=allopass" title="{$LNG.lm_achat_allo}">{$LNG.lm_achat_allo}</a></li>
              <li><a href="?page=Achat&mode=paypal" title="{$LNG.lm_achat_paypal}">{$LNG.lm_achat_paypal}</a></li>
			   <li><a href="?page=Achat&mode=paysafe" title="{$LNG.lm_achat_paysafe}">{$LNG.lm_achat_paysafe}</a></li>
              <li><a href="?page=Achat&mode=historique" title="{$LNG.lm_achat_history}">{$LNG.lm_achat_history}</a></li> 
            </ul>
          </div>
		  
		  
		  <div id="div_achat"><div class="avertissement_achat categorie">
              <h2>{$LNG.lm_achat_vii}</h2>
           {$LNG.lm_achat_vii1} :<br />
              <ul>
                  <li>{$LNG.lm_achat_vii2}.</li>
                  <li>{$LNG.lm_achat_vii3}.</li>
				  
                  
              </ul>
			{$LNG.lm_achat_moreinfo}.</div>
			{if $commandctr == 0}
			<div id="achat_allopass" class="categorie">
              <h2>{$LNG.lm_achat_buyallo}</h2><div style="text-align : justify; padding : 5px 20px 25px 20px;">
                 {$LNG.lm_achat_attention1}
                  <a href="?page=achat&amp;mode=probleme" style="text-decoration : underline;">{$LNG.lm_achat_compform}</a> {$LNG.lm_achat_compform1}.</span><br /><br />
              </div>

				<a href="{$getLink}"><button name="valid_form_allopass">{$LNG.NOUVEAUTE_233}</button></a>				
 
	</div>
	
	{else}
			  
			  <div id="achat_paypal" class="categorie">
              <h2>{$LNG.lm_achat_buyallo}</h2><div class="centre">
                          <span class="vert"><b>{$LNG.achat_succes_8}.</b><br><i>{$LNG.achat_succes_2}.</i></span><br><br>
                          <span style="display : inline-block; width : 200px; margin-right : 50px; font-weight : bold; text-align : left;">{$LNG.achat_succes_3} :</span>
                          <span style="display : inline-block; width : 250px; text-align : left;">{$pinCode}</span><br>
                          <span style="display : inline-block; width : 200px; margin-right : 50px; font-weight : bold; text-align : left;">{$LNG.achat_succes_4} :</span>
                          <span style="display : inline-block; width : 250px; text-align : left;">
                              <span class="cyan">{$pinCredits}</span> {$LNG.achat_succes_6} <b>{$pinPrice}</b>€
                          </span><br><br>
                          {$LNG.achat_succes_9}
                      </div></div>
			  
			  {/if}
	</div>
	</div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}

