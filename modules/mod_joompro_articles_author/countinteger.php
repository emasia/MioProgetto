<?php
/**
 * @copyright Copyright (C) 2012 Mark Dexter and Louis Landry. All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.form.formrule');

class JFormRuleCountInteger extends JFormRule
{
	public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
		{
		$max = (int) $element['maximum'] ? $element['maximum'] : 30;
		$min = (int) $element['minimum'] ? $element['minimum'] : 1;
		$result = ((int) $value >= $min && (int) $value <= $max);
		
		// Build JException object
		if ($result === false) {
			$result = new JException(JText::sprintf('MOD_JOOMPRO_ARTICLES_AUTHOR_COUNTINTEGER_MESSAGE', $min, $max));
		}
		
		return $result;
	}
	
}
