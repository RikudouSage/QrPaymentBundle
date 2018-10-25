# QR Payment Bundle

For Czech and Slovak banks.

This is a Symfony bundle that simplifies work with
my packages for [Czech](https://github.com/RikudouSage/QrPaymentCZ) and 
[Slovak](https://github.com/RikudouSage/QrPaymentSK) QR payments.

Read the individual documentations of the libraries if you want to know more about them.

This bundle takes these packages together, creates a [Symfony](https://symfony.com/)
service and allows you to set defaults for the payments.

## Installation

Run `composer require rikudou/qr-payment-bundle`.

If you use [Symfony Flex](https://github.com/symfony/flex)
the bundle should be enabled automatically.

The default config file is created
via [endroid/installer](https://github.com/endroid/installer).

## Configuration

Go to the `config/packages/rikudou_qr_payment.yaml` and edit the details.

If the file is not created for any reason, you can find the default config file
[here](.install/symfony/config/packages/rikudou_qr_payment.yaml).

The names should be pretty self-explanatory, you have to configure Czech and Slovak
defaults separately.

## Usage

This package defines one service, `Rikudou\QrPaymentBundle\QrPayment\QrPaymentFactory`,
which is used to create objects of instance `\rikudou\CzQrPayment\QrPayment` or
`\rikudou\SkQrPayment\QrPayment`.

### Example

```php
<?php

use \Rikudou\QrPaymentBundle\QrPayment\QrPaymentFactory;

class MyAwesomeService {
    
    /**
     * @var QrPaymentFactory 
     */
    private $qrPaymentFactory;
    
    public function __construct(QrPaymentFactory $qrPaymentFactory) {
        $this->qrPaymentFactory = $qrPaymentFactory;
    }
    
    public function getCzechQrCode() {
        return $this->qrPaymentFactory->czech();
    }
    
    public function getSlovakQrCode() {
        return $this->qrPaymentFactory->slovak();
    }
    
}
```

The methods `czech()` and `slovak()` return new instances with defaults from yaml file.
