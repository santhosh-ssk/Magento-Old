<?php

namespace Zilker\FirstModule\Observer;
use Magento\Customer\Model\Customer;

class CustomerRegisterObserver implements \Magento\Framework\Event\ObserverInterface
{
    private $logger,$_customerRepositoryInterface;
    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @var \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface)
     {
        $this->logger = $logger;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
     }

	public function execute(\Magento\Framework\Event\Observer $observer)
	{
        $customer = $observer->getEvent()->getCustomer();
        $fullname = $customer->getFirstname().' '.$customer->getLastname();
        $customer->setCustomAttribute('full_name',$fullname);
        $this->_customerRepositoryInterface->save($customer);
        $this->logger->info('Customer Email: '.get_class($customer));
        $this->logger->info('Customer Email: '.$customer->getEmail().', Name: '.$fullname);
	}
}