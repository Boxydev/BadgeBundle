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

class FormFactory
{
    private $form;

    public function __construct($form)
    {
        $this->form = $form;
    }

    public function getBadgeTypeFormClass()
    {
        return $this->form;
    }
}