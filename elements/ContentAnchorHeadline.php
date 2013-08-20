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
 * Run in a custom namespace, so the class can be replaced
 */
namespace Contao;


/**
 * Class ContentAnchorHeadline
 *
 * Front end content element "anchorheadline".
 * @copyright  bekanntmacher 2013
 * @author     Simon Wohler <https://contao.org>
 * @package    Core
 */
class ContentAnchorHeadline extends \ContentElement
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_anchorheadline';


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		$this->Template->anchor = standardize($this->headline) . '-' . $this->id;
	}
}
