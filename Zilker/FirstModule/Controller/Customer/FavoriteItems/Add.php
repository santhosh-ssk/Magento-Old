<?php
 /**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Zilker\FirstModule\Controller\Customer\FavoriteItems;
class Add extends \Magento\Framework\App\Action\Action
{

       protected $_resultJsonFactory;
       protected $_customerFavoriteItemsFactory;
       protected $_customerSession;
       

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Zilker\FirstModule\Model\CustomerFavoriteItemsFactory $customerFavoriteItemsFactory
     * @param \Magento\Customer\Model\Session $customerSession
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
       \Zilker\FirstModule\Model\CustomerFavoriteItemsFactory $customerFavoriteItemsFactory,
       \Magento\Customer\Model\Session $customerSession)
{
       $this->_resultJsonFactory = $resultJsonFactory;
       $this->_customerFavoriteItemsFactory = $customerFavoriteItemsFactory;
       $this->_customerSession = $customerSession;
       parent::__construct($context);
}
    /**
     * HelloWorld  page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
      $_customerFavoriteItems = $this->_customerFavoriteItemsFactory->create();
      $response    = $this->_resultJsonFactory->create();

      $responseObj = ["isSuccess" => false , "message" => "","data"=>NULL];  
      $responseObj['isLoggedIn'] = $this->_customerSession->isLoggedIn();
      
      if($this->_customerSession->isLoggedIn()){
         $customerId = $this->_customerSession->getCustomerId();
         $productId      = $this->getRequest()->getParam('prodId');
         if($productId){
          $favorite_item = [
                  "product_id"  => $productId,
                  "customer_id" => $customerId
            ];
            $_customerFavoriteItems->setData($favorite_item);
            try{
                  $_customerFavoriteItems->save();
                  $responseObj['message'] = 'success';
                  $responseObj['isSuccess'] = true;
            }
            catch( \Exception $e){
               $responseObj['message'] = 'error in saving data';   
            }
         }
         else{
            $responseObj['message'] = 'product Id not available';    
         }
      }
      else{
         $responseObj['message'] = 'customer is not logged In';
      }
      $response->setData($responseObj);
       return $response;
    }

}
?>