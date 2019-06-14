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

use ContaoEstateManager\Translator;

class Reference extends \System
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
     * @param $context
     */
    public function setFilterParameter(&$arrColumns, &$arrValues, &$arrOptions, $mode, $context)
    {
        if($mode === 'reference')
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
     * @param $objTemplate
     * @param $realEstate
     * @param $context
     */
    public function addStatusToken(&$objTemplate, $realEstate, $context)
    {
        $tokens = \StringUtil::deserialize($context->statusTokens);
        $arrTokens = array();

        if(!$tokens)
        {
            return;
        }

        // add reference status token
        if (in_array('reference', $tokens) && $realEstate->objRealEstate->referenz)
        {
            $arrTokens[] = array(
                'value' => Translator::translateValue('reference'),
                'class' => 'reference'
            );
        }

        // add sold status token, if this was not added by the core
        if (in_array('sold', $tokens) && $this->objRealEstate->verkaufstatus !== 'verkauft' && $realEstate->objRealEstate->referenz && ($realEstate->objRealEstate->vermarktungsartKauf || $realEstate->objRealEstate->vermarktungsartErbpacht))
        {
            $arrTokens[] = array(
                'value' => Translator::translateValue('sold'),
                'class' => 'sold'
            );
        }

        // add rented status token, if this was not added by the core
        if(in_array('rented', $tokens) && !$this->objRealEstate->vermietet && $realEstate->objRealEstate->referenz && ($this->objRealEstate->vermarktungsartMietePacht || $this->objRealEstate->vermarktungsartLeasing))
        {
            $arrTokens[] = array(
                'value' => Translator::translateValue('rented'),
                'class' => 'rented'
            );
        }

        if(count($arrTokens))
        {
            $objTemplate->arrStatusTokens = array_merge($objTemplate->arrStatusTokens, $arrTokens);
        }
    }
}