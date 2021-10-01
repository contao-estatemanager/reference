<?php

declare(strict_types=1);

/*
 * This file is part of Contao EstateManager.
 *
 * @see        https://www.contao-estatemanager.com/
 * @source     https://github.com/contao-estatemanager/reference
 * @copyright  Copyright (c) 2021 Oveleon GbR (https://www.oveleon.de)
 * @license    https://www.contao-estatemanager.com/lizenzbedingungen.html
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use ContaoEstateManager\Reference\AddonManager;

if (AddonManager::valid())
{
    // Add fields
    $GLOBALS['TL_DCA']['tl_interface']['fields']['dontDeleteReferences'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_interface']['dontDeleteReferences'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['tl_class' => 'w50'],
        'sql' => "char(1) NOT NULL default ''",
    ];

    // Extend the default palettes
    PaletteManipulator::create()
        ->addField(['dontDeleteReferences'], 'dontPublishRecords', PaletteManipulator::POSITION_AFTER)
        ->applyToPalette('openimmo', 'tl_interface')
    ;
}
