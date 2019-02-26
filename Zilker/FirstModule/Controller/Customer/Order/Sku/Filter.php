<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Zilker\FirstModule\Controller\Customer\Order\Sku;

class Filter extends \Magento\AdvancedCheckout\Controller\Sku\UploadFile
{
    private $logger,$_productReposityInterface;
    protected $_product;
    
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface,
            \Magento\Catalog\Model\ProductFactory $product,
            \Psr\Log\LoggerInterface $logger            
            )
    {
        parent::__construct($context);
        $this->logger = $logger;
        $this->_productReposityInterface = $productRepositoryInterface;
        $this->_product = $product;
    }
    
    /**
     * Upload file Action
     *
     * @return void
     */
    public function execute()
    {
        /** @var $helper \Magento\AdvancedCheckout\Helper\Data */
        $helper = $this->_objectManager->get(\Magento\AdvancedCheckout\Helper\Data::class);
        $rows = $helper->isSkuFileUploaded($this->getRequest()) ? $helper->processSkuFileUploading() : [];

        $items = $this->getRequest()->getPost('items');
        if (!is_array($items)) {
            $items = [];
        }

        if (count($rows)) {
            foreach ($rows as $row) {
                $items[] = $row;
            }
        }

        $index = 0;
        foreach ($items as $item) {
            $flag = $this->filterItem($item);
            if(!$flag){
                unset($items[$index]);
            }
            $index++;
        }
        // $this->logger->info('items: '.json_encode($items));
        $this->getRequest()->setParam('items', $items);
        $this->_forward('advancedAdd', 'cart');
    }

    public function filterItem($item){
        $itemSku = $item['sku'];
        $flag = 1;
        try{
            $item = $this->_productReposityInterface->get($itemSku);
        }
        catch(\Exception $e){
            // $this->logger->info('Product Sku: '.$itemSku.' does not exist');
            $flag = 0;
        }
        return $flag;
        
    }
}
