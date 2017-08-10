<?php
class Ameex_MinimumorderFee_Model_Observer
{
public function addScreenToPayPal(Varien_Event_Observer $observer)
{
    $paypal_cart = $observer->getPaypalCart();
    $amount = $paypal_cart->getSalesEntity()->getCustomFeeAmount();
        if ($amount) {
            $paypal_cart->addItem(Mage::helper('minimumorderfee')->__('Minimum order fee'), 1, $amount, 'Minimum order fee');
        }
}
}
