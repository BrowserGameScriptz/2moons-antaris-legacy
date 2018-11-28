{block name="title" prepend}{$LNG.LOSTPWD_7}{/block}
{block name="content"}
<!-- //// SECTION PRINCIPALE //// -->
		<section role="main">
			<div name="youAreHere">
				<ul>
					<li>{$LNG.INDEX_25}</li>
					<li>{$LNG.LOSTPWD_10}</li>
				</ul>

				<div name="media">
					{foreach $languages as $langKey => $langName}
					<a class="no-underline" target="_blank" onclick="setLNG('{$langKey}')" hreflang="{$langKey}" title="{$langName}"><img src="https://cdn.antaris-legacy.eu/images/login/flags/{$langKey}.png" alt="{$langKey}" width="16px" height="16px"></a>
					{/foreach}
					
				</div>
			</div>

			<div data-page="forgottenPassword">
			{if $iserror == 1}
						<div class="msg-error margin-top-large margin-left-xlarge margin-right-xlarge">
				<div class="icon icon_error-triangle"></div>
				<div class="msg">{$errors}</div>
			</div>
		{/if}	
	
	<div name="playerDescription">
		<div class="column-25">
			<img src="https://cdn.antaris-legacy.eu/images/avatars/avatar_defaut.jpg" />
		</div>

		<div name="description" class="column-75">
			<h2>{$LNG.LOSTPWD_10}</h2>

			{$LNG.LOSTPWD_11}<br /><br />

			<span class="font-size-xlarge color-blue">{$lostusername}</span>
			 &mdash; <span class="font-size-xlarge">{$lostuniverse}</span><br />
			<span class="color-grey">{$LNG.LOSTPWD_12} : {$lostonlineti}</span><br /><br />

			<strong>{$LNG.LOSTPWD_13} : </strong> {$lostIp} (<em>{$lostCoun}</em>)<br />
			<strong>{$LNG.LOSTPWD_14} :</strong> {$lostexpires}<br />
		</div>
	</div>

	<div name="formPassword">
		<form method="post">
			<div class="line margin-bottom-medium">
				<label for="forPassword">{$LNG.INDEX_33} :</label>
				<div class="champ icon-input icon-left">
					<span class="icon_key_alt"></span>
					<input type="password" id="forPassword" name="password" maxlength="32" placeholder="{$LNG.INDEX_33}" autocorrect="off" />
				</div>
			</div>

			<div class="line margin-bottom-medium">
				<label for="forConfirmation">{$LNG.REGISTER_13} :</label>
				<div class="champ icon-input icon-left">
					<span class="icon_key_alt"></span>
					<input type="password" id="forConfirmation" name="confirmation" maxlength="32" placeholder="{$LNG.REGISTER_14}" autocorrect="off" />
				</div>
			</div>

			<button type="submit" name="validForm">
				<span class="icon_key_alt"></span>
				{$LNG.LOSTPWD_7}
			</button>

			<p class="text-center margin-top-medium">
				<a href="/">{$LNG.LOSTPWD_8}</a>
			</p>
		</form>
	</div>

	<div class="clear-both"></div>
</div>		</section>
{/block}
{block name="script" append}
{/block}