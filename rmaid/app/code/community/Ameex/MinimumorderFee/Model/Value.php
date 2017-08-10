<?php
class Ameex_MinimumorderFee_Model_Value{
	public function toOptionArray()
	{
		return array(
		array('value'=>1,'label'=>Mage::helper('minimumorderfee')->__('Fixed Amount')),
		array('value'=>2,'label'=>Mage::helper('minimumorderfee')->__('Percentage of Amount'))
		);
	}
}
