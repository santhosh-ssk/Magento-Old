<?php
 /**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Zilker\KnockoutJs\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{

    protected $pageFactory;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory
       )
       {
         $this->pageFactory     = $pageFactory;
		   return parent::__construct($context);
       }
    /**
     * Index  page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
       return $this->pageFactory->create();
    } 
}
?>