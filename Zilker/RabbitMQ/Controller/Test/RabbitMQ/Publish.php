<?php
 /**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Zilker\RabbitMQ\Controller\Test\RabbitMQ;
use Zilker\RabbitMQ\Publisher\TestPublisher;

class Publish extends \Magento\Framework\App\Action\Action
{

       protected $_resultJsonFactory,$_testpublisher,$_publisher;
       

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \zilker\RabbitMQ\Publisher\TestPublisher $testpublisher
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
       \Zilker\RabbitMQ\Publisher\TestPublisher $testpublisher
     )
{
       $this->_resultJsonFactory = $resultJsonFactory;
       $this->_testpublisher     = $testpublisher;

       parent::__construct($context);
}
    /**
     * Publish  page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

      $this->_testpublisher->publish(array("id" => 1));
      $response    = $this->_resultJsonFactory->create();
      $responseObj = ["isSuccess" => true , "message" => "published a message"];  
      $response->setData($responseObj);
      return $response;
    }

}
?>