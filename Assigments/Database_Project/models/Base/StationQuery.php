<?php

namespace Base;

use \Station as ChildStation;
use \StationQuery as ChildStationQuery;
use \Exception;
use \PDO;
use Map\StationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'station' table.
 *
 *
 *
 * @method     ChildStationQuery orderByStationId($order = Criteria::ASC) Order by the station_id column
 * @method     ChildStationQuery orderByStationName($order = Criteria::ASC) Order by the station_name column
 * @method     ChildStationQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildStationQuery orderByJurisdictionId($order = Criteria::ASC) Order by the jurisdiction_id column
 *
 * @method     ChildStationQuery groupByStationId() Group by the station_id column
 * @method     ChildStationQuery groupByStationName() Group by the station_name column
 * @method     ChildStationQuery groupByAddress() Group by the address column
 * @method     ChildStationQuery groupByJurisdictionId() Group by the jurisdiction_id column
 *
 * @method     ChildStationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStationQuery leftJoinJurisdiction($relationAlias = null) Adds a LEFT JOIN clause to the query using the Jurisdiction relation
 * @method     ChildStationQuery rightJoinJurisdiction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Jurisdiction relation
 * @method     ChildStationQuery innerJoinJurisdiction($relationAlias = null) Adds a INNER JOIN clause to the query using the Jurisdiction relation
 *
 * @method     ChildStationQuery joinWithJurisdiction($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Jurisdiction relation
 *
 * @method     ChildStationQuery leftJoinWithJurisdiction() Adds a LEFT JOIN clause and with to the query using the Jurisdiction relation
 * @method     ChildStationQuery rightJoinWithJurisdiction() Adds a RIGHT JOIN clause and with to the query using the Jurisdiction relation
 * @method     ChildStationQuery innerJoinWithJurisdiction() Adds a INNER JOIN clause and with to the query using the Jurisdiction relation
 *
 * @method     ChildStationQuery leftJoinIncident($relationAlias = null) Adds a LEFT JOIN clause to the query using the Incident relation
 * @method     ChildStationQuery rightJoinIncident($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Incident relation
 * @method     ChildStationQuery innerJoinIncident($relationAlias = null) Adds a INNER JOIN clause to the query using the Incident relation
 *
 * @method     ChildStationQuery joinWithIncident($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Incident relation
 *
 * @method     ChildStationQuery leftJoinWithIncident() Adds a LEFT JOIN clause and with to the query using the Incident relation
 * @method     ChildStationQuery rightJoinWithIncident() Adds a RIGHT JOIN clause and with to the query using the Incident relation
 * @method     ChildStationQuery innerJoinWithIncident() Adds a INNER JOIN clause and with to the query using the Incident relation
 *
 * @method     ChildStationQuery leftJoinInventory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Inventory relation
 * @method     ChildStationQuery rightJoinInventory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Inventory relation
 * @method     ChildStationQuery innerJoinInventory($relationAlias = null) Adds a INNER JOIN clause to the query using the Inventory relation
 *
 * @method     ChildStationQuery joinWithInventory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Inventory relation
 *
 * @method     ChildStationQuery leftJoinWithInventory() Adds a LEFT JOIN clause and with to the query using the Inventory relation
 * @method     ChildStationQuery rightJoinWithInventory() Adds a RIGHT JOIN clause and with to the query using the Inventory relation
 * @method     ChildStationQuery innerJoinWithInventory() Adds a INNER JOIN clause and with to the query using the Inventory relation
 *
 * @method     ChildStationQuery leftJoinPersonnel($relationAlias = null) Adds a LEFT JOIN clause to the query using the Personnel relation
 * @method     ChildStationQuery rightJoinPersonnel($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Personnel relation
 * @method     ChildStationQuery innerJoinPersonnel($relationAlias = null) Adds a INNER JOIN clause to the query using the Personnel relation
 *
 * @method     ChildStationQuery joinWithPersonnel($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Personnel relation
 *
 * @method     ChildStationQuery leftJoinWithPersonnel() Adds a LEFT JOIN clause and with to the query using the Personnel relation
 * @method     ChildStationQuery rightJoinWithPersonnel() Adds a RIGHT JOIN clause and with to the query using the Personnel relation
 * @method     ChildStationQuery innerJoinWithPersonnel() Adds a INNER JOIN clause and with to the query using the Personnel relation
 *
 * @method     ChildStationQuery leftJoinShift($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shift relation
 * @method     ChildStationQuery rightJoinShift($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shift relation
 * @method     ChildStationQuery innerJoinShift($relationAlias = null) Adds a INNER JOIN clause to the query using the Shift relation
 *
 * @method     ChildStationQuery joinWithShift($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shift relation
 *
 * @method     ChildStationQuery leftJoinWithShift() Adds a LEFT JOIN clause and with to the query using the Shift relation
 * @method     ChildStationQuery rightJoinWithShift() Adds a RIGHT JOIN clause and with to the query using the Shift relation
 * @method     ChildStationQuery innerJoinWithShift() Adds a INNER JOIN clause and with to the query using the Shift relation
 *
 * @method     ChildStationQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildStationQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildStationQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildStationQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildStationQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildStationQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildStationQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildStationQuery leftJoinVehicles($relationAlias = null) Adds a LEFT JOIN clause to the query using the Vehicles relation
 * @method     ChildStationQuery rightJoinVehicles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Vehicles relation
 * @method     ChildStationQuery innerJoinVehicles($relationAlias = null) Adds a INNER JOIN clause to the query using the Vehicles relation
 *
 * @method     ChildStationQuery joinWithVehicles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Vehicles relation
 *
 * @method     ChildStationQuery leftJoinWithVehicles() Adds a LEFT JOIN clause and with to the query using the Vehicles relation
 * @method     ChildStationQuery rightJoinWithVehicles() Adds a RIGHT JOIN clause and with to the query using the Vehicles relation
 * @method     ChildStationQuery innerJoinWithVehicles() Adds a INNER JOIN clause and with to the query using the Vehicles relation
 *
 * @method     \JurisdictionQuery|\IncidentQuery|\InventoryQuery|\PersonnelQuery|\ShiftQuery|\UserQuery|\VehiclesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStation findOne(ConnectionInterface $con = null) Return the first ChildStation matching the query
 * @method     ChildStation findOneOrCreate(ConnectionInterface $con = null) Return the first ChildStation matching the query, or a new ChildStation object populated from the query conditions when no match is found
 *
 * @method     ChildStation findOneByStationId(int $station_id) Return the first ChildStation filtered by the station_id column
 * @method     ChildStation findOneByStationName(string $station_name) Return the first ChildStation filtered by the station_name column
 * @method     ChildStation findOneByAddress(string $address) Return the first ChildStation filtered by the address column
 * @method     ChildStation findOneByJurisdictionId(int $jurisdiction_id) Return the first ChildStation filtered by the jurisdiction_id column *

 * @method     ChildStation requirePk($key, ConnectionInterface $con = null) Return the ChildStation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStation requireOne(ConnectionInterface $con = null) Return the first ChildStation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStation requireOneByStationId(int $station_id) Return the first ChildStation filtered by the station_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStation requireOneByStationName(string $station_name) Return the first ChildStation filtered by the station_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStation requireOneByAddress(string $address) Return the first ChildStation filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStation requireOneByJurisdictionId(int $jurisdiction_id) Return the first ChildStation filtered by the jurisdiction_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStation[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildStation objects based on current ModelCriteria
 * @method     ChildStation[]|ObjectCollection findByStationId(int $station_id) Return ChildStation objects filtered by the station_id column
 * @method     ChildStation[]|ObjectCollection findByStationName(string $station_name) Return ChildStation objects filtered by the station_name column
 * @method     ChildStation[]|ObjectCollection findByAddress(string $address) Return ChildStation objects filtered by the address column
 * @method     ChildStation[]|ObjectCollection findByJurisdictionId(int $jurisdiction_id) Return ChildStation objects filtered by the jurisdiction_id column
 * @method     ChildStation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\StationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Station', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildStationQuery) {
            return $criteria;
        }
        $query = new ChildStationQuery();
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
     * @return ChildStation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT station_id, station_name, address, jurisdiction_id FROM station WHERE station_id = :p0';
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
            /** @var ChildStation $obj */
            $obj = new ChildStation();
            $obj->hydrate($row);
            StationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStation|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildStationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(StationTableMap::COL_STATION_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildStationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(StationTableMap::COL_STATION_ID, $keys, Criteria::IN);
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
     * @param     mixed $stationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStationQuery The current query, for fluid interface
     */
    public function filterByStationId($stationId = null, $comparison = null)
    {
        if (is_array($stationId)) {
            $useMinMax = false;
            if (isset($stationId['min'])) {
                $this->addUsingAlias(StationTableMap::COL_STATION_ID, $stationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stationId['max'])) {
                $this->addUsingAlias(StationTableMap::COL_STATION_ID, $stationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StationTableMap::COL_STATION_ID, $stationId, $comparison);
    }

    /**
     * Filter the query on the station_name column
     *
     * Example usage:
     * <code>
     * $query->filterByStationName('fooValue');   // WHERE station_name = 'fooValue'
     * $query->filterByStationName('%fooValue%', Criteria::LIKE); // WHERE station_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $stationName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStationQuery The current query, for fluid interface
     */
    public function filterByStationName($stationName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($stationName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StationTableMap::COL_STATION_NAME, $stationName, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStationQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StationTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the jurisdiction_id column
     *
     * Example usage:
     * <code>
     * $query->filterByJurisdictionId(1234); // WHERE jurisdiction_id = 1234
     * $query->filterByJurisdictionId(array(12, 34)); // WHERE jurisdiction_id IN (12, 34)
     * $query->filterByJurisdictionId(array('min' => 12)); // WHERE jurisdiction_id > 12
     * </code>
     *
     * @see       filterByJurisdiction()
     *
     * @param     mixed $jurisdictionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStationQuery The current query, for fluid interface
     */
    public function filterByJurisdictionId($jurisdictionId = null, $comparison = null)
    {
        if (is_array($jurisdictionId)) {
            $useMinMax = false;
            if (isset($jurisdictionId['min'])) {
                $this->addUsingAlias(StationTableMap::COL_JURISDICTION_ID, $jurisdictionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($jurisdictionId['max'])) {
                $this->addUsingAlias(StationTableMap::COL_JURISDICTION_ID, $jurisdictionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StationTableMap::COL_JURISDICTION_ID, $jurisdictionId, $comparison);
    }

    /**
     * Filter the query by a related \Jurisdiction object
     *
     * @param \Jurisdiction|ObjectCollection $jurisdiction The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStationQuery The current query, for fluid interface
     */
    public function filterByJurisdiction($jurisdiction, $comparison = null)
    {
        if ($jurisdiction instanceof \Jurisdiction) {
            return $this
                ->addUsingAlias(StationTableMap::COL_JURISDICTION_ID, $jurisdiction->getJurisdictionId(), $comparison);
        } elseif ($jurisdiction instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(StationTableMap::COL_JURISDICTION_ID, $jurisdiction->toKeyValue('PrimaryKey', 'JurisdictionId'), $comparison);
        } else {
            throw new PropelException('filterByJurisdiction() only accepts arguments of type \Jurisdiction or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Jurisdiction relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStationQuery The current query, for fluid interface
     */
    public function joinJurisdiction($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Jurisdiction');

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
            $this->addJoinObject($join, 'Jurisdiction');
        }

        return $this;
    }

    /**
     * Use the Jurisdiction relation Jurisdiction object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JurisdictionQuery A secondary query class using the current class as primary query
     */
    public function useJurisdictionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJurisdiction($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Jurisdiction', '\JurisdictionQuery');
    }

    /**
     * Filter the query by a related \Incident object
     *
     * @param \Incident|ObjectCollection $incident the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStationQuery The current query, for fluid interface
     */
    public function filterByIncident($incident, $comparison = null)
    {
        if ($incident instanceof \Incident) {
            return $this
                ->addUsingAlias(StationTableMap::COL_STATION_ID, $incident->getStationId(), $comparison);
        } elseif ($incident instanceof ObjectCollection) {
            return $this
                ->useIncidentQuery()
                ->filterByPrimaryKeys($incident->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByIncident() only accepts arguments of type \Incident or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Incident relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStationQuery The current query, for fluid interface
     */
    public function joinIncident($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Incident');

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
            $this->addJoinObject($join, 'Incident');
        }

        return $this;
    }

    /**
     * Use the Incident relation Incident object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \IncidentQuery A secondary query class using the current class as primary query
     */
    public function useIncidentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinIncident($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Incident', '\IncidentQuery');
    }

    /**
     * Filter the query by a related \Inventory object
     *
     * @param \Inventory|ObjectCollection $inventory the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStationQuery The current query, for fluid interface
     */
    public function filterByInventory($inventory, $comparison = null)
    {
        if ($inventory instanceof \Inventory) {
            return $this
                ->addUsingAlias(StationTableMap::COL_STATION_ID, $inventory->getStationId(), $comparison);
        } elseif ($inventory instanceof ObjectCollection) {
            return $this
                ->useInventoryQuery()
                ->filterByPrimaryKeys($inventory->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByInventory() only accepts arguments of type \Inventory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Inventory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStationQuery The current query, for fluid interface
     */
    public function joinInventory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Inventory');

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
            $this->addJoinObject($join, 'Inventory');
        }

        return $this;
    }

    /**
     * Use the Inventory relation Inventory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \InventoryQuery A secondary query class using the current class as primary query
     */
    public function useInventoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinInventory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Inventory', '\InventoryQuery');
    }

    /**
     * Filter the query by a related \Personnel object
     *
     * @param \Personnel|ObjectCollection $personnel the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStationQuery The current query, for fluid interface
     */
    public function filterByPersonnel($personnel, $comparison = null)
    {
        if ($personnel instanceof \Personnel) {
            return $this
                ->addUsingAlias(StationTableMap::COL_STATION_ID, $personnel->getStationId(), $comparison);
        } elseif ($personnel instanceof ObjectCollection) {
            return $this
                ->usePersonnelQuery()
                ->filterByPrimaryKeys($personnel->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPersonnel() only accepts arguments of type \Personnel or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Personnel relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStationQuery The current query, for fluid interface
     */
    public function joinPersonnel($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Personnel');

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
            $this->addJoinObject($join, 'Personnel');
        }

        return $this;
    }

    /**
     * Use the Personnel relation Personnel object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PersonnelQuery A secondary query class using the current class as primary query
     */
    public function usePersonnelQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPersonnel($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Personnel', '\PersonnelQuery');
    }

    /**
     * Filter the query by a related \Shift object
     *
     * @param \Shift|ObjectCollection $shift the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStationQuery The current query, for fluid interface
     */
    public function filterByShift($shift, $comparison = null)
    {
        if ($shift instanceof \Shift) {
            return $this
                ->addUsingAlias(StationTableMap::COL_STATION_ID, $shift->getStationId(), $comparison);
        } elseif ($shift instanceof ObjectCollection) {
            return $this
                ->useShiftQuery()
                ->filterByPrimaryKeys($shift->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByShift() only accepts arguments of type \Shift or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Shift relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStationQuery The current query, for fluid interface
     */
    public function joinShift($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Shift');

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
            $this->addJoinObject($join, 'Shift');
        }

        return $this;
    }

    /**
     * Use the Shift relation Shift object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ShiftQuery A secondary query class using the current class as primary query
     */
    public function useShiftQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShift($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Shift', '\ShiftQuery');
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStationQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(StationTableMap::COL_STATION_ID, $user->getStationId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            return $this
                ->useUserQuery()
                ->filterByPrimaryKeys($user->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStationQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\UserQuery');
    }

    /**
     * Filter the query by a related \Vehicles object
     *
     * @param \Vehicles|ObjectCollection $vehicles the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStationQuery The current query, for fluid interface
     */
    public function filterByVehicles($vehicles, $comparison = null)
    {
        if ($vehicles instanceof \Vehicles) {
            return $this
                ->addUsingAlias(StationTableMap::COL_STATION_ID, $vehicles->getStationId(), $comparison);
        } elseif ($vehicles instanceof ObjectCollection) {
            return $this
                ->useVehiclesQuery()
                ->filterByPrimaryKeys($vehicles->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVehicles() only accepts arguments of type \Vehicles or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Vehicles relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStationQuery The current query, for fluid interface
     */
    public function joinVehicles($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Vehicles');

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
            $this->addJoinObject($join, 'Vehicles');
        }

        return $this;
    }

    /**
     * Use the Vehicles relation Vehicles object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \VehiclesQuery A secondary query class using the current class as primary query
     */
    public function useVehiclesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVehicles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Vehicles', '\VehiclesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildStation $station Object to remove from the list of results
     *
     * @return $this|ChildStationQuery The current query, for fluid interface
     */
    public function prune($station = null)
    {
        if ($station) {
            $this->addUsingAlias(StationTableMap::COL_STATION_ID, $station->getStationId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the station table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StationTableMap::clearInstancePool();
            StationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // StationQuery
