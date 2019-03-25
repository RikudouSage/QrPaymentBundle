# QR Payment Bundle

For Czech, Slovak and European banks.

This is a Symfony bundle that simplifies work with
my packages for [Czech](https://github.com/RikudouSage/QrPaymentCZ), 
[Slovak](https://github.com/RikudouSage/QrPaymentSK)
and [European](https://github.com/RikudouSage/QrPaymentEU) QR payments.

Read the individual documentations of the libraries if you want to know more about them.

This bundle takes these packages together, creates a [Symfony](https://symfony.com/)
service and allows you to set defaults for the payments.

## Installation

Run `composer require rikudou/qr-payment-bundle`.

If you use [Symfony Flex](https://github.com/symfony/flex)
the bundle should be enabled automatically.

The default config file is created
via [rikudou/installer](https://github.com/RikudouSage/RikudouInstaller).

## Configuration

Go to the `config/packages/rikudou_qr_payment.yaml` and edit the details.

If the file is not created for any reason, you can find the default config file
[here](.installer/symfony/files/config/packages/rikudou_qr_payment.yaml).

The names should be pretty self-explanatory, you have to configure Czech, Slovak
and European defaults separately. You can also override defaults for European
standard for supported countries (Austria, Belgium, Germany, Netherlands).

## Usage

This package defines one service, `Rikudou\QrPaymentBundle\QrPayment\QrPaymentFactory`,
which is used to create instances of payment classes.

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
    
    public function getEuropeanQrCode() {
        return $this->qrPaymentFactory->european();
    }
    
    public function getAustrianQrCode() {
        return $this->qrPaymentFactory->austrian();
    }
    
    public function getBelgianQrCode() {
        return $this->qrPaymentFactory->belgian();
    }
    
    public function getGermanQrCode() {
        return $this->qrPaymentFactory->german();
    }
    
    public function getDutchQrCode() {
        return $this->qrPaymentFactory->dutch();
    }
    
    public function getFinnishQrCode() {
        return $this->qrPaymentFactory->finnish();
    }
    
}
```

The methods in example return new instances with defaults from yaml file.
