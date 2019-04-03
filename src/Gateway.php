<?php

namespace Omnipay\PaymentExpress;

use Omnipay\Common\AbstractGateway;

/**
 * PaymentExpress Gateway
 * @link https://www.paymentexpress.com/developer-ecommerce-pxpost
 */

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'PaymentExpress';
    }

    public function getDefaultParameters()
    {
        return [
            'PostUsername' => '',
            'PostPassword' => '',
        ];
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

    public function getMerchantCurrency()
    {
        return $this->getParameter('merchantCurrency');
    }
    public function setMerchantCurrency($value)
    {
        return $this->setParameter('merchantCurrency', $value);
    }

    public function getPaymentMethod()
    {
        return $this->getParameter('payment_method');
    }

    public function setPaymentMethod($value)
    {
        return $this->setParameter('payment_method', $value);
    }

    public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PaymentExpress\Message\CreateCardRequest', $parameters);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PaymentExpress\Message\AuthorizeRequest', $parameters);
    }

    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PaymentExpress\Message\CaptureRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PaymentExpress\Message\PurchaseRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PaymentExpress\Message\RefundRequest', $parameters);
    }
}

