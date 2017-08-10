<?php
class Ameex_MinimumorderFee_Model_Sales_Order_Invoice_Total_Minimumorderfee extends Mage_Sales_Model_Order_Invoice_Total_Abstract{
public function collect(Mage_Sales_Model_Order_Invoice $invoice)
{
	$invoice->setCustomFeeAmount(0);
	$invoice->setBaseCustomFeeAmount(0);
	$lastinvoiceCustomFeeAmount=0;
	$lastinvoiceBaseCustomFeeAmount=0;
	foreach($invoice->getOrder()->getInvoiceCollection() as $lastInvoice)
	{
		if($lastInvoice->getCustomFeeAmount() && !$lastInvoice->isCanceled)
		{
			$lastinvoiceCustomFeeAmount+=$lastInvoice->getCustomFeeAmount();
			$lastinvoiceBaseCustomFeeAmount+=$lastInvoice->getBaseCustomFeeAmount();
		}
	}
	$invoicedcustomfee = $invoice->getOrder()->getCustomFeeAmount() - $lastinvoiceCustomFeeAmount;
    $invoicedBasecustomfee = $invoice->getOrder()->getBaseCustomFeeAmount() - $lastinvoiceBaseCustomFeeAmount;
    $invoice->setCustomFeeAmount($invoicedcustomfee);
    $invoice->setBaseCustomFeeAmount($invoicedBasecustomfee);
	$invoice->setGrandTotal($invoice->getGrandTotal()+$invoicedcustomfee);
	$invoice->setBaseGrandTotal($invoice->getBaseGrandTotal()+$invoicedBasecustomfee);
    return $this;
}
}
