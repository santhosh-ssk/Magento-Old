<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Zilker\FirstModule\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Upgrade the Catalog module DB scheme
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.2.4', '<')) {
            $table = $installer->getConnection()->newTable(
				$installer->getTable('zilker_firstmodule_customer_favorite_items')
			)
				->addColumn(
					'entity_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
					'Entity ID'
				)
				->addColumn(
					'customer_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					['unsigned' => true, 'nullable' => false, 'default' => '0'],
					'Customer Id'
				)
				->addColumn(
					'product_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					['unsigned' => true, 'nullable' => false, 'default' => '0'],
					'Product Id'
                )
                ->addIndex(
                    $installer->getIdxName('zilker_firstmodule_customer_favorite_items', ['entity_id','customer_id']),
                    ['entity_id','customer_id']
                )->addForeignKey(
                    $installer->getFkName('zilker_firstmodule_customer_favorite_items', 'customer_id', 'customer_entity', 'entity_id'),
                    'customer_id',
                    $installer->getTable('customer_entity'),
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE,
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )->addForeignKey(
                    $installer->getFkName('zilker_firstmodule_customer_favorite_items', 'product_id', 'catalog_category_product', 'product_id'),
                    'product_id',
                    $installer->getTable('catalog_category_product'),
                    'product_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE,
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
				->setComment('Customer Favorite Items');
			$installer->getConnection()->createTable($table);
        }
        $setup->endSetup();
    }
}
