<?php
namespace Zilker\FirstModule\Model\ResourceModel\CustomerFavoriteItems;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'entity_id';
	protected $_eventPrefix = 'zilker_firstmodule_customer_favorite_items_collection';
	protected $_eventObject = 'customer_favorite_items_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Zilker\FirstModule\Model\CustomerFavoriteItems', 'Zilker\FirstModule\Model\ResourceModel\CustomerFavoriteItems');
	}

}
