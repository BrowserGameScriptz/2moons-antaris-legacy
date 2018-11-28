{block name="title" prepend}{$LNG.NOUVEAUTE_37}{/block}
{block name="content"}
<div id="page_contenu"><h1>{$LNG.NOUVEAUTE_37}</h1><div class="onglet">
              <ul>
                 <li><a href="?page=Reward2" title="{$LNG.lm_redeem_2}">{$LNG.lm_redeem_1}</a></li>
                  <li><a href="?page=Reward2&mode=historique" title="{$LNG.lm_redeem_3}">{$LNG.lm_redeem_4}</a></li>
              </ul>
          </div>
          <div id="div_bunker"><!-- Sous titre de l'onglet -->
<h2 class="titre_corps">{$LNG.lm_redeem_5}</h2>

<div name="bunker_transaction">
    <!-- Image d'illustration du bunker à ressources --> 
    <img name="illustration" src="https://cdngames.antaris-legacy.eu/media/image/voucher.jpg" />
    
    <!-- Paragraphe explicatif -->
    <p>
       {$LNG.lm_redeem_6}
        <br /><br />
    </p>
    {if !empty($Message)}{$Message}{/if}
    <!-- Si le formulaire a été envoyé par le joueur -->
        
    <!-- Formulaire à remplir pour effectuer des actions auprès du bunker -->
<form method="post" action="?page=Reward2">	
        <table>
            <tr>
                <th colspan="4"></th>

            </tr>

            <!-- On parcours les quatres ressources du jeu -->
                      
        </table>
        
        
     
        <!-- Explication sur le captcha -->
        <div name="explication_captcha">
           {$LNG.lm_redeem_7}
        </div><!--
        
        --><div name="captcha">
            <label for="captcha">{$LNG.lm_redeem_8} :</label> 
            
            <!-- Affichage de l'image captcha -->
            <div class="champ">
                <input type="text" id="captcha" name="voucher"  value="" />
            </div>

           
        </div>
                
        <input type="submit" name="redeem" value="{$LNG.lm_redeem_9}" />
    </form>
  
</div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}
