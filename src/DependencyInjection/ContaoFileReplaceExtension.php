<?php

/*
 * This file is part of ContaoFileReplace.
 *
 * (c) Harald Huber
 *
 * @license LGPL-3.0-or-later
 */

namespace Hhcom\ContaoFileReplace\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ContaoFileReplaceExtension extends Extension
{
    /**
     * {@inheritdoc}fd
     */
    public function load(array $mergedConfig, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');
    }
}