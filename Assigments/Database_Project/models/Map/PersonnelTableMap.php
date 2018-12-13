<?php

namespace Map;

use \Personnel;
use \PersonnelQuery;
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
 * This class defines the structure of the 'personnel' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PersonnelTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PersonnelTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'personnel';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Personnel';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Personnel';

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
     * the column name for the personnel_id field
     */
    const COL_PERSONNEL_ID = 'personnel.personnel_id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'personnel.name';

    /**
     * the column name for the address field
     */
    const COL_ADDRESS = 'personnel.address';

    /**
     * the column name for the height field
     */
    const COL_HEIGHT = 'personnel.height';

    /**
     * the column name for the weight field
     */
    const COL_WEIGHT = 'personnel.weight';

    /**
     * the column name for the ssn field
     */
    const COL_SSN = 'personnel.ssn';

    /**
     * the column name for the phone_number field
     */
    const COL_PHONE_NUMBER = 'personnel.phone_number';

    /**
     * the column name for the shift_id field
     */
    const COL_SHIFT_ID = 'personnel.shift_id';

    /**
     * the column name for the certification_id field
     */
    const COL_CERTIFICATION_ID = 'personnel.certification_id';

    /**
     * the column name for the station_id field
     */
    const COL_STATION_ID = 'personnel.station_id';

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
        self::TYPE_PHPNAME       => array('PersonnelId', 'Name', 'Address', 'Height', 'Weight', 'Ssn', 'PhoneNumber', 'ShiftId', 'CertificationId', 'StationId', ),
        self::TYPE_CAMELNAME     => array('personnelId', 'name', 'address', 'height', 'weight', 'ssn', 'phoneNumber', 'shiftId', 'certificationId', 'stationId', ),
        self::TYPE_COLNAME       => array(PersonnelTableMap::COL_PERSONNEL_ID, PersonnelTableMap::COL_NAME, PersonnelTableMap::COL_ADDRESS, PersonnelTableMap::COL_HEIGHT, PersonnelTableMap::COL_WEIGHT, PersonnelTableMap::COL_SSN, PersonnelTableMap::COL_PHONE_NUMBER, PersonnelTableMap::COL_SHIFT_ID, PersonnelTableMap::COL_CERTIFICATION_ID, PersonnelTableMap::COL_STATION_ID, ),
        self::TYPE_FIELDNAME     => array('personnel_id', 'name', 'address', 'height', 'weight', 'ssn', 'phone_number', 'shift_id', 'certification_id', 'station_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('PersonnelId' => 0, 'Name' => 1, 'Address' => 2, 'Height' => 3, 'Weight' => 4, 'Ssn' => 5, 'PhoneNumber' => 6, 'ShiftId' => 7, 'CertificationId' => 8, 'StationId' => 9, ),
        self::TYPE_CAMELNAME     => array('personnelId' => 0, 'name' => 1, 'address' => 2, 'height' => 3, 'weight' => 4, 'ssn' => 5, 'phoneNumber' => 6, 'shiftId' => 7, 'certificationId' => 8, 'stationId' => 9, ),
        self::TYPE_COLNAME       => array(PersonnelTableMap::COL_PERSONNEL_ID => 0, PersonnelTableMap::COL_NAME => 1, PersonnelTableMap::COL_ADDRESS => 2, PersonnelTableMap::COL_HEIGHT => 3, PersonnelTableMap::COL_WEIGHT => 4, PersonnelTableMap::COL_SSN => 5, PersonnelTableMap::COL_PHONE_NUMBER => 6, PersonnelTableMap::COL_SHIFT_ID => 7, PersonnelTableMap::COL_CERTIFICATION_ID => 8, PersonnelTableMap::COL_STATION_ID => 9, ),
        self::TYPE_FIELDNAME     => array('personnel_id' => 0, 'name' => 1, 'address' => 2, 'height' => 3, 'weight' => 4, 'ssn' => 5, 'phone_number' => 6, 'shift_id' => 7, 'certification_id' => 8, 'station_id' => 9, ),
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
        $this->setName('personnel');
        $this->setPhpName('Personnel');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Personnel');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('personnel_id', 'PersonnelId', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('address', 'Address', 'VARCHAR', true, 255, null);
        $this->addColumn('height', 'Height', 'VARCHAR', true, 255, null);
        $this->addColumn('weight', 'Weight', 'INTEGER', true, null, null);
        $this->addColumn('ssn', 'Ssn', 'VARCHAR', true, 255, null);
        $this->addColumn('phone_number', 'PhoneNumber', 'VARCHAR', true, 255, null);
        $this->addForeignKey('shift_id', 'ShiftId', 'INTEGER', 'shift', 'shift_id', true, null, null);
        $this->addForeignKey('certification_id', 'CertificationId', 'INTEGER', 'certifications', 'certification_id', true, null, null);
        $this->addForeignKey('station_id', 'StationId', 'INTEGER', 'station', 'station_id', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Shift', '\\Shift', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':shift_id',
    1 => ':shift_id',
  ),
), null, null, null, false);
        $this->addRelation('Certifications', '\\Certifications', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':certification_id',
    1 => ':certification_id',
  ),
), null, null, null, false);
        $this->addRelation('Station', '\\Station', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':station_id',
    1 => ':station_id',
  ),
), null, null, null, false);
        $this->addRelation('PersonnelEquipment', '\\PersonnelEquipment', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':personnel_id',
    1 => ':personnel_id',
  ),
), null, null, 'PersonnelEquipments', false);
        $this->addRelation('Supervisors', '\\Supervisors', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':personnel_id',
    1 => ':personnel_id',
  ),
), null, null, 'Supervisorss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonnelId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonnelId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonnelId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonnelId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonnelId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PersonnelId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PersonnelId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PersonnelTableMap::CLASS_DEFAULT : PersonnelTableMap::OM_CLASS;
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
     * @return array           (Personnel object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PersonnelTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PersonnelTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PersonnelTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PersonnelTableMap::OM_CLASS;
            /** @var Personnel $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PersonnelTableMap::addInstanceToPool($obj, $key);
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
            $key = PersonnelTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PersonnelTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Personnel $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PersonnelTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PersonnelTableMap::COL_PERSONNEL_ID);
            $criteria->addSelectColumn(PersonnelTableMap::COL_NAME);
            $criteria->addSelectColumn(PersonnelTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(PersonnelTableMap::COL_HEIGHT);
            $criteria->addSelectColumn(PersonnelTableMap::COL_WEIGHT);
            $criteria->addSelectColumn(PersonnelTableMap::COL_SSN);
            $criteria->addSelectColumn(PersonnelTableMap::COL_PHONE_NUMBER);
            $criteria->addSelectColumn(PersonnelTableMap::COL_SHIFT_ID);
            $criteria->addSelectColumn(PersonnelTableMap::COL_CERTIFICATION_ID);
            $criteria->addSelectColumn(PersonnelTableMap::COL_STATION_ID);
        } else {
            $criteria->addSelectColumn($alias . '.personnel_id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.height');
            $criteria->addSelectColumn($alias . '.weight');
            $criteria->addSelectColumn($alias . '.ssn');
            $criteria->addSelectColumn($alias . '.phone_number');
            $criteria->addSelectColumn($alias . '.shift_id');
            $criteria->addSelectColumn($alias . '.certification_id');
            $criteria->addSelectColumn($alias . '.station_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(PersonnelTableMap::DATABASE_NAME)->getTable(PersonnelTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PersonnelTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PersonnelTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PersonnelTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Personnel or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Personnel object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PersonnelTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Personnel) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PersonnelTableMap::DATABASE_NAME);
            $criteria->add(PersonnelTableMap::COL_PERSONNEL_ID, (array) $values, Criteria::IN);
        }

        $query = PersonnelQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PersonnelTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PersonnelTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the personnel table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PersonnelQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Personnel or Criteria object.
     *
     * @param mixed               $criteria Criteria or Personnel object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonnelTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Personnel object
        }

        if ($criteria->containsKey(PersonnelTableMap::COL_PERSONNEL_ID) && $criteria->keyContainsValue(PersonnelTableMap::COL_PERSONNEL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PersonnelTableMap::COL_PERSONNEL_ID.')');
        }


        // Set the correct dbName
        $query = PersonnelQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PersonnelTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PersonnelTableMap::buildTableMap();
