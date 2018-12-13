<?php

namespace Map;

use \Inventory;
use \InventoryQuery;
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
 * This class defines the structure of the 'inventory' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class InventoryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.InventoryTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'inventory';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Inventory';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Inventory';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the inventory_id field
     */
    const COL_INVENTORY_ID = 'inventory.inventory_id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'inventory.name';

    /**
     * the column name for the brand field
     */
    const COL_BRAND = 'inventory.brand';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'inventory.type';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'inventory.description';

    /**
     * the column name for the item_condition field
     */
    const COL_ITEM_CONDITION = 'inventory.item_condition';

    /**
     * the column name for the quantity field
     */
    const COL_QUANTITY = 'inventory.quantity';

    /**
     * the column name for the station_id field
     */
    const COL_STATION_ID = 'inventory.station_id';

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
        self::TYPE_PHPNAME       => array('InventoryId', 'Name', 'Brand', 'Type', 'Description', 'ItemCondition', 'Quantity', 'StationId', ),
        self::TYPE_CAMELNAME     => array('inventoryId', 'name', 'brand', 'type', 'description', 'itemCondition', 'quantity', 'stationId', ),
        self::TYPE_COLNAME       => array(InventoryTableMap::COL_INVENTORY_ID, InventoryTableMap::COL_NAME, InventoryTableMap::COL_BRAND, InventoryTableMap::COL_TYPE, InventoryTableMap::COL_DESCRIPTION, InventoryTableMap::COL_ITEM_CONDITION, InventoryTableMap::COL_QUANTITY, InventoryTableMap::COL_STATION_ID, ),
        self::TYPE_FIELDNAME     => array('inventory_id', 'name', 'brand', 'type', 'description', 'item_condition', 'quantity', 'station_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('InventoryId' => 0, 'Name' => 1, 'Brand' => 2, 'Type' => 3, 'Description' => 4, 'ItemCondition' => 5, 'Quantity' => 6, 'StationId' => 7, ),
        self::TYPE_CAMELNAME     => array('inventoryId' => 0, 'name' => 1, 'brand' => 2, 'type' => 3, 'description' => 4, 'itemCondition' => 5, 'quantity' => 6, 'stationId' => 7, ),
        self::TYPE_COLNAME       => array(InventoryTableMap::COL_INVENTORY_ID => 0, InventoryTableMap::COL_NAME => 1, InventoryTableMap::COL_BRAND => 2, InventoryTableMap::COL_TYPE => 3, InventoryTableMap::COL_DESCRIPTION => 4, InventoryTableMap::COL_ITEM_CONDITION => 5, InventoryTableMap::COL_QUANTITY => 6, InventoryTableMap::COL_STATION_ID => 7, ),
        self::TYPE_FIELDNAME     => array('inventory_id' => 0, 'name' => 1, 'brand' => 2, 'type' => 3, 'description' => 4, 'item_condition' => 5, 'quantity' => 6, 'station_id' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('inventory');
        $this->setPhpName('Inventory');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Inventory');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('inventory_id', 'InventoryId', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('brand', 'Brand', 'VARCHAR', true, 255, null);
        $this->addColumn('type', 'Type', 'VARCHAR', true, 255, null);
        $this->addColumn('description', 'Description', 'VARCHAR', true, 255, null);
        $this->addColumn('item_condition', 'ItemCondition', 'VARCHAR', true, 255, null);
        $this->addColumn('quantity', 'Quantity', 'INTEGER', true, null, null);
        $this->addForeignKey('station_id', 'StationId', 'INTEGER', 'station', 'station_id', true, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('InventoryId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('InventoryId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('InventoryId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('InventoryId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('InventoryId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('InventoryId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('InventoryId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? InventoryTableMap::CLASS_DEFAULT : InventoryTableMap::OM_CLASS;
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
     * @return array           (Inventory object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = InventoryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = InventoryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + InventoryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = InventoryTableMap::OM_CLASS;
            /** @var Inventory $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            InventoryTableMap::addInstanceToPool($obj, $key);
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
            $key = InventoryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = InventoryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Inventory $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                InventoryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(InventoryTableMap::COL_INVENTORY_ID);
            $criteria->addSelectColumn(InventoryTableMap::COL_NAME);
            $criteria->addSelectColumn(InventoryTableMap::COL_BRAND);
            $criteria->addSelectColumn(InventoryTableMap::COL_TYPE);
            $criteria->addSelectColumn(InventoryTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(InventoryTableMap::COL_ITEM_CONDITION);
            $criteria->addSelectColumn(InventoryTableMap::COL_QUANTITY);
            $criteria->addSelectColumn(InventoryTableMap::COL_STATION_ID);
        } else {
            $criteria->addSelectColumn($alias . '.inventory_id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.brand');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.item_condition');
            $criteria->addSelectColumn($alias . '.quantity');
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
        return Propel::getServiceContainer()->getDatabaseMap(InventoryTableMap::DATABASE_NAME)->getTable(InventoryTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(InventoryTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(InventoryTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new InventoryTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Inventory or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Inventory object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(InventoryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Inventory) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(InventoryTableMap::DATABASE_NAME);
            $criteria->add(InventoryTableMap::COL_INVENTORY_ID, (array) $values, Criteria::IN);
        }

        $query = InventoryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            InventoryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                InventoryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the inventory table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return InventoryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Inventory or Criteria object.
     *
     * @param mixed               $criteria Criteria or Inventory object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InventoryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Inventory object
        }

        if ($criteria->containsKey(InventoryTableMap::COL_INVENTORY_ID) && $criteria->keyContainsValue(InventoryTableMap::COL_INVENTORY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.InventoryTableMap::COL_INVENTORY_ID.')');
        }


        // Set the correct dbName
        $query = InventoryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // InventoryTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
InventoryTableMap::buildTableMap();
