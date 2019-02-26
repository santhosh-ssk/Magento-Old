<?php
 /**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Zilker\FirstModule\Controller\Page;
class CustomerRegister extends \Magento\Framework\App\Action\Action
{
      /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    
     private $logger;
     protected $resultJsonFactory;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
       \Psr\Log\LoggerInterface $logger)
    {
       $this->resultJsonFactory = $resultJsonFactory;
       parent::__construct($context);
       $this->logger = $logger;
    }
    
    /**
     * HelloWorld  page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
       $result = $this->resultJsonFactory->create();
       $data = ['message' => 'Hello world!'];
       $this->logger->info('custom log');
       return $result->setData($data);
       
    }

}
?>