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

use Boxydev\BadgeBundle\Entity\Rank;
use Boxydev\BadgeBundle\Event\BadgeEvent;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class BadgeManager
 * @package Boxydev\BadgeBundle\Manager
 * @author Matthieu Mota <matthieu@boxydev.com>
 */
class BadgeManager
{
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    public function __construct(ObjectManager $em, EventDispatcherInterface $dispatcher)
    {
        $this->em = $em;
        $this->dispatcher = $dispatcher;
    }

    public function checkAndUnlock($participant, $badge_group, $count)
    {
        $badge = $this->em
            ->getRepository('BoxydevBadgeBundle:Badge')
            ->findWithRank($participant, $badge_group, $count);

        if ($badge && $badge->getRanks()->isEmpty()) {
            $rank = new Rank();
            $rank->setBadge($badge)
                 ->setParticipant($participant);
            $this->em->persist($rank);
            $this->em->flush();
            $this->dispatcher->dispatch(BadgeEvent::NAME, new BadgeEvent($rank));
        }
    }

    public function getBadges($participant)
    {
        return $this->em->getRepository('BoxydevBadgeBundle:Badge')
            ->findBadges($participant);
    }
}