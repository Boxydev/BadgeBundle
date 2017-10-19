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

use Boxydev\BadgeBundle\Manager\EntityManager as BoxydevEntityManager;
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

    /**
     * @var BoxydevEntityManager
     */
    private $bem;

    public function __construct(ObjectManager $em, EventDispatcherInterface $dispatcher, BoxydevEntityManager $bem)
    {
        $this->em = $em;
        $this->dispatcher = $dispatcher;
        $this->bem = $bem;
    }

    public function checkAndUnlock($participant, $badge_group, $count)
    {
        $badge = $this->em
            ->getRepository($this->bem->getBadgeClass())
            ->findWithRank($participant, $badge_group, $count);

        if ($badge && $badge->getRanks()->isEmpty()) {
            $rank = $this->bem->getRankInstance();
            $rank->setBadge($badge)
                 ->setParticipant($participant);
            $this->em->persist($rank);
            $this->em->flush();
            $this->dispatcher->dispatch(BadgeEvent::NAME, new BadgeEvent($rank));
        }
    }

    public function getBadges($participant)
    {
        return $this->em->getRepository($this->bem->getBadgeClass())
            ->findBadges($participant);
    }
}