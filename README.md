BC Switch Admin Language
===================

This extension implements a solution to provide the ability to change the administration UI locale (language) on the fly. This solution requires and provides an extension based kernel class overrides to store cache by siteaccess name + locale identifier and switch ini locale per request dynamically for just the one request.


Version
=======

* The current version of BC Switch Admin Language is 0.1.0

* Last Major update: June 14, 2015


Copyright
=========

* BC Switch Admin Language is copyright 1999 - 2016 Brookins Consulting

* eZ Publish Kernel classes (used in kernel overrides) are copyright 1999 - 2016 eZ Systems AS.

* See: [COPYRIGHT.md](COPYRIGHT.md) for more information on the terms of the copyright and license


License
=======

BC Document Reader is licensed under the GNU General Public License.

The complete license agreement is included in the [LICENSE](LICENSE) file.

BC Document Reader is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License or at your
option a later version.

BC Document Reader is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

The GNU GPL gives you the right to use, modify and redistribute
BC Document Reader under certain conditions. The GNU GPL license
is distributed with the software, see the file doc/LICENSE.

It is also available at [http://www.gnu.org/licenses/gpl.txt](http://www.gnu.org/licenses/gpl.txt)

You should have received a copy of the GNU General Public License
along with BC Document Reader in doc/LICENSE.  If not, see [http://www.gnu.org/licenses/](http://www.gnu.org/licenses/).

Using BC Document Reader under the terms of the GNU GPL is free (as in freedom).

For more information or questions please contact: license@brookinsconsulting.com


Requirements
============

The following requirements exists for using BC Switch Admin Language extension:


### eZ Publish version

* Make sure you use eZ Publish version 5.x (required) or higher.

* Designed and tested with eZ Publish Community Project GitHub Release tag (via composer) v2015.01.3


### PHP version

* Make sure you have PHP 5.x or higher.


Dependencies
============

How to complete the following dependencies setup (if not already provided by your installation) is covered later in the README.md documentation

* This solution depends on eZ Publish Legacy's kernel class override feature is enabled in `config.php`. This documentation provides instructions how to setup this dependency in the **Installation > Enable eZ Publish Kernel Overrides** section.

* This solution expects that your admin siteaccess settings are already configured to have more than one language in the `SiteLanguageList[]` settings array. This documentation provides instructions how to setup this dependency in the **Installation > Configuration** section.

* This solution expects that your admin siteaccess settings are already configured to have the `TextTranslation=enabled` setting enabled. This documentation provides instructions how to setup this dependency in the **Installation > Configuration** section.


Features
========

### Kernel class overrides

This solution overrides the following kernel classes:

* PHP Class : `ezpKernelWeb` - Found by default at: `kernel/private/classes/ezpkernelweb.php`

* PHP Function File : `global_functions.php` - Found by default at: `kernel/private/classes/global_functions.php`

* PHP Class : `eZNodeviewfunctions` - Found by default at: `kernel/classes/eznodeviewfunctions.php`

* PHP Class : `eZTemplateCacheFunction` - Found by default at: `lib/eztemplate/classes/eztemplatecachefunction.php`

**Note**: This solution requires only a few legacy kernel class overrides of classes that are very stable and not subject to much change (if at all) per release (which is important for maintainability). Our changes to these classes are very minimalistic, clearly documented and only when absolutely required to support the solution.

You can review our changes to the kernel classes by searching for our kernel class change documentation comments (in each modified file block of code), `// BEGIN BC : BCSwitchAdminLanguage : Kernel Hack` and ends with `// END BC : BCSwitchAdminLanguage : Kernel Hack`.


### Module View

This solution provides a module 'switchadminlanguage' view 'switch' which is used by the provided admin right side toolbar 'Switch Language' form.

The 'Switch Language' form provides a drop down menu displaying all the languages available to the current siteaccess and allows you to select a different language, click switch button.

Upon clicking the switch button a the form is submits a request to the switch module view, which sets a session variable containing the language locale identifier to switch the admin siteaccess language locale when the switch module redirects the user back to the previous page.


Installation
============

### Extension Installation via Composer

Run the following command from your project root to install the extension:

    bash$ composer require brookinsconsulting/bcswitchadminlanguage dev-master;


### Extension Activation

Activate this extension by adding the following to your `settings/override/site.ini.append.php`:

    [ExtensionSettings]
    # <snip existing active extensions list />
    ActiveExtensions[]=bcswitchadminlanguage


### Enable eZ Publish Kernel Overrides

Kernel class overrides are only able to be used if you add the following to your eZ Publish Legacy config.php configuration file.

    cp -va config.php-RECOMMENDED config.php;

    # Edit config.php to set 'EZP_AUTOLOAD_ALLOW_KERNEL_OVERRIDE' to true. It should look like this:
    define( 'EZP_AUTOLOAD_ALLOW_KERNEL_OVERRIDE', true );


### Regenerate kernel class override autoloads

Regenerate kernel class override autoloads (Required).

    php ./bin/php/ezpgenerateautoloads.php  --kernel-override;


### Extension Settings Override

Next you must create an extension settings override and customize the admin siteaccess name (Required).

    cp -va extension/bcswitchadminlanguage/settings/bcswitchadminlanguage.ini.append.php settings/override/;

Edit `settings/override/bcswitchadminlanguage.ini.append.php` to set 'SharedAdminSiteaccessName' to your admin siteaccess name.

Here is an example of what it might look like in a default ezdemo based installation:

    [BCSwitchAdminLanguageSettings]
    SharedAdminSiteaccessName=ezdemo_site_admin


### Clear the caches

Clear eZ Publish Platform / eZ Publish Legacy caches (Required).

    php ./bin/php/ezcache.php --clear-all;


Configuration
=============

### Siteaccess site.ini [RegionalSettings] SiteLanguageList[] Settings

* Edit your `settings/siteaccess/(yourAdminSiteaccessName)/site.ini.append.php` settings file

* Add the languages you wish to be able to use to translation the siteaccess UI into by adding them to the `SiteLanguageList[]` settings array.

    * Here is a generic example of admin siteaccess settings which is configured to support translation from eng-US, fre-FR and ger-DE:

    [RegionalSettings]
    Locale=eng-US
    ContentObjectLocale=eng-US
    ShowUntranslatedObjects=enabled
    SiteLanguageList[]=eng-US
    SiteLanguageList[]=fre-FR
    SiteLanguageList[]=ger-DE
    TextTranslation=enabled

* If your not sure what language text strings are supported review the available default translations provide by default in the [share/translations](https://github.com/ezsystems/ezpublish-legacy/tree/master/share/translations) directory.
    * Note that the text strings representing the language name / identifiers expected in the `SiteLanguageList[]` settings array entries are the same as the `share/translations` sub directory names.

* Here is some related documentation on this [https://doc.ez.no/eZ-Publish/Technical-manual/4.x/Reference/Configuration-files/site.ini/RegionalSettings/SiteLanguageList](setting).


### Siteaccess site.ini [RegionalSettings] TextTranslation Setting

* Edit your `settings/siteaccess/(yourAdminSiteaccessName)/site.ini.append.php` settings file

* Check your default settings to ensure that the setting `[RegionalSettings] TextTranslation` is enabled. If it is not set or is disabled then you will need to change the setting to ensure it is specifically enabled within the siteaccess `site.ini.append.php` settings. Here is a abbreviated example:

    [RegionalSettings]
    # This line of comment represents the other required but omitted settings normally found in this settings block but not specific to this example settings snippet
    TextTranslation=enabled

* The `TextTranslation=enabled` is required as it is the setting which enables template text string translation. Here is some related documentation on this [https://doc.ez.no/eZ-Publish/Technical-manual/4.x/Reference/Configuration-files/site.ini/RegionalSettings/TextTranslation](setting).


Usage
=====

The solution is configured to work virtually by default once properly installed.

* First login to the admin siteaccess

* Then use the right side toolbar 'Switch Language' to select a different language.

* Then click 'Switch'

* Notice that the current (admin) siteaccess UI is now displayed using the previously selected language

**Note**: Changing the current language using this solution does not affect content object translation language in any way.


Troubleshooting
===============

### Read the FAQ

Some problems are more common than others. The most common ones are listed in the the [doc/FAQ.md](doc/FAQ.md)


### Support

If you have find any problems not handled by this document or the FAQ you can contact Brookins Consulting through the support system: [http://brookinsconsulting.com/contact](http://brookinsconsulting.com/contact)

