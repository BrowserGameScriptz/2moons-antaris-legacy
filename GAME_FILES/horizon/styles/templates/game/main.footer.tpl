 </div>
            <div class="espace"></div>
        
            
            <!-- On affiche le copyright -->
            <div id="bar_copyright">
                © {$LNG.NOUVEAUTE_164} - 
                <span name="temps_execution"></span> sec <span style="float:right;"><select onchange="window.open(this.options[this.selectedIndex].value,'_top')"><option {if $langen == 2}selected{/if} value="game.php?page=changelang&langs=fr">French</option><option value="game.php?page=changelang&langs=en" {if $langen == 1}selected{/if}>English</option></select></span>
            </div>
        
        <!-- Fin de l'ensemble -->
        </div>
                
        <!-- Cet élément « script » doit être obligatoirement en bas de la page -->
        <script type="text/javascript">
            CookieMethode.supprimer('application-cle_cryptage');
            CookieMethode.creer('application-cle_cryptage', 'zI85DfBGGf80NlhI96gd4fdNbYhQXumNmislA2f73BAlNYwnP1ZnAVotsHyLKCAcEjOlo7lJyfr0hdZy9G18Yg', 0);
        </script>
    </body>
</html>