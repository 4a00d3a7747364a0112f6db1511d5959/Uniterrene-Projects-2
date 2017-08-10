<?php

class Inchoo_Shipping_Model_Carrier
    extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
    /**
     * Carrier's code, as defined in parent class
     *
     * @var string
     */
    protected $_code = 'inchoo_shipping';

    /**
     * Returns available shipping rates for Inchoo Shipping carrier
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        /** @var Mage_Shipping_Model_Rate_Result $result */
       if (!Mage::getStoreConfig('carriers/'.$this->_code.'/active')) {
        return false;
    }
    //create a result object
    $result = Mage::getModel('shipping/rate_result');
    $percentage = 10;
    $minimum = 25;
    
    if ($request->getAllItems()) {
		 foreach ($request->getAllItems() as $item) {
			 $productSku = $item->getProduct()->getData('sku');
			$_product = Mage::getModel('catalog/product')->loadByAttribute('sku',$productSku);
		   $package_name = $_product->getData('package_name');
		   
		  $ups_rate = $_product->getShippingCost();
		     if($package_name == 3)
			{
				$price_ltl  = 89; 
			}
			
		 
		 }
		
	}
	 $count = Mage::helper('checkout/cart')->getSummaryCount();
	 
	 
    
    $cart_ttl = $request->getBaseSubtotalInclTax();
    
    if($cart_ttl<200)
    {
		$price = $cart_ttl*.15;
	}
	if($cart_ttl>200 && $cart_ttl<300)
	{
		$price = $cart_ttl*.13;
	}
	if($cart_ttl>300 && $cart_ttl<1699)
	{
		$price = $cart_ttl*.11;
		
	}
   // echo $price_ltl;
    if($price_ltl !="")
    {
		$price = $price_ltl;
	}
	
	
	
	if($cart_ttl>1700)
	{
		$price = 0;
	}
	
	//echo $cart_ttl;
	if($ups_rate>$price)
	{
		//echo "ups rate is ".$ups_rate;
		$price = $ups_rate;
	}
	
    $packageValue = $request->getPackageValue();//the cost of the products
    //~ $price = ($pachageValue * $percentage) / 100; //calculate 10% of the product cost
    //~ if ($price < $minimum){//if 10% is less than 25
        //~ $price = $cart_ttl*.50;
    //~ }
    
    /*Adding My Custom Code*/
   
    
    if($price>89)
    {
		$price  = 89; 
	}
	
	
	if($count == 1)
	{
		$price = $ups_rate;
	}
	
	/*Check the value is less than 12.5 or not*/
	if($price<12.50)
    {
		//echo "here";
		$price = 12.50;
	}
	
	//echo $price;
	//exit();
    //echo $price;
    //create new shipping method instance
    $method = Mage::getModel('shipping/rate_result_method');
    $method->setCarrier($this->_code);
    $method->setCarrierTitle($this->getConfigData('title'));
    $method->setMethod($this->_code);
    $method->setMethodTitle($this->getConfigData('name'));
    //set the price for the method instance
    $method->setPrice($price);
    $method->setCost($price);
    //add the price to results
    $result->append($method);
    return $result;
    }

    /**
     * Returns Allowed shipping methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return array(
            'standard'    =>  'Standard delivery',
            'express'     =>  'Express delivery',
        );
    }

    /**
     * Get Standard rate object
     *
     * @return Mage_Shipping_Model_Rate_Result_Method
     */
    protected function _getStandardRate()
    {
        /** @var Mage_Shipping_Model_Rate_Result_Method $rate */
        $rate = Mage::getModel('shipping/rate_result_method');

        $rate->setCarrier($this->_code);
        $rate->setCarrierTitle($this->getConfigData('title'));
        $rate->setMethod('large');
        $rate->setMethodTitle('Standard delivery');
        $rate->setPrice(1.23);
        $rate->setCost(0);

        return $rate;
    }

    /**
     * Get Express rate object
     *
     * @return Mage_Shipping_Model_Rate_Result_Method
     */
    protected function _getExpressRate()
    {
        /** @var Mage_Shipping_Model_Rate_Result_Method $rate */
        $rate = Mage::getModel('shipping/rate_result_method');

        $rate->setCarrier($this->_code);
        $rate->setCarrierTitle($this->getConfigData('title'));
        $rate->setMethod('express');
        $rate->setMethodTitle('Express delivery');
        $rate->setPrice(12.3);
        $rate->setCost(0);

        return $rate;
    }
}
