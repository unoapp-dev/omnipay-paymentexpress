<?php

namespace Omnipay\PaymentExpress\Message;

class CaptureRequest extends AbstractRequest
{
    public function getData()
    {
        $data = null;
        if ($this->getTransactionReference()) {

            $transactionReference = simplexml_load_string($this->getTransactionReference());
            $cardReference = $transactionReference->DpsTxnRef;

            $request =  new \SimpleXMLElement('<Txn></Txn>');
            $request->addChild('PostUsername',$this->getPostUsername());
            $request->addChild('PostPassword',$this->getPostPassword());
            $request->addChild('TxnType','Complete');
            $request->addChild('InputCurrency',$this->getMerchantCurrency());
            $request->addChild('Amount',$transactionReference->Transaction->Amount);
            $request->addChild('MerchantReference','Capture Transaction');
            $request->addChild('DpsTxnRef',$cardReference);
            $data = $request->asXML();
        }
        return preg_replace('/\n/', ' ', $data);
    }
}
