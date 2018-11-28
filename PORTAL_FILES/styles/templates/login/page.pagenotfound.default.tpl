{block name="title" prepend}{$LNG.ERREUR_2}{/block}
{block name="content"}
<!-- //// SECTION PRINCIPALE //// -->
		<section role="main">
			<div name="youAreHere">
				<ul>
					<li>{$LNG.INDEX_25}</li>
					<li>{$LNG.ERREUR_1}</li>
				</ul>

				<div name="media">
					{foreach $languages as $langKey => $langName}
					<a class="no-underline" target="_blank" onclick="setLNG('{$langKey}')" hreflang="{$langKey}" title="{$langName}"><img src="https://cdn.antaris-legacy.eu/images/login/flags/{$langKey}.png" alt="{$langKey}" width="16px" height="16px"></a>
					{/foreach}
					
				</div>
			</div>

			<div data-page="error" class="404">
	<div class="msg first">
		{$LNG.ERREUR_3}
	</div>

	<div class="container">
		<div class="vortex"></div>
		<div class="vortex"></div>
		<div class="vortex"></div>
		<div class="vortex"></div>
		<div class="vortex"></div>

		<div class="codeError">404</div>
		<div class="msgError">{$LNG.ERREUR_4}</div>
	</div>

	<div class="msg last">
		{$LNG.ERREUR_5}<br />
		<a href="/" title="{$LNG.ERREUR_6}">{$LNG.ERREUR_7}</a><br />
		<a href="/index.php?page=register" title="{$LNG.ERREUR_8}">{$LNG.ERREUR_9}</a>
	</div>
</div>		</section>
{/block}