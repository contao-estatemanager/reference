<?php
/**
 * This file is part of Contao EstateManager.
 *
 * @link      https://www.contao-estatemanager.com/
 * @source    https://github.com/contao-estatemanager/reference
 * @copyright Copyright (c) 2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://www.contao-estatemanager.com/lizenzbedingungen.html
 */

if(ContaoEstateManager\Reference\AddonManager::valid()) {
    // Add field
    $GLOBALS['TL_DCA']['tl_module']['fields']['allowReferences'] = array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_module']['allowReferences'],
        'exclude'                 => true,
        'inputType'               => 'checkbox',
        'eval'                    => array('tl_class'=>'w50'),
        'sql'                     => "char(1) NOT NULL default ''"
    );

    // Extend the default palettes
    Contao\CoreBundle\DataContainer\PaletteManipulator::create()
        ->addField(array('allowReferences'), 'allowUnpublishedRecords', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_AFTER)
        ->applyToPalette('realEstateExpose', 'tl_module')
    ;

    // Extend estate manager filterMode field options
    $GLOBALS['TL_DCA']['tl_module']['fields']['filterMode']['options'][] = 'reference';
    $GLOBALS['TL_DCA']['tl_module']['fields']['filterMode']['options'][] = 'appendReference';

    // Extend estate manager statusTokens field options
    $GLOBALS['TL_DCA']['tl_module']['fields']['statusTokens']['options'][] = 'reference';
}
