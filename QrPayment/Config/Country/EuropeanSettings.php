<?php

namespace Rikudou\QrPaymentBundle\QrPayment\Config\Country;

class EuropeanSettings
{

    /**
     * @var array
     */
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
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