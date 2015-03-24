<?php
/**
 * @copyright	Copyright (C) 2012 Mark Dexter and Louis Landry. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
JLoader::register('modJoomProArticlesAuthorHelper', dirname(__FILE__).'/helper.php');

$list = modJoomProArticlesAuthorHelper::getList($params);

// Only show module if there is something to show
if (isset($list[0])) {
	$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
	require JModuleHelper::getLayoutPath('mod_joompro_articles_author', $params->get('layout', 'default'));
}