<?php

namespace Rikudou\QrPaymentBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class RikudouQrPaymentExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . "/../Resources/config"));
        $loader->load("services.yaml");

        $configurationDefinition = new Configuration();
        $config = $this->processConfiguration($configurationDefinition, $configs);

        $czechConfig = [
            "accountNumber" => $config["cz"]["account"] ?? null,
            "bankCode" => $config["cz"]["bankCode"] ?? null,
            "iban" => $config["cz"]["iban"] ?? null,
            "options" => $config["cz"]["options"] ?? [],
        ];

        $slovakConfig = [
            "accountNumber" => $config["sk"]["account"] ?? null,
            "bankCode" => $config["sk"]["bankCode"] ?? null,
            "iban" => $config["sk"]["iban"] ?? null,
            "options" => $config["sk"]["options"] ?? [],
        ];


        $settingsDefinition = $container->getDefinition("rikudou_qr_payment.settings");
        $settingsDefinition->addArgument($czechConfig);
        $settingsDefinition->addArgument($slovakConfig);
    }
}