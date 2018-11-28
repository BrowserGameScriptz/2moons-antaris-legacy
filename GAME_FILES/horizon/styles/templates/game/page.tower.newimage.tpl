{block name="title" prepend}{$LNG.ls_tmanag_1}{/block}
{block name="content"}

<div id="page_contenu">      <h1>{$LNG.ls_tmanag_1}</h1><div id="page_tour_gestion">	<div class="onglet">
				<ul>
					<li><a href="?page=Tower" title="{$LNG.ls_tmanag_2}">{$LNG.ls_tmanag_2}</a></li>
					{if $headquarters_antaris >= 1}<li><a href="?page=Tower&mode=siege" title="{$LNG.ls_tmanag_3}">{$LNG.ls_tmanag_3}</a></li>{/if}
					{if $antaris_headpost >= 1}<li><a href="?page=Tower&mode=outpost" title="{$LNG.ls_tmanag_4}">{$LNG.ls_tmanag_4}</a></li>{/if}
					<li><a href="?page=Tower&mode=portal" title="{$LNG.ls_tmanag_5}">{$LNG.ls_tmanag_5}</a></li>
					<li><a href="?page=Tower&mode=construct" title="{$LNG.ls_tmanag_6}">{$LNG.ls_tmanag_6}</a></li>
				</ul>
			</div>	<div id="onglet_tour_gestion"><div id="general_planete" class="formulaire_image categorie">
						<h2>{$LNG.ls_tmanag_49} :</h2>
						{$LNG.ls_tmanag_50}.<br><br>
						<div id="reponse_ajax"></div><br><div class="choisir_image">
                                <img onclick="updateImage(34);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/34.jpg" title="{$LNG.NOUVEAUTE_350} : 34.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(41);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/41.jpg" title="{$LNG.NOUVEAUTE_350} : 41.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(18);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/18.jpg" title="{$LNG.NOUVEAUTE_350} : 18.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(32);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/32.jpg" title="{$LNG.NOUVEAUTE_350} : 32.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(26);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/26.jpg" title="{$LNG.NOUVEAUTE_350} : 26.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(21);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/21.jpg" title="{$LNG.NOUVEAUTE_350} : 21.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(28);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/28.jpg" title="{$LNG.NOUVEAUTE_350} : 28.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(14);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/14.jpg" title="{$LNG.NOUVEAUTE_350} : 14.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(4);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/4.jpg" title="{$LNG.NOUVEAUTE_350} : 4.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(17);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/17.jpg" title="{$LNG.NOUVEAUTE_350} : 17.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(42);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/42.jpg" title="{$LNG.NOUVEAUTE_350} : 42.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(30);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/30.jpg" title="{$LNG.NOUVEAUTE_350} : 30.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(8);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/8.jpg" title="{$LNG.NOUVEAUTE_350} : 8.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(12);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/12.jpg" title="{$LNG.NOUVEAUTE_350} : 12.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(44);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/44.jpg" title="{$LNG.NOUVEAUTE_350} : 44.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(10);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/10.jpg" title="{$LNG.NOUVEAUTE_350} : 10.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(19);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/19.jpg" title="{$LNG.NOUVEAUTE_350} : 19.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(36);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/36.jpg" title="{$LNG.NOUVEAUTE_350} : 36.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(43);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/43.jpg" title="{$LNG.NOUVEAUTE_350} : 43.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(27);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/27.jpg" title="{$LNG.NOUVEAUTE_350} : 27.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(9);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/9.jpg" title="{$LNG.NOUVEAUTE_350} : 9.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(37);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/37.jpg" title="{$LNG.NOUVEAUTE_350} : 37.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(38);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/38.jpg" title="{$LNG.NOUVEAUTE_350} : 38.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(35);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/35.jpg" title="{$LNG.NOUVEAUTE_350} : 35.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(3);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/3.jpg" title="{$LNG.NOUVEAUTE_350} : 3.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(5);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/5.jpg" title="{$LNG.NOUVEAUTE_350} : 5.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(24);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/24.jpg" title="{$LNG.NOUVEAUTE_350} : 24.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(6);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/6.jpg" title="{$LNG.NOUVEAUTE_350} : 6.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(31);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/31.jpg" title="{$LNG.NOUVEAUTE_350} : 31.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(22);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/22.jpg" title="{$LNG.NOUVEAUTE_350} : 22.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(7);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/7.jpg" title="{$LNG.NOUVEAUTE_350} : 7.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(23);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/23.jpg" title="{$LNG.NOUVEAUTE_350} : 23.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(33);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/33.jpg" title="{$LNG.NOUVEAUTE_350} : 33.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(13);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/13.jpg" title="{$LNG.NOUVEAUTE_350} : 13.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(2);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/2.jpg" title="{$LNG.NOUVEAUTE_350} : 2.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(1);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/1.jpg" title="{$LNG.NOUVEAUTE_350} : 1.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(11);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/11.jpg" title="{$LNG.NOUVEAUTE_350} : 11.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(25);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/25.jpg" title="{$LNG.NOUVEAUTE_350} : 25.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(39);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/39.jpg" title="{$LNG.NOUVEAUTE_350} : 39.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(40);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/40.jpg" title="{$LNG.NOUVEAUTE_350} : 40.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(16);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/16.jpg" title="{$LNG.NOUVEAUTE_350} : 16.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(20);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/20.jpg" title="{$LNG.NOUVEAUTE_350} : 20.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(15);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/15.jpg" title="{$LNG.NOUVEAUTE_350} : 15.jpg"></div><div class="choisir_image">
                                <img onclick="updateImage(29);" src="https://cdngames.antaris-legacy.eu/media/ingame/planet/29.jpg" title="{$LNG.NOUVEAUTE_350} : 29.jpg"></div>	<div class="espace"></div>
					  </div></div></div></div>                    <!-- Fin du corps -->
            <div class="espace"></div>
{/block}