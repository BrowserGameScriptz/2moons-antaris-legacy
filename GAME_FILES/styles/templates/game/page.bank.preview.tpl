{block name="title" prepend}Banque{/block}
{block name="content"}
{if $Bankaccept == 0}
    <div class="reponse_valide">{$LNG.ls_bank_29} :</div>
	
	
	<table>
                            <tbody><tr>
                                <td>{$LNG.ls_bank_30} :</td>
                                <td><span class="orange">{$quantite_vendu}</span> u. 
                                    {$langsell}</td>
                            </tr>
                            <tr>
                                <td>{$LNG.ls_bank_31} :</td>
                                <td><span class="{if $taxSell < 0}rouge{else}vert{/if}">{$taxSell} %</span><br></td>
                            </tr>
                            <tr>
                                <td>{$LNG.ls_bank_32} :</td>
                                <td><span class="{if $taxBuy < 0}rouge{else}vert{/if}">{$taxBuy} %</span><br></td>
                            </tr>
                            <tr>
                                <td>{$LNG.ls_bank_33} :</td>
                                <td class="jaune">{$impots} %</td>
                            </tr>
                            <tr>
                                <td>{$LNG.ls_bank_34} :</td>
                                <td><span class="orange">{$result}</span> u. 
                                    {$langbuy}</td> 
                            </tr>
                        </tbody></table>
						{else}
        <div id="proposition_banque">
            <div class="chargement"></div>
            <div id="result_message" class="message_flux">{$LNG.NOUVEAUTE_70}<br>
			{$Msg}
			</div>
        </div>
		{/if}
{/block}
{block name="script" append}
<script type="text/javascript">
var Bankacceptas = {$Bankaccept};
</script> 
{/block}