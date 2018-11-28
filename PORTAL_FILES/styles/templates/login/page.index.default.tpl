{block name="title" prepend}{$LNG.INDEX_12}{/block}
{block name="content"}

		<!-- //// SECTION PRINCIPALE //// -->
		<section role="main">
			<div name="youAreHere">
				<ul>
					<li>{$LNG.INDEX_25}</li>
					<li>{$LNG.INDEX_12}</li>
				</ul>

				<div name="media">
					{foreach $languages as $langKey => $langName}
					<a class="no-underline" target="_blank" onclick="setLNG('{$langKey}')" hreflang="{$langKey}" title="{$langName}"><img src="https://cdn.antaris-legacy.eu/images/login/flags/{$langKey}.png" alt="{$langKey}" width="16px" height="16px"></a>
					{/foreach}
					
				</div>
			</div>

			<div data-page="home">
	{if $ShowMessagePass == 1}
			<div class="msg-success">
				<div class="icon icon_check_alt2"></div>
				<div class="msg">
					{$ShowMessageTxt}
				</div>
			</div>
		{/if}	
	<div name="headband" class="num4"></div>

	<h1>{$LNG.INDEX_26}</h1>
	<div name="welcome">
		<div name="loginServer">
	{if $checkProxy != 1}	
		{if $ShowUser == 0}
			<h2>{$LNG.INDEX_27}</h2>

			<p class="margin-top-medium">
				{$LNG.INDEX_28}
				{$LNG.INDEX_29}
				{$LNG.INDEX_30}
			</p>

			<form method="post" action="?page=login">
				<div class="champ icon-input icon-left">
					<span class="icon_profile"></span>		
					<input type="text" name="pseudo" maxlength="20" placeholder="{$LNG.INDEX_32}" autocorrect="off" />
				</div>

				<div class="champ icon-input icon-left">	
					<span class="icon_key_alt"></span>			
					<input type="password" name="mdp" maxlength="32" placeholder="{$LNG.INDEX_33}" autocorrect="off" />
				</div>

				<button type="submit" name="validForm">
					<span class="arrow_triangle-right_alt2" style="margin-right:2px;"></span>
					{$LNG.INDEX_34}
				</button>

				<p class="margin-top-medium">
					<a href="index.php?page=LostPassword" title="{$LNG.INDEX_35}">{$LNG.INDEX_35}</a><br />
					<a href="index.php?page=register" title="{$LNG.INDEX_36}">{$LNG.INDEX_36}</a>
				</p>
			</form>
		{else}
				<ul class="nav">
		<a href="index.php?page=ingame">
		<li class="tw">
			<img class="icon" src="https://cdn.antaris-legacy.eu/images/login/rsz_8376.png" alt="">
			<span>{$LNG.SPECIAL_1}</span>
		</li>
		</a>
		<a href="index.php?page=invite">
		<li class="fb">
			<img class="icon" src="https://cdn.antaris-legacy.eu/images/login/group.png" alt="">
			<span>{$LNG.SPECIAL_2}</span>
		</li>
		</a>
		<a href="https://www.facebook.com/Control-Panel-890372641089987/">
		<li class="hm">
			<img class="icon" src="https://cdn.antaris-legacy.eu/images/login/social-facebook-24.png" alt="">
			<span>Facebook</span>
		</li>
		</a>
		<a href="index.php?page=profile">
		<li class="cl">
			<img class="icon" src="https://cdn.antaris-legacy.eu/images/login/rsz_user_female.png" alt="">
			<span>{$LNG.SPECIAL_3}</span>
		</li>
		</a>
	</ul>
		{/if}
	{else}
		<ul class="navProxy">
		<li class="fb">
		<span>Afin de limiter la tricherie sur le jeu Antaris Legacy, l'utilisation de VPN/proxy ou d'autre programme permettant de cacher la provenance et/ou l'adresse IP de l'internaute est prohibée. Le jeu et configuré automatiquement pour bloqué les requete venant de ce type de connexion.<br><br>Si vous pensez qu'il s'agit d'une erreur, vous pouvez ouvrir un thread sur notre forum avec votre nom d'utilisateur et l'ip [{$myuserip}] en question. [#err202sp1] - [<a href="//forum.antaris-univers.com">acceder au forum</a>]</span>
		</li>
	</ul>
	{/if}
		</div>

		<div name="listServer">
			<h2>{$LNG.INDEX_37}</h2>

												<ul>
				<li>
					<!-- Maintenance : icon_close_alt2 color-red -->
					<span class="icon_check_alt2 color-green"></span> 
					{$LNG.INDEX_38} <span class="font-bold">Horizon :</span>
				</li>
				<li>&mdash; {$LNG.INDEX_39} : {$memory_usage}</li>
				<li>&mdash; {$LNG.INDEX_40} : <span class="color-blue">{$LNG.months.8} 2016</span></li>
				<li>&mdash; {$LNG.INDEX_41} : <span class="color-orange">{$users_amount}</span></li>

				</ul>
							
					</div>
	</div>

	<h1>{$LNG.INDEX_43}</h1>
	<div name="listArticle"> 
	{foreach $newsList as $newsRow}
				<article data-num="{$newsRow.id}">
			<h2>{$newsRow.title}</h2>
			<p>          {$newsRow.text}       </p>

			<div name="date" class="color-grey">
				{$newsRow.date}				<span class="icon_calendar" style="margin-left:2px;"></span>
			</div>
			<div name="author" class="color-grey">
				{$LNG.INDEX_44} {$newsRow.from}			</div>
		</article>
		{/foreach}
			</div>
</div>
		</section>

		
{/block}
{block name="script" append}
<script>{if $code}alert({$code|json});{/if}</script>
{/block}