<?php

/**
 * This file is part of the BoxydevBadgeBundle package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\BadgeBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DoctrineResolveTargetEntityPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->findDefinition('doctrine.orm.listeners.resolve_target_entity');

        $definition->addMethodCall('addResolveTargetEntity', array(
            'Boxydev\BadgeBundle\Entity\Rank',
            $container->getParameter('boxydev_badge.rank_class'),
            array()
        ));

        $definition->addMethodCall('addResolveTargetEntity', array(
            'Boxydev\BadgeBundle\Entity\Badge',
            $container->getParameter('boxydev_badge.badge_class'),
            array()
        ));

        $definition->addMethodCall('addResolveTargetEntity', array(
            'Boxydev\BadgeBundle\Entity\Participant',
            'AppBundle\Entity\User',
            array()
        ));
    }
}