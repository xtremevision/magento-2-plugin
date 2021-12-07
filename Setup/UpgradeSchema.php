<?php
namespace SamdedayCourier\Shipping\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
		$installer = $setup;

		$installer->startSetup();

		if(version_compare($context->getVersion(), '0.0.6', '<')) {
			$installer->getConnection()->modifyColumn(
				$installer->getTable( 'samedaycourier_shipping_service' ),
				'price',
				[
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
					'length' => '10,4',
				]
			);
			$installer->getConnection()->modifyColumn(
				$installer->getTable( 'samedaycourier_shipping_service' ),
				'price_free',
				[
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
					'length' => '10,4',
				]
			);
		}



		$installer->endSetup();
	}
}

