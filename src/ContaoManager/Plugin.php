<?php

/*
 * This file is part of ContaoFileReplace.
 *
 * (c) Harald Huber
 *
 * @license LGPL-3.0-or-later
 */

namespace Hhcom\ContaoFileReplace\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\CalendarBundle\ContaoCalendarBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Hhcom\ContaoFileReplace\ContaoFileReplace;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoFileReplace::class)
                ->setLoadAfter([
                    ContaoCoreBundle::class,
                    ContaoFaqBundle::class,
                    ContaoNewsBundle::class,
                    ContaoNewsletterBundle::class,
                    ContaoCalendarBundle::class,
                    ContaoCommentsBundle::class
                    ]),
        ];
    }
}