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

use Doctrine\ORM\Version;
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
            'Boxydev\BadgeBundle\Model\RankInterface', $container->getParameter('boxydev_badge.rank_class'), array()
        ));

        $definition->addMethodCall('addResolveTargetEntity', array(
            'Boxydev\BadgeBundle\Model\BadgeInterface', $container->getParameter('boxydev_badge.badge_class'), array()
        ));

        $definition->addMethodCall('addResolveTargetEntity', array(
            'Boxydev\BadgeBundle\Model\ParticipantInterface', 'AppBundle\Entity\User', array()
        ));

        // BC: ResolveTargetEntityListener implements the subscriber interface since
        // v2.5.0-beta1 (Commit 437f812)
        if (version_compare(Version::VERSION, '2.5.0-DEV') < 0) {
            $definition->addTag('doctrine.event_listener', array('event' => 'loadClassMetadata'));
        } else {
            $definition->addTag('doctrine.event_subscriber');
        }
    }
}