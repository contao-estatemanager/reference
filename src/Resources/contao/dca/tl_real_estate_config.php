<?php
/**
 * This file is part of Contao EstateManager.
 *
 * @link      https://www.contao-estatemanager.com/
 * @source    https://github.com/contao-estatemanager/featured
 * @copyright Copyright (c) 2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://www.contao-estatemanager.com/lizenzbedingungen.html
 */
if(ContaoEstateManager\Reference\AddonManager::valid()) {
    // Extend estate manager statusTokens field options
    $GLOBALS['TL_DCA']['tl_real_estate_config']['fields']['referenceIndicatorFields'] = array
    (
        'label'                     => &$GLOBALS['TL_LANG']['tl_real_estate_config']['referenceIndicatorFields'],
        'inputType'                 => 'checkbox',
        'options'                   => array('sold', 'rented', 'unpublished'),
        'reference'                 => &$GLOBALS['TL_LANG']['tl_real_estate_config'],
        'eval'                      => array('multiple'=>true),
    );

    Contao\CoreBundle\DataContainer\PaletteManipulator::create()
        ->addLegend('reference_legend', 'filter_config_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_AFTER)
        ->addField(array('referenceIndicatorFields'), 'reference_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
        ->applyToPalette('default', 'tl_real_estate_config')
    ;
}