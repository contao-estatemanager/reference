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

use ContaoEstateManager\EstateManager;

class AddonManager
{
    /**
     * Addon name
     * @var string
     */
    public static $name = 'Reference';

    /**
     * Addon config key
     * @var string
     */
    public static $key  = 'addon_reference_license';

    /**
     * Is initialized
     * @var boolean
     */
    public static $initialized  = false;

    /**
     * Is valid
     * @var boolean
     */
    public static $valid  = false;

    /**
     * Licenses
     * @var array
     */
    private static $licenses = [
        '288c3d69e48bdbfffda8773ca71e711f',
        '41227c99432a1ac49caa9a0ce76549d2',
        '25aece434b8e001d9a85e6a57e781a29',
        'fbf6ee206125b2bbe1e9f490db20be69',
        '17d12d65f1096d4a8f688220e40204c3',
        'e716fa303e34da61c4bf4b49084de771',
        'b350bb7753133526c514c24b6e6656d7',
        '77967591229c93878118910509799cfe',
        '391f00f1dfb00f371359ee09cb6bd19b',
        '13cf451b55e1ccc0d0f7e6f134b7ecf6',
        'c84d66d740838c15f359a0b770c54454',
        '00061396bf86ce3c2bc19c50d28c5d93',
        'd3bca20b02691dca09b420f0a8246bc9',
        '1172789421c372c581cf2e65b5a79eb3',
        '70593b709b1823c17fc9de0c44d901df',
        '1a62e9aa655c02f8350b444bb930e0ef',
        '2f36bf66b0cb7a3e1886d620b5560a42',
        '764ec4febdb64e769b3a91e3f42b5b62',
        '0db6205abca3cc2b7fccfc6889b5bcd5',
        '0488ce129a31ee161a2bee88d89667f4',
        'b1568a706cbc40db57aac87f2bc91973',
        'aa8d0b015bb67ec29039522224665611',
        '20ec5cfec9548ed4e68d8337970704f7',
        '5fa05813e7cb54442932b70b195c520d',
        '3acea16cb42406d4a0cb09bb11e9a11f',
        '3f4f23a0f2331b08f2cacaba48a026bd',
        '90d0928f848fb3b29f2f6412682423f3',
        'e376c6328d49e95f2dd9848880627a4e',
        'f767dedfdc59594c03f788b4527e692f',
        '2106d094bfbfd684d6d74162496a872c',
        'feb27c0427a4e28d0840b90e2116ad3f',
        '3481d4ac43e4b2cf6c16330517a4f28e',
        '2ababa84e531ba5ec20ea6879e357c24',
        'c53e9dfca6676adf3484add8c38f918e',
        '68927f34442014cf231976ee3b6af431',
        '01a6d42acc47a52e8d9e6a65d40ee8df',
        '41050ff69aa851b9757234c4ed50d072',
        'c881d980fa56426bf9a5b2aadd60f285',
        '6833dfc52ae563eb67389564b3ba2c86',
        'd7900ca190bcb05e0aa26f3ff04cb3f3',
        '960251b8f60bc7035c51e492c4ddeaaf',
        '478175e933b3635a32ad7313791c1e16',
        '924deea8474a589982dd56dd80f127f5',
        '717a67fd5911fd40184d8e6d1bced883',
        '73ee8ae2cfe061c6dae9c9b649083541',
        '3dfc4ca6c657154234c9e860f6ac1c94',
        '1efbba5bc6b98d48e7caab10be40eb0f',
        'b1c7ac5523d3eada7620e26387479751',
        'd032e09f5e92c50cb69cd4121588a95f',
        '7be58a6e05323f7a243017ad2ee115cf'
    ];

    public static function getLicenses()
    {
        return static::$licenses;
    }

    public static function valid()
    {
        if(strpos(\Environment::get('requestUri'), '/contao/install') !== false)
        {
            return true;
        }

        if (static::$initialized === false)
        {
            static::$valid = EstateManager::checkLicenses(\Config::get(static::$key), static::$licenses, static::$key);
            static::$initialized = true;
        }

        return static::$valid;
    }

}
