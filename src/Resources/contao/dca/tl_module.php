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
    // Add field
    $GLOBALS['TL_DCA']['tl_module']['fields']['allowReferences'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_module']['allowReferences'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['tl_class' => 'w50'],
        'sql' => "char(1) NOT NULL default ''",
    ];

    // Extend the default palettes
    PaletteManipulator::create()
        ->addField(['allowReferences'], 'allowUnpublishedRecords', PaletteManipulator::POSITION_AFTER)
        ->applyToPalette('realEstateExpose', 'tl_module')
    ;

    // Extend estate manager filterMode field options
    $GLOBALS['TL_DCA']['tl_module']['fields']['filterMode']['options'][] = 'reference';
    $GLOBALS['TL_DCA']['tl_module']['fields']['filterMode']['options'][] = 'appendReference';

    // Extend estate manager statusTokens field options
    $GLOBALS['TL_DCA']['tl_module']['fields']['statusTokens']['options'][] = 'reference';
}
