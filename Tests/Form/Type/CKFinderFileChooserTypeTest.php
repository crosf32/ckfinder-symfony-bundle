<?php
/*
 * This file is a part of the CKFinder bundle for Symfony.
 *
 * Copyright (C) 2016, CKSource - Frederico Knabben. All rights reserved.
 *
 * Licensed under the terms of the MIT license.
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace CKSource\Bundle\CKFinderBundle\Tests\Form\Type;

use CKSource\Bundle\CKFinderBundle\Form\Type\CKFinderFileChooserType;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

/**
 * CKFinderFileChooserType test.
 */
class CKFinderFileChooserTypeTest extends TypeTestCase
{
    protected function getExtensions()
    {
        $fieldType = new CKFinderFileChooserType();

        return array(new PreloadedExtension(array(
            $fieldType,
        ), array()));
    }

    public function testDefaultOptions()
    {
        $form = $this->factory->create(CKFinderFileChooserType::class);
        $view = $form->createView();

        $this->assertSame('popup', $view->vars['mode']);
        $this->assertSame('Browse', $view->vars['button_text']);
        $this->assertSame(array(), $view->vars['button_attr']);
        $this->assertSame('ckf_filechooser_' . $view->vars['id'], $view->vars['button_id']);
    }

    public function testModeOptionExpectsModalOrPopup()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->factory->create(CKFinderFileChooserType::class, null, array(
            'mode' => 'foo'
        ));
    }

    public function testButtonTextOptionExpectsString()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->factory->create(CKFinderFileChooserType::class, null, array(
            'button_text' => []
        ));
    }

    public function testButtonAttrOptionExpectsArray()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->factory->create(CKFinderFileChooserType::class, null, array(
            'button_attr' => 'foo'
        ));
    }

    public function testViewValues()
    {
        $form = $this->factory->create(CKFinderFileChooserType::class, null, array(
            'mode' => 'modal',
            'button_text' => 'foo',
            'button_attr' => array('class' => 'bar')
        ));
        $view = $form->createView();

        $this->assertSame('modal', $view->vars['mode']);
        $this->assertSame('foo', $view->vars['button_text']);
        $this->assertSame(array('class' => 'bar'), $view->vars['button_attr']);
    }
}
