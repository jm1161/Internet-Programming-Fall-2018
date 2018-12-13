<?php

namespace Base;

use \Inventory as ChildInventory;
use \InventoryQuery as ChildInventoryQuery;
use \Exception;
use \PDO;
use Map\InventoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'inventory' table.
 *
 *
 *
 * @method     ChildInventoryQuery orderByInventoryId($order = Criteria::ASC) Order by the inventory_id column
 * @method     ChildInventoryQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildInventoryQuery orderByBrand($order = Criteria::ASC) Order by the brand column
 * @method     ChildInventoryQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildInventoryQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildInventoryQuery orderByItemCondition($order = Criteria::ASC) Order by the item_condition column
 * @method     ChildInventoryQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 * @method     ChildInventoryQuery orderByStationId($order = Criteria::ASC) Order by the station_id column
 *
 * @method     ChildInventoryQuery groupByInventoryId() Group by the inventory_id column
 * @method     ChildInventoryQuery groupByName() Group by the name column
 * @method     ChildInventoryQuery groupByBrand() Group by the brand column
 * @method     ChildInventoryQuery groupByType() Group by the type column
 * @method     ChildInventoryQuery groupByDescription() Group by the description column
 * @method     ChildInventoryQuery groupByItemCondition() Group by the item_condition column
 * @method     ChildInventoryQuery groupByQuantity() Group by the quantity column
 * @method     ChildInventoryQuery groupByStationId() Group by the station_id column
 *
 * @method     ChildInventoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildInventoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildInventoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildInventoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildInventoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildInventoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildInventoryQuery leftJoinStation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Station relation
 * @method     ChildInventoryQuery rightJoinStation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Station relation
 * @method     ChildInventoryQuery innerJoinStation($relationAlias = null) Adds a INNER JOIN clause to the query using the Station relation
 *
 * @method     ChildInventoryQuery joinWithStation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Station relation
 *
 * @method     ChildInventoryQuery leftJoinWithStation() Adds a LEFT JOIN clause and with to the query using the Station relation
 * @method     ChildInventoryQuery rightJoinWithStation() Adds a RIGHT JOIN clause and with to the query using the Station relation
 * @method     ChildInventoryQuery innerJoinWithStation() Adds a INNER JOIN clause and with to the query using the Station relation
 *
 * @method     \StationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildInventory findOne(ConnectionInterface $con = null) Return the first ChildInventory matching the query
 * @method     ChildInventory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildInventory matching the query, or a new ChildInventory object populated from the query conditions when no match is found
 *
 * @method     ChildInventory findOneByInventoryId(int $inventory_id) Return the first ChildInventory filtered by the inventory_id column
 * @method     ChildInventory findOneByName(string $name) Return the first ChildInventory filtered by the name column
 * @method     ChildInventory findOneByBrand(string $brand) Return the first ChildInventory filtered by the brand column
 * @method     ChildInventory findOneByType(string $type) Return the first ChildInventory filtered by the type column
 * @method     ChildInventory findOneByDescription(string $description) Return the first ChildInventory filtered by the description column
 * @method     ChildInventory findOneByItemCondition(string $item_condition) Return the first ChildInventory filtered by the item_condition column
 * @method     ChildInventory findOneByQuantity(int $quantity) Return the first ChildInventory filtered by the quantity column
 * @method     ChildInventory findOneByStationId(int $station_id) Return the first ChildInventory filtered by the station_id column *

 * @method     ChildInventory requirePk($key, ConnectionInterface $con = null) Return the ChildInventory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventory requireOne(ConnectionInterface $con = null) Return the first ChildInventory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInventory requireOneByInventoryId(int $inventory_id) Return the first ChildInventory filtered by the inventory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventory requireOneByName(string $name) Return the first ChildInventory filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventory requireOneByBrand(string $brand) Return the first ChildInventory filtered by the brand column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventory requireOneByType(string $type) Return the first ChildInventory filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventory requireOneByDescription(string $description) Return the first ChildInventory filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventory requireOneByItemCondition(string $item_condition) Return the first ChildInventory filtered by the item_condition column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventory requireOneByQuantity(int $quantity) Return the first ChildInventory filtered by the quantity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventory requireOneByStationId(int $station_id) Return the first ChildInventory filtered by the station_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInventory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildInventory objects based on current ModelCriteria
 * @method     ChildInventory[]|ObjectCollection findByInventoryId(int $inventory_id) Return ChildInventory objects filtered by the inventory_id column
 * @method     ChildInventory[]|ObjectCollection findByName(string $name) Return ChildInventory objects filtered by the name column
 * @method     ChildInventory[]|ObjectCollection findByBrand(string $brand) Return ChildInventory objects filtered by the brand column
 * @method     ChildInventory[]|ObjectCollection findByType(string $type) Return ChildInventory objects filtered by the type column
 * @method     ChildInventory[]|ObjectCollection findByDescription(string $description) Return ChildInventory objects filtered by the description column
 * @method     ChildInventory[]|ObjectCollection findByItemCondition(string $item_condition) Return ChildInventory objects filtered by the item_condition column
 * @method     ChildInventory[]|ObjectCollection findByQuantity(int $quantity) Return ChildInventory objects filtered by the quantity column
 * @method     ChildInventory[]|ObjectCollection findByStationId(int $station_id) Return ChildInventory objects filtered by the station_id column
 * @method     ChildInventory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class InventoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\InventoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Inventory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildInventoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildInventoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildInventoryQuery) {
            return $criteria;
        }
        $query = new ChildInventoryQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildInventory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(InventoryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = InventoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildInventory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT inventory_id, name, brand, type, description, item_condition, quantity, station_id FROM inventory WHERE inventory_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildInventory $obj */
            $obj = new ChildInventory();
            $obj->hydrate($row);
            InventoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildInventory|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(InventoryTableMap::COL_INVENTORY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(InventoryTableMap::COL_INVENTORY_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the inventory_id column
     *
     * Example usage:
     * <code>
     * $query->filterByInventoryId(1234); // WHERE inventory_id = 1234
     * $query->filterByInventoryId(array(12, 34)); // WHERE inventory_id IN (12, 34)
     * $query->filterByInventoryId(array('min' => 12)); // WHERE inventory_id > 12
     * </code>
     *
     * @param     mixed $inventoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByInventoryId($inventoryId = null, $comparison = null)
    {
        if (is_array($inventoryId)) {
            $useMinMax = false;
            if (isset($inventoryId['min'])) {
                $this->addUsingAlias(InventoryTableMap::COL_INVENTORY_ID, $inventoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($inventoryId['max'])) {
                $this->addUsingAlias(InventoryTableMap::COL_INVENTORY_ID, $inventoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventoryTableMap::COL_INVENTORY_ID, $inventoryId, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventoryTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the brand column
     *
     * Example usage:
     * <code>
     * $query->filterByBrand('fooValue');   // WHERE brand = 'fooValue'
     * $query->filterByBrand('%fooValue%', Criteria::LIKE); // WHERE brand LIKE '%fooValue%'
     * </code>
     *
     * @param     string $brand The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByBrand($brand = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brand)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventoryTableMap::COL_BRAND, $brand, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventoryTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventoryTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the item_condition column
     *
     * Example usage:
     * <code>
     * $query->filterByItemCondition('fooValue');   // WHERE item_condition = 'fooValue'
     * $query->filterByItemCondition('%fooValue%', Criteria::LIKE); // WHERE item_condition LIKE '%fooValue%'
     * </code>
     *
     * @param     string $itemCondition The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByItemCondition($itemCondition = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($itemCondition)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventoryTableMap::COL_ITEM_CONDITION, $itemCondition, $comparison);
    }

    /**
     * Filter the query on the quantity column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantity(1234); // WHERE quantity = 1234
     * $query->filterByQuantity(array(12, 34)); // WHERE quantity IN (12, 34)
     * $query->filterByQuantity(array('min' => 12)); // WHERE quantity > 12
     * </code>
     *
     * @param     mixed $quantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByQuantity($quantity = null, $comparison = null)
    {
        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                $this->addUsingAlias(InventoryTableMap::COL_QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                $this->addUsingAlias(InventoryTableMap::COL_QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventoryTableMap::COL_QUANTITY, $quantity, $comparison);
    }

    /**
     * Filter the query on the station_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStationId(1234); // WHERE station_id = 1234
     * $query->filterByStationId(array(12, 34)); // WHERE station_id IN (12, 34)
     * $query->filterByStationId(array('min' => 12)); // WHERE station_id > 12
     * </code>
     *
     * @see       filterByStation()
     *
     * @param     mixed $stationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByStationId($stationId = null, $comparison = null)
    {
        if (is_array($stationId)) {
            $useMinMax = false;
            if (isset($stationId['min'])) {
                $this->addUsingAlias(InventoryTableMap::COL_STATION_ID, $stationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stationId['max'])) {
                $this->addUsingAlias(InventoryTableMap::COL_STATION_ID, $stationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventoryTableMap::COL_STATION_ID, $stationId, $comparison);
    }

    /**
     * Filter the query by a related \Station object
     *
     * @param \Station|ObjectCollection $station The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildInventoryQuery The current query, for fluid interface
     */
    public function filterByStation($station, $comparison = null)
    {
        if ($station instanceof \Station) {
            return $this
                ->addUsingAlias(InventoryTableMap::COL_STATION_ID, $station->getStationId(), $comparison);
        } elseif ($station instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InventoryTableMap::COL_STATION_ID, $station->toKeyValue('PrimaryKey', 'StationId'), $comparison);
        } else {
            throw new PropelException('filterByStation() only accepts arguments of type \Station or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Station relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function joinStation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Station');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Station');
        }

        return $this;
    }

    /**
     * Use the Station relation Station object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \StationQuery A secondary query class using the current class as primary query
     */
    public function useStationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Station', '\StationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildInventory $inventory Object to remove from the list of results
     *
     * @return $this|ChildInventoryQuery The current query, for fluid interface
     */
    public function prune($inventory = null)
    {
        if ($inventory) {
            $this->addUsingAlias(InventoryTableMap::COL_INVENTORY_ID, $inventory->getInventoryId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the inventory table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InventoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            InventoryTableMap::clearInstancePool();
            InventoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InventoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(InventoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            InventoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            InventoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // InventoryQuery
