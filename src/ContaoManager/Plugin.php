<?php

namespace Mindbird\ContaoNodeOverlay\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\CoreBundle\ContaoCoreBundle;
use Mindbird\ContaoNodeOverlay\ContaoNodeOverlayBundle;

class Plugin implements BundlePluginInterface {
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoNodeOverlayBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
