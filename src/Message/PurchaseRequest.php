<?php

namespace Omnipay\PaymentExpress\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $data = null;
        $this->validate('amount');
        $paymentMethod = $this->getPaymentMethod();
        switch ($paymentMethod)
        {
            case 'card' :
                break;
            case 'payment_profile' :
                if ($this->getCardReference()) {

                    $request =  new \SimpleXMLElement('<Txn></Txn>');
                    $request->addChild('PostUsername',$this->getPostUsername());
                    $request->addChild('PostPassword',$this->getPostPassword());
                    $request->addChild('TxnType','Purchase');
                    $request->addChild('InputCurrency',$this->getMerchantCurrency());
                    $request->addChild('Amount',$this->getAmount());
                    $request->addChild('MerchantReference',$this->getOrderNumber());
                    $request->addChild('DpsBillingId',$this->getCardReference());
                    $data = $request->asXML();
                }
                break;
            case 'token' :
                break;
            default :
                break;
        }
        return preg_replace('/\n/', ' ', $data);
    }
}

