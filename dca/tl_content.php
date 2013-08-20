<?php

if (!defined('TL_ROOT'))
    die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  X-Projects | Benjamin Hummel 2011
 * @author     X-Projects | Benjamin Hummel <infos@x-projects.de>
 * @package    xgrind
 * @license    GPL
 * @filesource 
 */
 
 
 
foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key => $value) 
{
	$GLOBALS['TL_DCA']['tl_content']['palettes'][$key] = str_replace('cssID', ',cssID,ceGrid', $value);
}

 

$GLOBALS['TL_DCA']['tl_content']['fields']['ceGrid'] = array
	(	
	'label' 			=> &$GLOBALS['TL_LANG']['tl_content']['ceGrid'],
    'inputType' 		=> 'select',
	'exclude' 			=> true,
	'options_callback' 	=> array('tl_ceGrid', 'getOptions'),
	'save_callback' 	=> array
		(
			array('tl_ceGrid', 'saveGridClass')
		),
	'eval' 				=> array('tl_class' => 'w50')
);

/**
 * Class tl_content
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2013
 * @author     Leo Feyer <https://contao.org>
 * @package    Core
 */

class tl_ceGrid extends Backend {

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function getOptions(DataContainer $dc)
	{
	 	$anz = 6;
	 	
	 	// aktueller Wert laden 
	 	$id = $dc->activeRecord->id;
	 	$objCte = ContentModel::findByPk($id);
		$arrCssID = deserialize($objCte->cssID);
	 	
	    //print_r ($arrCssID);
	 	
	 	// bereits gespeicherter wert suchen
		
	 	if(preg_match("/ceGrid[0-9]{1,2}/",$arrCssID[1], $arrRegs))
	 	{
	 		$key = $arrRegs[0];
	 		$arrOptions[$key] = $GLOBALS['TL_LANG']['tl_content']['cegrid'][$key];
	 		$arrOptions['ceGrid0'] = '-';
	 	}
	 	else
	 	$arrOptions['ceGrid0'] = '-';
	 	
	 	for($i=1;$i<=$anz;$i++)
		{
			$k = 'ceGrid'.$i;
			if($k != $arrRegs[0])
			$arrOptions[$k] = $GLOBALS['TL_LANG']['tl_content']['cegrid'][$k];
		}
	
		return $arrOptions;
	}
	
	public function saveGridClass($varValue, DataContainer $dc)
	{
		$id = $dc->activeRecord->id;
		$objCte = ContentModel::findByPk($id);
		
		$arrCssID = deserialize($objCte->cssID);
		$arrCssID[1] = preg_replace("/^ceGrid[0-9]{1,2}$/","",$arrCssID[1]);
		
		if($varValue != 'ceGrid0')
		{
			trim($arrCssID[1]);
			$arrCssID[1] = $arrCssID[1] . ' ' . $varValue;
		}
		
		$objCte_s = ContentModel::findById($id);
		$objCte_s->cssID = serialize($arrCssID);
		$objCte_s->save();
	}
}

?>
