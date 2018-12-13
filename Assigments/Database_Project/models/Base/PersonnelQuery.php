<?php

namespace Base;

use \Personnel as ChildPersonnel;
use \PersonnelQuery as ChildPersonnelQuery;
use \Exception;
use \PDO;
use Map\PersonnelTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'personnel' table.
 *
 *
 *
 * @method     ChildPersonnelQuery orderByPersonnelId($order = Criteria::ASC) Order by the personnel_id column
 * @method     ChildPersonnelQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPersonnelQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildPersonnelQuery orderByHeight($order = Criteria::ASC) Order by the height column
 * @method     ChildPersonnelQuery orderByWeight($order = Criteria::ASC) Order by the weight column
 * @method     ChildPersonnelQuery orderBySsn($order = Criteria::ASC) Order by the ssn column
 * @method     ChildPersonnelQuery orderByPhoneNumber($order = Criteria::ASC) Order by the phone_number column
 * @method     ChildPersonnelQuery orderByShiftId($order = Criteria::ASC) Order by the shift_id column
 * @method     ChildPersonnelQuery orderByCertificationId($order = Criteria::ASC) Order by the certification_id column
 * @method     ChildPersonnelQuery orderByStationId($order = Criteria::ASC) Order by the station_id column
 *
 * @method     ChildPersonnelQuery groupByPersonnelId() Group by the personnel_id column
 * @method     ChildPersonnelQuery groupByName() Group by the name column
 * @method     ChildPersonnelQuery groupByAddress() Group by the address column
 * @method     ChildPersonnelQuery groupByHeight() Group by the height column
 * @method     ChildPersonnelQuery groupByWeight() Group by the weight column
 * @method     ChildPersonnelQuery groupBySsn() Group by the ssn column
 * @method     ChildPersonnelQuery groupByPhoneNumber() Group by the phone_number column
 * @method     ChildPersonnelQuery groupByShiftId() Group by the shift_id column
 * @method     ChildPersonnelQuery groupByCertificationId() Group by the certification_id column
 * @method     ChildPersonnelQuery groupByStationId() Group by the station_id column
 *
 * @method     ChildPersonnelQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPersonnelQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPersonnelQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPersonnelQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPersonnelQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPersonnelQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPersonnelQuery leftJoinShift($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shift relation
 * @method     ChildPersonnelQuery rightJoinShift($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shift relation
 * @method     ChildPersonnelQuery innerJoinShift($relationAlias = null) Adds a INNER JOIN clause to the query using the Shift relation
 *
 * @method     ChildPersonnelQuery joinWithShift($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shift relation
 *
 * @method     ChildPersonnelQuery leftJoinWithShift() Adds a LEFT JOIN clause and with to the query using the Shift relation
 * @method     ChildPersonnelQuery rightJoinWithShift() Adds a RIGHT JOIN clause and with to the query using the Shift relation
 * @method     ChildPersonnelQuery innerJoinWithShift() Adds a INNER JOIN clause and with to the query using the Shift relation
 *
 * @method     ChildPersonnelQuery leftJoinCertifications($relationAlias = null) Adds a LEFT JOIN clause to the query using the Certifications relation
 * @method     ChildPersonnelQuery rightJoinCertifications($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Certifications relation
 * @method     ChildPersonnelQuery innerJoinCertifications($relationAlias = null) Adds a INNER JOIN clause to the query using the Certifications relation
 *
 * @method     ChildPersonnelQuery joinWithCertifications($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Certifications relation
 *
 * @method     ChildPersonnelQuery leftJoinWithCertifications() Adds a LEFT JOIN clause and with to the query using the Certifications relation
 * @method     ChildPersonnelQuery rightJoinWithCertifications() Adds a RIGHT JOIN clause and with to the query using the Certifications relation
 * @method     ChildPersonnelQuery innerJoinWithCertifications() Adds a INNER JOIN clause and with to the query using the Certifications relation
 *
 * @method     ChildPersonnelQuery leftJoinStation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Station relation
 * @method     ChildPersonnelQuery rightJoinStation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Station relation
 * @method     ChildPersonnelQuery innerJoinStation($relationAlias = null) Adds a INNER JOIN clause to the query using the Station relation
 *
 * @method     ChildPersonnelQuery joinWithStation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Station relation
 *
 * @method     ChildPersonnelQuery leftJoinWithStation() Adds a LEFT JOIN clause and with to the query using the Station relation
 * @method     ChildPersonnelQuery rightJoinWithStation() Adds a RIGHT JOIN clause and with to the query using the Station relation
 * @method     ChildPersonnelQuery innerJoinWithStation() Adds a INNER JOIN clause and with to the query using the Station relation
 *
 * @method     ChildPersonnelQuery leftJoinPersonnelEquipment($relationAlias = null) Adds a LEFT JOIN clause to the query using the PersonnelEquipment relation
 * @method     ChildPersonnelQuery rightJoinPersonnelEquipment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PersonnelEquipment relation
 * @method     ChildPersonnelQuery innerJoinPersonnelEquipment($relationAlias = null) Adds a INNER JOIN clause to the query using the PersonnelEquipment relation
 *
 * @method     ChildPersonnelQuery joinWithPersonnelEquipment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PersonnelEquipment relation
 *
 * @method     ChildPersonnelQuery leftJoinWithPersonnelEquipment() Adds a LEFT JOIN clause and with to the query using the PersonnelEquipment relation
 * @method     ChildPersonnelQuery rightJoinWithPersonnelEquipment() Adds a RIGHT JOIN clause and with to the query using the PersonnelEquipment relation
 * @method     ChildPersonnelQuery innerJoinWithPersonnelEquipment() Adds a INNER JOIN clause and with to the query using the PersonnelEquipment relation
 *
 * @method     ChildPersonnelQuery leftJoinSupervisors($relationAlias = null) Adds a LEFT JOIN clause to the query using the Supervisors relation
 * @method     ChildPersonnelQuery rightJoinSupervisors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Supervisors relation
 * @method     ChildPersonnelQuery innerJoinSupervisors($relationAlias = null) Adds a INNER JOIN clause to the query using the Supervisors relation
 *
 * @method     ChildPersonnelQuery joinWithSupervisors($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Supervisors relation
 *
 * @method     ChildPersonnelQuery leftJoinWithSupervisors() Adds a LEFT JOIN clause and with to the query using the Supervisors relation
 * @method     ChildPersonnelQuery rightJoinWithSupervisors() Adds a RIGHT JOIN clause and with to the query using the Supervisors relation
 * @method     ChildPersonnelQuery innerJoinWithSupervisors() Adds a INNER JOIN clause and with to the query using the Supervisors relation
 *
 * @method     \ShiftQuery|\CertificationsQuery|\StationQuery|\PersonnelEquipmentQuery|\SupervisorsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPersonnel findOne(ConnectionInterface $con = null) Return the first ChildPersonnel matching the query
 * @method     ChildPersonnel findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPersonnel matching the query, or a new ChildPersonnel object populated from the query conditions when no match is found
 *
 * @method     ChildPersonnel findOneByPersonnelId(int $personnel_id) Return the first ChildPersonnel filtered by the personnel_id column
 * @method     ChildPersonnel findOneByName(string $name) Return the first ChildPersonnel filtered by the name column
 * @method     ChildPersonnel findOneByAddress(string $address) Return the first ChildPersonnel filtered by the address column
 * @method     ChildPersonnel findOneByHeight(string $height) Return the first ChildPersonnel filtered by the height column
 * @method     ChildPersonnel findOneByWeight(int $weight) Return the first ChildPersonnel filtered by the weight column
 * @method     ChildPersonnel findOneBySsn(string $ssn) Return the first ChildPersonnel filtered by the ssn column
 * @method     ChildPersonnel findOneByPhoneNumber(string $phone_number) Return the first ChildPersonnel filtered by the phone_number column
 * @method     ChildPersonnel findOneByShiftId(int $shift_id) Return the first ChildPersonnel filtered by the shift_id column
 * @method     ChildPersonnel findOneByCertificationId(int $certification_id) Return the first ChildPersonnel filtered by the certification_id column
 * @method     ChildPersonnel findOneByStationId(int $station_id) Return the first ChildPersonnel filtered by the station_id column *

 * @method     ChildPersonnel requirePk($key, ConnectionInterface $con = null) Return the ChildPersonnel by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnel requireOne(ConnectionInterface $con = null) Return the first ChildPersonnel matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPersonnel requireOneByPersonnelId(int $personnel_id) Return the first ChildPersonnel filtered by the personnel_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnel requireOneByName(string $name) Return the first ChildPersonnel filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnel requireOneByAddress(string $address) Return the first ChildPersonnel filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnel requireOneByHeight(string $height) Return the first ChildPersonnel filtered by the height column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnel requireOneByWeight(int $weight) Return the first ChildPersonnel filtered by the weight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnel requireOneBySsn(string $ssn) Return the first ChildPersonnel filtered by the ssn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnel requireOneByPhoneNumber(string $phone_number) Return the first ChildPersonnel filtered by the phone_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnel requireOneByShiftId(int $shift_id) Return the first ChildPersonnel filtered by the shift_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnel requireOneByCertificationId(int $certification_id) Return the first ChildPersonnel filtered by the certification_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnel requireOneByStationId(int $station_id) Return the first ChildPersonnel filtered by the station_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPersonnel[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPersonnel objects based on current ModelCriteria
 * @method     ChildPersonnel[]|ObjectCollection findByPersonnelId(int $personnel_id) Return ChildPersonnel objects filtered by the personnel_id column
 * @method     ChildPersonnel[]|ObjectCollection findByName(string $name) Return ChildPersonnel objects filtered by the name column
 * @method     ChildPersonnel[]|ObjectCollection findByAddress(string $address) Return ChildPersonnel objects filtered by the address column
 * @method     ChildPersonnel[]|ObjectCollection findByHeight(string $height) Return ChildPersonnel objects filtered by the height column
 * @method     ChildPersonnel[]|ObjectCollection findByWeight(int $weight) Return ChildPersonnel objects filtered by the weight column
 * @method     ChildPersonnel[]|ObjectCollection findBySsn(string $ssn) Return ChildPersonnel objects filtered by the ssn column
 * @method     ChildPersonnel[]|ObjectCollection findByPhoneNumber(string $phone_number) Return ChildPersonnel objects filtered by the phone_number column
 * @method     ChildPersonnel[]|ObjectCollection findByShiftId(int $shift_id) Return ChildPersonnel objects filtered by the shift_id column
 * @method     ChildPersonnel[]|ObjectCollection findByCertificationId(int $certification_id) Return ChildPersonnel objects filtered by the certification_id column
 * @method     ChildPersonnel[]|ObjectCollection findByStationId(int $station_id) Return ChildPersonnel objects filtered by the station_id column
 * @method     ChildPersonnel[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PersonnelQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PersonnelQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Personnel', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPersonnelQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPersonnelQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPersonnelQuery) {
            return $criteria;
        }
        $query = new ChildPersonnelQuery();
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
     * @return ChildPersonnel|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PersonnelTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PersonnelTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPersonnel A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT personnel_id, name, address, height, weight, ssn, phone_number, shift_id, certification_id, station_id FROM personnel WHERE personnel_id = :p0';
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
            /** @var ChildPersonnel $obj */
            $obj = new ChildPersonnel();
            $obj->hydrate($row);
            PersonnelTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPersonnel|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PersonnelTableMap::COL_PERSONNEL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PersonnelTableMap::COL_PERSONNEL_ID, $keys, Criteria::IN);
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
     * @param     mixed $personnelId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByPersonnelId($personnelId = null, $comparison = null)
    {
        if (is_array($personnelId)) {
            $useMinMax = false;
            if (isset($personnelId['min'])) {
                $this->addUsingAlias(PersonnelTableMap::COL_PERSONNEL_ID, $personnelId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($personnelId['max'])) {
                $this->addUsingAlias(PersonnelTableMap::COL_PERSONNEL_ID, $personnelId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelTableMap::COL_PERSONNEL_ID, $personnelId, $comparison);
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
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the height column
     *
     * Example usage:
     * <code>
     * $query->filterByHeight('fooValue');   // WHERE height = 'fooValue'
     * $query->filterByHeight('%fooValue%', Criteria::LIKE); // WHERE height LIKE '%fooValue%'
     * </code>
     *
     * @param     string $height The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByHeight($height = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($height)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelTableMap::COL_HEIGHT, $height, $comparison);
    }

    /**
     * Filter the query on the weight column
     *
     * Example usage:
     * <code>
     * $query->filterByWeight(1234); // WHERE weight = 1234
     * $query->filterByWeight(array(12, 34)); // WHERE weight IN (12, 34)
     * $query->filterByWeight(array('min' => 12)); // WHERE weight > 12
     * </code>
     *
     * @param     mixed $weight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByWeight($weight = null, $comparison = null)
    {
        if (is_array($weight)) {
            $useMinMax = false;
            if (isset($weight['min'])) {
                $this->addUsingAlias(PersonnelTableMap::COL_WEIGHT, $weight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($weight['max'])) {
                $this->addUsingAlias(PersonnelTableMap::COL_WEIGHT, $weight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelTableMap::COL_WEIGHT, $weight, $comparison);
    }

    /**
     * Filter the query on the ssn column
     *
     * Example usage:
     * <code>
     * $query->filterBySsn('fooValue');   // WHERE ssn = 'fooValue'
     * $query->filterBySsn('%fooValue%', Criteria::LIKE); // WHERE ssn LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ssn The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterBySsn($ssn = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ssn)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelTableMap::COL_SSN, $ssn, $comparison);
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
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByPhoneNumber($phoneNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelTableMap::COL_PHONE_NUMBER, $phoneNumber, $comparison);
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
     * @see       filterByShift()
     *
     * @param     mixed $shiftId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByShiftId($shiftId = null, $comparison = null)
    {
        if (is_array($shiftId)) {
            $useMinMax = false;
            if (isset($shiftId['min'])) {
                $this->addUsingAlias(PersonnelTableMap::COL_SHIFT_ID, $shiftId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shiftId['max'])) {
                $this->addUsingAlias(PersonnelTableMap::COL_SHIFT_ID, $shiftId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelTableMap::COL_SHIFT_ID, $shiftId, $comparison);
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
     * @see       filterByCertifications()
     *
     * @param     mixed $certificationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByCertificationId($certificationId = null, $comparison = null)
    {
        if (is_array($certificationId)) {
            $useMinMax = false;
            if (isset($certificationId['min'])) {
                $this->addUsingAlias(PersonnelTableMap::COL_CERTIFICATION_ID, $certificationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($certificationId['max'])) {
                $this->addUsingAlias(PersonnelTableMap::COL_CERTIFICATION_ID, $certificationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelTableMap::COL_CERTIFICATION_ID, $certificationId, $comparison);
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
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByStationId($stationId = null, $comparison = null)
    {
        if (is_array($stationId)) {
            $useMinMax = false;
            if (isset($stationId['min'])) {
                $this->addUsingAlias(PersonnelTableMap::COL_STATION_ID, $stationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stationId['max'])) {
                $this->addUsingAlias(PersonnelTableMap::COL_STATION_ID, $stationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelTableMap::COL_STATION_ID, $stationId, $comparison);
    }

    /**
     * Filter the query by a related \Shift object
     *
     * @param \Shift|ObjectCollection $shift The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByShift($shift, $comparison = null)
    {
        if ($shift instanceof \Shift) {
            return $this
                ->addUsingAlias(PersonnelTableMap::COL_SHIFT_ID, $shift->getShiftId(), $comparison);
        } elseif ($shift instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PersonnelTableMap::COL_SHIFT_ID, $shift->toKeyValue('PrimaryKey', 'ShiftId'), $comparison);
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
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
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
     * Filter the query by a related \Certifications object
     *
     * @param \Certifications|ObjectCollection $certifications The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByCertifications($certifications, $comparison = null)
    {
        if ($certifications instanceof \Certifications) {
            return $this
                ->addUsingAlias(PersonnelTableMap::COL_CERTIFICATION_ID, $certifications->getCertificationId(), $comparison);
        } elseif ($certifications instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PersonnelTableMap::COL_CERTIFICATION_ID, $certifications->toKeyValue('PrimaryKey', 'CertificationId'), $comparison);
        } else {
            throw new PropelException('filterByCertifications() only accepts arguments of type \Certifications or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Certifications relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function joinCertifications($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Certifications');

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
            $this->addJoinObject($join, 'Certifications');
        }

        return $this;
    }

    /**
     * Use the Certifications relation Certifications object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CertificationsQuery A secondary query class using the current class as primary query
     */
    public function useCertificationsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCertifications($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Certifications', '\CertificationsQuery');
    }

    /**
     * Filter the query by a related \Station object
     *
     * @param \Station|ObjectCollection $station The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByStation($station, $comparison = null)
    {
        if ($station instanceof \Station) {
            return $this
                ->addUsingAlias(PersonnelTableMap::COL_STATION_ID, $station->getStationId(), $comparison);
        } elseif ($station instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PersonnelTableMap::COL_STATION_ID, $station->toKeyValue('PrimaryKey', 'StationId'), $comparison);
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
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
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
     * Filter the query by a related \PersonnelEquipment object
     *
     * @param \PersonnelEquipment|ObjectCollection $personnelEquipment the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterByPersonnelEquipment($personnelEquipment, $comparison = null)
    {
        if ($personnelEquipment instanceof \PersonnelEquipment) {
            return $this
                ->addUsingAlias(PersonnelTableMap::COL_PERSONNEL_ID, $personnelEquipment->getPersonnelId(), $comparison);
        } elseif ($personnelEquipment instanceof ObjectCollection) {
            return $this
                ->usePersonnelEquipmentQuery()
                ->filterByPrimaryKeys($personnelEquipment->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPersonnelEquipment() only accepts arguments of type \PersonnelEquipment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PersonnelEquipment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function joinPersonnelEquipment($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PersonnelEquipment');

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
            $this->addJoinObject($join, 'PersonnelEquipment');
        }

        return $this;
    }

    /**
     * Use the PersonnelEquipment relation PersonnelEquipment object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PersonnelEquipmentQuery A secondary query class using the current class as primary query
     */
    public function usePersonnelEquipmentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPersonnelEquipment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PersonnelEquipment', '\PersonnelEquipmentQuery');
    }

    /**
     * Filter the query by a related \Supervisors object
     *
     * @param \Supervisors|ObjectCollection $supervisors the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPersonnelQuery The current query, for fluid interface
     */
    public function filterBySupervisors($supervisors, $comparison = null)
    {
        if ($supervisors instanceof \Supervisors) {
            return $this
                ->addUsingAlias(PersonnelTableMap::COL_PERSONNEL_ID, $supervisors->getPersonnelId(), $comparison);
        } elseif ($supervisors instanceof ObjectCollection) {
            return $this
                ->useSupervisorsQuery()
                ->filterByPrimaryKeys($supervisors->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySupervisors() only accepts arguments of type \Supervisors or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Supervisors relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function joinSupervisors($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Supervisors');

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
            $this->addJoinObject($join, 'Supervisors');
        }

        return $this;
    }

    /**
     * Use the Supervisors relation Supervisors object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SupervisorsQuery A secondary query class using the current class as primary query
     */
    public function useSupervisorsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSupervisors($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Supervisors', '\SupervisorsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPersonnel $personnel Object to remove from the list of results
     *
     * @return $this|ChildPersonnelQuery The current query, for fluid interface
     */
    public function prune($personnel = null)
    {
        if ($personnel) {
            $this->addUsingAlias(PersonnelTableMap::COL_PERSONNEL_ID, $personnel->getPersonnelId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the personnel table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonnelTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PersonnelTableMap::clearInstancePool();
            PersonnelTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PersonnelTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PersonnelTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PersonnelTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PersonnelTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PersonnelQuery
