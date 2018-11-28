{block name="title" prepend}{$LNG.CONTACT_0}{/block}
{block name="content"}
<!-- //// SECTION PRINCIPALE //// -->
		<section role="main">
			<div name="youAreHere">
				<ul>
					<li>{$LNG.INDEX_25}</li>
					<li>{$LNG.CONTACT_1}</li>
				</ul>

				<div name="media">
					{foreach $languages as $langKey => $langName}
					<a class="no-underline" target="_blank" onclick="setLNG('{$langKey}')" hreflang="{$langKey}" title="{$langName}"><img src="https://cdn.antaris-legacy.eu/images/login/flags/{$langKey}.png" alt="{$langKey}" width="16px" height="16px"></a>
					{/foreach}
					
				</div>
			</div>

			<div data-page="contact">
	<div name="explanation" class="margin-top-medium margin-bottom-xlarge">
		{$LNG.CONTACT_2} 
        {$LNG.CONTACT_3}
        {$LNG.CONTACT_4}<br /><br />
        
        {$LNG.CONTACT_5} 
        {$LNG.CONTACT_6}<br /><br />
        
        <strong class="color-grey">
        	{$LNG.CONTACT_7} 
        	{$LNG.CONTACT_8}
        </strong>
	</div>

	<h1>{$LNG.CONTACT_9}</h1>
	<div name="formContact" class="margin-top-medium">
			{if $errorNum == 0}
			<div class="msg-error">
					<div class="icon icon_error-triangle"></div>
					<div class="msg">{$errorMsg}<br /></div>
			</div>
			{elseif $errorNum == 1}
			<div class="msg-success">
					<div class="icon icon_check_alt2"></div>
					<div class="msg">
						{$errorMsg}
					</div>
				</div>
			{/if}
		<form method="post">
			<div class="column-50">
				<label for="forName">{$LNG.CONTACT_10} :</label>
				<div class="champ icon-input icon-left">
					<span class="icon_profile"></span>		
					<input  type="text" id="forName" name="name" maxlength="50" placeholder="{$LNG.CONTACT_11}" 
							autocorrect="off" value="{$nickname}" />
				</div>

				<label for="forEmail">{$LNG.CONTACT_12} :</label>
				<div class="champ icon-input icon-left">
					<span class="icon_mail_alt" style="padding-top:3px"></span>		
					<input  type="email" id="forEmail" name="email" maxlength="255" placeholder="{$LNG.REGISTER_15}" 
							autocorrect="off" value="{$email}" />
				</div>

				<label for="forSubject">{$LNG.CONTACT_13} :</label>
				<div class="champ icon-input icon-left">
					<span class="icon_menu-square_alt2"></span>
					<select id="forSubject" name="subject">
													<option value="1" {if $subject == 1}selected{/if}>{$LNG.CONTACT_14.1}</option>
													<option value="2" {if $subject == 2}selected{/if}>{$LNG.CONTACT_14.2}</option>
													<option value="3" {if $subject == 3}selected{/if}>{$LNG.CONTACT_14.3}</option>
													<option value="4" {if $subject == 4}selected{/if}>{$LNG.CONTACT_14.4}</option>
													<option value="5" {if $subject == 5}selected{/if}>{$LNG.CONTACT_14.5}</option>
													<option value="6" {if $subject == 6}selected{/if}>{$LNG.CONTACT_14.6}</option>
											</select>
				</div>
			</div>
			<div class="column-50">
				<label for="forMessage">{$LNG.CONTACT_19} :</label>
				<div class="champ">
					<textarea id="forMessage" name="message" placeholder="{$LNG.CONTACT_20}">{$message}</textarea>
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

				<div class="text-right">
					<button type="submit" name="validForm">
						<span class="icon_mail_alt" style="margin-right:2px;"></span>
						{$LNG.CONTACT_22}
					</button>
				</div>
			</div>
		</form>
	</div>

	<h1>{$LNG.CONTACT_23}</h1>
	<div name="legalNotice" class="margin-top-medium margin-bottom-xlarge">
		<h2>{$LNG.CONTACT_24}</h2>
		{$LNG.CONTACT_25}

		<div class="font-bold margin-top-medium">{$LNG.CONTACT_26} :</div>
		<ul>
			{*<li>
				{$LNG.CONTACT_27} : 
				<span class="color-grey">M. Jeremy Baukens</span>
			</li>
			<li>
				{$LNG.CONTACT_28} : 
				<span class="color-grey">M. Jeremy Baukens</span>
			</li>*}
			<li>
				{$LNG.CONTACT_29} : 
				<span class="color-grey">{$LNG.CONTACT_31}</span>
			</li>
			<li>
				{$LNG.REGISTER_15} : 
				<span class="color-grey">clients<span class="no-display">[</span>[at]<span class="no-display">]</span>makeyourgame.pro</span>
			</li>
			<li>
				{$LNG.CONTACT_30} : 
				<span class="color-grey">{$LNG.CONTACT_31}</span>
			</li>
		</ul>

		<h2 class="margin-top-large">{$LNG.CONTACT_32}</h2>
		{$LNG.CONTACT_33}. 

		<div class="font-bold margin-top-medium">{$LNG.CONTACT_34} :</div>
		<ul>
			<li>
				{$LNG.CONTACT_35} : 
				<div class="color-grey margin-left-xlarge">OVH – RCS Roubaix – Tourcoing<br />424 761 419 00045</div>
			</li>
			<li>
				{$LNG.CONTACT_36} :
				<div class="color-grey margin-left-xlarge">2 rue Kellermann<br />59 100 Roubaix, France </div>
			</li>
			<li>
				{$LNG.CONTACT_30} : 
				<span class="color-grey">(+33)9 72 10 01 11</span>
			</li>
		</ul>

	</div>
</div>		</section>

{/block}