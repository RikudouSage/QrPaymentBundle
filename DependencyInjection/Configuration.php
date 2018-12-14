<?php

namespace Rikudou\QrPaymentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root("rikudou_qr_payment");

        $rootNode
            ->children()
                ->arrayNode("cz")
                    ->children()
                        ->scalarNode("account")->end()
                        ->scalarNode("bankCode")->end()
                        ->scalarNode("iban")->end()
                        ->arrayNode("options")
                            ->children()
                                ->scalarNode("variableSymbol")->end()
                                ->scalarNode("specificSymbol")->end()
                                ->scalarNode("constantSymbol")->end()
                                ->scalarNode("currency")->end()
                                ->scalarNode("comment")->end()
                                ->integerNode("repeat")->end()
                                ->scalarNode("internalId")->end()
                                ->floatNode("amount")->end()
                                ->scalarNode("country")->end()
                                ->integerNode("dueDays")->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode("sk")
                    ->children()
                        ->scalarNode("account")->end()
                        ->scalarNode("bankCode")->end()
                        ->scalarNode("iban")->end()
                        ->arrayNode("options")
                            ->children()
                                ->scalarNode("variableSymbol")->end()
                                ->scalarNode("specificSymbol")->end()
                                ->scalarNode("constantSymbol")->end()
                                ->scalarNode("currency")->end()
                                ->scalarNode("comment")->end()
                                ->scalarNode("internalId")->end()
                                ->floatNode("amount")->end()
                                ->scalarNode("country")->end()
                                ->scalarNode("swift")->end()
                                ->integerNode("dueDays")->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}