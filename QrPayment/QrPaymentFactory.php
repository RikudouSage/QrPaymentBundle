<?php

namespace Rikudou\QrPaymentBundle\QrPayment;

use Rikudou\QrPaymentBundle\QrPayment\Config\Country\EuropeanSettings;
use Rikudou\QrPaymentBundle\QrPayment\Config\QrPaymentSettings;
use Rikudou\QrPaymentBundle\QrPayment\Helper\CharacterSetStringToConstant;

/**
 * @method \rikudou\EuQrPayment\QrPayment austrian()
 * @method \rikudou\EuQrPayment\QrPayment belgian()
 * @method \rikudou\EuQrPayment\QrPayment dutch()
 * @method \rikudou\EuQrPayment\QrPayment german()
 * @method \rikudou\EuQrPayment\QrPayment european()
 */
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
        $config = $this->settings->getCzechSettings();
        if ($config->getAccountNumber() && $config->getBankCode()) {
            $instance = new \rikudou\CzQrPayment\QrPayment($config->getAccountNumber(), $config->getBankCode());
        } else if ($config->getIban()) {
            $instance = \rikudou\CzQrPayment\QrPayment::fromIBAN($config->getIban());
        } else {
            throw new \LogicException("Neither account number and bank code or IBAN supplied");
        }
        $options = $config->getOptions();
        if (isset($options["dueDays"])) {
            $options["dueDate"] = "+{$options["dueDays"]} days";
            unset($options["dueDays"]);
        }
        $instance->setOptions(array_filter($options));
        return $instance;
    }

    public function slovak(): \rikudou\SkQrPayment\QrPayment
    {
        $config = $this->settings->getSlovakSettings();
        if ($config->getIban()) {
            $instance = \rikudou\SkQrPayment\QrPayment::fromIBAN($config->getIban());
        } else if ($config->getAccountNumber() && $config->getBankCode()) {
            $instance = new \rikudou\SkQrPayment\QrPayment($config->getAccountNumber(), $config->getBankCode());
        } else {
            throw new \LogicException("Neither IBAN or account number and bank code supplied");
        }

        $options = $config->getOptions();
        if (isset($options["dueDays"])) {
            $options["dueDate"] = "+{$options["dueDays"]} days";
            unset($options["dueDays"]);
        }
        $instance->setOptions($options);
        return $instance;
    }

    public function __call($name, $arguments)
    {
        $allowedMethods = [
            "austrian",
            "belgian",
            "dutch",
            "german",
            "european",
        ];

        if (!in_array($name, $allowedMethods)) {
            throw new \BadMethodCallException("Call to undefined method " . get_called_class() . "::{$name}");
        }

        switch ($name) {
            case "european":
                $settings = $this->settings->getEuropeanSettings();
                break;
            case "austrian":
                $settings = $this->settings->getAustrianSettings();
                break;
            case "belgian":
                $settings = $this->settings->getBelgianSettings();
                break;
            case "dutch":
                $settings = $this->settings->getDutchSettings();
                break;
            case "german":
                $settings = $this->settings->getGermanSettings();
                break;
            default:
                throw new \LogicException("Could not get the country key");
        }

        if (!($settings instanceof EuropeanSettings)) {
            throw new \LogicException("The settings must be instance of " . EuropeanSettings::class);
        }

        if (!$settings->getIban()) {
            throw new \LogicException("Cannot initiate payment instance without IBAN");
        }
        $options = $settings->getOptions();

        $assignIfNotEmpty = function (string $key) use (&$instance, &$options) {
            /** @var \rikudou\EuQrPayment\QrPayment $instance */
            if (!isset($options[$key]) || !$options[$key]) {
                return;
            }
            $value = $options[$key];
            switch ($key) {
                case "character_set":
                    $charSet = CharacterSetStringToConstant::getConstant($value);
                    $instance->setCharacterSet($charSet);
                    break;
                case "bic":
                case "swift":
                    $instance->setBic($value);
                    break;
                case "beneficiary_name":
                    $instance->setBeneficiaryName($value);
                    break;
                case "amount":
                    $instance->setAmount($value);
                    break;
                case "purpose":
                    $instance->setPurpose($value);
                    break;
                case "remittance_text":
                    $instance->setRemittanceText($value);
                    break;
                case "information":
                case "comment":
                    $instance->setInformation($value);
                    break;
                case "currency":
                    $instance->setCurrency($value);
                    break;
                default:
                    throw new \InvalidArgumentException("Unknown key: {$key}");
            }
        };

        $instance = new \rikudou\EuQrPayment\QrPayment($settings->getIban());
        $assignIfNotEmpty("character_set");
        $assignIfNotEmpty("beneficiary_name");
        $assignIfNotEmpty("amount");
        $assignIfNotEmpty("purpose");
        $assignIfNotEmpty("remittance_text");
        $assignIfNotEmpty("currency");

        if (isset($options["bic"]) && $options["bic"]) {
            $assignIfNotEmpty("bic");
        } else if (isset($options["swift"]) && $options["swift"]) {
            $assignIfNotEmpty("swift");
        }
        if (isset($options["information"]) && $options["information"]) {
            $assignIfNotEmpty("information");
        } else if (isset($options["comment"]) && $options["comment"]) {
            $assignIfNotEmpty("comment");
        }

        return $instance;
    }

}