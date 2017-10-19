<?php

/**
 * This file is part of the BoxydevBadgeBundle package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\BadgeBundle\Request\ParamConverter;

use Boxydev\BadgeBundle\Manager\EntityManager as BadgeEntityManager;
use Boxydev\BadgeBundle\Model\BadgeInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BadgeConverter implements ParamConverterInterface
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var BadgeEntityManager
     */
    private $badgeEntityManager;

    public function __construct(ObjectManager $manager, BadgeEntityManager $badgeEntityManager)
    {
        $this->manager = $manager;
        $this->badgeEntityManager = $badgeEntityManager;
    }

    /**
     * Stores the object in the request.
     *
     * @param Request $request The request
     * @param ParamConverter $configuration Contains the name, class and options of the object
     *
     * @return bool True if the object has been successfully set, else false
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $id = $request->attributes->get('id');

        if (null === $id) {
            throw new \InvalidArgumentException('Route attribute is missing');
        }

        $repository = $this->manager->getRepository($this->badgeEntityManager->getBadgeClass());
        $badge = $repository->find($id);

        if (null === $badge) {
            throw new NotFoundHttpException(sprintf('%s object not found.', $this->badgeEntityManager->getBadgeClass()));
        }

        $request->attributes->set($configuration->getName(), $badge);
    }

    /**
     * Checks if the object is supported.
     *
     * @param ParamConverter $configuration Should be an instance of ParamConverter
     *
     * @return bool True if the object is supported, else false
     */
    public function supports(ParamConverter $configuration)
    {
        if (BadgeInterface::class !== $configuration->getClass()) {
            return false;
        }

        if (null === $this->manager) {
            return false;
        }

        return true;
    }
}