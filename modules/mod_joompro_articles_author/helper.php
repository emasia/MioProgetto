<?php
/**
 * @copyright	Copyright (C) 2011 Mark Dexter and Louis Landry. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JLoader::register('ContentHelperRoute', JPATH_SITE.'/components/com_content/helpers/route.php');

abstract class modJoomProArticlesAuthorHelper
{
	public static function getList(&$params)
	{
		// Initialize return variable
		$items		= array();
		
		// Process only if this is a single-article view
		$option	= JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		if ($option == 'com_content' && $view == 'article')
		{
			// Get the dbo
			$db = JFactory::getDbo();
			$app = JFactory::getApplication();
			$user = JFactory::getUser();
			$id = JRequest::getInt('id');
			
			// Get the levels as a comma-separated string
			$levels	= implode(',', $user->getAuthorisedViewLevels());
			
			// Set the current and empty date fields
			$date = JFactory::getDate(); //recupero data odierna (anno mese giorno)
			$now = $date->toSql();
			$nullDate = $db->getNullDate();

			// Initialize the query object
			$query = $db->getQuery(true); 
			
			// Query the database to get the author information for the current article
			$query->select('id, created_by, created_by_alias');
			$query->from('#__content');
			$query->where('id = ' . (int) $id);
			$db->setQuery($query);
			$currentArticle = $db->loadObject();

			// Query the database to get articles that match the current author
			$query->clear(); //pulizia var query
			$query->select('a.*');
			$query->select('c.access AS cat_access, c.published as cat_state, c.alias as cat_alias');
			$query->from('#__content AS a');
			
			// We need category information to make the link to the articles and to check access
			$query->leftJoin('#__categories AS c ON c.id = a.catid');
			
			// Only show published articles
			$query->where('a.state = 1'); //controllo sullo stato cestinato
			$query->where('c.published = 1');
			
			// Only show where we have access to article and category
			$query->where('a.access IN (' . $levels . ')');
			$query->where('c.access IN (' . $levels . ')');
			
			// Only show where articles are currently published
			$query->where('(a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).')');
			$query->where('(a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).')');
			
			// Check the author of the article
			if ($currentArticle->created_by_alias) {
				// If the current article has an author alias, check for matches in created_by or created_by_alias
				$query->where('(a.created_by =' . (int) $currentArticle->created_by . ' OR ' 
					. 'a.created_by_alias =' . $db->quote($currentArticle->created_by_alias) . ')');
			} else {
				// If current articles does not have author alias, only check the created_by column for matches
				$query->where('a.created_by =' . (int) $currentArticle->created_by);
			}
			
			// We don't want to show the article we are currently viewing
			$query->where('a.id !=' .  (int) $currentArticle->id);
			
			// If the language filter is enabled, only show articles that match the current language
			if ($app->getLanguageFilter()) {
				$query->where('a.language IN (' . $db->Quote(JFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')');
			}
			
			// Set ordering based on parameter
			// We know it is valid because of validate="options" in the form
			$query->order($params->get('article_ordering', 'a.title') . ' ' . $params->get('article_ordering_direction', 'ASC'));
			
			// Set query limit using count parameter (note that we have no pagination on the module)
			$db->setQuery($query, 0, $params->get('count', 5));
			
			// Get list of rows
			$items = $db->loadObjectList();

			// Create the link field for each item using the content router class
			foreach ($items as &$item) {
				$item->slug = $item->id.':'.$item->alias;
				$item->catslug = $item->catid.':'.$item->cat_alias;
				$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug));
			}
		}

		return $items;
	}
}
