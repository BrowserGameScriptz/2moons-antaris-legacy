{block name="title" prepend}{$LNG.fcm_info}{/block}
{block name="content"}
 <script>
	  $(function(){
		$("#paypal_form").submit();
	  });
	  </script>
<div id="page_contenu"><h1>{$LNG.fcm_info}</h1><div id="div_achat">    <div class="categorie">
                <form method="post" id="paypal_form" name="paypal_form" action="https://www.paypal.com/cgi-bin/webscr">
	  {foreach from=$fields item=i key=k}
		{$i.text}
	  {/foreach}
              {$LNG.NOUVEAUTE_229}
			   <br>
			   <br>{$LNG.NOUVEAUTE_230}<br><br>{$LNG.NOUVEAUTE_231}<br><br><input type="submit" value="{$LNG.NOUVEAUTE_232}">
              </div>
              </div></div>       </form>             <!-- Fin du corps -->
            <div class="espace"></div>
{/block}


