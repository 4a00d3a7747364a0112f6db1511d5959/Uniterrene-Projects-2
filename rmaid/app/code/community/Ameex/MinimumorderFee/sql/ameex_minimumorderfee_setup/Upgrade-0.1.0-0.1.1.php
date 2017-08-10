<?php
$installer=$this;
$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable('sales/quote_address_item'),'base_custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'Base custom fee'));
$installer->getConnection()->addColumn($installer->getTable('sales/quote_address_item'),'custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'custom fee'));

$installer->getConnection()->addColumn($installer->getTable('sales/order_item'),'base_custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'Base custom fee'));
$installer->getConnection()->addColumn($installer->getTable('sales/order_item'),'custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'custom fee'));

$installer->getConnection()->addColumn($installer->getTable('sales/order'),'base_custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'Base custom fee'));
$installer->getConnection()->addColumn($installer->getTable('sales/order'),'custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'custom fee'));

$installer->getConnection()->addColumn($installer->getTable('sales/invoice'),'base_custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'Base custom fee'));
$installer->getConnection()->addColumn($installer->getTable('sales/invoice'),'custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'custom fee'));

$installer->getConnection()->addColumn($installer->getTable('sales/creditmemo'),'base_custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'Base custom fee'));
$installer->getConnection()->addColumn($installer->getTable('sales/creditmemo'),'custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'custom fee'));

$installer->getConnection()->addColumn($installer->getTable('sales/invoice_item'),'base_custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'Base custom fee'));
$installer->getConnection()->addColumn($installer->getTable('sales/invoice_item'),'custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'custom fee'));

$installer->getConnection()->addColumn($installer->getTable('sales/creditmemo_item'),'base_custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'Base custom fee'));
$installer->getConnection()->addColumn($installer->getTable('sales/creditmemo_item'),'custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'custom fee'));

$installer->endSetup();
