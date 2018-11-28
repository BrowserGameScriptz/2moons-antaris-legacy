{block name="title" prepend}{$LNG.REGISTER_1}{/block}
{block name="content"}
<!-- //// SECTION PRINCIPALE //// -->
		<section role="main">
			<div name="youAreHere">
				<ul>
					<li>{$LNG.INDEX_25}</li>
					<li>{$LNG.REGISTER_1}</li>
				</ul>

				<div name="media">
					{foreach $languages as $langKey => $langName}
					<a class="no-underline" target="_blank" onclick="setLNG('{$langKey}')" hreflang="{$langKey}" title="{$langName}"><img src="https://cdn.antaris-legacy.eu/images/login/flags/{$langKey}.png" alt="{$langKey}" width="16px" height="16px"></a>
					{/foreach}
					
				</div>
			</div>

			<div data-page="registration">
	
	

	<div class="text-center margin-large">
		{$LNG.REGISTER_3}</span>
	</div>

	{*<h1>{$LNG.REGISTER_4}</h1>
	
	<div name="method" class="listRadio">
		<a name="create" class="activate" data-top="true" href="?page=register">
			<div class="background"></div>

			<div class="icon_circle-slelected"></div>
			<div name="description">
				<div class="font-size-xxlarge">{$LNG.REGISTER_6}</div>
				{$LNG.REGISTER_5}
			</div>
		</a>

		<a name="recovery" class=" column-50" data-top="false" href="?page=recover">
			<div class="background"></div>

			<div class="icon_circle-empty"></div>
			<div name="description">
				<div class="font-size-xxlarge">{$LNG.REGISTER_7}</div>
				{$LNG.REGISTER_8}
			</div>
		</a>
	</div>

	<div class="text-center margin-large">
		{$LNG.REGISTER_9}
	</div>
	*}

	<h1>
					{$LNG.REGISTER_10} Horizon		
	</h1>
	<div name="formCreate" id="hashFormCreate" class="margin-top-medium">
	
	{if $MsgI == 1}
		<div class="msg-error margin-bottom-large">
					<div class="icon icon_error-triangle"></div>
					<div class="msg">{$Msg}</div>
				</div>
		{/if}

		{if $Rgs == 0}
					<form method="post" action="#hashFormCreate">
				<input type="hidden" name="idUnivers" value="1" />
				<input type="hidden" name="idPlayer" value="" />
				<input type="hidden" name="mode" value="send" />
				<input type="hidden" value="{$externalAuth.account}" name="externalAuth[account]">
				<input type="hidden" value="{$externalAuth.method}" name="externalAuth[method]">
				<input type="hidden" value="{$referralData.id}" name="referralID">

				<div class="line margin-bottom-medium">
					<label for="forNickname">{$LNG.INDEX_32} :</label>
					<div class="champ icon-input icon-left">
						<span class="icon_profile"></span>
						<input type="text" id="forNickname" name="nickname" maxlength="20" placeholder="{$LNG.INDEX_32}" autocorrect="off" value="" />
					</div>
					<div class="color-grey">{$LNG.REGISTER_11}</div>
				</div>

				<div class="line margin-bottom-medium">
					<label for="forPassword">{$LNG.INDEX_33} :</label>
					<div class="champ icon-input icon-left">
						<span class="icon_key_alt"></span>
						<input type="password" id="forPassword" name="password" maxlength="32" placeholder="{$LNG.INDEX_33}" autocorrect="off" />
					</div>
					<div class="color-grey">{$LNG.REGISTER_12}</div>
				</div>

				<div class="line margin-bottom-medium">
					<label for="forConfirmation">{$LNG.REGISTER_13} :</label>
					<div class="champ icon-input icon-left">
						<span class="icon_key_alt"></span>
						<input type="password" id="forConfirmation" name="confirmation" maxlength="32" placeholder="{$LNG.REGISTER_14}" autocorrect="off" />
					</div>
					<div class="color-grey">{$LNG.REGISTER_29}</div>
				</div>

				<div class="line margin-bottom-medium">
					<label for="forEmail">{$LNG.REGISTER_15} :</label>
					<div class="champ icon-input icon-left">
						<span class="icon_mail_alt" style="padding-top:3px"></span>
						<input type="email" id="forEmail" name="email" maxlength="255" placeholder="{$LNG.REGISTER_15}" autocorrect="off" value="" />
					</div>
					<div class="color-grey">{$LNG.REGISTER_16}</div>
				</div>

				<div class="line margin-bottom-medium">
					<label for="forNamePlanet">{$LNG.REGISTER_17} :</label>
					<div class="champ icon-input icon-left">
						<span class="icon_house_alt" style="padding-top:3px"></span>
						<input type="text" id="forNamePlanet" name="namePlanet" maxlength="32" placeholder="{$LNG.REGISTER_18}" autocorrect="off" value="" />
					</div>
					<div class="color-grey">{$LNG.REGISTER_19}</div>
				</div>
				
				<div class="line margin-bottom-medium">
					<label for="forLanguage">{$LNG.SPECIAL_7} :</label>
					<div class="champ icon-input icon-left">
						<select name="lang" id="language">{html_options options=$languages selected=$lang}</select>
					</div>
					<div class="color-grey">{$LNG.SPECIAL_6}</div>
				</div>

				<div class="line margin-bottom-medium">
					<label for="forCaptcha">{$LNG.REGISTER_20} :</label>
					<div class="champ icon-input icon-left">
						<span class="icon_lock_alt"></span>
						<input type="text" id="forCaptcha" name="captcha" maxlength="4" placeholder="{$LNG.REGISTER_21}" autocorrect="off" />

						<img name="captcha" src="simple_php_captcha.php" />
					</div>
					<div class="color-grey">{$LNG.REGISTER_22}</div>
				</div>

				<div class="lineRule champ">
					<input type="checkbox" id="ruleGame" name="ruleGame" value="1"  />
					<label for="ruleGame">
						{$LNG.REGISTER_23}<span class="color-white"> - </span>
						<a href="?page=rules" title="{$LNG.REGISTER_24}">{$LNG.REGISTER_25}</a>
					</label>

					<input type="checkbox" id="termAndCondition" name="termAndCondition" value="1"  />
					<label for="termAndCondition">
						{$LNG.REGISTER_26}<span class="color-white"> - </span>
						<a href="?page=conditions" title="{$LNG.REGISTER_27}">{$LNG.REGISTER_25}</a>
					</label>
				</div>

				<div class="lineButton champ">
					<button type="submit" name="validForm">
						<span class="arrow_triangle-right_alt2" style="margin-right:2px;"></span>
						{$LNG.REGISTER_28}
					</button>
				</div>
			</form>
			{else}
				<div class="msg-success margin-bottom-large">
					<div class="icon icon_check_alt2"></div>
					<div class="msg">
						{$LNG.REGISTER_60}
					</div>
				</div>

				<div class="msg-warning margin-bottom-large">
					<div class="icon icon_error-circle_alt"></div>
					<div class="msg">
						{$LNG.REGISTER_61}
					</div>
				</div>

				<div class="text-justify">
					{$LNG.REGISTER_62}
					{$LNG.REGISTER_63}<br /><br />

					{$LNG.REGISTER_64}
				</div>
			{/if}
			</div>
</div>		</section>
{/block}
{block name="script" append}

{/block}