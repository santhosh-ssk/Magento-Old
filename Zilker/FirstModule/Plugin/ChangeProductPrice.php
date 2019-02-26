<?php 
    namespace Zilker\FirstModule\Plugin;

    class ChangeProductPrice
    {
        private $logger;
        
        /**
         * * @param \Psr\Log\LoggerInterface $logger
         */

        public function __construct(\Psr\Log\LoggerInterface $logger){
            $this->logger = $logger;
        }

        public function afterInitProduct(\Magento\Catalog\Helper\Product $product,$result)
        {
            //$this->logger->info(json_encode(get_class_methods($result)));
            $price = $result->getPrice();
            $this->logger->info('Original Price: '.$price.', Special Price: '.($price/2));
            $result->setPrice($price/2);
            return $result;
        }
    }
?>