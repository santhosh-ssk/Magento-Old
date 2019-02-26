<?php 
    namespace Zilker\FirstModule\Plugin;

    class CartProductsLog
    {
        private $logger;
        
        /**
         * * @param \Psr\Log\LoggerInterface $logger
         */

        public function __construct(\Psr\Log\LoggerInterface $logger){
            $this->logger = $logger;
        }

        public function afteraddProduct(\Magento\Checkout\Model\Cart $subject,
                                        $productInfo,
                                        $requestInfo = null,$result)
        {
            
            $productName = $productInfo->getName();
            $this->logger->info('After Call ProductName: '.$productName);
        }
    }
?>