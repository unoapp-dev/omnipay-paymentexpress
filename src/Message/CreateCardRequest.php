<?php

namespace Omnipay\PaymentExpress\Message;

class CreateCardRequest extends AbstractRequest
{
    public function getData()
    {
        $data = null;
        $this->getCard()->validate();
        if ($this->getCard()) {
            $request =  new \SimpleXMLElement('<Txn></Txn>');
            $request->addChild('PostUsername',$this->getPostUsername());
            $request->addChild('PostPassword',$this->getPostPassword());
            $request->addChild('TxnType','Validate');
            $request->addChild('InputCurrency',$this->getMerchantCurrency());
            $request->addChild('CardHolderName',$this->getCard()->getBillingName());
            $request->addChild('CardNumber',$this->getCard()->getNumber());
            $request->addChild('DateExpiry',$this->getCard()->getExpiryDate('my'));
            $request->addChild('Cvc2',$this->getCard()->getCvv());
            $request->addChild('Amount',0.00);
            $request->addChild('MerchantReference','Create card Transaction');
            $request->addChild('EnableAddBillCard',1);
            $data = $request->asXML();

        }
        return preg_replace('/\n/', ' ', $data);
    }
}
