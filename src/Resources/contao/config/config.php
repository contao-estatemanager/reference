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
use ContaoEstateManager\Reference\Reference;

// ESTATEMANAGER
$GLOBALS['TL_ESTATEMANAGER_ADDONS'][] = ['ContaoEstateManager\Reference', 'AddonManager'];

if (AddonManager::valid())
{
    // Hooks
    $GLOBALS['CEM_HOOKS']['getTypeParameter'][] = [Reference::class, 'setFilterParameter'];
    $GLOBALS['CEM_HOOKS']['getParameterByGroups'][] = [Reference::class, 'setFilterParameter'];
    $GLOBALS['CEM_HOOKS']['getParameterByTypes'][] = [Reference::class, 'setFilterParameter'];
    $GLOBALS['CEM_HOOKS']['getTypeParameterByGroups'][] = [Reference::class, 'setFilterParameter'];
    $GLOBALS['CEM_HOOKS']['getSimilarFilterOptions'][] = [Reference::class, 'setSimilarFilterParameter'];
    $GLOBALS['CEM_HOOKS']['compileRealEstateExpose'][] = [Reference::class, 'compileRealEstateExpose'];
    $GLOBALS['CEM_HOOKS']['realEstateImportDeleteRecord'][] = [Reference::class, 'realEstateImportDeleteRecord'];

    $GLOBALS['CEM_HOOKS']['getStatusTokens'][] = [Reference::class, 'addStatusToken'];
    $GLOBALS['CEM_HOOKS']['getMainDetails'][] = [Reference::class, 'removeReferenceMainDetails'];
}
