{block name="title" prepend}{$LNG.PRESENTATION_1}{/block}
{block name="content"}
<!-- //// SECTION PRINCIPALE //// -->
		<section role="main">
			<div name="youAreHere">
				<ul>
					<li>{$LNG.INDEX_25}</li>
					<li>{$LNG.PRESENTATION_1}</li>
				</ul>

				<div name="media">
					{foreach $languages as $langKey => $langName}
					<a class="no-underline" target="_blank" onclick="setLNG('{$langKey}')" hreflang="{$langKey}" title="{$langName}"><img src="https://cdn.antaris-legacy.eu/images/login/flags/{$langKey}.png" alt="{$langKey}" width="16px" height="16px"></a>
					{/foreach}
					
				</div>
			</div>

			<div data-page="presentation">
	<div name="introduction" class="margin-top-medium margin-bottom-xlarge">
		{$LNG.PRESENTATION_2}<br /><br />

		{$LNG.PRESENTATION_3}<br /><br />

		{$LNG.PRESENTATION_4}<br /><br />

		{$LNG.PRESENTATION_5} 
	</div>

	<h1>{$LNG.PRESENTATION_6}</h1>
	<div name="listPicture">
		<a class="fancybox" href="https://cdn.antaris-legacy.eu/images/login/screens/salle_de_controle.jpg" title="1. {$LNG.PRESENTATION_7}">
			<img src="https://cdn.antaris-legacy.eu/images/login/screens/salle_de_controle.jpg" alt="1. {$LNG.PRESENTATION_7}" />
		</a>
		<a class="fancybox" href="https://cdn.antaris-legacy.eu/images/login/screens/capteur.jpg" title="2. {$LNG.PRESENTATION_8}">
			<img src="https://cdn.antaris-legacy.eu/images/login/screens/capteur.jpg" alt="2. {$LNG.PRESENTATION_8}" />
		</a>
		<a class="fancybox" href="https://cdn.antaris-legacy.eu/images/login/screens/portail.jpg" title="3. {$LNG.PRESENTATION_9}">
			<img src="https://cdn.antaris-legacy.eu/images/login/screens/portail.jpg" alt="3. {$LNG.PRESENTATION_9}" />
		</a>
		<a class="fancybox" href="https://cdn.antaris-legacy.eu/images/login/screens/centre_spatial.jpg" title="4. {$LNG.PRESENTATION_10}">
			<img src="https://cdn.antaris-legacy.eu/images/login/screens/centre_spatial.jpg" alt="4. {$LNG.PRESENTATION_10}" />
		</a>
		<a class="fancybox" href="https://cdn.antaris-legacy.eu/images/login/screens/batiment.jpg" title="5. {$LNG.PRESENTATION_11}">
			<img src="https://cdn.antaris-legacy.eu/images/login/screens/batiment.jpg" alt="5. {$LNG.PRESENTATION_11}" />
		</a>
		<a class="fancybox" href="https://cdn.antaris-legacy.eu/images/login/screens/technologie.jpg" title="6. {$LNG.PRESENTATION_12}">
			<img src="https://cdn.antaris-legacy.eu/images/login/screens/technologie.jpg" alt="6. {$LNG.PRESENTATION_12}" />
		</a>
		<a class="fancybox" href="https://cdn.antaris-legacy.eu/images/login/screens/appareil.jpg" title="7. {$LNG.PRESENTATION_13}">
			<img src="https://cdn.antaris-legacy.eu/images/login/screens/appareil.jpg" alt="7. {$LNG.PRESENTATION_13}" />
		</a>
		<a class="fancybox" href="https://cdn.antaris-legacy.eu/images/login/screens/defense.jpg" title="8. {$LNG.PRESENTATION_14}">
			<img src="https://cdn.antaris-legacy.eu/images/login/screens/defense.jpg" alt="8. {$LNG.PRESENTATION_14}" />
		</a>
		<a class="fancybox" href="https://cdn.antaris-legacy.eu/images/login/screens/population.jpg" title="9. {$LNG.PRESENTATION_15}">
			<img src="https://cdn.antaris-legacy.eu/images/login/screens/population.jpg" alt="9. {$LNG.PRESENTATION_15}" />
		</a>
		<a class="fancybox" href="https://cdn.antaris-legacy.eu/images/login/screens/banque.jpg" title="10. {$LNG.PRESENTATION_16}">
			<img src="https://cdn.antaris-legacy.eu/images/login/screens/banque.jpg" alt="10. {$LNG.PRESENTATION_16}" />
		</a>
		<a class="fancybox" href="https://cdn.antaris-legacy.eu/images/login/screens/statistique.jpg" title="11. {$LNG.PRESENTATION_17}">
			<img src="https://cdn.antaris-legacy.eu/images/login/screens/statistique.jpg" alt="11. {$LNG.PRESENTATION_17}" />
		</a>
		<a class="fancybox" href="https://cdn.antaris-legacy.eu/images/login/screens/mission.jpg" title="12. {$LNG.PRESENTATION_18}">
			<img src="https://cdn.antaris-legacy.eu/images/login/screens/mission.jpg" alt="12. {$LNG.PRESENTATION_18}" />
		</a>
	</div>


	<h1>{$LNG.PRESENTATION_19}</h1>
	<p class="margin-top-medium">
		{$LNG.PRESENTATION_20}
	</p>

	<div name="listBrowser" class="margin-top-large">
		<div name="chrome">
			<img src="https://cdn.antaris-legacy.eu/images/login/icon_browser/chrome_black.png" title="{$LNG.PRESENTATION_21}" />
			<div class="font-size-large margin-bottom-medium">Google Chrome</div>

			<span>
				<em>{$LNG.PRESENTATION_22}.</em><br />
				<a href="http://www.google.com/intl/fr/chrome/browser/">{$LNG.PRESENTATION_23}</a><br />
				<span class="font-size-large margin-top-medium inline-block">58,81 %*</span>
			</span>
		</div>

		<div name="firefox">
			<img src="https://cdn.antaris-legacy.eu/images/login/icon_browser/firefox_black.png" title="{$LNG.PRESENTATION_24}" />
			<div class="font-size-large margin-bottom-medium">Mozilla Firefox</div>

			<span>
			   <em>{$LNG.PRESENTATION_26}</em><br />
			   <a href="http://www.mozilla.org/fr/firefox/fx/">{$LNG.PRESENTATION_25}</a><br />
			   <span class="font-size-large margin-top-medium inline-block">27,28 %*</span>
			</span>
		</div>

		<div name="safari">
			<img src="https://cdn.antaris-legacy.eu/images/login/icon_browser/safari_black.png" title="{$LNG.PRESENTATION_27}" />
			<div class="font-size-large margin-bottom-medium">Safari d'Apple</div>

			<span>
				<em>{$LNG.PRESENTATION_28}.</em><br />
				<a href="http://www.apple.com/fr/safari/">{$LNG.PRESENTATION_29}</a><br />
				<span class="font-size-large margin-top-medium inline-block">5,29 %*</span>
			</span>
		</div>

		<div name="IE">
			<img src="https://cdn.antaris-legacy.eu/images/login/icon_browser/IE_black.png" title="{$LNG.PRESENTATION_30}" />
			<div class="font-size-large margin-bottom-medium">Internet Explorer</div>

			<span>
				<em>{$LNG.PRESENTATION_31}.</em><br />
				<a href="http://windows.microsoft.com/fr-fr/internet-explorer/download-ie">{$LNG.PRESENTATION_32}</a><br />
				<span class="font-size-large margin-top-medium inline-block">2,72 %*</span>
			</span>
		</div>
	</div>

	<p class="margin-top-medium margin-bottom-medium text-right">
		{$LNG.PRESENTATION_33}
	</p>
</div>		</section>

{/block}