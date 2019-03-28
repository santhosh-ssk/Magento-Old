<?php
namespace Zilker\FirstModule\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

	public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
	{
		$installer = $setup;
		$installer->startSetup();
		if (!$installer->tableExists('zilker_firstmodule_customer_favorite_items')) {
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
					['unsigned' => true, 'nullable' => false],
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
		$installer->endSetup();
	}
}

