<?php

namespace Omnipay\PaymentExpress\Message;

use Omnipay\Common\Exception\InvalidRequestException;
class RefundRequest extends AbstractRequest
{

    public function getData()
    {
        $this->validate('amount', 'transactionReference');
        $transactionReference = simplexml_load_string($this->getTransactionReference());
        $cardReference = $transactionReference->DpsTxnRef;
        $request =  new \SimpleXMLElement('<Txn></Txn>');
        $request->addChild('PostUsername',$this->getPostUsername());
        $request->addChild('PostPassword',$this->getPostPassword());
        $request->addChild('TxnType','Refund');
        $request->addChild('InputCurrency',$this->getMerchantCurrency());
        $request->addChild('Amount',$this->getAmount());
        $request->addChild('MerchantReference','Capture Transaction');
        $request->addChild('DpsTxnRef',$cardReference);
        $data = $request->asXML();
        return preg_replace('/\n/', ' ', $data);
    }
}
