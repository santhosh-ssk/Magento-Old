<?php 
    namespace Zilker\FirstModule\Plugin;

    class CustomerFirstNameLog
    {
        private $logger;
        
        /**
         * * @param \Psr\Log\LoggerInterface $logger
         */

        public function __construct(\Psr\Log\LoggerInterface $logger){
            $this->logger = $logger;
        }

        public function beforeGetEmail(\Magento\Customer\Model\Data\Customer $customer)
        {
            $this->logger->info('Before call, Customer First Name: '.$customer->getFirstname());
            return null;
        }

        public function aroundGetEmail(\Magento\Customer\Model\Data\Customer $customer,callable $proceed)
        {
            $this->logger->info('Around call, Customer First Name: '.$customer->getFirstname());
            $result=$proceed();
            $this->logger->info('Around after Proceed, Customer First Name: '.$customer->getFirstname());
            return $result;
        }

        public function afterGetEmail(\Magento\Customer\Model\Data\Customer $customer, $result)
        {
            $this->logger->info('After call, Customer First Name: '.$customer->getFirstname());
            return $result;
        }

    }
?>