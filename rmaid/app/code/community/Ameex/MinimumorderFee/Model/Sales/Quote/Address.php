<?php
class Ameex_MinimumorderFee_Model_Sales_Quote_Address extends Mage_Sales_Model_Quote_Address
{
public function validateMinimumAmount()
    {
        $amount = Mage::getStoreConfig('sales/minimum_order/amount', Mage::app()->getStore()->getId());
        $minimumorderfee=Mage::getStoreConfig('sales/minimum_order/minimumfee');
		if (($this->getBaseSubtotalWithDiscount() < $amount) && ($minimumorderfee=='')) {
            return false;
        } 
        return true;
    }

}
