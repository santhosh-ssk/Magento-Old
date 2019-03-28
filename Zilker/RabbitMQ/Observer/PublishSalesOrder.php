<?php

namespace Zilker\RabbitMQ\Observer;

class PublishSalesOrder implements \Magento\Framework\Event\ObserverInterface
{
    private $logger,$_productRepositoryInterface,$configurable,$publish_customer_order_products;
    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger
        ,\Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface,
        \Magento\ConfigurableProduct\Model\Product\Type\Configurable $configurable,
        \Zilker\RabbitMQ\Publisher\Customer\Order\Products $publish_customer_order_products
      )
     {
        $this->logger = $logger;
        $this->_productRepositoryInterface = $productRepositoryInterface;
        $this->configurable = $configurable;
        $this->publish_customer_order_products = $publish_customer_order_products;
     }

	public function execute(\Magento\Framework\Event\Observer $observer)
	{
        $order = $observer->getEvent()->getOrder();
        $orderitems = $order->getAllVisibleItems();
        $xml_data = ["CustomerName" => $order->getCustomerName()]; 
        $products = [];
        foreach($orderitems as $item){
            $product = $item->getProduct();
            $typeId  = $product->getTypeId();
            if($typeId == 'configurable'){
                continue;
            }
            $name  = $product->getName();
            $skuId = $product->getSku();
            $price = $product->getPrice();

            array_push($products,["product"=>["name"=>$name,"skuId"=>$skuId,"price"=>$price,"type"=>$typeId]]);
        }

        $xml_data["products"] = $products;
        $xml = new \SimpleXMLElement('<root/>');

        foreach($xml_data as $key => $values){
           if(!is_array($values)){
               $xml->addChild($key,$values);
           } 
           else{
                $products_xml = $xml->addChild('<products>');    
                foreach($values as  $key => $value){
                    $product_xml = $products_xml->addChild('<product>');
                    foreach($value['product'] as $key=>$value){
                        $product_xml->addChild($key,$value);
                    }    
                }
           }
        }
        $this->publish_customer_order_products->publish($xml->asXML()); 
        $this->logger->info('published');
        
    }
}