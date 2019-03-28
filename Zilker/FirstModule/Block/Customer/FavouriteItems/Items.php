<?php
namespace Zilker\FirstModule\Block\Customer\FavouriteItems;
use Magento\Framework\App\Filesystem\DirectoryList;

class Items extends \Magento\Framework\View\Element\Template
{
	protected $_customerFavoriteItemsFactory;
	protected $_customerSession;
	
	private $logFileName = 'favouriteItemsLog'; 
	private $logger,$directoryList,$_productRepositoryInterface,$_imageBuilder;
	
	/**
	 * @param \Magento\Framework\View\Element\Template\Context $context
	 * @param \Zilker\FirstModule\Model\CustomerFavoriteItemsFactory $customerFavoriteItemsFactory
     * @param \Magento\Customer\Model\Session $customerSession
	 * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface
	 * @param \Magento\Catalog\Block\Product\ImageBuilder $imageBuilder
	 */
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Zilker\FirstModule\Model\CustomerFavoriteItemsFactory $customerFavoriteItemsFactory,
		\Magento\Customer\Model\Session $customerSession,
		DirectoryList $directoryList,
		\Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface
		// \Magento\Catalog\Block\Product\ImageBuilder $imageBuilder
	)
	{
		$this->_customerFavoriteItemsFactory = $customerFavoriteItemsFactory;
		$this->_customerSession = $customerSession;
		$this->directoryList = $directoryList; 
		$logDir = $directoryList->getPath('log'); 
		$writer = new \Zend\Log\Writer\Stream($logDir . DIRECTORY_SEPARATOR . $this->logFileName); 
		$logger = new \Zend\Log\Logger(); $logger->addWriter($writer); 
		$this->logger = $logger;
		$this->_productRepositoryInterface = $productRepositoryInterface;
		// $this->_imageBuilder = $imageBuilder;
		parent::__construct($context);
	}

	public function getFavouriteItems()
	{
		$_customerFavoriteItems = $this->_customerFavoriteItemsFactory->create();
		if($this->_customerSession->isLoggedIn()){
			$customerId = $this->_customerSession->getCustomerId();
			$products = $_customerFavoriteItems->getCollection()->addFieldToFilter('customer_id',array('eq' => $customerId))->addFieldToSelect(['product_id']);
			$items    = [];
			
			// $this->logger->info(json_encode(get_class_methods($this)));
			foreach ($products  as $product){
				$this->logger->info('Entity Id: '.$product['entity_id'].' Product ID: '.$product['product_id']);	
				$item = $this->_productRepositoryInterface->getById($product['product_id']);
				array_push($items,$item);
			}
			return $items;
		}
		else{
			return __('Customer is not logged In');
		}
		
	}

	

}
