<?php

namespace Base;

use \Incident as ChildIncident;
use \IncidentQuery as ChildIncidentQuery;
use \Exception;
use \PDO;
use Map\IncidentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'incident' table.
 *
 *
 *
 * @method     ChildIncidentQuery orderByIncidentId($order = Criteria::ASC) Order by the incident_id column
 * @method     ChildIncidentQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildIncidentQuery orderByIncidentType($order = Criteria::ASC) Order by the incident_type column
 * @method     ChildIncidentQuery orderByLocation($order = Criteria::ASC) Order by the location column
 * @method     ChildIncidentQuery orderByStationId($order = Criteria::ASC) Order by the station_id column
 *
 * @method     ChildIncidentQuery groupByIncidentId() Group by the incident_id column
 * @method     ChildIncidentQuery groupByDate() Group by the date column
 * @method     ChildIncidentQuery groupByIncidentType() Group by the incident_type column
 * @method     ChildIncidentQuery groupByLocation() Group by the location column
 * @method     ChildIncidentQuery groupByStationId() Group by the station_id column
 *
 * @method     ChildIncidentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildIncidentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildIncidentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildIncidentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildIncidentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildIncidentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildIncidentQuery leftJoinStation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Station relation
 * @method     ChildIncidentQuery rightJoinStation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Station relation
 * @method     ChildIncidentQuery innerJoinStation($relationAlias = null) Adds a INNER JOIN clause to the query using the Station relation
 *
 * @method     ChildIncidentQuery joinWithStation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Station relation
 *
 * @method     ChildIncidentQuery leftJoinWithStation() Adds a LEFT JOIN clause and with to the query using the Station relation
 * @method     ChildIncidentQuery rightJoinWithStation() Adds a RIGHT JOIN clause and with to the query using the Station relation
 * @method     ChildIncidentQuery innerJoinWithStation() Adds a INNER JOIN clause and with to the query using the Station relation
 *
 * @method     ChildIncidentQuery leftJoinInvolvedParty($relationAlias = null) Adds a LEFT JOIN clause to the query using the InvolvedParty relation
 * @method     ChildIncidentQuery rightJoinInvolvedParty($relationAlias = null) Adds a RIGHT JOIN clause to the query using the InvolvedParty relation
 * @method     ChildIncidentQuery innerJoinInvolvedParty($relationAlias = null) Adds a INNER JOIN clause to the query using the InvolvedParty relation
 *
 * @method     ChildIncidentQuery joinWithInvolvedParty($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the InvolvedParty relation
 *
 * @method     ChildIncidentQuery leftJoinWithInvolvedParty() Adds a LEFT JOIN clause and with to the query using the InvolvedParty relation
 * @method     ChildIncidentQuery rightJoinWithInvolvedParty() Adds a RIGHT JOIN clause and with to the query using the InvolvedParty relation
 * @method     ChildIncidentQuery innerJoinWithInvolvedParty() Adds a INNER JOIN clause and with to the query using the InvolvedParty relation
 *
 * @method     \StationQuery|\InvolvedPartyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildIncident findOne(ConnectionInterface $con = null) Return the first ChildIncident matching the query
 * @method     ChildIncident findOneOrCreate(ConnectionInterface $con = null) Return the first ChildIncident matching the query, or a new ChildIncident object populated from the query conditions when no match is found
 *
 * @method     ChildIncident findOneByIncidentId(int $incident_id) Return the first ChildIncident filtered by the incident_id column
 * @method     ChildIncident findOneByDate(int $date) Return the first ChildIncident filtered by the date column
 * @method     ChildIncident findOneByIncidentType(string $incident_type) Return the first ChildIncident filtered by the incident_type column
 * @method     ChildIncident findOneByLocation(int $location) Return the first ChildIncident filtered by the location column
 * @method     ChildIncident findOneByStationId(int $station_id) Return the first ChildIncident filtered by the station_id column *

 * @method     ChildIncident requirePk($key, ConnectionInterface $con = null) Return the ChildIncident by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIncident requireOne(ConnectionInterface $con = null) Return the first ChildIncident matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIncident requireOneByIncidentId(int $incident_id) Return the first ChildIncident filtered by the incident_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIncident requireOneByDate(int $date) Return the first ChildIncident filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIncident requireOneByIncidentType(string $incident_type) Return the first ChildIncident filtered by the incident_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIncident requireOneByLocation(int $location) Return the first ChildIncident filtered by the location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildIncident requireOneByStationId(int $station_id) Return the first ChildIncident filtered by the station_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildIncident[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildIncident objects based on current ModelCriteria
 * @method     ChildIncident[]|ObjectCollection findByIncidentId(int $incident_id) Return ChildIncident objects filtered by the incident_id column
 * @method     ChildIncident[]|ObjectCollection findByDate(int $date) Return ChildIncident objects filtered by the date column
 * @method     ChildIncident[]|ObjectCollection findByIncidentType(string $incident_type) Return ChildIncident objects filtered by the incident_type column
 * @method     ChildIncident[]|ObjectCollection findByLocation(int $location) Return ChildIncident objects filtered by the location column
 * @method     ChildIncident[]|ObjectCollection findByStationId(int $station_id) Return ChildIncident objects filtered by the station_id column
 * @method     ChildIncident[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class IncidentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\IncidentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Incident', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildIncidentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildIncidentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildIncidentQuery) {
            return $criteria;
        }
        $query = new ChildIncidentQuery();
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
     * @return ChildIncident|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(IncidentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = IncidentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildIncident A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT incident_id, date, incident_type, location, station_id FROM incident WHERE incident_id = :p0';
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
            /** @var ChildIncident $obj */
            $obj = new ChildIncident();
            $obj->hydrate($row);
            IncidentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildIncident|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildIncidentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(IncidentTableMap::COL_INCIDENT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildIncidentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(IncidentTableMap::COL_INCIDENT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the incident_id column
     *
     * Example usage:
     * <code>
     * $query->filterByIncidentId(1234); // WHERE incident_id = 1234
     * $query->filterByIncidentId(array(12, 34)); // WHERE incident_id IN (12, 34)
     * $query->filterByIncidentId(array('min' => 12)); // WHERE incident_id > 12
     * </code>
     *
     * @param     mixed $incidentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIncidentQuery The current query, for fluid interface
     */
    public function filterByIncidentId($incidentId = null, $comparison = null)
    {
        if (is_array($incidentId)) {
            $useMinMax = false;
            if (isset($incidentId['min'])) {
                $this->addUsingAlias(IncidentTableMap::COL_INCIDENT_ID, $incidentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($incidentId['max'])) {
                $this->addUsingAlias(IncidentTableMap::COL_INCIDENT_ID, $incidentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IncidentTableMap::COL_INCIDENT_ID, $incidentId, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate(1234); // WHERE date = 1234
     * $query->filterByDate(array(12, 34)); // WHERE date IN (12, 34)
     * $query->filterByDate(array('min' => 12)); // WHERE date > 12
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIncidentQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(IncidentTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(IncidentTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IncidentTableMap::COL_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the incident_type column
     *
     * Example usage:
     * <code>
     * $query->filterByIncidentType('fooValue');   // WHERE incident_type = 'fooValue'
     * $query->filterByIncidentType('%fooValue%', Criteria::LIKE); // WHERE incident_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $incidentType The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIncidentQuery The current query, for fluid interface
     */
    public function filterByIncidentType($incidentType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($incidentType)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IncidentTableMap::COL_INCIDENT_TYPE, $incidentType, $comparison);
    }

    /**
     * Filter the query on the location column
     *
     * Example usage:
     * <code>
     * $query->filterByLocation(1234); // WHERE location = 1234
     * $query->filterByLocation(array(12, 34)); // WHERE location IN (12, 34)
     * $query->filterByLocation(array('min' => 12)); // WHERE location > 12
     * </code>
     *
     * @param     mixed $location The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildIncidentQuery The current query, for fluid interface
     */
    public function filterByLocation($location = null, $comparison = null)
    {
        if (is_array($location)) {
            $useMinMax = false;
            if (isset($location['min'])) {
                $this->addUsingAlias(IncidentTableMap::COL_LOCATION, $location['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($location['max'])) {
                $this->addUsingAlias(IncidentTableMap::COL_LOCATION, $location['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IncidentTableMap::COL_LOCATION, $location, $comparison);
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
     * @return $this|ChildIncidentQuery The current query, for fluid interface
     */
    public function filterByStationId($stationId = null, $comparison = null)
    {
        if (is_array($stationId)) {
            $useMinMax = false;
            if (isset($stationId['min'])) {
                $this->addUsingAlias(IncidentTableMap::COL_STATION_ID, $stationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stationId['max'])) {
                $this->addUsingAlias(IncidentTableMap::COL_STATION_ID, $stationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(IncidentTableMap::COL_STATION_ID, $stationId, $comparison);
    }

    /**
     * Filter the query by a related \Station object
     *
     * @param \Station|ObjectCollection $station The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildIncidentQuery The current query, for fluid interface
     */
    public function filterByStation($station, $comparison = null)
    {
        if ($station instanceof \Station) {
            return $this
                ->addUsingAlias(IncidentTableMap::COL_STATION_ID, $station->getStationId(), $comparison);
        } elseif ($station instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(IncidentTableMap::COL_STATION_ID, $station->toKeyValue('PrimaryKey', 'StationId'), $comparison);
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
     * @return $this|ChildIncidentQuery The current query, for fluid interface
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
     * Filter the query by a related \InvolvedParty object
     *
     * @param \InvolvedParty|ObjectCollection $involvedParty the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildIncidentQuery The current query, for fluid interface
     */
    public function filterByInvolvedParty($involvedParty, $comparison = null)
    {
        if ($involvedParty instanceof \InvolvedParty) {
            return $this
                ->addUsingAlias(IncidentTableMap::COL_INCIDENT_ID, $involvedParty->getIncidentId(), $comparison);
        } elseif ($involvedParty instanceof ObjectCollection) {
            return $this
                ->useInvolvedPartyQuery()
                ->filterByPrimaryKeys($involvedParty->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByInvolvedParty() only accepts arguments of type \InvolvedParty or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the InvolvedParty relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildIncidentQuery The current query, for fluid interface
     */
    public function joinInvolvedParty($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('InvolvedParty');

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
            $this->addJoinObject($join, 'InvolvedParty');
        }

        return $this;
    }

    /**
     * Use the InvolvedParty relation InvolvedParty object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \InvolvedPartyQuery A secondary query class using the current class as primary query
     */
    public function useInvolvedPartyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinInvolvedParty($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'InvolvedParty', '\InvolvedPartyQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildIncident $incident Object to remove from the list of results
     *
     * @return $this|ChildIncidentQuery The current query, for fluid interface
     */
    public function prune($incident = null)
    {
        if ($incident) {
            $this->addUsingAlias(IncidentTableMap::COL_INCIDENT_ID, $incident->getIncidentId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the incident table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(IncidentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            IncidentTableMap::clearInstancePool();
            IncidentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(IncidentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(IncidentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            IncidentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            IncidentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // IncidentQuery
