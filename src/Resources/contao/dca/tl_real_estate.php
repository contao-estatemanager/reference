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
use Contao\DataContainer;
use ContaoEstateManager\Reference\AddonManager;

if (AddonManager::valid())
{
    $GLOBALS['TL_DCA']['tl_real_estate']['list']['label']['post_label_callbacks'][] = ['tl_real_estate_reference', 'addReferenceInformation'];

    // Add field
    $GLOBALS['TL_DCA']['tl_real_estate']['fields']['referenz'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_real_estate']['referenz'],
        'inputType' => 'checkbox',
        'filter' => true,
        'eval' => ['tl_class' => 'w50 m12'],
        'sql' => "char(1) NOT NULL default '0'",
    ];

    // Extend the default palettes
    PaletteManipulator::create()
        ->addField(['referenz'], 'vermietet', PaletteManipulator::POSITION_AFTER)
        ->applyToPalette('default', 'tl_real_estate')
    ;
}

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Fabian Ekert <fabian@oveleon.de>
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class tl_real_estate_reference extends Backend
{
    /**
     * Import the back end user object.
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * Add reference flag.
     *
     * @param array  $row
     * @param string $label
     * @param array  $args
     *
     * @return array
     */
    public function addReferenceInformation($row, $label, DataContainer $dc, $args)
    {
        if (!$row['referenz'])
        {
            return $args;
        }

        // add reference information
        $args[0] .= '<span class="token" style="background-color:#ef634c; color:#fff;" title="Reference">R</span>';

        return $args;
    }
}
