<?php
class Ameex_MinimumorderFee_Model_Calculation{
	public function toOptionArray()
	{
		return array(
		array('value'=>1,'label'=>Mage::helper('minimumorderfee')->__('Subtotal')),
		array('value'=>2,'label'=>Mage::helper('minimumorderfee')->__('Subtotal + Tax')),
		array('value'=>3,'label'=>Mage::helper('minimumorderfee')->__('Subtotal After Discount'))
		);
	}
}
