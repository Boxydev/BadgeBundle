<?php

/**
 * This file is part of the BoxydevBadgeBundle package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\BadgeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class BadgeType
 * @package Boxydev\BadgeBundle\Form
 * @author Matthieu Mota <matthieu@boxydev.com>
 */
class BadgeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('badgeGroup')
            ->add('count')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'boxydev_badgebundle_badge';
    }


}
