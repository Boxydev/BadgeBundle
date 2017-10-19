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

use Boxydev\BadgeBundle\Entity\BadgeInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BadgeController
 * @package Boxydev\BadgeBundle\Controller
 * @author Matthieu Mota <matthieu@boxydev.com>
 *
 * @Security("is_granted('ROLE_ADMIN')")
 */
class BadgeController extends Controller
{
    use BadgeControllerTrait;

    /**
     * List badges
     *
     * @Route("/", name="boxydev_badge_list")
     *
     */
    public function listAction()
    {
        $em = $this->getDoctrine();
        $badges = $em->getRepository($this->getBadgeClass())
            ->findAll();

        return $this->render('BoxydevBadgeBundle:Badge:list.html.twig', [
            'badges' => $badges
        ]);
    }

    /**
     * Create a badge
     *
     * @Route("/create", name="boxydev_badge_create")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $badge = $this->getBadgeInstance();

        $form = $this->createForm($this->getBadgeTypeFormClass(), $badge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($badge);
            $em->flush();

            return $this->redirectToRoute('boxydev_badge_show', ['id' => $badge->getId()]);
        }

        return $this->render('BoxydevBadgeBundle:Badge:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Show a badge
     *
     * @Route("/{id}", name="boxydev_badge_show")
     *
     * @param BadgeInterface $badge
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(BadgeInterface $badge)
    {
        return $this->render('BoxydevBadgeBundle:Badge:show.html.twig', [
            'badge' => $badge
        ]);
    }

    /**
     * Edit a badge
     *
     * @Route("/edit/{id}", name="boxydev_badge_edit")
     *
     * @param Request $request
     * @param BadgeInterface $badge
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, BadgeInterface $badge)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm($this->getBadgeTypeFormClass(), $badge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($badge);
            $em->flush();

            return $this->redirectToRoute('boxydev_badge_show', ['id' => $badge->getId()]);
        }

        return $this->render('BoxydevBadgeBundle:Badge:edit.html.twig', [
            'form' => $form->createView(),
            'badge' => $badge
        ]);
    }

    /**
     * Delete a badge
     *
     * @Route("/delete/{id}", name="boxydev_badge_delete")
     *
     * @param BadgeInterface $badge
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(BadgeInterface $badge)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($badge);
        $em->flush();

        return $this->redirectToRoute('boxydev_badge_list');
    }
}
