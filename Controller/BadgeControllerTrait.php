<?php

/*
 * This file is part of the BoxydevBadgeBundle package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\BadgeBundle\Controller;

/**
 * Trait BadgeControllerTrait
 * @package Boxydev\BadgeBundle\Controller
 * @author Matthieu Mota <matthieu@boxydev.com>
 */
trait BadgeControllerTrait
{
    protected function getBadgeClass()
    {
        return $this->container->get('boxydev_badge.entity_manager')->getBadgeClass();
    }

    protected function getBadgeInstance()
    {
        return $this->container->get('boxydev_badge.entity_manager')->getBadgeInstance();
    }

    protected function getBadgeTypeFormClass()
    {
        return $this->container->get('boxydev_badge.form_factory')->getBadgeTypeFormClass();
    }
}
