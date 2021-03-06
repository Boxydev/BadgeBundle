<?php

/*
 * This file is part of the BoxydevBadgeBundle package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\BadgeBundle\Event;

use Boxydev\BadgeBundle\Model\RankInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * @author Matthieu Mota <matthieu@boxydev.com>
 */
class BadgeEvent extends Event
{
    const NAME = 'badge.ranking';

    /**
     * @var RankInterface
     */
    private $rank;

    public function __construct(RankInterface $rank)
    {
        $this->rank = $rank;
    }

    public function getBadge()
    {
        return $this->rank->getBadge();
    }

    public function getParticipant()
    {
        return $this->rank->getParticipant();
    }
}
