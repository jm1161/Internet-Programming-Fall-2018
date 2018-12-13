<?php

namespace Base;

use \Shift as ChildShift;
use \ShiftQuery as ChildShiftQuery;
use \Exception;
use \PDO;
use Map\ShiftTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'shift' table.
 *
 *
 *
 * @method     ChildShiftQuery orderByShiftId($order = Criteria::ASC) Order by the shift_id column
 * @method     ChildShiftQuery orderByShiftName($order = Criteria::ASC) Order by the shift_name column
 * @method     ChildShiftQuery orderByStationId($order = Criteria::ASC) Order by the station_id column
 *
 * @method     ChildShiftQuery groupByShiftId() Group by the shift_id column
 * @method     ChildShiftQuery groupByShiftName() Group by the shift_name column
 * @method     ChildShiftQuery groupByStationId() Group by the station_id column
 *
 * @method     ChildShiftQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShiftQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShiftQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShiftQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildShiftQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildShiftQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildShiftQuery leftJoinStation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Station relation
 * @method     ChildShiftQuery rightJoinStation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Station relation
 * @method     ChildShiftQuery innerJoinStation($relationAlias = null) Adds a INNER JOIN clause to the query using the Station relation
 *
 * @method     ChildShiftQuery joinWithStation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Station relation
 *
 * @method     ChildShiftQuery leftJoinWithStation() Adds a LEFT JOIN clause and with to the query using the Station relation
 * @method     ChildShiftQuery rightJoinWithStation() Adds a RIGHT JOIN clause and with to the query using the Station relation
 * @method     ChildShiftQuery innerJoinWithStation() Adds a INNER JOIN clause and with to the query using the Station relation
 *
 * @method     ChildShiftQuery leftJoinPersonnel($relationAlias = null) Adds a LEFT JOIN clause to the query using the Personnel relation
 * @method     ChildShiftQuery rightJoinPersonnel($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Personnel relation
 * @method     ChildShiftQuery innerJoinPersonnel($relationAlias = null) Adds a INNER JOIN clause to the query using the Personnel relation
 *
 * @method     ChildShiftQuery joinWithPersonnel($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Personnel relation
 *
 * @method     ChildShiftQuery leftJoinWithPersonnel() Adds a LEFT JOIN clause and with to the query using the Personnel relation
 * @method     ChildShiftQuery rightJoinWithPersonnel() Adds a RIGHT JOIN clause and with to the query using the Personnel relation
 * @method     ChildShiftQuery innerJoinWithPersonnel() Adds a INNER JOIN clause and with to the query using the Personnel relation
 *
 * @method     \StationQuery|\PersonnelQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildShift findOne(ConnectionInterface $con = null) Return the first ChildShift matching the query
 * @method     ChildShift findOneOrCreate(ConnectionInterface $con = null) Return the first ChildShift matching the query, or a new ChildShift object populated from the query conditions when no match is found
 *
 * @method     ChildShift findOneByShiftId(int $shift_id) Return the first ChildShift filtered by the shift_id column
 * @method     ChildShift findOneByShiftName(string $shift_name) Return the first ChildShift filtered by the shift_name column
 * @method     ChildShift findOneByStationId(int $station_id) Return the first ChildShift filtered by the station_id column *

 * @method     ChildShift requirePk($key, ConnectionInterface $con = null) Return the ChildShift by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShift requireOne(ConnectionInterface $con = null) Return the first ChildShift matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShift requireOneByShiftId(int $shift_id) Return the first ChildShift filtered by the shift_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShift requireOneByShiftName(string $shift_name) Return the first ChildShift filtered by the shift_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShift requireOneByStationId(int $station_id) Return the first ChildShift filtered by the station_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShift[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildShift objects based on current ModelCriteria
 * @method     ChildShift[]|ObjectCollection findByShiftId(int $shift_id) Return ChildShift objects filtered by the shift_id column
 * @method     ChildShift[]|ObjectCollection findByShiftName(string $shift_name) Return ChildShift objects filtered by the shift_name column
 * @method     ChildShift[]|ObjectCollection findByStationId(int $station_id) Return ChildShift objects filtered by the station_id column
 * @method     ChildShift[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ShiftQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ShiftQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Shift', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShiftQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShiftQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildShiftQuery) {
            return $criteria;
        }
        $query = new ChildShiftQuery();
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
     * @return ChildShift|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShiftTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ShiftTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildShift A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT shift_id, shift_name, station_id FROM shift WHERE shift_id = :p0';
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
            /** @var ChildShift $obj */
            $obj = new ChildShift();
            $obj->hydrate($row);
            ShiftTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildShift|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildShiftQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ShiftTableMap::COL_SHIFT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildShiftQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ShiftTableMap::COL_SHIFT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the shift_id column
     *
     * Example usage:
     * <code>
     * $query->filterByShiftId(1234); // WHERE shift_id = 1234
     * $query->filterByShiftId(array(12, 34)); // WHERE shift_id IN (12, 34)
     * $query->filterByShiftId(array('min' => 12)); // WHERE shift_id > 12
     * </code>
     *
     * @param     mixed $shiftId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShiftQuery The current query, for fluid interface
     */
    public function filterByShiftId($shiftId = null, $comparison = null)
    {
        if (is_array($shiftId)) {
            $useMinMax = false;
            if (isset($shiftId['min'])) {
                $this->addUsingAlias(ShiftTableMap::COL_SHIFT_ID, $shiftId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shiftId['max'])) {
                $this->addUsingAlias(ShiftTableMap::COL_SHIFT_ID, $shiftId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShiftTableMap::COL_SHIFT_ID, $shiftId, $comparison);
    }

    /**
     * Filter the query on the shift_name column
     *
     * Example usage:
     * <code>
     * $query->filterByShiftName('fooValue');   // WHERE shift_name = 'fooValue'
     * $query->filterByShiftName('%fooValue%', Criteria::LIKE); // WHERE shift_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $shiftName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShiftQuery The current query, for fluid interface
     */
    public function filterByShiftName($shiftName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shiftName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShiftTableMap::COL_SHIFT_NAME, $shiftName, $comparison);
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
     * @return $this|ChildShiftQuery The current query, for fluid interface
     */
    public function filterByStationId($stationId = null, $comparison = null)
    {
        if (is_array($stationId)) {
            $useMinMax = false;
            if (isset($stationId['min'])) {
                $this->addUsingAlias(ShiftTableMap::COL_STATION_ID, $stationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stationId['max'])) {
                $this->addUsingAlias(ShiftTableMap::COL_STATION_ID, $stationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShiftTableMap::COL_STATION_ID, $stationId, $comparison);
    }

    /**
     * Filter the query by a related \Station object
     *
     * @param \Station|ObjectCollection $station The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildShiftQuery The current query, for fluid interface
     */
    public function filterByStation($station, $comparison = null)
    {
        if ($station instanceof \Station) {
            return $this
                ->addUsingAlias(ShiftTableMap::COL_STATION_ID, $station->getStationId(), $comparison);
        } elseif ($station instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ShiftTableMap::COL_STATION_ID, $station->toKeyValue('PrimaryKey', 'StationId'), $comparison);
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
     * @return $this|ChildShiftQuery The current query, for fluid interface
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
     * Filter the query by a related \Personnel object
     *
     * @param \Personnel|ObjectCollection $personnel the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildShiftQuery The current query, for fluid interface
     */
    public function filterByPersonnel($personnel, $comparison = null)
    {
        if ($personnel instanceof \Personnel) {
            return $this
                ->addUsingAlias(ShiftTableMap::COL_SHIFT_ID, $personnel->getShiftId(), $comparison);
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
     * @return $this|ChildShiftQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildShift $shift Object to remove from the list of results
     *
     * @return $this|ChildShiftQuery The current query, for fluid interface
     */
    public function prune($shift = null)
    {
        if ($shift) {
            $this->addUsingAlias(ShiftTableMap::COL_SHIFT_ID, $shift->getShiftId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the shift table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShiftTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShiftTableMap::clearInstancePool();
            ShiftTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ShiftTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShiftTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShiftTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShiftTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ShiftQuery
