<?php

/*
 * This file is part of the BoxydevBadgeBundle package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\BadgeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 *
 * @author Matthieu Mota <matthieu@boxydev.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('boxydev_badge');

        $rootNode
            ->children()
                ->scalarNode('badge')
                    ->defaultValue('Boxydev\BadgeBundle\Entity\Badge')
                ->end()
                ->scalarNode('rank')
                    ->defaultValue('Boxydev\BadgeBundle\Entity\Rank')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
