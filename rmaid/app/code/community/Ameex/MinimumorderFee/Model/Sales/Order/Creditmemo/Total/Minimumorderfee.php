<?php
class Ameex_MinimumorderFee_Model_Sales_Order_Creditmemo_Total_Minimumorderfee extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract{
	public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo){
		$creditmemo->setCustomFeeAmount(0);
		$creditmemo->setBaseCustomFeeAmount(0);
		$lastcreditmemoCustomFeeAmount=0;
		$lastcreditmemoBaseCustomFeeAmount=0;
		foreach($creditmemo->getOrder()->getCreditmemosCollection() as $lastCreditmemo)
		{
			if($lastCreditmemo->getCustomFeeAmount() && ($lastCreditmemo->getState()!=Mage_Sales_Model_Order_Creditmemo::STATE_CANCELED))
			{
				$lastcreditmemoCustomFeeAmount+=$lastCreditmemo->getCustomFeeAmount();
				$lastcreditmemoBaseCustomFeeAmount+=$lastCreditmemo->getBaseCustomFeeAmount();
			}
		}
		$creditedMemo=$creditmemo->getOrder()->getCustomFeeAmount()-$lastcreditmemoCustomFeeAmount;
		$creditedMemoBase=$creditmemo->getOrder()->getCustomFeeAmount()-$lastcreditmemoBaseCustomFeeAmount;
		$creditmemo->setCustomFeeAmount($creditedMemo);
		$creditmemo->setBaseCustomFeeAmount($creditedMemoBase);
		$creditmemo->setGrandTotal($creditmemo->getGrandTotal()+$creditedMemo);
		$creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal()+$creditedMemoBase);
		return $this;
	}
}
