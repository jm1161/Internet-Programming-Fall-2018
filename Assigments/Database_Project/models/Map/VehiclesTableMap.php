<?php

namespace Map;

use \Vehicles;
use \VehiclesQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'vehicles' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class VehiclesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.VehiclesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'vehicles';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Vehicles';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Vehicles';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the vehicle_id field
     */
    const COL_VEHICLE_ID = 'vehicles.vehicle_id';

    /**
     * the column name for the make field
     */
    const COL_MAKE = 'vehicles.make';

    /**
     * the column name for the model field
     */
    const COL_MODEL = 'vehicles.model';

    /**
     * the column name for the year field
     */
    const COL_YEAR = 'vehicles.year';

    /**
     * the column name for the vin field
     */
    const COL_VIN = 'vehicles.vin';

    /**
     * the column name for the mileage field
     */
    const COL_MILEAGE = 'vehicles.mileage';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'vehicles.type';

    /**
     * the column name for the license_plate field
     */
    const COL_LICENSE_PLATE = 'vehicles.license_plate';

    /**
     * the column name for the station_id field
     */
    const COL_STATION_ID = 'vehicles.station_id';

    /**
     * the column name for the in_service field
     */
    const COL_IN_SERVICE = 'vehicles.in_service';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('VehicleId', 'Make', 'Model', 'Year', 'Vin', 'Mileage', 'Type', 'LicensePlate', 'StationId', 'InService', ),
        self::TYPE_CAMELNAME     => array('vehicleId', 'make', 'model', 'year', 'vin', 'mileage', 'type', 'licensePlate', 'stationId', 'inService', ),
        self::TYPE_COLNAME       => array(VehiclesTableMap::COL_VEHICLE_ID, VehiclesTableMap::COL_MAKE, VehiclesTableMap::COL_MODEL, VehiclesTableMap::COL_YEAR, VehiclesTableMap::COL_VIN, VehiclesTableMap::COL_MILEAGE, VehiclesTableMap::COL_TYPE, VehiclesTableMap::COL_LICENSE_PLATE, VehiclesTableMap::COL_STATION_ID, VehiclesTableMap::COL_IN_SERVICE, ),
        self::TYPE_FIELDNAME     => array('vehicle_id', 'make', 'model', 'year', 'vin', 'mileage', 'type', 'license_plate', 'station_id', 'in_service', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('VehicleId' => 0, 'Make' => 1, 'Model' => 2, 'Year' => 3, 'Vin' => 4, 'Mileage' => 5, 'Type' => 6, 'LicensePlate' => 7, 'StationId' => 8, 'InService' => 9, ),
        self::TYPE_CAMELNAME     => array('vehicleId' => 0, 'make' => 1, 'model' => 2, 'year' => 3, 'vin' => 4, 'mileage' => 5, 'type' => 6, 'licensePlate' => 7, 'stationId' => 8, 'inService' => 9, ),
        self::TYPE_COLNAME       => array(VehiclesTableMap::COL_VEHICLE_ID => 0, VehiclesTableMap::COL_MAKE => 1, VehiclesTableMap::COL_MODEL => 2, VehiclesTableMap::COL_YEAR => 3, VehiclesTableMap::COL_VIN => 4, VehiclesTableMap::COL_MILEAGE => 5, VehiclesTableMap::COL_TYPE => 6, VehiclesTableMap::COL_LICENSE_PLATE => 7, VehiclesTableMap::COL_STATION_ID => 8, VehiclesTableMap::COL_IN_SERVICE => 9, ),
        self::TYPE_FIELDNAME     => array('vehicle_id' => 0, 'make' => 1, 'model' => 2, 'year' => 3, 'vin' => 4, 'mileage' => 5, 'type' => 6, 'license_plate' => 7, 'station_id' => 8, 'in_service' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('vehicles');
        $this->setPhpName('Vehicles');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Vehicles');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('vehicle_id', 'VehicleId', 'INTEGER', true, null, null);
        $this->addColumn('make', 'Make', 'VARCHAR', true, 255, null);
        $this->addColumn('model', 'Model', 'VARCHAR', true, 255, null);
        $this->addColumn('year', 'Year', 'INTEGER', true, null, null);
        $this->addColumn('vin', 'Vin', 'VARCHAR', true, 255, null);
        $this->addColumn('mileage', 'Mileage', 'INTEGER', true, null, null);
        $this->addColumn('type', 'Type', 'VARCHAR', true, 255, null);
        $this->addColumn('license_plate', 'LicensePlate', 'VARCHAR', true, 255, null);
        $this->addForeignKey('station_id', 'StationId', 'INTEGER', 'station', 'station_id', true, null, null);
        $this->addColumn('in_service', 'InService', 'BOOLEAN', true, 1, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Station', '\\Station', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':station_id',
    1 => ':station_id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VehicleId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VehicleId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VehicleId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VehicleId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VehicleId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('VehicleId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('VehicleId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? VehiclesTableMap::CLASS_DEFAULT : VehiclesTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Vehicles object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = VehiclesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = VehiclesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + VehiclesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = VehiclesTableMap::OM_CLASS;
            /** @var Vehicles $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            VehiclesTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = VehiclesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = VehiclesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Vehicles $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                VehiclesTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(VehiclesTableMap::COL_VEHICLE_ID);
            $criteria->addSelectColumn(VehiclesTableMap::COL_MAKE);
            $criteria->addSelectColumn(VehiclesTableMap::COL_MODEL);
            $criteria->addSelectColumn(VehiclesTableMap::COL_YEAR);
            $criteria->addSelectColumn(VehiclesTableMap::COL_VIN);
            $criteria->addSelectColumn(VehiclesTableMap::COL_MILEAGE);
            $criteria->addSelectColumn(VehiclesTableMap::COL_TYPE);
            $criteria->addSelectColumn(VehiclesTableMap::COL_LICENSE_PLATE);
            $criteria->addSelectColumn(VehiclesTableMap::COL_STATION_ID);
            $criteria->addSelectColumn(VehiclesTableMap::COL_IN_SERVICE);
        } else {
            $criteria->addSelectColumn($alias . '.vehicle_id');
            $criteria->addSelectColumn($alias . '.make');
            $criteria->addSelectColumn($alias . '.model');
            $criteria->addSelectColumn($alias . '.year');
            $criteria->addSelectColumn($alias . '.vin');
            $criteria->addSelectColumn($alias . '.mileage');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.license_plate');
            $criteria->addSelectColumn($alias . '.station_id');
            $criteria->addSelectColumn($alias . '.in_service');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(VehiclesTableMap::DATABASE_NAME)->getTable(VehiclesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(VehiclesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(VehiclesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new VehiclesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Vehicles or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Vehicles object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VehiclesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Vehicles) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(VehiclesTableMap::DATABASE_NAME);
            $criteria->add(VehiclesTableMap::COL_VEHICLE_ID, (array) $values, Criteria::IN);
        }

        $query = VehiclesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            VehiclesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                VehiclesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the vehicles table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return VehiclesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Vehicles or Criteria object.
     *
     * @param mixed               $criteria Criteria or Vehicles object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VehiclesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Vehicles object
        }

        if ($criteria->containsKey(VehiclesTableMap::COL_VEHICLE_ID) && $criteria->keyContainsValue(VehiclesTableMap::COL_VEHICLE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.VehiclesTableMap::COL_VEHICLE_ID.')');
        }


        // Set the correct dbName
        $query = VehiclesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // VehiclesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
VehiclesTableMap::buildTableMap();
