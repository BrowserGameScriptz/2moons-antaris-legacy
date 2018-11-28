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
          </div><div id="div_achat">
		  
		  <div class="avertissement_achat categorie">
              <h2>{$LNG.lm_achat_vii}</h2>
           {$LNG.lm_achat_vii1} :<br />
              <ul>
                  <li>{$LNG.lm_achat_vii2}.</li>
                  <li>{$LNG.lm_achat_vii3}.</li>
                  <li>{$LNG.lm_achat_vii4}.</li>
				  
                  
              </ul>
			
			{$LNG.lm_achat_moreinfo}.</div><div id="achat_allopass" class="categorie">
              <h2>{$LNG.lm_achat_paysafep}</h2><div style="text-align : justify; padding : 5px 20px 25px 20px;">
                
                 {$LNG.lm_achat_paysafepro}
                  <a href="?page=Achat&amp;mode=probleme" style="text-decoration : underline;">{$LNG.lm_achat_compform}</a> {$LNG.lm_achat_compform1}.</span><br />
              </div>
			  {if empty($Message)}
			 <form action="?page=Achat&mode=paysafe" method="post">
         <tr>
                              <td><b>{$LNG.NOUVEAUTE_216} :</b></td>
                              <td>{$payusername} (<i>#{$payid}</i>)</td>
                            </tr>
							<br><br>
							  <tr>
                              <td><label for="code_allopass">{$LNG.NOUVEAUTE_217}</label> <b>:</b></td>
                              <td><input id="code4" name="code4" maxlength="3" size="3" type="text"> (<i>€</i>)</td>
                            </tr>
							<br><br>
		  <tr>
                                <td><label for="code_allopass">{$LNG.NOUVEAUTE_218}</label><b>:</b></td>
                                <td><input id="code0" name="code0" maxlength="4" size="4" placeholder="1234" type="text"></td>-
								<td><input id="code1" name="code1" maxlength="4" size="4" placeholder="1234" type="text"></td>-
								<td><input id="code2" name="code2" maxlength="4" size="4" placeholder="1234" type="text"></td>-
								<td><input id="code3" name="code3" maxlength="4" size="4" placeholder="1234" type="text"></td>
                            </tr>
							
							 <input type="submit" value="{$LNG.lm_achat_paysafe}" />
							</form>
				{else}
						<form id="form_notification" method="post" action="?page=Achat&mode=paysafe">{$Message}<br><a onclick="location.href='game.php?page=Achat&mode=paysafe';">{$LNG.NOUVEAUTE_21}</a>	</form>
				{/if}
	</div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}