<?php
 /**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Zilker\FirstModule\Controller\Page;
class HelloWorld extends \Magento\Framework\App\Action\Action
{

       protected $_resultJsonFactory;
       

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * 
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     )
{
       $this->_resultJsonFactory = $resultJsonFactory;
       parent::__construct($context);
}
    /**
     * HelloWorld  page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
      $response    = $this->_resultJsonFactory->create();
      $responseObj = ["isSuccess" => false , "message" => "Hi"];  
      $response->setData($responseObj);
       return $response;
    }

}
?>