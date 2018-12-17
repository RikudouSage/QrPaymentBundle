<?php

namespace Rikudou\QrPaymentBundle\QrPayment\Config;

use Rikudou\QrPaymentBundle\QrPayment\Config\Country\AustrianSettings;
use Rikudou\QrPaymentBundle\QrPayment\Config\Country\BelgianSettings;
use Rikudou\QrPaymentBundle\QrPayment\Config\Country\CzechSettings;
use Rikudou\QrPaymentBundle\QrPayment\Config\Country\DutchSettings;
use Rikudou\QrPaymentBundle\QrPayment\Config\Country\EuropeanSettings;
use Rikudou\QrPaymentBundle\QrPayment\Config\Country\GermanSettings;
use Rikudou\QrPaymentBundle\QrPayment\Config\Country\SlovakSettings;

class QrPaymentSettings
{

    /**
     * @var array
     */
    private $config;

    /**
     * @var null|CzechSettings
     */
    private $czechSettings = null;

    /**
     * @var null|SlovakSettings
     */
    private $slovakSettings = null;

    /**
     * @var null|EuropeanSettings
     */
    private $europeanSettings = null;

    /**
     * @var null|AustrianSettings
     */
    private $austrianSettings = null;

    /**
     * @var null|BelgianSettings
     */
    private $belgianSettings = null;

    /**
     * @var null|DutchSettings
     */
    private $dutchSettings = null;

    /**
     * @var null|GermanSettings
     */
    private $germanSettings = null;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getCzechSettings(): CzechSettings
    {
        if (is_null($this->czechSettings)) {
            $this->czechSettings = new CzechSettings($this->config["cz"] ?? []);
        }

        return $this->czechSettings;
    }

    public function getSlovakSettings(): SlovakSettings
    {
        if (is_null($this->slovakSettings)) {
            $this->slovakSettings = new SlovakSettings($this->config["sk"] ?? []);
        }

        return $this->slovakSettings;
    }

    public function getEuropeanSettings(): EuropeanSettings
    {
        if (is_null($this->europeanSettings)) {
            $this->europeanSettings = new EuropeanSettings($this->config["eu"] ?? []);
        }

        return $this->europeanSettings;
    }

    public function getAustrianSettings(): AustrianSettings
    {
        if (is_null($this->austrianSettings)) {
            $eu = $this->config["eu"] ?? [];
            $country = $this->config["at"] ?? [];
            $config = array_replace_recursive($eu, $country);

            $this->austrianSettings = new AustrianSettings($config);
        }

        return $this->austrianSettings;
    }

    public function getBelgianSettings(): BelgianSettings
    {
        if (is_null($this->belgianSettings)) {
            $eu = $this->config["eu"] ?? [];
            $country = $this->config["be"] ?? [];
            $config = array_replace_recursive($eu, $country);

            $this->belgianSettings = new BelgianSettings($config);
        }

        return $this->belgianSettings;
    }

    public function getDutchSettings(): DutchSettings
    {
        if (is_null($this->dutchSettings)) {
            $eu = $this->config["eu"] ?? [];
            $country = $this->config["nl"] ?? [];
            $config = array_replace_recursive($eu, $country);

            $this->dutchSettings = new DutchSettings($config);
        }

        return $this->dutchSettings;
    }

    public function getGermanSettings(): GermanSettings
    {
        if (is_null($this->germanSettings)) {
            $eu = $this->config["eu"] ?? [];
            $country = $this->config["de"] ?? [];
            $config = array_replace_recursive($eu, $country);

            $this->germanSettings = new GermanSettings($config);
        }

        return $this->germanSettings;
    }

}