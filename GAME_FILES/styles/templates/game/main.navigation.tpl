<!-- Le menu à gauche -->
            <div id="menu">
                <h1>{$LNG.lm_title_1}</h1>
                <ul>
                    {if isModulAvalible($smarty.const.MODULE_OVERVIEW)}<li><a href="?page=overview" title="{$LNG.lm_expl_1}">{$LNG.lm_overview}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_TECHTREE)}<li><a href="?page=techtree" title="{$LNG.lm_expl_2}">{$LNG.NOUVEAUTE_457}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_GALAXY)}<li><a href="?page=galaxy" title="{$LNG.lm_expl_3}">{$LNG.NOUVEAUTE_524}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_TPORTAL)}<li><a href="?page=Tportal" title="{$LNG.lm_expl_5}">{$LNG.lm_tportal}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_SPACECENTER)}<li><a href="?page=center" title="{$LNG.lm_expl_4}">{$LNG.lm_fleettable_5}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_TOWER)}<li><a href="?page=Tower" title="{$LNG.lm_expl_6}">{$LNG.lm_tmanagement}</a></li>{/if}
                </ul>
                <h1>{$LNG.lm_title_2}</h1>
                <ul>
                    {if isModulAvalible($smarty.const.MODULE_BUILDING)}<li><a href="?page=buildings&cmdd=build" title="{$LNG.lm_expl_8}">{$LNG.lm_buildings}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_RESEARCH)}<li><a href="?page=research" title="{$LNG.lm_expl_9}">{$LNG.NOUVEAUTE_268}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_SPECIALIZED)}<li><a href="?page=shipyard&mode=fleet" title="{$LNG.lm_expl_10}">{$LNG.NOUVEAUTE_320}</a></li>{/if}
					{if isModulAvalible($smarty.const.MODULE_CREATESHIP)}<li><a href="?page=CreateShip" title="{$LNG.NOUVEAUTE_451}">{$LNG.NOUVEAUTE_387}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_DEFENSE)}<li><a href="?page=defense" title="{$LNG.lm_expl_11}">{$LNG.NOUVEAUTE_336}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_POPULATION)}<li><a href="?page=population" title="{$LNG.lm_expl_12}">{$LNG.lm_population}</a></li>{/if}

                </ul>
                <h1>{$LNG.lm_title_3}</h1>
                <ul>
                    {if isModulAvalible($smarty.const.MODULE_SEARCH)}<li><a href="?page=search" title="{$LNG.lm_expl_13}">{$LNG.lm_search}</a> </li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_ALLIANCE) || isModulAvalible($smarty.const.MODULE_MARKET)}<li>{if isModulAvalible($smarty.const.MODULE_ALLIANCE)}<a href="?page=alliance" title="{$LNG.lm_expl_14}">{$LNG.lm_alliance}</a>{/if} / {if isModulAvalible($smarty.const.MODULE_MARKET)}<a href="?page=market" title="{$LNG.lm_expl_15}">{$LNG.lm_market}</a>{/if}</li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_BUNKER) || isModulAvalible($smarty.const.MODULE_BANK)}<li>{if isModulAvalible($smarty.const.MODULE_BUNKER)}<a href="?page=Bunker" title="{$LNG.lm_expl_16}">{$LNG.lm_bunker}</a>{/if} / {if isModulAvalible($smarty.const.MODULE_BANK)}<a href="?page=Bank" title="{$LNG.lm_expl_32}">{$LNG.lm_expl_33}</a>{/if}</li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_RESSOURCE_LIST)}<li><a href="?page=resources" title="{$LNG.lm_expl_17}">{$LNG.lm_resources}</a></li>{/if}
					{if isModulAvalible($smarty.const.MODULE_SIMULATOR_PORTAL) || isModulAvalible($smarty.const.MODULE_SIMULATOR_SPACE)}<li>{if isModulAvalible($smarty.const.MODULE_SIMULATOR_PORTAL)}<a href="?page=battleSimulator" title="{$LNG.NOUVEAUTE_809}">{$LNG.NOUVEAUTE_807}</a>{/if} / {if isModulAvalible($smarty.const.MODULE_SIMULATOR_SPACE)}<a href="?page=spaceSimulator" title="{$LNG.NOUVEAUTE_810}">{$LNG.NOUVEAUTE_808}</a>{/if}</li>{/if}
                </ul>
				<h1>{$LNG.lm_title_4}</h1>
                <ul>
                    {if isModulAvalible($smarty.const.MODULE_IMMUNITY)}<li><a href="?page=Immunity" title="{$LNG.lm_expl_18}.">{$LNG.lm_immunity}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_PLANET_CLOAK)}<li><a href="?page=Planetcloak" title="{$LNG.lm_expl_19}.">{$LNG.lm_pcloak}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_LOTTERY)}<li><a href="?page=Lottery" title="{$LNG.lm_expl_20}.">{$LNG.lm_lotto}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_REDEEM)}<li> <a href="?page=Reward2" title="{$LNG.lm_expl_21}.">{$LNG.lm_redeem}</a></li>{/if}
                </ul>
                <h1>{$LNG.lm_title_5}</h1>
                <ul>
                    {if isModulAvalible($smarty.const.MODULE_MESSAGES)}<li><a id="gotit" href="?page=messages" name="messagerie" title="{$LNG.lm_expl_22}">{$LNG.lm_messages}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_STATISTICS)}<li><a href="?page=statistics" title="{$LNG.lm_expl_23}">{$LNG.lm_statistics}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_SETTINGS)}<li><a href="?page=settings" title="{$LNG.lm_expl_24}">{$LNG.lm_proset}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_GESTION)}<li><a href="?page=gestion" title="{$LNG.lm_expl_25}">{$LNG.lm_gestion}</a></li>{/if}
					{if isModulAvalible($smarty.const.MODULE_CHAT)}<li><a id="gotit2" href="?page=Tchat" name="tchat" title="{$LNG.NOUVEAUTE_90}">{$LNG.NOUVEAUTE_91}</a></li>{/if}
					
					{if isModulAvalible($smarty.const.MODULE_ACHAT)}<li><a href="?page=Achat" title="{$LNG.lm_expl_26}">{$LNG.lm_shop}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_FAQ) || isModulAvalible($smarty.const.MODULE_SUPPORT)}<li>{if isModulAvalible($smarty.const.MODULE_FAQ)}<a href="?page=faq" title="{$LNG.ls_faq_13}">{$LNG.ls_faq_13}</a>{/if} / {if isModulAvalible($smarty.const.MODULE_SUPPORT)}<a href="?page=ticket" title="{$LNG.NOUVEAUTE_818}">{$LNG.NOUVEAUTE_817}</a>{/if}</li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_BANNED)}<li><a href="?page=banList" title="{$LNG.lm_expl_28}.">{$LNG.lm_banned}</a></li>{/if}
                    {if isModulAvalible($smarty.const.MODULE_BATTLEHALL)}<li><a href="?page=battleHall" title="{$LNG.lm_expl_29}">{$LNG.lm_topkb}</a></li>{/if}
                    <li><a data-ajax="0" href="?page=logout" title="{$LNG.lm_expl_30}">{$LNG.lm_logout}</a></li>
                </ul>
                <h1>{$LNG.lm_title_6}</h1>
                <ul>
                    <li>Horizon : <span name="charge_serveur"></span></li>
                    <li>Time : <span name="horloge" data-timestamp="{$timestamp}"></span></li>
                    <li><span name="nb_connecte" style="font-weight : bold;"></span> {$LNG.lm_connected}</li>
                </ul>
            </div>