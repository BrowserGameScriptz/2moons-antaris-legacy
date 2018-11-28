{block name="title" prepend}Intro{/block}
{block name="content"}
 <!-- Le corps de la page -->
        
              
        <div id="page_contenu"><h1>{$LNG.ls_intro_1} {$userick}</h1>
<div id="bienvenue">
    <div class="acces"><a onclick="location.href='game.php?page=overview';" title="{$LNG.ls_intro_2}">{$LNG.ls_intro_3}</a></div>
    <div class="texte">
        <div class="titre centre">{$LNG.ls_intro_4}</div>
        {$LNG.ls_intro_5}<br><br>

        {$LNG.ls_intro_6}.<br><br>

        {$LNG.ls_intro_7}<br><br>

        {$LNG.ls_intro_8}
    </div>
</div>
<a onclick="javascript:ApplicationMethode.supprimerMessageBienvenue();" class="gris">Je ne souhaite plus voir afficher cette page lors de ma connexion.</a></div>                    <!-- Fin du corps -->
       
			{/block}