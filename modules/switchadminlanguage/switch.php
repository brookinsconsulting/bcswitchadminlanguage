<?php
/**
 * File containing the switchadminlanguage/switch module view based heavily on the default user/login module view customized to only confirm password not login.
 *
 * @copyright Copyright (C) 1999 - 2016 Brookins Consulting. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2.0
 * @version 0.1.0
 * @package bcconfirmpassword
 */

/**
 * Default module parameters
 */
$Module = $Params["Module"];

/**
* Default class instances
*/
$http = eZHTTPTool::instance();

// Init template behaviors
$tpl = eZTemplate::factory();

// Access ini variables
$ini = eZINI::instance();
$fallbackUserRedirectURI = 'content/dashboard';

if ( $Module->isCurrentAction( 'SwitchAdminLanguage' ) and
     $Module->hasActionParameter( 'SwitchAdminLanguageSetLanguage' ) and
     $Module->hasActionParameter( 'SwitchAdminLanguageRedirectURI' )
   )
{
    $userLanguage = trim( $Module->actionParameter( 'SwitchAdminLanguageSetLanguage' ) );
    $userRedirectURI = trim( $Module->actionParameter( 'SwitchAdminLanguageRedirectURI' ) );

    if( $userLanguage != null )
    {
        $http->setSessionVariable( 'BCSwitchAdminLanguageSetLanguageLocaleIdentifier', $userLanguage );
        // var_dump( $http->sessionVariable( 'BCSwitchAdminLanguageSetLanguageLocaleIdentifier' ) ); die();
        // var_dump( $userLanguage ); die();
    }
    
    if( $userRedirectURI != null )
    {
        return $Module->redirectTo( $userRedirectURI );
    }
}
else
{
    return $Module->redirectTo( $fallbackUserRedirectURI );
}

?>