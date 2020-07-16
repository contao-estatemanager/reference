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

    // Add fields
    $GLOBALS['TL_DCA']['tl_interface']['fields']['dontDeleteReferences'] = array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_interface']['dontDeleteReferences'],
        'exclude'                 => true,
        'inputType'               => 'checkbox',
        'eval'                    => array('tl_class'=>'w50'),
        'sql'                     => "char(1) NOT NULL default ''"
    );

    // Extend the default palettes
    Contao\CoreBundle\DataContainer\PaletteManipulator::create()
        ->addField(array('dontDeleteReferences'), 'dontPublishRecords', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_AFTER)
        ->applyToPalette('openimmo', 'tl_interface')
    ;
}
