<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @package Core
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Contao;


/**
 * Class ModuleNavigation
 *
 * Front end module "navigation".
 * @copyright  Leo Feyer 2005-2013
 * @author     Leo Feyer <https://contao.org>
 * @package    Core
 */
class ModuleAnchorNavigation extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_anchornavigation';


	/**
	 * Do not display the module if there are no menu items
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ANKER NAVIGATION ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}
		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		global $objPage;
		$arrAnchors = array();
		$strRequest = ampersand(\Environment::get('request'), true);

		//Find all articles
		$objArticle = ArticleModel::findPublishedByPidAndColumn($objPage->id, $this->strColumn);

		if ($objArticle === false)
		{
			return;
		}

		//Find all anchorheadlines
		while ($objArticle->next())
		{
			$objCe = \ContentModel::findPublishedByPidAndTable($objArticle->id,'tl_article');

			if ($objCe === false)
			{
				continue;
			}

			while ($objCe->next())
			{
				if ($objCe->type == 'anchorheadline')
				{
					$arrHeadline = unserialize($objCe->headline);
					$arrAnchors[] = array
					(
						'href' 	=> $strRequest . '#' . standardize($arrHeadline['value']) . '-' . $objCe->id,
						'title'	=> $arrHeadline['value'],
					);
				}
			}
		}
	$this->Template->anchors = $arrAnchors;

	}
}
