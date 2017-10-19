<?php

/**
 * This file is part of the BoxydevBadgeBundle package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\BadgeBundle\Manager;

/**
 * Class EntityManager
 * @package Boxydev\BadgeBundle\Manager
 * @author Matthieu Mota <matthieu@boxydev.com>
 */
class EntityManager
{
    private $badge;
    private $rank;

    public function __construct($badge, $rank)
    {
        $this->badge = $badge;
        $this->rank = $rank;
    }

    public function getBadgeClass()
    {
        return $this->badge;
    }

    public function getBadgeInstance()
    {
        return new $this->badge();
    }

    public function getRankClass()
    {
        return $this->rank;
    }

    public function getRankInstance()
    {
        return new $this->rank();
    }
}
