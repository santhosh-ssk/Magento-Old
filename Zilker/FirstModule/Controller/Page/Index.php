<?php
 /**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Zilker\FirstModule\Controller\Page;
class Index extends \Magento\Framework\App\Action\Action
{

    protected $pageFactory;
    protected $_messageManager;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       \Magento\Framework\Message\ManagerInterface $messageManager)
       {
         $this->pageFactory     = $pageFactory;
         $this->_messageManager = $messageManager;
		   return parent::__construct($context);
       }
    /**
     * Index  page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
       $this->_messageManager->addError('hi');
       return $this->pageFactory->create();
    } 
}
?>