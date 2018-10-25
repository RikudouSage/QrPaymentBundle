<?php

namespace Rikudou\QrPaymentBundle\QrPayment;

use Rikudou\QrPaymentBundle\QrPayment\Config\QrPaymentSettings;

class QrPaymentFactory
{

    /**
     * @var QrPaymentSettings
     */
    private $settings;

    public function __construct(QrPaymentSettings $settings)
    {
        $this->settings = $settings;
    }

    public function czech(): \rikudou\CzQrPayment\QrPayment
    {
        if ($this->settings->getCzechAccountNumber() && $this->settings->getCzechBankCode()) {
            $instance = new \rikudou\CzQrPayment\QrPayment($this->settings->getCzechAccountNumber(), $this->settings->getCzechBankCode());
        } else if ($this->settings->getCzechIBAN()) {
            $instance = \rikudou\CzQrPayment\QrPayment::fromIBAN($this->settings->getCzechIBAN());
        } else {
            throw new \LogicException("Neither account number and bank code or IBAN supplied");
        }
        $options = $this->settings->getCzechOptions();
        if(isset($options["dueDays"])) {
            $options["dueDate"] = "+{$options["dueDays"]} days";
            unset($options["dueDays"]);
        }
        $instance->setOptions(array_filter($options));
        return $instance;
    }

    public function slovak(): \rikudou\SkQrPayment\QrPayment
    {
        if ($this->settings->getSlovakIBAN()) {
            $instance = \rikudou\SkQrPayment\QrPayment::fromIBAN($this->settings->getSlovakIBAN());
        } else if ($this->settings->getSlovakAccountNumber() && $this->settings->getSlovakBankCode()) {
            $instance = new \rikudou\SkQrPayment\QrPayment($this->settings->getSlovakAccountNumber(), $this->settings->getSlovakBankCode());
        } else {
            throw new \LogicException("Neither IBAN or account number and bank code supplied");
        }

        $options = $this->settings->getSlovakOptions();
        if(isset($options["dueDays"])) {
            $options["dueDate"] = "+{$options["dueDays"]} days";
            unset($options["dueDays"]);
        }
        $instance->setOptions($options);
        return $instance;
    }

}