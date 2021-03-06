<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7bdb79e80861fc7d156dc8fb3690dd2e
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Contracts\\' => 18,
            'Symfony\\Component\\Yaml\\' => 23,
            'Symfony\\Component\\Validator\\' => 28,
            'Symfony\\Component\\Finder\\' => 25,
            'Symfony\\Component\\Filesystem\\' => 29,
            'Symfony\\Component\\Console\\' => 26,
            'Symfony\\Component\\Config\\' => 25,
            'Slim\\Views\\' => 11,
            'Slim\\' => 5,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Container\\' => 14,
        ),
        'I' => 
        array (
            'Interop\\Container\\' => 18,
        ),
        'F' => 
        array (
            'FastRoute\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Contracts\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/contracts',
        ),
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
        'Symfony\\Component\\Validator\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/validator',
        ),
        'Symfony\\Component\\Finder\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/finder',
        ),
        'Symfony\\Component\\Filesystem\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/filesystem',
        ),
        'Symfony\\Component\\Console\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/console',
        ),
        'Symfony\\Component\\Config\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/config',
        ),
        'Slim\\Views\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/twig-view/src',
        ),
        'Slim\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/slim/Slim',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Interop\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/container-interop/container-interop/src/Interop/Container',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
        'P' => 
        array (
            'Propel' => 
            array (
                0 => __DIR__ . '/..' . '/propel/propel/src',
            ),
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/src',
            ),
        ),
    );

    public static $classMap = array (
        'Base\\Certifications' => __DIR__ . '/../..' . '/models/Base/Certifications.php',
        'Base\\CertificationsQuery' => __DIR__ . '/../..' . '/models/Base/CertificationsQuery.php',
        'Base\\Incident' => __DIR__ . '/../..' . '/models/Base/Incident.php',
        'Base\\IncidentQuery' => __DIR__ . '/../..' . '/models/Base/IncidentQuery.php',
        'Base\\Inventory' => __DIR__ . '/../..' . '/models/Base/Inventory.php',
        'Base\\InventoryQuery' => __DIR__ . '/../..' . '/models/Base/InventoryQuery.php',
        'Base\\InvolvedParty' => __DIR__ . '/../..' . '/models/Base/InvolvedParty.php',
        'Base\\InvolvedPartyQuery' => __DIR__ . '/../..' . '/models/Base/InvolvedPartyQuery.php',
        'Base\\Jurisdiction' => __DIR__ . '/../..' . '/models/Base/Jurisdiction.php',
        'Base\\JurisdictionQuery' => __DIR__ . '/../..' . '/models/Base/JurisdictionQuery.php',
        'Base\\Personnel' => __DIR__ . '/../..' . '/models/Base/Personnel.php',
        'Base\\PersonnelEquipment' => __DIR__ . '/../..' . '/models/Base/PersonnelEquipment.php',
        'Base\\PersonnelEquipmentQuery' => __DIR__ . '/../..' . '/models/Base/PersonnelEquipmentQuery.php',
        'Base\\PersonnelQuery' => __DIR__ . '/../..' . '/models/Base/PersonnelQuery.php',
        'Base\\Shift' => __DIR__ . '/../..' . '/models/Base/Shift.php',
        'Base\\ShiftQuery' => __DIR__ . '/../..' . '/models/Base/ShiftQuery.php',
        'Base\\Station' => __DIR__ . '/../..' . '/models/Base/Station.php',
        'Base\\StationQuery' => __DIR__ . '/../..' . '/models/Base/StationQuery.php',
        'Base\\Supervisors' => __DIR__ . '/../..' . '/models/Base/Supervisors.php',
        'Base\\SupervisorsQuery' => __DIR__ . '/../..' . '/models/Base/SupervisorsQuery.php',
        'Base\\User' => __DIR__ . '/../..' . '/models/Base/User.php',
        'Base\\UserQuery' => __DIR__ . '/../..' . '/models/Base/UserQuery.php',
        'Base\\Vehicles' => __DIR__ . '/../..' . '/models/Base/Vehicles.php',
        'Base\\VehiclesQuery' => __DIR__ . '/../..' . '/models/Base/VehiclesQuery.php',
        'Certifications' => __DIR__ . '/../..' . '/models/Certifications.php',
        'CertificationsQuery' => __DIR__ . '/../..' . '/models/CertificationsQuery.php',
        'Incident' => __DIR__ . '/../..' . '/models/Incident.php',
        'IncidentQuery' => __DIR__ . '/../..' . '/models/IncidentQuery.php',
        'Inventory' => __DIR__ . '/../..' . '/models/Inventory.php',
        'InventoryQuery' => __DIR__ . '/../..' . '/models/InventoryQuery.php',
        'InvolvedParty' => __DIR__ . '/../..' . '/models/InvolvedParty.php',
        'InvolvedPartyQuery' => __DIR__ . '/../..' . '/models/InvolvedPartyQuery.php',
        'Jurisdiction' => __DIR__ . '/../..' . '/models/Jurisdiction.php',
        'JurisdictionQuery' => __DIR__ . '/../..' . '/models/JurisdictionQuery.php',
        'Map\\CertificationsTableMap' => __DIR__ . '/../..' . '/models/Map/CertificationsTableMap.php',
        'Map\\IncidentTableMap' => __DIR__ . '/../..' . '/models/Map/IncidentTableMap.php',
        'Map\\InventoryTableMap' => __DIR__ . '/../..' . '/models/Map/InventoryTableMap.php',
        'Map\\InvolvedPartyTableMap' => __DIR__ . '/../..' . '/models/Map/InvolvedPartyTableMap.php',
        'Map\\JurisdictionTableMap' => __DIR__ . '/../..' . '/models/Map/JurisdictionTableMap.php',
        'Map\\PersonnelEquipmentTableMap' => __DIR__ . '/../..' . '/models/Map/PersonnelEquipmentTableMap.php',
        'Map\\PersonnelTableMap' => __DIR__ . '/../..' . '/models/Map/PersonnelTableMap.php',
        'Map\\ShiftTableMap' => __DIR__ . '/../..' . '/models/Map/ShiftTableMap.php',
        'Map\\StationTableMap' => __DIR__ . '/../..' . '/models/Map/StationTableMap.php',
        'Map\\SupervisorsTableMap' => __DIR__ . '/../..' . '/models/Map/SupervisorsTableMap.php',
        'Map\\UserTableMap' => __DIR__ . '/../..' . '/models/Map/UserTableMap.php',
        'Map\\VehiclesTableMap' => __DIR__ . '/../..' . '/models/Map/VehiclesTableMap.php',
        'Personnel' => __DIR__ . '/../..' . '/models/Personnel.php',
        'PersonnelEquipment' => __DIR__ . '/../..' . '/models/PersonnelEquipment.php',
        'PersonnelEquipmentQuery' => __DIR__ . '/../..' . '/models/PersonnelEquipmentQuery.php',
        'PersonnelQuery' => __DIR__ . '/../..' . '/models/PersonnelQuery.php',
        'Shift' => __DIR__ . '/../..' . '/models/Shift.php',
        'ShiftQuery' => __DIR__ . '/../..' . '/models/ShiftQuery.php',
        'Station' => __DIR__ . '/../..' . '/models/Station.php',
        'StationQuery' => __DIR__ . '/../..' . '/models/StationQuery.php',
        'Supervisors' => __DIR__ . '/../..' . '/models/Supervisors.php',
        'SupervisorsQuery' => __DIR__ . '/../..' . '/models/SupervisorsQuery.php',
        'User' => __DIR__ . '/../..' . '/models/User.php',
        'UserQuery' => __DIR__ . '/../..' . '/models/UserQuery.php',
        'Vehicles' => __DIR__ . '/../..' . '/models/Vehicles.php',
        'VehiclesQuery' => __DIR__ . '/../..' . '/models/VehiclesQuery.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7bdb79e80861fc7d156dc8fb3690dd2e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7bdb79e80861fc7d156dc8fb3690dd2e::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit7bdb79e80861fc7d156dc8fb3690dd2e::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit7bdb79e80861fc7d156dc8fb3690dd2e::$classMap;

        }, null, ClassLoader::class);
    }
}
