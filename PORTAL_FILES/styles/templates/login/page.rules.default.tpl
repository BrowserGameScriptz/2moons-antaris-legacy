{block name="title" prepend}{$LNG.RULES_1}{/block}
{block name="content"}

<!-- //// SECTION PRINCIPALE //// -->
		<section role="main">
			<div name="youAreHere">
				<ul>
					<li>{$LNG.INDEX_25}</li>
					<li>{$LNG.RULES_1}</li>
				</ul>

				<div name="media">
					{foreach $languages as $langKey => $langName}
					<a class="no-underline" target="_blank" onclick="setLNG('{$langKey}')" hreflang="{$langKey}" title="{$langName}"><img src="https://cdn.antaris-legacy.eu/images/login/flags/{$langKey}.png" alt="{$langKey}" width="16px" height="16px"></a>
					{/foreach}
					
				</div>
			</div>

			<div data-page="rule">
    <!-- Sommaire -->
    <div name="summary" class="margin-top-medium">
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionCompte">
                    <b>1.&nbsp;{$LNG.RULES_12}</b>
                </a><br />

                                    &mdash;&nbsp;<a class="no-underline" href="#articleMultiCompte">
                        1.1.&nbsp;{$LNG.RULES_2}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleNavigationAnonyme">
                        1.2.&nbsp;{$LNG.RULES_3}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleCoGerance">
                        1.3.&nbsp;{$LNG.RULES_4}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleDonCompte">
                        1.4.&nbsp;{$LNG.RULES_5}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articlePretCompte">
                        1.5.&nbsp;{$LNG.RULES_6}                   </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleModePause">
                        1.6.&nbsp;{$LNG.RULES_7}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleMotDePasse">
                        1.7.&nbsp;{$LNG.RULES_8}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleUsurpation">
                        1.8.&nbsp;{$LNG.RULES_9}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleCommunication">
                        1.9.&nbsp;{$LNG.RULES_10}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleSuppressionCompte">
                        1.10.&nbsp;{$LNG.RULES_11}                    </a><br />
                            </div>
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionCommercePush">
                    <b>2.&nbsp;{$LNG.RULES_13}</b>
                </a><br />

                                    &mdash;&nbsp;<a class="no-underline" href="#articleRupturePacte">
                        2.1.&nbsp;{$LNG.RULES_14}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articlePush">
                        2.2.&nbsp;{$LNG.RULES_15}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleCompteDormant">
                        2.3.&nbsp;{$LNG.RULES_16}                   </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleContournementRegle">
                        2.4.&nbsp;{$LNG.RULES_17}                    </a><br />
                            </div>
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionAttaque">
                    <b>3.&nbsp;{$LNG.RULES_18}</b>
                </a><br />

                                    &mdash;&nbsp;<a class="no-underline" href="#articleAttaqueTempsGuerre">
                        3.1.&nbsp;{$LNG.RULES_19}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleTreveGenerale">
                        3.2.&nbsp;{$LNG.RULES_20}                    </a><br />
                            </div>
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionAlliance">
                    <b>4.&nbsp;{$LNG.RULES_21}</b>
                </a><br />

                                    &mdash;&nbsp;<a class="no-underline" href="#articleAllianceTempsGuerre">
                        4.1.&nbsp;{$LNG.RULES_22}                    </a><br />
                            </div>
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionBugErreur">
                    <b>5.&nbsp;{$LNG.RULES_23}</b>
                </a><br />

                                    &mdash;&nbsp;<a class="no-underline" href="#articleAideTechnique">
                        5.1.&nbsp;{$LNG.RULES_24}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleBug">
                        5.2.&nbsp;{$LNG.RULES_25}                    </a><br />
                            </div>
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionInjure">
                    <b>6.&nbsp;{$LNG.RULES_26}</b>
                </a><br />

                                    &mdash;&nbsp;<a class="no-underline" href="#articleRegleTchat">
                        6.1.&nbsp;{$LNG.RULES_27}                    </a><br />
                            </div>
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionRespectReglement">
                    <b>7.&nbsp;{$LNG.RULES_28}</b>
                </a><br />

                                    &mdash;&nbsp;<a class="no-underline" href="#articleSanction">
                        7.1.&nbsp;{$LNG.RULES_29}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleDesavantage">
                        7.2.&nbsp;{$LNG.RULES_30}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleModification">
                        7.3.&nbsp;{$LNG.RULES_31}                    </a><br />
                            </div>
            </div>

    <!-- Titre du document -->
    <h1>{$LNG.RULES_32}</h1>

            <!-- Section -->
        <h2 id="sectionCompte">
            1.&nbsp;{$LNG.RULES_12}        </h2>
        <section>
                                        {$LNG.RULES_62}          <br /><br /> 
            
                            <!-- Article -->
                <h3 id="articleMultiCompte">
                    1.1.&nbsp;{$LNG.RULES_2}                </h3>
                <article>
                                {$LNG.RULES_61}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleNavigationAnonyme">
                    1.2.&nbsp;{$LNG.RULES_3}                </h3>
                <article>
                                {$LNG.RULES_60}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleCoGerance">
                    1.3.&nbsp;{$LNG.RULES_4}                </h3>
                <article>
                                {$LNG.RULES_59}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleDonCompte">
                    1.4.&nbsp;{$LNG.RULES_5}                </h3>
                <article>
                                {$LNG.RULES_58}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articlePretCompte">
                    1.5.&nbsp;{$LNG.RULES_6}                </h3>
                <article>
                                {$LNG.RULES_57}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleModePause">
                    1.6.&nbsp;{$LNG.RULES_7}                </h3>
                <article>
                                {$LNG.RULES_56}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleMotDePasse">
                    1.7.&nbsp;{$LNG.RULES_8}                </h3>
                <article>
                                {$LNG.RULES_55}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleUsurpation">
                    1.8.&nbsp;{$LNG.RULES_9}                </h3>
                <article>
                                {$LNG.RULES_54}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleCommunication">
                    1.9.&nbsp;{$LNG.RULES_10}                </h3>
                <article>
                                {$LNG.RULES_53}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleSuppressionCompte">
                    1.10.&nbsp;{$LNG.RULES_11}                </h3>
                <article>
                                {$LNG.RULES_52}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                    </section>
            <!-- Section -->
        <h2 id="sectionCommercePush">
            2.&nbsp;{$LNG.RULES_13}        </h2>
        <section>
                                        {$LNG.RULES_51}          <br /><br /> 
            
                            <!-- Article -->
                <h3 id="articleRupturePacte">
                    2.1.&nbsp;{$LNG.RULES_13}                </h3>
                <article>
                                {$LNG.RULES_50}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articlePush">
                    2.2.&nbsp;{$LNG.RULES_15}                </h3>
                <article>
                               {$LNG.RULES_49}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleCompteDormant">
                    2.3.&nbsp;{$LNG.RULES_16}                </h3>
                <article>
                                {$LNG.RULES_48}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleContournementRegle">
                    2.4.&nbsp;{$LNG.RULES_17}                </h3>
                <article>
                                {$LNG.RULES_47}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                    </section>
            <!-- Section -->
        <h2 id="sectionAttaque">
            3.&nbsp;{$LNG.RULES_18}        </h2>
        <section>
                                        {$LNG.RULES_46}          <br /><br /> 
            
                            <!-- Article -->
                <h3 id="articleAttaqueTempsGuerre">
                    3.1.&nbsp;{$LNG.RULES_19}                </h3>
                <article>
                                {$LNG.RULES_45}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleTreveGenerale">
                    3.2.&nbsp;{$LNG.RULES_20}                </h3>
                <article>
                                {$LNG.RULES_44}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                    </section>
            <!-- Section -->
        <h2 id="sectionAlliance">
            4.&nbsp;{$LNG.RULES_21}        </h2>
        <section>
                                        {$LNG.RULES_43}          <br /><br /> 
            
                            <!-- Article -->
                <h3 id="articleAllianceTempsGuerre">
                    4.1.&nbsp;{$LNG.RULES_22}                </h3>
                <article>
                                {$LNG.RULES_42}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                    </section>
            <!-- Section -->
        <h2 id="sectionBugErreur">
            5.&nbsp;{$LNG.RULES_23}        </h2>
        <section>
            
                            <!-- Article -->
                <h3 id="articleAideTechnique">
                    5.1.&nbsp;{$LNG.RULES_24}                </h3>
                <article>
                                {$LNG.RULES_41}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleBug">
                    5.2.&nbsp;{$LNG.RULES_25}                </h3>
                <article>
                                {$LNG.RULES_40}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                    </section>
            <!-- Section -->
        <h2 id="sectionInjure">
            6.&nbsp;{$LNG.RULES_26}        </h2>
        <section>
                                        {$LNG.RULES_39}          <br /><br /> 
            
                            <!-- Article -->
                <h3 id="articleRegleTchat">
                    6.1.&nbsp;{$LNG.RULES_27}                </h3>
                <article>
                                {$LNG.RULES_38}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                    </section>
            <!-- Section -->
        <h2 id="sectionRespectReglement">
            7.&nbsp;{$LNG.RULES_28}        </h2>
        <section>
            
                            <!-- Article -->
                <h3 id="articleSanction">
                    7.1.&nbsp;{$LNG.RULES_29}                </h3>
                <article>
                                {$LNG.RULES_37}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleDesavantage">
                    7.2.&nbsp;{$LNG.RULES_30}                </h3>
                <article>
                                {$LNG.RULES_36}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleModification">
                    7.3.&nbsp;{$LNG.RULES_31}                </h3>
                <article>
                                {$LNG.RULES_33}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                    </section>
    </div>		</section>

{/block}