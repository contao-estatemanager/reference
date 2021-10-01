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

use ContaoEstateManager\Reference\AddonManager;

// ESTATEMANAGER
$GLOBALS['TL_ESTATEMANAGER_ADDONS'][] = ['ContaoEstateManager\Reference', 'AddonManager'];

if (AddonManager::valid())
{
    // Hooks
    $GLOBALS['TL_HOOKS']['getTypeParameter'][] = ['ContaoEstateManager\Reference\Reference', 'setFilterParameter'];
    $GLOBALS['TL_HOOKS']['getParameterByGroups'][] = ['ContaoEstateManager\Reference\Reference', 'setFilterParameter'];
    $GLOBALS['TL_HOOKS']['getParameterByTypes'][] = ['ContaoEstateManager\Reference\Reference', 'setFilterParameter'];
    $GLOBALS['TL_HOOKS']['getTypeParameterByGroups'][] = ['ContaoEstateManager\Reference\Reference', 'setFilterParameter'];
    $GLOBALS['TL_HOOKS']['getSimilarFilterOptions'][] = ['ContaoEstateManager\Reference\Reference', 'setSimilarFilterParameter'];
    $GLOBALS['TL_HOOKS']['compileRealEstateExpose'][] = ['ContaoEstateManager\Reference\Reference', 'compileRealEstateExpose'];
    $GLOBALS['TL_HOOKS']['realEstateImportDeleteRecord'][] = ['ContaoEstateManager\Reference\Reference', 'realEstateImportDeleteRecord'];

    $GLOBALS['TL_HOOKS']['getStatusTokens'][] = ['ContaoEstateManager\Reference\Reference', 'addStatusToken'];
    $GLOBALS['TL_HOOKS']['getMainDetails'][] = ['ContaoEstateManager\Reference\Reference', 'removeReferenceMainDetails'];
}
