{block name="title" prepend}{$LNG.CONDITION_1}{/block}
{block name="content"}
<!-- //// SECTION PRINCIPALE //// -->
		<section role="main">
			<div name="youAreHere">
				<ul>
					<li>{$LNG.INDEX_25}</li>
					<li>{$LNG.CONDITION_1}</li>
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
                <a class="no-underline" href="#sectionIntroduction">
                    <b>1.&nbsp;{$LNG.CONDITION_2}</b>
                </a><br />

                            </div>
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionServices">
                    <b>2.&nbsp;{$LNG.CONDITION_3}</b>
                </a><br />

                                    &mdash;&nbsp;<a class="no-underline" href="#articleConditionParticipation">
                        2.1.&nbsp;{$LNG.CONDITION_4}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articlePreRequis">
                        2.2.&nbsp;{$LNG.CONDITION_5}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleResponsabilite">
                        2.3.&nbsp;{$LNG.CONDITION_6}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articlePropriete">
                        2.4.&nbsp;{$LNG.CONDITION_7}                    </a><br />
                            </div>
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionAdhesionResiliation">
                    <b>3.&nbsp;{$LNG.CONDITION_8}</b>
                </a><br />

                                    &mdash;&nbsp;<a class="no-underline" href="#articleConditionAdhesion">
                        3.1.&nbsp;{$LNG.CONDITION_9}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleResiliationUtilisateur">
                        3.2.&nbsp;{$LNG.CONDITION_10}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleResilitationEntreprise">
                        3.3.&nbsp;{$LNG.CONDITION_11}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleRemboursement">
                        3.4.&nbsp;{$LNG.CONDITION_12}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleDroitFinancement">
                        3.5.&nbsp;{$LNG.CONDITION_13}                    </a><br />
                            </div>
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionCDPR">
                    <b>4.&nbsp;{$LNG.CONDITION_14}</b>
                </a><br />

                                    &mdash;&nbsp;<a class="no-underline" href="#articleContenu">
                        4.1.&nbsp;{$LNG.CONDITION_15}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleDommage">
                        4.2.&nbsp;{$LNG.CONDITION_16}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articlePiratage">
                        4.3.&nbsp;{$LNG.CONDITION_17}                    </a><br />
                            </div>
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionActionInterdite">
                    <b>5.&nbsp;{$LNG.CONDITION_18}</b>
                </a><br />

                                    &mdash;&nbsp;<a class="no-underline" href="#articleActionUtilisateur">
                        5.1.&nbsp;{$LNG.CONDITION_19}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleProgamme">
                        5.2.&nbsp;{$LNG.CONDITION_20}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleUsurpation">
                        5.3.&nbsp;{$LNG.CONDITION_21}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleConnexionAuto">
                        5.4.&nbsp;{$LNG.CONDITION_22}                    </a><br />
                            </div>
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionRegleLimitation">
                    <b>6.&nbsp;{$LNG.CONDITION_23}</b>
                </a><br />

                                    &mdash;&nbsp;<a class="no-underline" href="#articleNbCompte">
                        6.1.&nbsp;{$LNG.CONDITION_24}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleRegle">
                        6.2.&nbsp;{$LNG.CONDITION_25}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleNonRespect">
                        6.3.&nbsp;{$LNG.CONDITION_26}                    </a><br />
                            </div>
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionDonneePersonnelle">
                    <b>7.&nbsp;{$LNG.CONDITION_27}</b>
                </a><br />

                                    &mdash;&nbsp;<a class="no-underline" href="#articleSauvegardeDonnee">
                        7.1.&nbsp;{$LNG.CONDITION_28}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleCommunication">
                        7.2.&nbsp;{$LNG.CONDITION_29}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleDemandeSuppression">
                        7.3.&nbsp;{$LNG.CONDITION_31}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleGoogleAnalytics">
                        7.4.&nbsp;{$LNG.CONDITION_32}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleTransfertDonnee">
                        7.5.&nbsp;{$LNG.CONDITION_33}                    </a><br />
                            </div>
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionDroitEntreprise">
                    <b>8.&nbsp;{$LNG.CONDITION_34}</b>
                </a><br />

                                    &mdash;&nbsp;<a class="no-underline" href="#articleGeneraliteDroit">
                        8.1.&nbsp;{$LNG.CONDITION_35}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleInterdictionExploitation">
                        8.2.&nbsp;{$LNG.CONDITION_36}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleException">
                        8.3.&nbsp;{$LNG.CONDITION_37}                    </a><br />
                                    &mdash;&nbsp;<a class="no-underline" href="#articleElementJeu">
                        8.4.&nbsp;{$LNG.CONDITION_38}                    </a><br />
                            </div>
                    <div class="margin-bottom-medium">
                <a class="no-underline" href="#sectionModification">
                    <b>9.&nbsp;{$LNG.CONDITION_39}</b>
                </a><br />

                            </div>
            </div>

    <!-- Titre du document -->
    <h1>{$LNG.CONDITION_40}</h1>

            <!-- Section -->
        <h2 id="sectionIntroduction">
            1.&nbsp;{$LNG.CONDITION_2}        </h2>
        <section>
                                        {$LNG.CONDITION_41}          <br /><br /> 
            
                    </section>
            <!-- Section -->
        <h2 id="sectionServices">
            2.&nbsp;{$LNG.CONDITION_3}        </h2>
        <section>
            
                            <!-- Article -->
                <h3 id="articleConditionParticipation">
                    2.1.&nbsp;{$LNG.CONDITION_4}                </h3>
                <article>
                                {$LNG.CONDITION_42}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articlePreRequis">
                    2.2.&nbsp;{$LNG.CONDITION_5}                </h3>
                <article>
                                {$LNG.CONDITION_43}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleResponsabilite">
                    2.3.&nbsp;{$LNG.CONDITION_6}                </h3>
                <article>
                                {$LNG.CONDITION_44}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articlePropriete">
                    2.4.&nbsp;{$LNG.CONDITION_7}                </h3>
                <article>
                                {$LNG.CONDITION_45}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                    </section>
            <!-- Section -->
        <h2 id="sectionAdhesionResiliation">
            3.&nbsp;{$LNG.CONDITION_8}        </h2>
        <section>
            
                            <!-- Article -->
                <h3 id="articleConditionAdhesion">
                    3.1.&nbsp;{$LNG.CONDITION_9}                </h3>
                <article>
                               {$LNG.CONDITION_46}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleResiliationUtilisateur">
                    3.2.&nbsp;{$LNG.CONDITION_10}                </h3>
                <article>
                                {$LNG.CONDITION_47}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleResilitationEntreprise">
                    3.3.&nbsp;{$LNG.CONDITION_11}                </h3>
                <article>
                                {$LNG.CONDITION_48}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleRemboursement">
                    3.4.&nbsp;{$LNG.CONDITION_12}                </h3>
                <article>
                                {$LNG.CONDITION_49}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleDroitFinancement">
                    3.5.&nbsp;{$LNG.CONDITION_13}                </h3>
                <article>
                                {$LNG.CONDITION_50}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                    </section>
            <!-- Section -->
        <h2 id="sectionCDPR">
            4.&nbsp;{$LNG.CONDITION_14}        </h2>
        <section>
            
                            <!-- Article -->
                <h3 id="articleContenu">
                    4.1.&nbsp;{$LNG.CONDITION_15}                </h3>
                <article>
                                {$LNG.CONDITION_51}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleDommage">
                    4.2.&nbsp;{$LNG.CONDITION_16}                </h3>
                <article>
                                {$LNG.CONDITION_52}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articlePiratage">
                    4.3.&nbsp;{$LNG.CONDITION_17}                </h3>
                <article>
                                {$LNG.CONDITION_53}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                    </section>
            <!-- Section -->
        <h2 id="sectionActionInterdite">
            5.&nbsp;{$LNG.CONDITION_18}        </h2>
        <section>
            
                            <!-- Article -->
                <h3 id="articleActionUtilisateur">
                    5.1.&nbsp;{$LNG.CONDITION_19}                </h3>
                <article>
                                {$LNG.CONDITION_54}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleProgamme">
                    5.2.&nbsp;{$LNG.CONDITION_20}                </h3>
                <article>
                                {$LNG.CONDITION_55}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleUsurpation">
                    5.3.&nbsp;{$LNG.CONDITION_21}                </h3>
                <article>
                                {$LNG.CONDITION_56}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleConnexionAuto">
                    5.4.&nbsp;{$LNG.CONDITION_22}                </h3>
                <article>
                                {$LNG.CONDITION_57}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                    </section>
            <!-- Section -->
        <h2 id="sectionRegleLimitation">
            6.&nbsp;{$LNG.CONDITION_23}        </h2>
        <section>
            
                            <!-- Article -->
                <h3 id="articleNbCompte">
                    6.1.&nbsp;{$LNG.CONDITION_24}                </h3>
                <article>
                                {$LNG.CONDITION_58}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleRegle">
                    6.2.&nbsp;{$LNG.CONDITION_25}                </h3>
                <article>
                                {$LNG.CONDITION_59}                               <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleNonRespect">
                    6.3.&nbsp;{$LNG.CONDITION_26}                </h3>
                <article>
                                {$LNG.CONDITION_61}<br /><br />                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                    </section>
            <!-- Section -->
        <h2 id="sectionDonneePersonnelle">
            7.&nbsp;{$LNG.CONDITION_27}        </h2>
        <section>
            
                            <!-- Article -->
                <h3 id="articleSauvegardeDonnee">
                    7.1.&nbsp;{$LNG.CONDITION_28}                </h3>
                <article>
                                {$LNG.CONDITION_62}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleCommunication">
                    7.2.&nbsp;{$LNG.CONDITION_29}                </h3>
                <article>
                                {$LNG.CONDITION_63}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
               
                            <!-- Article -->
                <h3 id="articleDemandeSuppression">
                    7.4.&nbsp;{$LNG.CONDITION_31}                </h3>
                <article>
                                {$LNG.CONDITION_65}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleGoogleAnalytics">
                    7.5.&nbsp;{$LNG.CONDITION_32}                </h3>
                <article>
                                {$LNG.CONDITION_66}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleTransfertDonnee">
                    7.6.&nbsp;{$LNG.CONDITION_33}                </h3>
                <article>
                                {$LNG.CONDITION_67}                             <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                    </section>
            <!-- Section -->
        <h2 id="sectionDroitEntreprise">
            8.&nbsp;{$LNG.CONDITION_34}        </h2>
        <section>
            
                            <!-- Article -->
                <h3 id="articleGeneraliteDroit">
                    8.1.&nbsp;{$LNG.CONDITION_35}                </h3>
                <article>
                                {$LNG.CONDITION_68}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleInterdictionExploitation">
                    8.2.&nbsp;{$LNG.CONDITION_36}                </h3>
                <article>
                                {$LNG.CONDITION_69}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleException">
                    8.3.&nbsp;{$LNG.CONDITION_37}                </h3>
                <article>
                                {$LNG.CONDITION_70}                              <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                            <!-- Article -->
                <h3 id="articleElementJeu">
                    8.4.&nbsp;{$LNG.CONDITION_38}                </h3>
                <article>
                                {$LNG.CONDITION_71}                             <a name="backTop" href="#hashBackTop" title="{$LNG.RULES_34}">{$LNG.RULES_35}</a>
                </article>
                    </section>
            <!-- Section -->
        <h2 id="sectionModification">
            9.&nbsp;{$LNG.CONDITION_39}        </h2>
        <section>
                                         {$LNG.CONDITION_72}          <br /><br /> 
            
                    </section>
    </div>		</section>

{/block}