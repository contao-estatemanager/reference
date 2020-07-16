<?php
/**
 * This file is part of Contao EstateManager.
 *
 * @link      https://www.contao-estatemanager.com/
 * @source    https://github.com/contao-estatemanager/reference
 * @copyright Copyright (c) 2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://www.contao-estatemanager.com/lizenzbedingungen.html
 */

namespace ContaoEstateManager\Reference;

use Contao\Controller;
use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\Environment;
use Contao\StringUtil;
use ContaoEstateManager\RealEstateModel;
use ContaoEstateManager\Translator;

class Reference extends Controller
{
    /**
     * Table
     * @var string
     */
    protected $strTable = 'tl_real_estate';

    /**
     * Set reference filter parameters
     * @param $arrColumns
     * @param $arrValues
     * @param $arrOptions
     * @param $mode
     * @param $addFragments
     * @param $objModule
     * @param $context
     */
    public function setFilterParameter(&$arrColumns, &$arrValues, &$arrOptions, $mode, $addFragments, $objModule, $context): void
    {
        if($mode === 'reference')
        {
            $arrColumns[] = "$this->strTable.referenz=1";
        }
        else if ($mode === 'appendReference')
        {
            $arrOptions['order'] = "$this->strTable.referenz" . ($arrOptions['order'] ? ', ' . $arrOptions['order'] : '');
        }
        else
        {
            $arrColumns[] = "$this->strTable.referenz=0";
        }
    }

    /**
     * Set reference filter parameters for similar objects
     * @param $arrColumns
     * @param $arrValues
     * @param $arrOptions
     * @param $realEstate
     */
    public function setSimilarFilterParameter(&$arrColumns, &$arrValues, &$arrOptions, $realEstate): void
    {
        if($realEstate->referenz)
        {
            $arrColumns[] = "$this->strTable.referenz=1";
        }
        else
        {
            $arrColumns[] = "$this->strTable.referenz=0";
        }
    }

    /**
     * Add status token for reference objects
     *
     * @param $validStatusToken
     * @param $arrStatusTokens
     * @param $context
     */
    public function addStatusToken($validStatusToken, &$arrStatusTokens, $context): void
    {
        // add reference status token
        if (in_array('reference', $validStatusToken) && $context->objRealEstate->referenz)
        {
            $arrStatusTokens[] = array(
                'value' => Translator::translateValue('reference'),
                'class' => 'reference'
            );
        }

        // add sold status token, if this was not added by the core
        if (in_array('sold', $validStatusToken) && $context->objRealEstate->verkaufstatus !== 'verkauft' && $context->objRealEstate->referenz && ($context->objRealEstate->vermarktungsartKauf || $context->objRealEstate->vermarktungsartErbpacht))
        {
            $arrStatusTokens[] = array(
                'value' => Translator::translateValue('sold'),
                'class' => 'sold'
            );
        }

        // add rented status token, if this was not added by the core
        if(in_array('rented', $validStatusToken) && !$context->objRealEstate->vermietet && $context->objRealEstate->referenz && ($context->objRealEstate->vermarktungsartMietePacht || $context->objRealEstate->vermarktungsartLeasing))
        {
            $arrStatusTokens[] = array(
                'value' => Translator::translateValue('rented'),
                'class' => 'rented'
            );
        }
    }

    /**
     * Remove main datails for reference objects
     *
     * @param array           $arrMainDetails
     * @param RealEstateModel $objRealEstate
     * @param integer         $max
     * @param mixed           $context
     */
    public function removeReferenceMainDetails(&$arrMainDetails, $objRealEstate, &$max, $context): void
    {
        if ($objRealEstate->referenz)
        {
            foreach ($arrMainDetails as $i => $mainDetail)
            {
                if ($GLOBALS['TL_DCA']['tl_real_estate']['fields'][$mainDetail['field']]['realEstate']['price'])
                {
                    unset($arrMainDetails[$i]);
                }
            }
        }
    }

    /**
     * Check if expose module is allowed to display reference records
     *
     * @param $objTemplate
     * @param $objRealEstate
     * @param $context
     */
    public function compileRealEstateExpose($objTemplate, $objRealEstate, $context)
    {
        if ($objRealEstate->referenz && !$context->allowReferences)
        {
            throw new PageNotFoundException('Page not found: ' . Environment::get('uri'));
        }
    }
}
