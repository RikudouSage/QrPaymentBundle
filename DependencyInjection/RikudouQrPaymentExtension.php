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

        $settingsDefinition = $container->getDefinition("rikudou_qr_payment.settings");
        $settingsDefinition->addArgument($config);
    }
}