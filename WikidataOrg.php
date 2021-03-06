<?php

/**
 * Configuration for and customizations to Wikibase
 * that are specific to wikidata.org
 *
 *  ## ##### ##### ## ## ##### ## ##### ## ##
 *  ## ##### ##### ## ## ##### ## ##### ## ##
 *  ## ##### ##### ## ## ##### ## ##### ## ##
 *  ## ##### ##### ## ## ##### ## ##### ## ##
 *  ## ##### ##### ## ## ##### ## ##### ## ##
 *  ## ##### ##### ## ## ##### ## ##### ## ##
 *  ## ##### ##### ## ## ##### ## ##### ## ##
 *  ## ##### ##### ## ## ##### ## ##### ## ##
 *  ## ##### ##### ## ## ##### ## ##### ## ##
 *  ## ##### ##### ## ## ##### ## ##### ## ##
 *  __      _____ _  _____ ___   _ _____ _
 *  \ \    / /_ _| |/ /_ _|   \ /_\_   _/_\
 *   \ \/\/ / | || ' < | || |) / _ \| |/ _ \
 *    \_/\_/ |___|_|\_\___|___/_/ \_\_/_/ \_\
 *
 */

/**
 * Entry point for for the Wikidata.org extension.
 *
 * @see README.md
 * @see https://github.com/wmde/Wikidata.org
 * @license GNU GPL v2+
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

if ( defined( 'WIKIDATA_ORG_VERSION' ) ) {
	// Do not initialize more than once.
	return 1;
}

define( 'WIKIDATA_ORG_VERSION', '0.1 alpha' );

// This is the path to the autoloader generated by composer in case of a composer install.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	include_once( __DIR__ . '/vendor/autoload.php' );
}

$GLOBALS['wgMessagesDirs']['Wikidata.org'] = __DIR__ . '/i18n';

$GLOBALS['wgExtensionFunctions'][] = function() {
	global $wgExtensionCredits, $wgHooks, $wgResourceModules;

	if ( !defined( 'WB_VERSION' ) ) {
		throw new Exception( 'The Wikidata.org extension requires Wikibase to be installed.' );
	}

	$wgExtensionCredits['wikibase'][] = array(
		'path' => __DIR__,
		'name' => 'Wikidata.org',
		'version' => WIKIDATA_ORG_VERSION,
		'author' => '[https://www.mediawiki.org/wiki/User:Bene* Bene*]',
		'url' => 'https://github.com/wmde/Wikidata.org',
		'descriptionmsg' => 'wikidata-org-desc',
		'license-name' => 'GPL-2.0+'
	);

	// Hooks
	$wgHooks['BeforePageDisplay'][] = 'WikidataOrg\Hooks::onBeforePageDisplay';
	$wgHooks['SkinTemplateOutputPageBeforeExec'][] = 'WikidataOrg\Hooks::onSkinTemplateOutputPageBeforeExec';

	// Resource Loader modules
	$wgResourceModules = array_merge( $wgResourceModules, include( __DIR__ . '/resources/Resources.php' ) );

};
