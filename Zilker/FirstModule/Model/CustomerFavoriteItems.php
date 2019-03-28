<?php
namespace Zilker\FirstModule\Model;


class CustomerFavoriteItems extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'zilker_firstmodule_customer_favorite_items';

	protected $_cacheTag = 'zilker_firstmodule_customer_favorite_items';

	protected $_eventPrefix = 'zilker_firstmodule_customer_favorite_items';

	protected function _construct()
	{
		$this->_init('Zilker\FirstModule\Model\ResourceModel\CustomerFavoriteItems');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}

}
