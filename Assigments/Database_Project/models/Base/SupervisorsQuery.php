<?php

namespace Base;

use \Supervisors as ChildSupervisors;
use \SupervisorsQuery as ChildSupervisorsQuery;
use \Exception;
use \PDO;
use Map\SupervisorsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'supervisors' table.
 *
 *
 *
 * @method     ChildSupervisorsQuery orderBySupervisorId($order = Criteria::ASC) Order by the supervisor_id column
 * @method     ChildSupervisorsQuery orderByRank($order = Criteria::ASC) Order by the rank column
 * @method     ChildSupervisorsQuery orderByPersonnelId($order = Criteria::ASC) Order by the personnel_id column
 *
 * @method     ChildSupervisorsQuery groupBySupervisorId() Group by the supervisor_id column
 * @method     ChildSupervisorsQuery groupByRank() Group by the rank column
 * @method     ChildSupervisorsQuery groupByPersonnelId() Group by the personnel_id column
 *
 * @method     ChildSupervisorsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSupervisorsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSupervisorsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSupervisorsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSupervisorsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSupervisorsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSupervisorsQuery leftJoinPersonnel($relationAlias = null) Adds a LEFT JOIN clause to the query using the Personnel relation
 * @method     ChildSupervisorsQuery rightJoinPersonnel($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Personnel relation
 * @method     ChildSupervisorsQuery innerJoinPersonnel($relationAlias = null) Adds a INNER JOIN clause to the query using the Personnel relation
 *
 * @method     ChildSupervisorsQuery joinWithPersonnel($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Personnel relation
 *
 * @method     ChildSupervisorsQuery leftJoinWithPersonnel() Adds a LEFT JOIN clause and with to the query using the Personnel relation
 * @method     ChildSupervisorsQuery rightJoinWithPersonnel() Adds a RIGHT JOIN clause and with to the query using the Personnel relation
 * @method     ChildSupervisorsQuery innerJoinWithPersonnel() Adds a INNER JOIN clause and with to the query using the Personnel relation
 *
 * @method     \PersonnelQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSupervisors findOne(ConnectionInterface $con = null) Return the first ChildSupervisors matching the query
 * @method     ChildSupervisors findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSupervisors matching the query, or a new ChildSupervisors object populated from the query conditions when no match is found
 *
 * @method     ChildSupervisors findOneBySupervisorId(int $supervisor_id) Return the first ChildSupervisors filtered by the supervisor_id column
 * @method     ChildSupervisors findOneByRank(int $rank) Return the first ChildSupervisors filtered by the rank column
 * @method     ChildSupervisors findOneByPersonnelId(int $personnel_id) Return the first ChildSupervisors filtered by the personnel_id column *

 * @method     ChildSupervisors requirePk($key, ConnectionInterface $con = null) Return the ChildSupervisors by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupervisors requireOne(ConnectionInterface $con = null) Return the first ChildSupervisors matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSupervisors requireOneBySupervisorId(int $supervisor_id) Return the first ChildSupervisors filtered by the supervisor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupervisors requireOneByRank(int $rank) Return the first ChildSupervisors filtered by the rank column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupervisors requireOneByPersonnelId(int $personnel_id) Return the first ChildSupervisors filtered by the personnel_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSupervisors[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSupervisors objects based on current ModelCriteria
 * @method     ChildSupervisors[]|ObjectCollection findBySupervisorId(int $supervisor_id) Return ChildSupervisors objects filtered by the supervisor_id column
 * @method     ChildSupervisors[]|ObjectCollection findByRank(int $rank) Return ChildSupervisors objects filtered by the rank column
 * @method     ChildSupervisors[]|ObjectCollection findByPersonnelId(int $personnel_id) Return ChildSupervisors objects filtered by the personnel_id column
 * @method     ChildSupervisors[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SupervisorsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SupervisorsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Supervisors', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSupervisorsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSupervisorsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSupervisorsQuery) {
            return $criteria;
        }
        $query = new ChildSupervisorsQuery();
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
     * @return ChildSupervisors|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SupervisorsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SupervisorsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSupervisors A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT supervisor_id, rank, personnel_id FROM supervisors WHERE supervisor_id = :p0';
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
            /** @var ChildSupervisors $obj */
            $obj = new ChildSupervisors();
            $obj->hydrate($row);
            SupervisorsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSupervisors|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSupervisorsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SupervisorsTableMap::COL_SUPERVISOR_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSupervisorsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SupervisorsTableMap::COL_SUPERVISOR_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the supervisor_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySupervisorId(1234); // WHERE supervisor_id = 1234
     * $query->filterBySupervisorId(array(12, 34)); // WHERE supervisor_id IN (12, 34)
     * $query->filterBySupervisorId(array('min' => 12)); // WHERE supervisor_id > 12
     * </code>
     *
     * @param     mixed $supervisorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSupervisorsQuery The current query, for fluid interface
     */
    public function filterBySupervisorId($supervisorId = null, $comparison = null)
    {
        if (is_array($supervisorId)) {
            $useMinMax = false;
            if (isset($supervisorId['min'])) {
                $this->addUsingAlias(SupervisorsTableMap::COL_SUPERVISOR_ID, $supervisorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($supervisorId['max'])) {
                $this->addUsingAlias(SupervisorsTableMap::COL_SUPERVISOR_ID, $supervisorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupervisorsTableMap::COL_SUPERVISOR_ID, $supervisorId, $comparison);
    }

    /**
     * Filter the query on the rank column
     *
     * Example usage:
     * <code>
     * $query->filterByRank(1234); // WHERE rank = 1234
     * $query->filterByRank(array(12, 34)); // WHERE rank IN (12, 34)
     * $query->filterByRank(array('min' => 12)); // WHERE rank > 12
     * </code>
     *
     * @param     mixed $rank The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSupervisorsQuery The current query, for fluid interface
     */
    public function filterByRank($rank = null, $comparison = null)
    {
        if (is_array($rank)) {
            $useMinMax = false;
            if (isset($rank['min'])) {
                $this->addUsingAlias(SupervisorsTableMap::COL_RANK, $rank['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rank['max'])) {
                $this->addUsingAlias(SupervisorsTableMap::COL_RANK, $rank['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupervisorsTableMap::COL_RANK, $rank, $comparison);
    }

    /**
     * Filter the query on the personnel_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonnelId(1234); // WHERE personnel_id = 1234
     * $query->filterByPersonnelId(array(12, 34)); // WHERE personnel_id IN (12, 34)
     * $query->filterByPersonnelId(array('min' => 12)); // WHERE personnel_id > 12
     * </code>
     *
     * @see       filterByPersonnel()
     *
     * @param     mixed $personnelId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSupervisorsQuery The current query, for fluid interface
     */
    public function filterByPersonnelId($personnelId = null, $comparison = null)
    {
        if (is_array($personnelId)) {
            $useMinMax = false;
            if (isset($personnelId['min'])) {
                $this->addUsingAlias(SupervisorsTableMap::COL_PERSONNEL_ID, $personnelId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($personnelId['max'])) {
                $this->addUsingAlias(SupervisorsTableMap::COL_PERSONNEL_ID, $personnelId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupervisorsTableMap::COL_PERSONNEL_ID, $personnelId, $comparison);
    }

    /**
     * Filter the query by a related \Personnel object
     *
     * @param \Personnel|ObjectCollection $personnel The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSupervisorsQuery The current query, for fluid interface
     */
    public function filterByPersonnel($personnel, $comparison = null)
    {
        if ($personnel instanceof \Personnel) {
            return $this
                ->addUsingAlias(SupervisorsTableMap::COL_PERSONNEL_ID, $personnel->getPersonnelId(), $comparison);
        } elseif ($personnel instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SupervisorsTableMap::COL_PERSONNEL_ID, $personnel->toKeyValue('PrimaryKey', 'PersonnelId'), $comparison);
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
     * @return $this|ChildSupervisorsQuery The current query, for fluid interface
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
     * @param   ChildSupervisors $supervisors Object to remove from the list of results
     *
     * @return $this|ChildSupervisorsQuery The current query, for fluid interface
     */
    public function prune($supervisors = null)
    {
        if ($supervisors) {
            $this->addUsingAlias(SupervisorsTableMap::COL_SUPERVISOR_ID, $supervisors->getSupervisorId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the supervisors table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SupervisorsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SupervisorsTableMap::clearInstancePool();
            SupervisorsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SupervisorsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SupervisorsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SupervisorsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SupervisorsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SupervisorsQuery
