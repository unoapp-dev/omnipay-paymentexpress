<?php

namespace  Omnipay\PaymentExpress\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $host = 'https://sec.paymentexpress.com/pxpost.aspx';
    protected $testHost = 'https://uat.paymentexpress.com/pxpost.aspx';
    protected $endpoint = '';

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testHost : $this->host;
    }

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function getPostUsername()
    {
        return $this->getParameter('PostUsername');
    }

    public function setPostUsername($value)
    {
        return $this->setParameter('PostUsername', $value);
    }

    public function getPostPassword()
    {
        return $this->getParameter('PostPassword');
    }

    public function setPostPassword($value)
    {
        return $this->setParameter('PostPassword', $value);
    }

    public function getPaymentMethod()
    {
        return $this->getParameter('payment_method');
    }

    public function setPaymentMethod($value)
    {
        return $this->setParameter('payment_method', $value);
    }

    public function getMerchantCurrency()
    {
        return $this->getParameter('merchantCurrency');
    }
    public function setMerchantCurrency($value)
    {
        return $this->setParameter('merchantCurrency', $value);
    }

    public function getCardHolderName()
    {
        return $this->getParameter('cardholdername');
    }

    public function setCardHolderName($value)
    {
        return $this->setParameter('cardholdername', $value);
    }

    public function getOrderNumber()
    {
        return $this->getParameter('order_number');
    }

    public function setOrderNumber($value)
    {
        return $this->setParameter('order_number', $value);
    }

    protected function getHttpMethod()
    {
        return 'POST';
    }

    public function sendData($data)
    {
        $headers = [
            'Content-Type' => 'text/xml'
        ];
        if (!empty($data)) {
            $httpResponse = $this->httpClient->request($this->getHttpMethod(), $this->getEndpoint(), $headers, $data);
        }
        else {
            $httpResponse = $this->httpClient->request($this->getHttpMethod(), $this->getEndpoint(), $headers);
        }
        try {
            $xmlResponse = simplexml_load_string($httpResponse->getBody()->getContents());
        }
        catch (\Exception $e){
            info('Guzzle response : ', [$httpResponse]);
            $res = [];
            $res['resptext'] = 'Oops! something went wrong, Try again after sometime.';
            return $this->response = new Response($this, $res);
        }
        return $this->response = new Response($this, $xmlResponse);
    }

}

