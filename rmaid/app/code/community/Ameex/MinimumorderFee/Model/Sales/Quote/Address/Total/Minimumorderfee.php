<?php
class Ameex_MinimumorderFee_Model_Sales_Quote_Address_Total_Minimumorderfee extends Mage_Sales_Model_Quote_Address_Total_Abstract{
	//protected $minimumfeeTiers=array(0=>10,5=>20,10=>30,);
	public function __construct(){
		$this->setCode('minimumorderfee');
	}
	public function collect(Mage_Sales_Model_Quote_Address $address){
		parent::collect($address);
		$this->_setAmount(0);
		$this->_setBaseAmount(0);
        $items = $this->_getAddressItems($address);
        if (!count($items)) {
            return $this; //this makes only address type shipping to come through
        }
        $quote = $address->getQuote();
		$minimumorderfee=Mage::getStoreConfig('sales/minimum_order/minimumfee');
		$isMinAmt= Mage::getStoreConfig('sales/minimum_order/amount', Mage::app()->getStore()->getId());
		$isMinAmtActive= Mage::getStoreConfig('sales/minimum_order/active', Mage::app()->getStore()->getId());
		$subtotalcalculation=Mage::getStoreConfig('sales/minimum_order/subtotalcalculation', Mage::app()->getStore()->getId());
		switch($subtotalcalculation)
		{
			case 1:
				$subtotal=$address->getSubtotal();
				break;
			case 2:
				$firstsubtotal=$address->getSubtotal();
				$tax=$address->getTaxAmount();
				$subtotal=$firstsubtotal+$tax;
				break;
			case 3:
			   $subtotal=$address->getSubtotalWithDiscount();
				break;
		}
		if($isMinAmtActive==1 && $subtotal<$isMinAmt){
			$feecalculation=Mage::getStoreConfig('sales/minimum_order/feecalculation', Mage::app()->getStore()->getId());
			switch($feecalculation){
				/* case 1 is for fixed amount */
				case 1 :
					$address->setBaseCustomFeeAmount($minimumorderfee);
					$address->setCustomFeeAmount($minimumorderfee);
					//$this->_addBaseAmount($minimumorderfee);
					//$this->_addAmount($minimumorderfee);
					//return $this;
					 $quote->setCustomFeeAmount($minimumorderfee);
 
            $address->setGrandTotal($address->getGrandTotal() + $address->getCustomFeeAmount());
            $address->setBaseGrandTotal($address->getBaseGrandTotal() + $address->getBaseCustomFeeAmount());
					break;
				case 2 :
					/* case 2 is for percentage of fixed amount */
				$percentcalculation=$subtotal*($minimumorderfee/100);
				$address->setBaseCustomFeeAmount($percentcalculation);
				$address->setCustomFeeAmount($percentcalculation);
				//$this->_addBaseAmount($percentcalculation);
				//$this->_addAmount($percentcalculation);
				//return $this;
				 $quote->setCustomFeeAmount($percentcalculation);
 
            $address->setGrandTotal($address->getGrandTotal() + $address->getCustomFeeAmount());
            $address->setBaseGrandTotal($address->getBaseGrandTotal() + $address->getBaseCustomFeeAmount());

			}
		}
	}
	public function fetch(Mage_Sales_Model_Quote_Address $address)
	{
    $amount = $address->getCustomFeeAmount();
    if($amount!=0){
		$isMinAmt= Mage::getStoreConfig('sales/minimum_order/amount', Mage::app()->getStore()->getId());
		$subtotal=$address->getSubtotal();
		$isMinAmtActive= Mage::getStoreConfig('sales/minimum_order/active', Mage::app()->getStore()->getId());
		if($isMinAmtActive==1 && $subtotal<$isMinAmt){
				$address->addTotal(array(
					'code' => $this->getCode(),
					'title' => Mage::helper('minimumorderfee')
                    ->__('Minimum Order Fee'),
					'value' => $amount
				));
		}
		return $this;
	}
	}	
}
