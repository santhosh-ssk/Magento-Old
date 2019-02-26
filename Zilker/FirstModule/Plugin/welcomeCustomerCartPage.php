<?php 
    namespace Zilker\FirstModule\Plugin;

    class welcomeCustomerCartPage extends \Magento\Checkout\Controller\Index\Index
    {
        private $logger;
        protected $_messageManager;
        
        /**
         * @param \Psr\Log\LoggerInterface $logger
         * @param \Magento\Framework\Message\ManagerInterface $messageManager
         */

        public function __construct(\Psr\Log\LoggerInterface $logger,\Magento\Framework\Message\ManagerInterface $messageManager){
            $this->logger = $logger;
            $this->_messageManager = $messageManager;
        }

        public function beforeExecute(\Magento\Checkout\Controller\Index\Index $index)
        {
            echo "You are the 100th visitor";
            $this->_messageManager->addSuccess("hi");
            
        }
    }
?>