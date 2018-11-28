{block name="title" prepend}{$LNG.NOUVEAUTE_43}{/block}
{block name="content"}
<div id="page_contenu">
<h1>{$LNG.NOUVEAUTE_43}</h1> <span id="loading" style="display:none;">{$LNG.sh_loading}</span>
			  <div class="categorie">
				<h2>{$LNG.NOUVEAUTE_44}</h2>
			
					<label for="recherche" style="margin-right : 7px;">{$LNG.NOUVEAUTE_43} : </label>
						<input type="text" id="searchtext" name="searchtext" style="width : 100px; margin-right : 20px;" />
					<label for="type" style="margin-right : 7px;">{$LNG.NOUVEAUTE_45} : </label>
					
					{html_options options=$modeSelector name="type" id="type"}
	
					
					<input type="submit" id="valid_form" onclick="search();" name="valid_form" value="{$LNG.NOUVEAUTE_9}" />

			  </div>
			
			<div id="recherche_resultat">{$LNG.ls_search_1}	</div>
				</div>	  
{/block}
{block name="script" append}
<script type="text/javascript">
	var lgnpsu = '{$LNG.NOUVEAUTE_46}';
	var lgnpla = '{$LNG.NOUVEAUTE_47}';
	var lgnall = '{$LNG.NOUVEAUTE_48}';
	var lgntag = '{$LNG.NOUVEAUTE_49}';
</script>
{/block}