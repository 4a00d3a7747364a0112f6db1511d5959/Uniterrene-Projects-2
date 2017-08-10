<?php
$installer=$this;
$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable('sales/quote_address'),'base_custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'Base custom fee'));
$installer->getConnection()->addColumn($installer->getTable('sales/quote_address'),'custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'custom fee'));

$installer->getConnection()->addColumn($installer->getTable('sales/quote_item'),'base_custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'Base custom fee'));
$installer->getConnection()->addColumn($installer->getTable('sales/quote_item'),'custom_fee_amount',array('type'=>Varien_Db_Ddl_Table::TYPE_DECIMAL,'nullable'=>'true','length'=>'12,4','comment'=>'custom fee'));


$installer->endSetup();
