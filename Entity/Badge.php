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

use Doctrine\ORM\Mapping as ORM;

/**
 * Badge
 *
 * @ORM\Table(name="badge")
 * @ORM\Entity(repositoryClass="Boxydev\BadgeBundle\Repository\BadgeRepository")
 *
 * @author Matthieu Mota <matthieu@boxydev.com>
 */
class Badge implements BadgeInterface
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="badge_group", type="string", length=255)
     */
    private $badgeGroup;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Boxydev\BadgeBundle\Entity\Rank", mappedBy="badge", orphanRemoval=true)
     */
    private $ranks;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ranks = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Badge
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set badgeGroup
     *
     * @param string $badgeGroup
     *
     * @return Badge
     */
    public function setBadgeGroup($badgeGroup)
    {
        $this->badgeGroup = $badgeGroup;

        return $this;
    }

    /**
     * Get badgeGroup
     *
     * @return string
     */
    public function getBadgeGroup()
    {
        return $this->badgeGroup;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return Badge
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Add rank
     *
     * @param Rank $rank
     *
     * @return Badge
     */
    public function addRank(Rank $rank)
    {
        $this->ranks[] = $rank;

        return $this;
    }

    /**
     * Remove rank
     *
     * @param Rank $rank
     */
    public function removeRank(Rank $rank)
    {
        $this->ranks->removeElement($rank);
    }

    /**
     * Get ranks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRanks()
    {
        return $this->ranks;
    }
}
