{def $languages = ezini( 'RegionalSettings', 'SiteLanguageList', 'site.ini' )
     $locale_language_name = false()
     $locale_ini_file = false()
     $redirect_uri = concat( module_params()['module_name'], '/', module_params()['function_name'] )
     $current_locale = ezini( 'RegionalSettings', 'Locale', 'site.ini' )
     $current_locale_match = false()}

{if module_params()['parameters']|count|gt( 0 )}
{set $redirect_uri = concat( module_params()['module_name'], '/', module_params()['function_name'], '/',  module_params()['parameters']|implode( '/' ) )}
{/if}

<div id="bcswitchadminlanguage">

{* DESIGN: Header START *}<div class="box-header"><div class="box-ml">

<h4>{'Switch Language'|i18n( 'design/bcswitchlanguage/admin_switch_language' )}</h4>

{* DESIGN: Header END *}</div></div>

{* DESIGN: Content START *}<div class="box-bc"><div class="box-ml"><div class="box-content">

<form id="bcswitchadminlanguageform" action={'switchadminlanguage/switch'|ezurl} method="post">
<input type="hidden" name="RedirectURI" value={$redirect_uri|ezurl}>

<div class="block">
<select name="Language"{eq( $ui_context, 'edit' )|choose( '', ' disabled="disabled"' )} autocomplete="off">
  {foreach $languages as $language_identifier}
    {set $current_locale_match = false()}
    {set $locale_ini_file = concat( $language_identifier|trim, ".ini" )|trim}
    {set $locale_language_name = ezini( 'RegionalSettings', 'LanguageName', $locale_ini_file, 'share/locale/', true() )}

    {if $language_identifier|eq( $current_locale ) }
    {set $current_locale_match = true()}
    {/if}

    <option value="{$language_identifier}"{if $current_locale_match|eq( true() )} selected="selected"{/if}>{$locale_language_name}</option>
  {/foreach}
</select>
</div>
<div class="block">
    <input {eq( $ui_context, 'edit' )|choose( 'class="button"', 'class="button-disabled"' )}{eq( $ui_context, 'edit' )|choose( '', ' disabled="disabled"' )} type="submit" name="SwitchAdminLanguageButton" value="{'Switch'|i18n( 'design/bcswitchlanguage/admin_switch_language' )}" />
</div>

</form>

{* DESIGN: Content END *}</div></div></div>

</div>

