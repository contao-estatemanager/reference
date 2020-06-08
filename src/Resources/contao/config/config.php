<?php
/**
 * This file is part of Contao EstateManager.
 *
 * @link      https://www.contao-estatemanager.com/
 * @source    https://github.com/contao-estatemanager/reference
 * @copyright Copyright (c) 2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://www.contao-estatemanager.com/lizenzbedingungen.html
 */

// ESTATEMANAGER
$GLOBALS['TL_ESTATEMANAGER_ADDONS'][] = array('ContaoEstateManager\Reference', 'AddonManager');

if(ContaoEstateManager\Reference\AddonManager::valid()) {
    // Hooks
    $GLOBALS['TL_HOOKS']['getTypeParameter'][]         = array('ContaoEstateManager\Reference\Reference', 'setFilterParameter');
    $GLOBALS['TL_HOOKS']['getParameterByGroups'][]     = array('ContaoEstateManager\Reference\Reference', 'setFilterParameter');
    $GLOBALS['TL_HOOKS']['getTypeParameterByGroups'][] = array('ContaoEstateManager\Reference\Reference', 'setFilterParameter');
    $GLOBALS['TL_HOOKS']['getSimilarFilterOptions'][]  = array('ContaoEstateManager\Reference\Reference', 'setSimilarFilterParameter');

    $GLOBALS['TL_HOOKS']['getStatusTokens'][]          = array('ContaoEstateManager\Reference\Reference', 'addStatusToken');
    $GLOBALS['TL_HOOKS']['getMainDetails'][]           = array('ContaoEstateManager\Reference\Reference', 'removeReferenceMainDetails');
}
