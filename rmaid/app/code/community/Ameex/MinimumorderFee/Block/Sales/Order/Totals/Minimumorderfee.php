<?php
class Ameex_MinimumorderFee_Block_Sales_Order_Totals_Minimumorderfee extends Mage_Core_Block_Abstract
{
	public function getSource()
	{
		return $this->getParentBlock()->getSource();
	}

	public function initTotals()
	{
		if((float)$this->getSource()->getBaseCustomFeeAmount()==0){
			return $this;
		}
		$total=new Varien_Object(array('code'=>'minimumorderfee','label'=>$this->__('Minimum Order Fee'),'value'=>$this->getSource()->getBaseCustomFeeAmount(),'field'=>'custom_fee_amount'));
		$this->getParentBlock()->addTotalBefore($total, 'shipping');
		return $this;
	}
}
