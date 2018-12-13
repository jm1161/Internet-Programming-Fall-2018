<?php

namespace Base;

use \Certifications as ChildCertifications;
use \CertificationsQuery as ChildCertificationsQuery;
use \Exception;
use \PDO;
use Map\CertificationsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'certifications' table.
 *
 *
 *
 * @method     ChildCertificationsQuery orderByCertificationId($order = Criteria::ASC) Order by the certification_id column
 * @method     ChildCertificationsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCertificationsQuery orderByCertificationNumber($order = Criteria::ASC) Order by the certification_number column
 *
 * @method     ChildCertificationsQuery groupByCertificationId() Group by the certification_id column
 * @method     ChildCertificationsQuery groupByName() Group by the name column
 * @method     ChildCertificationsQuery groupByCertificationNumber() Group by the certification_number column
 *
 * @method     ChildCertificationsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCertificationsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCertificationsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCertificationsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCertificationsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCertificationsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCertificationsQuery leftJoinPersonnel($relationAlias = null) Adds a LEFT JOIN clause to the query using the Personnel relation
 * @method     ChildCertificationsQuery rightJoinPersonnel($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Personnel relation
 * @method     ChildCertificationsQuery innerJoinPersonnel($relationAlias = null) Adds a INNER JOIN clause to the query using the Personnel relation
 *
 * @method     ChildCertificationsQuery joinWithPersonnel($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Personnel relation
 *
 * @method     ChildCertificationsQuery leftJoinWithPersonnel() Adds a LEFT JOIN clause and with to the query using the Personnel relation
 * @method     ChildCertificationsQuery rightJoinWithPersonnel() Adds a RIGHT JOIN clause and with to the query using the Personnel relation
 * @method     ChildCertificationsQuery innerJoinWithPersonnel() Adds a INNER JOIN clause and with to the query using the Personnel relation
 *
 * @method     \PersonnelQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCertifications findOne(ConnectionInterface $con = null) Return the first ChildCertifications matching the query
 * @method     ChildCertifications findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCertifications matching the query, or a new ChildCertifications object populated from the query conditions when no match is found
 *
 * @method     ChildCertifications findOneByCertificationId(int $certification_id) Return the first ChildCertifications filtered by the certification_id column
 * @method     ChildCertifications findOneByName(string $name) Return the first ChildCertifications filtered by the name column
 * @method     ChildCertifications findOneByCertificationNumber(string $certification_number) Return the first ChildCertifications filtered by the certification_number column *

 * @method     ChildCertifications requirePk($key, ConnectionInterface $con = null) Return the ChildCertifications by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCertifications requireOne(ConnectionInterface $con = null) Return the first ChildCertifications matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCertifications requireOneByCertificationId(int $certification_id) Return the first ChildCertifications filtered by the certification_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCertifications requireOneByName(string $name) Return the first ChildCertifications filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCertifications requireOneByCertificationNumber(string $certification_number) Return the first ChildCertifications filtered by the certification_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCertifications[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCertifications objects based on current ModelCriteria
 * @method     ChildCertifications[]|ObjectCollection findByCertificationId(int $certification_id) Return ChildCertifications objects filtered by the certification_id column
 * @method     ChildCertifications[]|ObjectCollection findByName(string $name) Return ChildCertifications objects filtered by the name column
 * @method     ChildCertifications[]|ObjectCollection findByCertificationNumber(string $certification_number) Return ChildCertifications objects filtered by the certification_number column
 * @method     ChildCertifications[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CertificationsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CertificationsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Certifications', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCertificationsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCertificationsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCertificationsQuery) {
            return $criteria;
        }
        $query = new ChildCertificationsQuery();
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
     * @return ChildCertifications|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CertificationsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CertificationsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCertifications A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT certification_id, name, certification_number FROM certifications WHERE certification_id = :p0';
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
            /** @var ChildCertifications $obj */
            $obj = new ChildCertifications();
            $obj->hydrate($row);
            CertificationsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCertifications|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCertificationsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CertificationsTableMap::COL_CERTIFICATION_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCertificationsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CertificationsTableMap::COL_CERTIFICATION_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the certification_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCertificationId(1234); // WHERE certification_id = 1234
     * $query->filterByCertificationId(array(12, 34)); // WHERE certification_id IN (12, 34)
     * $query->filterByCertificationId(array('min' => 12)); // WHERE certification_id > 12
     * </code>
     *
     * @param     mixed $certificationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCertificationsQuery The current query, for fluid interface
     */
    public function filterByCertificationId($certificationId = null, $comparison = null)
    {
        if (is_array($certificationId)) {
            $useMinMax = false;
            if (isset($certificationId['min'])) {
                $this->addUsingAlias(CertificationsTableMap::COL_CERTIFICATION_ID, $certificationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($certificationId['max'])) {
                $this->addUsingAlias(CertificationsTableMap::COL_CERTIFICATION_ID, $certificationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CertificationsTableMap::COL_CERTIFICATION_ID, $certificationId, $comparison);
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
     * @return $this|ChildCertificationsQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CertificationsTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the certification_number column
     *
     * Example usage:
     * <code>
     * $query->filterByCertificationNumber('fooValue');   // WHERE certification_number = 'fooValue'
     * $query->filterByCertificationNumber('%fooValue%', Criteria::LIKE); // WHERE certification_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $certificationNumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCertificationsQuery The current query, for fluid interface
     */
    public function filterByCertificationNumber($certificationNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($certificationNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CertificationsTableMap::COL_CERTIFICATION_NUMBER, $certificationNumber, $comparison);
    }

    /**
     * Filter the query by a related \Personnel object
     *
     * @param \Personnel|ObjectCollection $personnel the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCertificationsQuery The current query, for fluid interface
     */
    public function filterByPersonnel($personnel, $comparison = null)
    {
        if ($personnel instanceof \Personnel) {
            return $this
                ->addUsingAlias(CertificationsTableMap::COL_CERTIFICATION_ID, $personnel->getCertificationId(), $comparison);
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
     * @return $this|ChildCertificationsQuery The current query, for fluid interface
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
     * @param   ChildCertifications $certifications Object to remove from the list of results
     *
     * @return $this|ChildCertificationsQuery The current query, for fluid interface
     */
    public function prune($certifications = null)
    {
        if ($certifications) {
            $this->addUsingAlias(CertificationsTableMap::COL_CERTIFICATION_ID, $certifications->getCertificationId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the certifications table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CertificationsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CertificationsTableMap::clearInstancePool();
            CertificationsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CertificationsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CertificationsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CertificationsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CertificationsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CertificationsQuery
