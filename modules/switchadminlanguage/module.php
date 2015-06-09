<?php
/**
 * File containing the switchadminlanguage module configuration file, module.php
 *
 * @copyright Copyright (C) 1999 - 2016 Brookins Consulting. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2 (or later)
 * @version 0.1.0
 * @package bcswitchadminlanguage
*/

// Define module name
$Module = array( 'name' => 'BC Switch Admin Language' );

// Define module view and parameters
$ViewList = array();

// Define 'switch' module view parameters
$ViewList['switch'] = array( 'script' => 'switch.php',
                             'ui_context' => 'authentication',
                             'functions' => array( 'switch' ),
                             'default_navigation_part' => 'bcswitchadminlanguagenavigationpart',
                             'post_actions' => array(),
//                           'default_action' => array( array( 'name' => 'Switch',
//                                                             'type' => 'post',
//                                                             'parameters' => array( 'Language' ) ) ),
                              'single_post_actions' => array( 'SwitchAdminLanguageButton' => 'SwitchAdminLanguage' ),
                              'post_action_parameters' => array( 'SwitchAdminLanguage' => array( 'SwitchAdminLanguageSetLanguage' => 'Language',
                                                                                                 'SwitchAdminLanguageRedirectURI' => 'RedirectURI' ) ),
                              'params' => array() );

// Define function parameters
$FunctionList = array();

// Define function 'switch' parameters
$FunctionList['switch'] = array(); // array( 'SiteAccess' => $SiteAccess );

?>