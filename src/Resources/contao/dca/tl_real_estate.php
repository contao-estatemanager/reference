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
    $GLOBALS['TL_DCA']['tl_real_estate']['config']['onsubmit_callback'][] = array('tl_real_estate_reference', 'setReferenceField');

    $GLOBALS['TL_DCA']['tl_real_estate']['list']['label']['post_label_callbacks'][] = array('tl_real_estate_reference', 'addReferenceInformation');

    // Add field
    $GLOBALS['TL_DCA']['tl_real_estate']['fields']['referenz'] = array
    (
        'label'                     => &$GLOBALS['TL_LANG']['tl_real_estate']['referenz'],
        'inputType'                 => 'checkbox',
        'filter'                    => true,
        'eval'                      => array('tl_class' => 'w50 m12'),
        'sql'                       => "char(1) NOT NULL default '0'",
    );

    // Extend the default palettes
    Contao\CoreBundle\DataContainer\PaletteManipulator::create()
        ->addField(array('referenz'), 'vermietet', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_AFTER)
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
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * Set the reference field if needed
     *
     * @param Contao\DataContainer $dc
     */
    public function setReferenceField(Contao\DataContainer $dc)
    {
        // Return if there is no active record
        if (!$dc->activeRecord)
        {
            return;
        }

        if ($dc->activeRecord->referenz)
        {
            return;
        }

        $reference = false;

        $arrIndicator = Contao\StringUtil::deserialize(Contao\Config::get('referenceIndicatorFields'));

        foreach ($arrIndicator as $indicator)
        {
            switch ($indicator)
            {
                case 'sold':
                    if ($dc->activeRecord->verkaufstatus === 'verkauft')
                    {
                        $reference = true;
                    }
                    break;
                case 'rented':
                    if ($dc->activeRecord->vermietet)
                    {
                        $reference = true;
                    }
                    break;
                case 'unpublished':
                    if ($dc->activeRecord->published == '' || $dc->activeRecord->published == '0')
                    {
                        $reference = true;
                    }
                    break;
            }
        }
    }

    /**
     * Add reference flag
     *
     * @param array                $row
     * @param string               $label
     * @param Contao\DataContainer $dc
     * @param array                $args
     *
     * @return array
     */
    public function addReferenceInformation($row, $label, Contao\DataContainer $dc, $args)
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
