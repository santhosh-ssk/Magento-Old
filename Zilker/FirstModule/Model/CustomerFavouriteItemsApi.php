<?php
namespace Zilker\FirstModule\Model;
use \Zilker\FirstModule\Api\Customer\FavouriteItems\ShowInterface;

class CustomerFavouriteItemsApi implements ShowInterface{
    
    protected $_customerFavoriteItemsFactory,$_productRepositoryInterface;
    /**
     * @param \Zilker\FirstModule\Model\CustomerFavoriteItemsFactory $customerFavoriteItemsFactory
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface
     */
    public function __construct(\Zilker\FirstModule\Model\CustomerFavoriteItemsFactory $customerFavoriteItemsFactory,
    \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface
    ){
        $this->_customerFavoriteItemsFactory = $customerFavoriteItemsFactory;
        $this->_productRepositoryInterface  = $productRepositoryInterface;
    }
     /**
     * Returns greeting message to user
     *
     * @api
     * @param  int $customerId
     * @return mixed[]
     */

    public function getPost($customerId)
	{

        $_customerFavoriteItems = $this->_customerFavoriteItemsFactory->create();
		$products = $_customerFavoriteItems->getCollection()->addFieldToFilter('customer_id',array('eq' => $customerId))->addFieldToSelect(['product_id']);
		$items    = [];
			
			foreach ($products  as $product){
				$item = $this->_productRepositoryInterface->getById($product['product_id']);
				array_push($items,array("name" => $item->getName()));
			}
		return $items;	
	}
}