<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   anchornavi
 * @author    Simon Wohler <mail@bekanntmacher.ch>
 * @license   LGPL
 * @copyright bekanntmacher 2012
 */



/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Elements
	'Contao\ContentAnchorHeadline'		=> 'system/modules/anchor/elements/ContentAnchorHeadline.php',

	// Modules
	'Contao\ModuleAnchorNavigation'		=> 'system/modules/anchor/modules/ModuleAnchorNavigation.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_anchorheadline'         		=> 'system/modules/anchor/templates',
	'mod_anchornavigation'				=> 'system/modules/anchor/templates'
));
