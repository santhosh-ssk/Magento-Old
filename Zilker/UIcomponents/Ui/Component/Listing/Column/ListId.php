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
 * Class ListId
 */
class ListId extends Column
{
    /**
     * @var RequisitionListRepositoryInterface
     */
    protected $requisitionListRepository;

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
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->requisitionListRepository = $requisitionListRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item['list_id'] = 'List Id '.sprintf("%05d", $item['entity_id']);
            }
        }

        return $dataSource;
    }
}
