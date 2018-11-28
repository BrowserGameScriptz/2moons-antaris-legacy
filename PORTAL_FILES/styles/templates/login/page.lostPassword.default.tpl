{block name="title" prepend}{$LNG.LOSTPWD_7}{/block}
{block name="content"}
<!-- //// SECTION PRINCIPALE //// -->
		<section role="main">
			<div name="youAreHere">
				<ul>
					<li>{$LNG.INDEX_25}</li>
					<li>{$LNG.INDEX_35}</li>
				</ul>

				<div name="media">
					{foreach $languages as $langKey => $langName}
					<a class="no-underline" target="_blank" onclick="setLNG('{$langKey}')" hreflang="{$langKey}" title="{$langName}"><img src="https://cdn.antaris-legacy.eu/images/login/flags/{$langKey}.png" alt="{$langKey}" width="16px" height="16px"></a>
					{/foreach}
					
				</div>
			</div>

			<div data-page="forgottenPassword">
			
			{if $MsgI == 1}
				<div class="msg-error margin-top-large margin-left-xlarge margin-right-xlarge">
				<div class="icon icon_error-triangle"></div>
				<div class="msg">{$Msg}</div>
			</div>
			{/if}
			
			{if $Rgs == 1}
				<div class="msg-success margin-top-large margin-left-xlarge margin-right-xlarge">
				<div class="icon icon_check_alt2"></div>
				<div class="msg">
					{$MsgII}
				</div>
			</div>
			{/if}


	<div name="explanation">
		<h2>{$LNG.LOSTPWD_1}</h2>

		{$LNG.LOSTPWD_2}
		{$LNG.LOSTPWD_3}<br /><br />

		{$LNG.LOSTPWD_4}
		{$LNG.LOSTPWD_5}<br /><br />

		{$LNG.LOSTPWD_6}
	</div>

	<div name="formPassword">
		<form method="post">
		<input type="hidden" value="send" name="mode">


			<label for="forEmail">{$LNG.CONTACT_12} :</label>
			<div class="champ icon-input icon-left">
				<span class="icon_mail_alt" style="padding-top:3px"></span>
				<input type="email" id="forEmail" name="email" maxlength="255" placeholder="{$LNG.REGISTER_15}"
					   autocorrect="off" value="{if $mail != 0}$mail{/if}" />
			</div>

			<label for="forCaptcha">{$LNG.REGISTER_20} : </label>
			<div class="champ icon-input icon-left">
				<span class="icon_lock_alt"></span>
				<input type="text" id="forCaptcha" name="captcha" maxlength="4" placeholder="{$LNG.REGISTER_21}" autocorrect="off" />

				<img name="captcha" src="simple_php_captcha.php" class="margin-right-medium" />
				<span class="inline-block font-italic color-grey">
					{$LNG.CONTACT_21}
				</span>
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