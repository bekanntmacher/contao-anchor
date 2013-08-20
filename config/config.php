<?php 

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @package   anchor
 * @author    Simon Wohler <mail@bekanntmacher.ch> 
 * @license   LGPL 
 * @copyright bekanntmacher 2012 
 */



/**
 * Front end modules
 */
array_insert( $GLOBALS['FE_MOD']['navigationMenu'], -1, array
(
	'anchornavi'		=> 'ModuleAnchorNavigation'
));


/**
 * Content elements
 */
array_insert( $GLOBALS['TL_CTE']['texts'],1, array
(
	'anchorheadline' 	=> 'ContentAnchorHeadline'
));