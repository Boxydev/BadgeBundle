<?php

/*
 * This file is part of the BoxydevBadgeBundle package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\BadgeBundle\Entity;

use Boxydev\BadgeBundle\Model\BadgeInterface;
use Boxydev\BadgeBundle\Model\ParticipantInterface;
use Boxydev\BadgeBundle\Model\RankInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rank
 *
 * @ORM\Table(name="rank")
 * @ORM\Entity(repositoryClass="Boxydev\BadgeBundle\Repository\RankRepository")
 *
 * @author Matthieu Mota <matthieu@boxydev.com>
 */
class Rank implements RankInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var BadgeInterface
     *
     * @ORM\ManyToOne(targetEntity="Boxydev\BadgeBundle\Model\BadgeInterface", inversedBy="ranks")
     */
    private $badge;

    /**
     * @var ParticipantInterface
     *
     * @ORM\ManyToOne(targetEntity="Boxydev\BadgeBundle\Model\ParticipantInterface")
     */
    private $participant;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set badge
     *
     * @param BadgeInterface $badge
     * @return RankInterface
     */
    public function setBadge(BadgeInterface $badge = null)
    {
        $this->badge = $badge;

        return $this;
    }

    /**
     * Get badge
     *
     * @return BadgeInterface
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * Set participant
     *
     * @param ParticipantInterface $participant
     *
     * @return RankInterface
     */
    public function setParticipant(ParticipantInterface $participant = null)
    {
        $this->participant = $participant;

        return $this;
    }

    /**
     * Get participant
     *
     * @return ParticipantInterface
     */
    public function getParticipant()
    {
        return $this->participant;
    }
}
