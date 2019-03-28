<?php
namespace Zilker\FirstModule\Model\ResourceModel;


class CustomerFavoriteItems extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('zilker_firstmodule_customer_favorite_items', 'entity_id');
	}
	
}
