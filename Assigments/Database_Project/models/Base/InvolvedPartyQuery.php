<?php

namespace Base;

use \InvolvedParty as ChildInvolvedParty;
use \InvolvedPartyQuery as ChildInvolvedPartyQuery;
use \Exception;
use \PDO;
use Map\InvolvedPartyTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'involved_party' table.
 *
 *
 *
 * @method     ChildInvolvedPartyQuery orderByInvolvedPartyId($order = Criteria::ASC) Order by the involved_party_id column
 * @method     ChildInvolvedPartyQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildInvolvedPartyQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildInvolvedPartyQuery orderByDriverLicense($order = Criteria::ASC) Order by the driver_license column
 * @method     ChildInvolvedPartyQuery orderByPhoneNumber($order = Criteria::ASC) Order by the phone_number column
 * @method     ChildInvolvedPartyQuery orderByInsuranceNumber($order = Criteria::ASC) Order by the insurance_number column
 * @method     ChildInvolvedPartyQuery orderByIncidentId($order = Criteria::ASC) Order by the incident_id column
 *
 * @method     ChildInvolvedPartyQuery groupByInvolvedPartyId() Group by the involved_party_id column
 * @method     ChildInvolvedPartyQuery groupByName() Group by the name column
 * @method     ChildInvolvedPartyQuery groupByAddress() Group by the address column
 * @method     ChildInvolvedPartyQuery groupByDriverLicense() Group by the driver_license column
 * @method     ChildInvolvedPartyQuery groupByPhoneNumber() Group by the phone_number column
 * @method     ChildInvolvedPartyQuery groupByInsuranceNumber() Group by the insurance_number column
 * @method     ChildInvolvedPartyQuery groupByIncidentId() Group by the incident_id column
 *
 * @method     ChildInvolvedPartyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildInvolvedPartyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildInvolvedPartyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildInvolvedPartyQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildInvolvedPartyQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildInvolvedPartyQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildInvolvedPartyQuery leftJoinIncident($relationAlias = null) Adds a LEFT JOIN clause to the query using the Incident relation
 * @method     ChildInvolvedPartyQuery rightJoinIncident($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Incident relation
 * @method     ChildInvolvedPartyQuery innerJoinIncident($relationAlias = null) Adds a INNER JOIN clause to the query using the Incident relation
 *
 * @method     ChildInvolvedPartyQuery joinWithIncident($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Incident relation
 *
 * @method     ChildInvolvedPartyQuery leftJoinWithIncident() Adds a LEFT JOIN clause and with to the query using the Incident relation
 * @method     ChildInvolvedPartyQuery rightJoinWithIncident() Adds a RIGHT JOIN clause and with to the query using the Incident relation
 * @method     ChildInvolvedPartyQuery innerJoinWithIncident() Adds a INNER JOIN clause and with to the query using the Incident relation
 *
 * @method     \IncidentQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildInvolvedParty findOne(ConnectionInterface $con = null) Return the first ChildInvolvedParty matching the query
 * @method     ChildInvolvedParty findOneOrCreate(ConnectionInterface $con = null) Return the first ChildInvolvedParty matching the query, or a new ChildInvolvedParty object populated from the query conditions when no match is found
 *
 * @method     ChildInvolvedParty findOneByInvolvedPartyId(int $involved_party_id) Return the first ChildInvolvedParty filtered by the involved_party_id column
 * @method     ChildInvolvedParty findOneByName(string $name) Return the first ChildInvolvedParty filtered by the name column
 * @method     ChildInvolvedParty findOneByAddress(string $address) Return the first ChildInvolvedParty filtered by the address column
 * @method     ChildInvolvedParty findOneByDriverLicense(string $driver_license) Return the first ChildInvolvedParty filtered by the driver_license column
 * @method     ChildInvolvedParty findOneByPhoneNumber(string $phone_number) Return the first ChildInvolvedParty filtered by the phone_number column
 * @method     ChildInvolvedParty findOneByInsuranceNumber(string $insurance_number) Return the first ChildInvolvedParty filtered by the insurance_number column
 * @method     ChildInvolvedParty findOneByIncidentId(int $incident_id) Return the first ChildInvolvedParty filtered by the incident_id column *

 * @method     ChildInvolvedParty requirePk($key, ConnectionInterface $con = null) Return the ChildInvolvedParty by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvolvedParty requireOne(ConnectionInterface $con = null) Return the first ChildInvolvedParty matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInvolvedParty requireOneByInvolvedPartyId(int $involved_party_id) Return the first ChildInvolvedParty filtered by the involved_party_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvolvedParty requireOneByName(string $name) Return the first ChildInvolvedParty filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvolvedParty requireOneByAddress(string $address) Return the first ChildInvolvedParty filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvolvedParty requireOneByDriverLicense(string $driver_license) Return the first ChildInvolvedParty filtered by the driver_license column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvolvedParty requireOneByPhoneNumber(string $phone_number) Return the first ChildInvolvedParty filtered by the phone_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvolvedParty requireOneByInsuranceNumber(string $insurance_number) Return the first ChildInvolvedParty filtered by the insurance_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInvolvedParty requireOneByIncidentId(int $incident_id) Return the first ChildInvolvedParty filtered by the incident_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInvolvedParty[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildInvolvedParty objects based on current ModelCriteria
 * @method     ChildInvolvedParty[]|ObjectCollection findByInvolvedPartyId(int $involved_party_id) Return ChildInvolvedParty objects filtered by the involved_party_id column
 * @method     ChildInvolvedParty[]|ObjectCollection findByName(string $name) Return ChildInvolvedParty objects filtered by the name column
 * @method     ChildInvolvedParty[]|ObjectCollection findByAddress(string $address) Return ChildInvolvedParty objects filtered by the address column
 * @method     ChildInvolvedParty[]|ObjectCollection findByDriverLicense(string $driver_license) Return ChildInvolvedParty objects filtered by the driver_license column
 * @method     ChildInvolvedParty[]|ObjectCollection findByPhoneNumber(string $phone_number) Return ChildInvolvedParty objects filtered by the phone_number column
 * @method     ChildInvolvedParty[]|ObjectCollection findByInsuranceNumber(string $insurance_number) Return ChildInvolvedParty objects filtered by the insurance_number column
 * @method     ChildInvolvedParty[]|ObjectCollection findByIncidentId(int $incident_id) Return ChildInvolvedParty objects filtered by the incident_id column
 * @method     ChildInvolvedParty[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class InvolvedPartyQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\InvolvedPartyQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\InvolvedParty', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildInvolvedPartyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildInvolvedPartyQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildInvolvedPartyQuery) {
            return $criteria;
        }
        $query = new ChildInvolvedPartyQuery();
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
     * @return ChildInvolvedParty|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(InvolvedPartyTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = InvolvedPartyTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildInvolvedParty A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT involved_party_id, name, address, driver_license, phone_number, insurance_number, incident_id FROM involved_party WHERE involved_party_id = :p0';
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
            /** @var ChildInvolvedParty $obj */
            $obj = new ChildInvolvedParty();
            $obj->hydrate($row);
            InvolvedPartyTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildInvolvedParty|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildInvolvedPartyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(InvolvedPartyTableMap::COL_INVOLVED_PARTY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildInvolvedPartyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(InvolvedPartyTableMap::COL_INVOLVED_PARTY_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the involved_party_id column
     *
     * Example usage:
     * <code>
     * $query->filterByInvolvedPartyId(1234); // WHERE involved_party_id = 1234
     * $query->filterByInvolvedPartyId(array(12, 34)); // WHERE involved_party_id IN (12, 34)
     * $query->filterByInvolvedPartyId(array('min' => 12)); // WHERE involved_party_id > 12
     * </code>
     *
     * @param     mixed $involvedPartyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvolvedPartyQuery The current query, for fluid interface
     */
    public function filterByInvolvedPartyId($involvedPartyId = null, $comparison = null)
    {
        if (is_array($involvedPartyId)) {
            $useMinMax = false;
            if (isset($involvedPartyId['min'])) {
                $this->addUsingAlias(InvolvedPartyTableMap::COL_INVOLVED_PARTY_ID, $involvedPartyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($involvedPartyId['max'])) {
                $this->addUsingAlias(InvolvedPartyTableMap::COL_INVOLVED_PARTY_ID, $involvedPartyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvolvedPartyTableMap::COL_INVOLVED_PARTY_ID, $involvedPartyId, $comparison);
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
     * @return $this|ChildInvolvedPartyQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvolvedPartyTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildInvolvedPartyQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvolvedPartyTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the driver_license column
     *
     * Example usage:
     * <code>
     * $query->filterByDriverLicense('fooValue');   // WHERE driver_license = 'fooValue'
     * $query->filterByDriverLicense('%fooValue%', Criteria::LIKE); // WHERE driver_license LIKE '%fooValue%'
     * </code>
     *
     * @param     string $driverLicense The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvolvedPartyQuery The current query, for fluid interface
     */
    public function filterByDriverLicense($driverLicense = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($driverLicense)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvolvedPartyTableMap::COL_DRIVER_LICENSE, $driverLicense, $comparison);
    }

    /**
     * Filter the query on the phone_number column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoneNumber('fooValue');   // WHERE phone_number = 'fooValue'
     * $query->filterByPhoneNumber('%fooValue%', Criteria::LIKE); // WHERE phone_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phoneNumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvolvedPartyQuery The current query, for fluid interface
     */
    public function filterByPhoneNumber($phoneNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvolvedPartyTableMap::COL_PHONE_NUMBER, $phoneNumber, $comparison);
    }

    /**
     * Filter the query on the insurance_number column
     *
     * Example usage:
     * <code>
     * $query->filterByInsuranceNumber('fooValue');   // WHERE insurance_number = 'fooValue'
     * $query->filterByInsuranceNumber('%fooValue%', Criteria::LIKE); // WHERE insurance_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $insuranceNumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvolvedPartyQuery The current query, for fluid interface
     */
    public function filterByInsuranceNumber($insuranceNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($insuranceNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvolvedPartyTableMap::COL_INSURANCE_NUMBER, $insuranceNumber, $comparison);
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
     * @see       filterByIncident()
     *
     * @param     mixed $incidentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInvolvedPartyQuery The current query, for fluid interface
     */
    public function filterByIncidentId($incidentId = null, $comparison = null)
    {
        if (is_array($incidentId)) {
            $useMinMax = false;
            if (isset($incidentId['min'])) {
                $this->addUsingAlias(InvolvedPartyTableMap::COL_INCIDENT_ID, $incidentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($incidentId['max'])) {
                $this->addUsingAlias(InvolvedPartyTableMap::COL_INCIDENT_ID, $incidentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InvolvedPartyTableMap::COL_INCIDENT_ID, $incidentId, $comparison);
    }

    /**
     * Filter the query by a related \Incident object
     *
     * @param \Incident|ObjectCollection $incident The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildInvolvedPartyQuery The current query, for fluid interface
     */
    public function filterByIncident($incident, $comparison = null)
    {
        if ($incident instanceof \Incident) {
            return $this
                ->addUsingAlias(InvolvedPartyTableMap::COL_INCIDENT_ID, $incident->getIncidentId(), $comparison);
        } elseif ($incident instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InvolvedPartyTableMap::COL_INCIDENT_ID, $incident->toKeyValue('PrimaryKey', 'IncidentId'), $comparison);
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
     * @return $this|ChildInvolvedPartyQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildInvolvedParty $involvedParty Object to remove from the list of results
     *
     * @return $this|ChildInvolvedPartyQuery The current query, for fluid interface
     */
    public function prune($involvedParty = null)
    {
        if ($involvedParty) {
            $this->addUsingAlias(InvolvedPartyTableMap::COL_INVOLVED_PARTY_ID, $involvedParty->getInvolvedPartyId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the involved_party table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InvolvedPartyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            InvolvedPartyTableMap::clearInstancePool();
            InvolvedPartyTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(InvolvedPartyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(InvolvedPartyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            InvolvedPartyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            InvolvedPartyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // InvolvedPartyQuery
