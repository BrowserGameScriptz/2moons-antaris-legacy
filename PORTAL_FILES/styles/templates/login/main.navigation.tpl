<div class="spaceShip large"></div>
		<div class="spaceShip small"></div>
		<div class="spaceShip medium"></div>

		<!-- //// POLITIQUE DES COOKIES //// -->
		<div name="cookiePolicy" class="no-display">
			{$LNG.INDEX_6}

			<a href="#" title="{$LNG.INDEX_7}">{$LNG.INDEX_8}</a>
		</div>

		<!-- //// RETOUR HAUT DE PAGE //// -->
		<div name="backTop">
			<a href="#hashBackTop" title="{$LNG.INDEX_9}" data-duration="speed">
				<span class="arrow_carrot-up_alt2 color-grey"></span>
			</a>
		</div>

		<!-- //// MENU DE NAVIGATION //// -->
		<nav id="hashBackTop">
			<a href="#" name="menuSmallScreen">
				<span class="arrow_carrot-2down"></span>
				{$LNG.INDEX_10}
				<span class="arrow_carrot-2down"></span>
			</a>

			<ul>
				<li>
					<a href="index.php" title="{$LNG.INDEX_11}">{$LNG.INDEX_12}</a>
					<span></span>
				</li>
				<li>
					<a href="index.php?page=presentation" title="{$LNG.INDEX_13}">{$LNG.INDEX_14}</a>
					<span></span>
				</li>
				<li>
					<a href="index.php?page=rules" title="{$LNG.INDEX_15}">{$LNG.INDEX_16}</a>
					<span></span>
				</li>
				<li>
					<a href="index.php?page=conditions" title="{$LNG.INDEX_17}">{$LNG.INDEX_18}</a>
					<span></span>
				</li>
				<li>
					<a href="index.php?page=disclamer" title="{$LNG.INDEX_19}">{$LNG.INDEX_20}</a>
					<span></span>
				</li>
				<li>
					{if $ShowUser == 0}<a href="index.php?page=register" title="{$LNG.INDEX_21}">{$LNG.INDEX_22}</a>{else}
					<a href="index.php?page=Logout" title="{$LNG.SPECIAL_5}">{$LNG.SPECIAL_4}</a>{/if}
					<span></span>
				</li>
			</ul>
		</nav>

		<!-- //// HEADER //// -->
		<header>
			{$LNG.INDEX_23}
			{$LNG.INDEX_24}
		</header>