<?php
/**
 * @package	HikaShop for Joomla!
 * @version	5.0.0
 * @author	hikashop.com
 * @copyright	(C) 2010-2023 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php
$jversion = preg_replace('#[^0-9\.]#i','',JVERSION);
if(version_compare($jversion,'4.0.0','>=')) {
	include_once(__DIR__.'/hikashop_j4.php');
} else {
	include_once(__DIR__.'/hikashop_j3.php');
}

class plgFinderHikashop extends plgFinderHikashopBridge
{
	protected $context = 'Product';
	protected $extension = 'com_hikashop';
	protected $layout = 'product';
	protected $type_title = 'Product';
	protected $table = '#__hikashop_product';
	protected $state_field = 'product_published';
	protected $item = null;

	protected function handleOtherLanguages(&$item) {
		hikashop_writeToLog($item);
		$translationHelper = hikashop_get('helper.translation');
		if($translationHelper->isMulti() && !$translationHelper->falang) {
			$languages = $translationHelper->loadLanguages();

			$mainColumns = array(
				'title' => 'product_name',
				'summary' => 'product_description',
				'metakey' => 'product_keywords',
				'metadesc' => 'product_meta_description',
				'product_alias' => 'product_alias'
			);
			$fields = $this->params->get('fields');
			if(!is_array($fields)){
				$fields = explode(',',(string)$fields);
			}
			if(!empty($fields) && count($fields)) {
				$columns = array_merge($mainColumns, $fields);
			} else {
				$columns = $mainColumns;
			}
			foreach($languages as $language) {
				$originals = array();
				foreach($columns as $column) {
					if(!empty($item->$column)) {
						$originals[$column] = $item->$column;
					}
				}
				if(count($originals)) {
					$translations = hikashop_translate($originals, $language->code);
					$copy = null;
					foreach($originals as $k => $o) {
						if($o == $translations[$k])
							continue;
						if(is_null($copy)) {
							$serialize = $item->serialize();
							$class = $this->resultClass;
							$copy = new $class();
							@$copy->unserialize($serialize);
							$copy->language = $language->code;
							$copy->addTaxonomy('Language', $copy->language);
						}
						$copy->$k = $translations[$k];

						foreach($columns as $column) {
							if(in_array($column, $mainColumns)) {
								$key = array_search($column, $mainColumns);
								if($key == 'summary') {
									$copy->summary = $this->prepareContent($copy->summary, $copy->params);
								} else {
									$copy->$key = $copy->$column;

								}
							}
						}

						$copy->alias = '';
						$this->addAlias($copy);
					}
					if(!is_null($copy)) {
						$menusClass = hikashop_get('class.menus');
						$itemid = $menusClass->getPublicMenuItemId();
						$extra = '';
						if(!empty($itemid))
							$extra = '&Itemid='.$itemid;

						$copy->url   = "index.php?option=com_hikashop&ctrl=product&task=show&cid=" . $copy->id."&name=".$copy->alias.$extra;
						$copy->route = "index.php?option=com_hikashop&ctrl=product&task=show&cid=" . $copy->id."&name=".$copy->alias.$extra;
						$this->indexer->index($copy);
					}
				}
			}
		}
	}

	public function onFinderGarbageCollection()
	{
		$db      = $this->db;
		$type_id = $this->getTypeId();

		$query    = $db->getQuery(true);
		$subquery = $db->getQuery(true);
		$subquery->select('CONCAT(' . $db->quote($this->getUrl('%', $this->extension, $this->layout)) . ', product_id)')
			->from($db->quoteName($this->table));
		$query->select($db->quoteName('l.link_id'))
			->from($db->quoteName('#__finder_links', 'l'))
			->where($db->quoteName('l.type_id') . ' = ' . $type_id)
			->where($db->quoteName('l.url') . ' LIKE ' . $db->quote($this->getUrl('%', $this->extension, $this->layout)))
			->where($db->quoteName('l.url') . ' NOT IN (' . $subquery . ')');
		$db->setQuery($query);
		$items = $db->loadColumn();

		foreach ($items as $item) {
			$this->indexer->remove($item);
		}

		return count($items);
	}

	public function onFinderCategoryChangeState($extension, $pks, $value)
	{
		if ($extension == 'com_hikashop')
		{
			$this->categoryStateChange($pks, $value);
		}
	}

	public function onFinderAfterDelete($context, $table)
	{
		if ($context == 'com_hikashop.product' && !empty($table->product_id))
		{
			$id = $table->product_id;
		}
		else if ($context == 'com_finder.index' && !empty($table->link_id))
		{
			$id = $table->link_id;
		}
		else
		{
			return true;
		}

		return $this->remove($id);
	}

	public function onFinderAfterSave($context, $row, $isNew)
	{
		if ($context == 'com_hikashop.product' && !is_null($row))
		{

			if(!empty($row->categories)) {
				$query = 'SELECT category_id FROM #__hikashop_category WHERE category_id IN('.implode(',', $row->categories).') AND category_published=1;';
				$db = JFactory::getDBO();
				$db->setQuery($query);
				$res = $db->loadResult();

				if(!$res) {
					return $this->remove($row->product_id);
				}
			}

			$this->reindex($row->product_id);
		}

		return true;
	}

	public function onFinderBeforeSave($context, $row, $isNew)
	{
		return true;
	}

	protected function translateState($item, $category = null)
	{
		if(!empty($this->item->id)) {
			$query = 'SELECT c.category_id FROM #__hikashop_category AS c LEFT JOIN #__hikashop_product_category AS pc ON pc.category_id = c.category_id WHERE c.category_published=1 AND pc.product_id ='.$this->item->id;
			$db = JFactory::getDBO();
			$db->setQuery($query);
			$res = $db->loadResult();
			if($res)
				$category = 1;
			else
				$category = 0;
		}

		return parent::translatestate($item, $category);
	}

	public function onFinderChangeState($context, $pks, $value)
	{
		if ($context == 'com_hikashop.product')
		{
			$this->itemStateChange($pks, $value);
		}
		if ($context == 'com_plugins.plugin' && $value === 0)
		{
			$this->pluginDisable($pks);
		}
	}

	protected function setup()
	{
		$this->_setup();
		return true;
	}

	protected function _setup() {

		if(!defined('DS'))
			define('DS', DIRECTORY_SEPARATOR);
		include_once(rtrim(JPATH_ADMINISTRATOR,DS).DS.'components'.DS.'com_hikashop'.DS.'helpers'.DS.'helper.php');
	}

	protected function getUrl($id, $extension, $view)
	{
		static $extra = null;
		$url = 'index.php?option=' . $extension . '&ctrl=' . $view . '&task=show&cid=';
		if(!empty($id)) {
			if(is_numeric($id)) {
				if(is_null($extra)) {
					$this->_setup();
					$menusClass = hikashop_get('class.menus');
					$itemid = $menusClass->getPublicMenuItemId();
					if($itemid)
						$extra = '&Itemid='.$itemid;
					else
						$extra = '';
				}
				$productClass = hikashop_get('class.product');
				$item = $productClass->get($id);
				if($item->product_type == 'variant') {
					$parent = $productClass->get($item->product_parent_id);
					if($parent)
						$item->alias = $parent->alias;
				}
				$url .= $id ."&name=".$item->alias. $extra;
			} elseif($id === '%') {
				$url .= $id;
			}
		}

		return $url;
	}

	protected function getListQuery($query = null)
	{
		$category = (bool)$this->params->get('index_per_category');
		$db = JFactory::getDbo();
		$query = $query instanceof JDatabaseQuery ? $query : $db->getQuery(true)
			->select('a.*')
			->select('a.product_id AS id, a.product_name AS title, a.product_alias AS alias, "" AS link, a.product_description AS summary')
			->select('a.product_keywords AS metakey, a.product_meta_description AS metadesc, "" AS metadata, a.product_access AS access')
			->select('"" AS created_by_alias, a.product_modified AS modified, "" AS modified_by')
			->select('a.product_sale_start AS publish_start_date, a.product_sale_end AS publish_end_date')
			->select($this->getStateColumn().' AS state, a.product_sale_start AS start_date, 1 AS access')
			->select('brand.category_name AS brand, brand.category_alias as brandalias, brand.category_published AS brand_state, 1 AS brand_access');
		if($category) {
			$query->select('c.category_name AS category, c.category_alias as categoryalias, c.category_published AS cat_state, 1 AS cat_access');
		}

		$case_when_item_alias = ' CASE WHEN a.product_alias != "" THEN a.product_alias ELSE a.product_name END as slug';
		$query->select($case_when_item_alias);
		if($category) {
			$case_when_category_alias = 'c.category_id AS catid, CASE WHEN c.category_alias != "" THEN c.category_alias ELSE c.category_name END as catslug';
			$query->select($case_when_category_alias);
		}

		$query->from('#__hikashop_product AS a')
			->join('LEFT', '#__hikashop_category AS brand ON a.product_manufacturer_id = brand.category_id');

		if($category) {
			$query->join('LEFT', '#__hikashop_product_category AS pc ON a.product_id = pc.product_id')
				->join('LEFT', '#__hikashop_category AS c ON pc.category_id = c.category_id');
		}
		return $query;
	}
	protected function getItem($id)
	{
		$query = $this->getListQuery();
		$query->where('a.product_id = ' . (int) $id);

		$this->db->setQuery($query);
		$row = $this->db->loadAssoc();

		if(empty($row))
			$row = array();

		$item = $this->toObject($row);

		$item->type_id = $this->type_id;

		$item->layout = $this->layout;

		return $item;
	}

	protected function categoryStateChange($pks, $value)
	{
		foreach ($pks as $pk)
		{
			$query = clone $this->getStateQuery();
			$query->where('c.category_id = ' . (int) $pk);

			$this->db->setQuery($query);
			$items = $this->db->loadObjectList();

			foreach ($items as $item)
			{
				$temp = $this->translateState($item->state, $value);

				$this->change($item->id, 'state', $temp);

				$this->reindex($item->id);
			}
		}
	}

	protected function checkItemAccess($row)
	{
		$query = $this->db->getQuery(true)
			->select($this->db->quoteName('access'))
			->from($this->db->quoteName($this->table))
			->where($this->db->quoteName('product_id') . ' = ' . (int) $row->id);
		$this->db->setQuery($query);

		$this->old_access = $this->db->loadResult();
	}
	protected function itemStateChange($pks, $value)
	{
		foreach ($pks as $pk)
		{
			$query = clone $this->getStateQuery();
			$query->where('a.product_id = ' . (int) $pk);

			$this->db->setQuery($query);
			$item = $this->db->loadObject();

			$temp = $this->translateState($value, $item->cat_state);

			$this->change($pk, 'state', $temp);

			$this->reindex($pk);
		}
	}

	protected function getUpdateQueryByTime($time)
	{
		$query = $this->db->getQuery(true)
			->where('a.product_modified >= ' . $this->db->quote($time));

		return $query;
	}

	protected function getUpdateQueryByIds($ids)
	{
		$query = $this->db->getQuery(true)
			->where('a.product_id IN(' . implode(',', $ids) . ')');

		return $query;
	}

	protected function getStateQuery()
	{
		$query = $this->db->getQuery(true);

		$query->select('a.product_id AS id, c.category_id AS catid');

		$query->select($this->getStateColumn().' AS state, c.category_published AS cat_state');
		$query->select('1 AS access,  1 AS cat_access')
			->from($this->table . ' AS a')
			->join('LEFT', '#__hikashop_product_category AS pc ON a.product_id = pc.product_id')
			->join('LEFT', '#__hikashop_category AS c ON pc.category_id = c.category_id');

		return $query;
	}

	protected function getStateColumn() {
		$state = 'a.product_published';
		if(!function_exists('hikashop_config'))
			$this->setup();
		$config = hikashop_config();
		$out_of_stock = (int)$config->get('show_out_of_stock','1');
		if(!$out_of_stock){
			$state = '(CASE a.product_quantity WHEN 0 THEN 0 ELSE a.product_published END)';
		}
		return $state;
	}
}
