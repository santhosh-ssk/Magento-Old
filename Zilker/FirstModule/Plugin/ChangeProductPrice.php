<?php 
    namespace Zilker\FirstModule\Plugin;

    class ChangeProductPrice
    {
        private $logger,$_messageManager;
        
        /**
         * * @param \Psr\Log\LoggerInterface $logger
         */

        public function __construct(\Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Message\ManagerInterface $messageManager
        ){
            $this->logger          = $logger;
            $this->_messageManager = $messageManager;
        }

        public function afterInitProduct(\Magento\Catalog\Helper\Product $product,$result)
        {
            $this->logger->info(json_encode(get_class_methods($this->_messageManager)));
            $price = $result->getPrice();
            $this->logger->info('Original Price: '.$price.', Special Price: '.($price/2));
            $result->setPrice($price/2);
            $this->_messageManager->addError('Error');
            $this->_messageManager->addSuccess('Success');
            $this->_messageManager->addWarning('Warning');
            $this->_messageManager->addNotice('Notice');
            return $result;
        }
    }
?>