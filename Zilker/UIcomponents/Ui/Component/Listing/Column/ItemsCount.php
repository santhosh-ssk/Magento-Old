<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Zilker\UIcomponents\Ui\Component\Listing\Column;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\RequisitionList\Api\RequisitionListRepositoryInterface;

/**
 * Class Items
 */
class ItemsCount extends Column
{
    /**
     * @var RequisitionListRepositoryInterface
     */
    protected $requisitionListRepository,$productRepositoryInterface;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param RequisitionListRepositoryInterface $requisitionListRepository
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        RequisitionListRepositoryInterface $requisitionListRepository,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->requisitionListRepository  = $requisitionListRepository;
        $this->productRepositoryInterface = $productRepositoryInterface;;
    }

    /**
     * {@inheritdoc}
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                try {
                    $listItems  = $this->requisitionListRepository->get($item['entity_id'])->getItems();
                    $totalprice = 0;
                    foreach($listItems as $listItemKey => $listItem){
                          $product = $this->productRepositoryInterface->get($listItem->getSku());
                          $totalprice+= $product->getPrice();
                    }
                } catch (NoSuchEntityException $e) {
                    $listItems = [];
                }
                $item['items'] = count($listItems) . ' Items $'.$totalprice;
            }
        }

        return $dataSource;
    }
}
