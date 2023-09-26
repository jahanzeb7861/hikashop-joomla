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
jimport('joomla.application.component.helper');
require_once JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/adapter.php';

abstract class plgFinderHikashopBridge extends FinderIndexerAdapter {
	public $resultClass = 'FinderIndexerResult';

	public function __construct(&$subject, $config) {
		if(!isset($this->params)) {
			$plugin = JPluginHelper::getPlugin('finder', 'hikashop');
			$this->params = new JRegistry(@$plugin->params);
		}

		parent::__construct($subject, $config);
	}

	protected function index(FinderIndexerResult $item, $format = 'html')
	{
		if (JComponentHelper::isEnabled($this->extension) == false)
		{
			return;
		}

		$registry = new JRegistry;
		$registry->loadString($item->params);
		$item->params = JComponentHelper::getParams('com_hikashop', true);
		$item->params->merge($registry);

		$registry = new JRegistry;
		if(!empty($item->params))
			$registry->loadString($item->metadata);
		$item->metadata = $registry;

		$item->summary = FinderIndexerHelper::prepareContent($item->summary, $item->params);
		$item->body    = FinderIndexerHelper::prepareContent($item->body, $item->params);

		$menusClass = hikashop_get('class.menus');
		$itemid = $menusClass->getPublicMenuItemId();
		$this->addAlias($item);
		$extra = '';
		if(!empty($itemid))
			$extra = '&Itemid='.$itemid;

		$item->url   = "index.php?option=com_hikashop&ctrl=product&task=show&cid=" . $item->id."&name=".$item->alias.$extra;
		$item->route = "index.php?option=com_hikashop&ctrl=product&task=show&cid=" . $item->id."&name=".$item->alias.$extra;
		$item->path  = FinderIndexerHelper::getContentPath($item->route);

		$title = $this->getItemMenuTitle($item->url);

		if (!empty($title) && $this->params->get('use_menu_title', true))
		{
			$item->title = $title;
		}

		$item->metaauthor = $item->metadata->get('author');

		$class = hikashop_get('class.product');
		$data = $class->getProduct($item->id);
		if(!empty($data->images) && count($data->images)) {
			$image = reset($data->images);
		}
		$imageHelper = hikashop_get('helper.image');
		$imageHelper->uploadFolder_url =  rtrim(HIKASHOP_LIVE,'/').'/';
		$append = trim(str_replace(array(JPATH_ROOT, DS), array('', '/'),$imageHelper->uploadFolder), '/');
		if(!empty($append)) {
			$imageHelper->uploadFolder_url .= $append.'/';
		}
		$img = $imageHelper->getThumbnail(@$image->file_path, array('width' => $imageHelper->main_thumbnail_x, 'height' => $imageHelper->main_thumbnail_y), array('default' => true));
		if($img->success) {
			$item->imageUrl = $img->url;
			$item->imageAlt = @$image->file_name;
		}

		$item->addInstruction(FinderIndexer::META_CONTEXT, 'metakey');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'metadesc');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'created_by_alias');

		$fields = $this->params->get('fields');
		if(!is_array($fields)){
			$fields = explode(',',(string)$fields);
		}
		if(!empty($fields) && count($fields)) {
			foreach($fields as $field) {
				if(!in_array($field, array('product_name', 'product_description', 'product_keywords', 'product_meta_description')))
					$item->addInstruction(FinderIndexer::META_CONTEXT, $field);
			}
		}

		$this->item = $item;
		$item->state = $this->translateState($item->state, $item->cat_state);

		$item->addTaxonomy('Type', 'Product');

		$item->addTaxonomy('Category', 		$item->category, $item->cat_state, $item->cat_access);

		$item->addTaxonomy('Brand', 	$item->brand, 	$item->brand_state, $item->brand_access);

		$item->addTaxonomy('Language', 		$item->language);

		FinderIndexerHelper::getContentExtras($item);

		$this->indexer->index($item);
		$this->handleOtherLanguages($item);
	}

	public function prepareContent($summary, $params) {
		return FinderIndexerHelper::prepareContent($summary, $params);
	}

	protected function addAlias(&$element){
		if(empty($element->alias)){
			if(empty($element->title))
				return;
			$element->alias = strip_tags(preg_replace('#<span class="hikashop_product_variant_subname">.*</span>#isU','',$element->title));
		}

		$config = JFactory::getConfig();
		if(!$config->get('unicodeslugs')){
			$lang = JFactory::getLanguage();
			$element->alias = str_replace(array(',', "'", '"'), array('-', '-', '-'), $lang->transliterate($element->alias));
		}
		$app = JFactory::getApplication();
		if(method_exists($app,'stringURLSafe')){
			$element->alias = $app->stringURLSafe($element->alias);
		}elseif(method_exists('JFilterOutput','stringURLUnicodeSlug')){
			$element->alias = JFilterOutput::stringURLUnicodeSlug($element->alias);
		}else{
			$element->alias = JFilterOutput::stringURLSafe($element->alias);
		}
	}

	public function toObject($row) {
		if(HIKASHOP_J30) {
			$item = Joomla\Utilities\ArrayHelper::toObject($row, 'FinderIndexerResult');
		} else {
			$item = ArrayHelper::toObject((array) $row, 'FinderIndexerResult');
		}
		return $item;
	}

}
