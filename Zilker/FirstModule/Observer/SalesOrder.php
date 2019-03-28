<?php

namespace Zilker\FirstModule\Observer;

class SalesOrder implements \Magento\Framework\Event\ObserverInterface
{
    private $logger,$_productRepositoryInterface,$configurable;
    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger
        ,\Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface,
        \Magento\ConfigurableProduct\Model\Product\Type\Configurable $configurable
      )
     {
        $this->logger = $logger;
        $this->_productRepositoryInterface = $productRepositoryInterface;
        $this->configurable = $configurable;
     }

	public function execute(\Magento\Framework\Event\Observer $observer)
	{
        $order = $observer->getEvent()->getOrder();
        $orderitems = $order->getAllVisibleItems();
        foreach($orderitems as $item){
            $product = $item->getProduct();
            $typeId  = $product->getTypeId();
            $skuId      = $product->getSku();
            if($typeId == 'configurable'){
                continue;
            }
            
            $this->logger->info('Product : '.$skuId.',type: '.$typeId);     
        }
        
    }
}