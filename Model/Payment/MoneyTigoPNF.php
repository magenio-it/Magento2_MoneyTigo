<?php


namespace Ipsinternationnal\MoneyTigo\Model\Payment;



class MoneyTigoPNF extends \Magento\Payment\Model\Method\AbstractMethod
{

    protected $_code = "moneytigopnf";
    protected $_isOffline = true;

    public function isAvailable(
        \Magento\Quote\Api\Data\CartInterface $quote = null
    ) {
    	// Recover card amount total
    	$amount = $quote->getGrandTotal();

    	// Recover param for payment in 3 installments
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    	$helper = $objectManager->create('Ipsinternationnal\MoneyTigo\Helper\Data');
    	$maxAmount = $helper->getPNFConfig('amountPNF');

    	// Disable payment in 3 installments if total amount is smaller than the payment in 3 installments param
    	if($amount < $maxAmount){
    		return false;
    	}

        return parent::isAvailable($quote);
    }
}