<?php

namespace Rikudou\QrPaymentBundle\QrPayment\Config;


class QrPaymentSettings
{

    /**
     * @var array
     */
    private $czechConfig;

    /**
     * @var array
     */
    private $slovakConfig;

    public function __construct(array $czechConfig, array $slovakConfig)
    {
        $this->czechConfig = $czechConfig;
        $this->slovakConfig = $slovakConfig;
    }

    public function getCzechAccountNumber(): ?string
    {
        return $this->czechConfig["accountNumber"];
    }

    public function getCzechBankCode(): ?string
    {
        return $this->czechConfig["bankCode"];
    }

    public function getCzechIBAN(): ?string
    {
        return $this->czechConfig["iban"];
    }

    public function getSlovakAccountNumber(): ?string
    {
        return $this->slovakConfig["accountNumber"];
    }

    public function getSlovakBankCode(): ?string
    {
        return $this->slovakConfig["bankCode"];
    }

    public function getSlovakIBAN(): ?string
    {
        return $this->slovakConfig["iban"];
    }

    public function getCzechOptions(): array
    {
        return $this->czechConfig["options"];
    }

    public function getSlovakOptions(): array
    {
        return $this->slovakConfig["options"];
    }

}