<?php

namespace Rikudou\QrPaymentBundle\QrPayment\Config\Country;

class CzechSettings
{

    /**
     * @var array
     */
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getAccountNumber(): ?string
    {
        return $this->config["account"] ?? null;
    }

    public function getBankCode(): ?string
    {
        return $this->config["bankCode"] ?? null;
    }

    public function getIban(): ?string
    {
        return $this->config["iban"] ?? null;
    }

    public function getOptions(): array
    {
        return $this->config["options"] ?? [];
    }

}