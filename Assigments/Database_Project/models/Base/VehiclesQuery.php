<?php

namespace Base;

use \Vehicles as ChildVehicles;
use \VehiclesQuery as ChildVehiclesQuery;
use \Exception;
use \PDO;
use Map\VehiclesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'vehicles' table.
 *
 *
 *
 * @method     ChildVehiclesQuery orderByVehicleId($order = Criteria::ASC) Order by the vehicle_id column
 * @method     ChildVehiclesQuery orderByMake($order = Criteria::ASC) Order by the make column
 * @method     ChildVehiclesQuery orderByModel($order = Criteria::ASC) Order by the model column
 * @method     ChildVehiclesQuery orderByYear($order = Criteria::ASC) Order by the year column
 * @method     ChildVehiclesQuery orderByVin($order = Criteria::ASC) Order by the vin column
 * @method     ChildVehiclesQuery orderByMileage($order = Criteria::ASC) Order by the mileage column
 * @method     ChildVehiclesQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildVehiclesQuery orderByLicensePlate($order = Criteria::ASC) Order by the license_plate column
 * @method     ChildVehiclesQuery orderByStationId($order = Criteria::ASC) Order by the station_id column
 * @method     ChildVehiclesQuery orderByInService($order = Criteria::ASC) Order by the in_service column
 *
 * @method     ChildVehiclesQuery groupByVehicleId() Group by the vehicle_id column
 * @method     ChildVehiclesQuery groupByMake() Group by the make column
 * @method     ChildVehiclesQuery groupByModel() Group by the model column
 * @method     ChildVehiclesQuery groupByYear() Group by the year column
 * @method     ChildVehiclesQuery groupByVin() Group by the vin column
 * @method     ChildVehiclesQuery groupByMileage() Group by the mileage column
 * @method     ChildVehiclesQuery groupByType() Group by the type column
 * @method     ChildVehiclesQuery groupByLicensePlate() Group by the license_plate column
 * @method     ChildVehiclesQuery groupByStationId() Group by the station_id column
 * @method     ChildVehiclesQuery groupByInService() Group by the in_service column
 *
 * @method     ChildVehiclesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVehiclesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVehiclesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVehiclesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVehiclesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVehiclesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVehiclesQuery leftJoinStation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Station relation
 * @method     ChildVehiclesQuery rightJoinStation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Station relation
 * @method     ChildVehiclesQuery innerJoinStation($relationAlias = null) Adds a INNER JOIN clause to the query using the Station relation
 *
 * @method     ChildVehiclesQuery joinWithStation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Station relation
 *
 * @method     ChildVehiclesQuery leftJoinWithStation() Adds a LEFT JOIN clause and with to the query using the Station relation
 * @method     ChildVehiclesQuery rightJoinWithStation() Adds a RIGHT JOIN clause and with to the query using the Station relation
 * @method     ChildVehiclesQuery innerJoinWithStation() Adds a INNER JOIN clause and with to the query using the Station relation
 *
 * @method     \StationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVehicles findOne(ConnectionInterface $con = null) Return the first ChildVehicles matching the query
 * @method     ChildVehicles findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVehicles matching the query, or a new ChildVehicles object populated from the query conditions when no match is found
 *
 * @method     ChildVehicles findOneByVehicleId(int $vehicle_id) Return the first ChildVehicles filtered by the vehicle_id column
 * @method     ChildVehicles findOneByMake(string $make) Return the first ChildVehicles filtered by the make column
 * @method     ChildVehicles findOneByModel(string $model) Return the first ChildVehicles filtered by the model column
 * @method     ChildVehicles findOneByYear(int $year) Return the first ChildVehicles filtered by the year column
 * @method     ChildVehicles findOneByVin(string $vin) Return the first ChildVehicles filtered by the vin column
 * @method     ChildVehicles findOneByMileage(int $mileage) Return the first ChildVehicles filtered by the mileage column
 * @method     ChildVehicles findOneByType(string $type) Return the first ChildVehicles filtered by the type column
 * @method     ChildVehicles findOneByLicensePlate(string $license_plate) Return the first ChildVehicles filtered by the license_plate column
 * @method     ChildVehicles findOneByStationId(int $station_id) Return the first ChildVehicles filtered by the station_id column
 * @method     ChildVehicles findOneByInService(boolean $in_service) Return the first ChildVehicles filtered by the in_service column *

 * @method     ChildVehicles requirePk($key, ConnectionInterface $con = null) Return the ChildVehicles by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicles requireOne(ConnectionInterface $con = null) Return the first ChildVehicles matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVehicles requireOneByVehicleId(int $vehicle_id) Return the first ChildVehicles filtered by the vehicle_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicles requireOneByMake(string $make) Return the first ChildVehicles filtered by the make column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicles requireOneByModel(string $model) Return the first ChildVehicles filtered by the model column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicles requireOneByYear(int $year) Return the first ChildVehicles filtered by the year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicles requireOneByVin(string $vin) Return the first ChildVehicles filtered by the vin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicles requireOneByMileage(int $mileage) Return the first ChildVehicles filtered by the mileage column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicles requireOneByType(string $type) Return the first ChildVehicles filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicles requireOneByLicensePlate(string $license_plate) Return the first ChildVehicles filtered by the license_plate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicles requireOneByStationId(int $station_id) Return the first ChildVehicles filtered by the station_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicles requireOneByInService(boolean $in_service) Return the first ChildVehicles filtered by the in_service column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVehicles[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVehicles objects based on current ModelCriteria
 * @method     ChildVehicles[]|ObjectCollection findByVehicleId(int $vehicle_id) Return ChildVehicles objects filtered by the vehicle_id column
 * @method     ChildVehicles[]|ObjectCollection findByMake(string $make) Return ChildVehicles objects filtered by the make column
 * @method     ChildVehicles[]|ObjectCollection findByModel(string $model) Return ChildVehicles objects filtered by the model column
 * @method     ChildVehicles[]|ObjectCollection findByYear(int $year) Return ChildVehicles objects filtered by the year column
 * @method     ChildVehicles[]|ObjectCollection findByVin(string $vin) Return ChildVehicles objects filtered by the vin column
 * @method     ChildVehicles[]|ObjectCollection findByMileage(int $mileage) Return ChildVehicles objects filtered by the mileage column
 * @method     ChildVehicles[]|ObjectCollection findByType(string $type) Return ChildVehicles objects filtered by the type column
 * @method     ChildVehicles[]|ObjectCollection findByLicensePlate(string $license_plate) Return ChildVehicles objects filtered by the license_plate column
 * @method     ChildVehicles[]|ObjectCollection findByStationId(int $station_id) Return ChildVehicles objects filtered by the station_id column
 * @method     ChildVehicles[]|ObjectCollection findByInService(boolean $in_service) Return ChildVehicles objects filtered by the in_service column
 * @method     ChildVehicles[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VehiclesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\VehiclesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Vehicles', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVehiclesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVehiclesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVehiclesQuery) {
            return $criteria;
        }
        $query = new ChildVehiclesQuery();
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
     * @return ChildVehicles|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VehiclesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VehiclesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildVehicles A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT vehicle_id, make, model, year, vin, mileage, type, license_plate, station_id, in_service FROM vehicles WHERE vehicle_id = :p0';
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
            /** @var ChildVehicles $obj */
            $obj = new ChildVehicles();
            $obj->hydrate($row);
            VehiclesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildVehicles|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVehiclesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VehiclesTableMap::COL_VEHICLE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVehiclesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VehiclesTableMap::COL_VEHICLE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the vehicle_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVehicleId(1234); // WHERE vehicle_id = 1234
     * $query->filterByVehicleId(array(12, 34)); // WHERE vehicle_id IN (12, 34)
     * $query->filterByVehicleId(array('min' => 12)); // WHERE vehicle_id > 12
     * </code>
     *
     * @param     mixed $vehicleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehiclesQuery The current query, for fluid interface
     */
    public function filterByVehicleId($vehicleId = null, $comparison = null)
    {
        if (is_array($vehicleId)) {
            $useMinMax = false;
            if (isset($vehicleId['min'])) {
                $this->addUsingAlias(VehiclesTableMap::COL_VEHICLE_ID, $vehicleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($vehicleId['max'])) {
                $this->addUsingAlias(VehiclesTableMap::COL_VEHICLE_ID, $vehicleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehiclesTableMap::COL_VEHICLE_ID, $vehicleId, $comparison);
    }

    /**
     * Filter the query on the make column
     *
     * Example usage:
     * <code>
     * $query->filterByMake('fooValue');   // WHERE make = 'fooValue'
     * $query->filterByMake('%fooValue%', Criteria::LIKE); // WHERE make LIKE '%fooValue%'
     * </code>
     *
     * @param     string $make The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehiclesQuery The current query, for fluid interface
     */
    public function filterByMake($make = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($make)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehiclesTableMap::COL_MAKE, $make, $comparison);
    }

    /**
     * Filter the query on the model column
     *
     * Example usage:
     * <code>
     * $query->filterByModel('fooValue');   // WHERE model = 'fooValue'
     * $query->filterByModel('%fooValue%', Criteria::LIKE); // WHERE model LIKE '%fooValue%'
     * </code>
     *
     * @param     string $model The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehiclesQuery The current query, for fluid interface
     */
    public function filterByModel($model = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($model)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehiclesTableMap::COL_MODEL, $model, $comparison);
    }

    /**
     * Filter the query on the year column
     *
     * Example usage:
     * <code>
     * $query->filterByYear(1234); // WHERE year = 1234
     * $query->filterByYear(array(12, 34)); // WHERE year IN (12, 34)
     * $query->filterByYear(array('min' => 12)); // WHERE year > 12
     * </code>
     *
     * @param     mixed $year The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehiclesQuery The current query, for fluid interface
     */
    public function filterByYear($year = null, $comparison = null)
    {
        if (is_array($year)) {
            $useMinMax = false;
            if (isset($year['min'])) {
                $this->addUsingAlias(VehiclesTableMap::COL_YEAR, $year['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($year['max'])) {
                $this->addUsingAlias(VehiclesTableMap::COL_YEAR, $year['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehiclesTableMap::COL_YEAR, $year, $comparison);
    }

    /**
     * Filter the query on the vin column
     *
     * Example usage:
     * <code>
     * $query->filterByVin('fooValue');   // WHERE vin = 'fooValue'
     * $query->filterByVin('%fooValue%', Criteria::LIKE); // WHERE vin LIKE '%fooValue%'
     * </code>
     *
     * @param     string $vin The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehiclesQuery The current query, for fluid interface
     */
    public function filterByVin($vin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($vin)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehiclesTableMap::COL_VIN, $vin, $comparison);
    }

    /**
     * Filter the query on the mileage column
     *
     * Example usage:
     * <code>
     * $query->filterByMileage(1234); // WHERE mileage = 1234
     * $query->filterByMileage(array(12, 34)); // WHERE mileage IN (12, 34)
     * $query->filterByMileage(array('min' => 12)); // WHERE mileage > 12
     * </code>
     *
     * @param     mixed $mileage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehiclesQuery The current query, for fluid interface
     */
    public function filterByMileage($mileage = null, $comparison = null)
    {
        if (is_array($mileage)) {
            $useMinMax = false;
            if (isset($mileage['min'])) {
                $this->addUsingAlias(VehiclesTableMap::COL_MILEAGE, $mileage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mileage['max'])) {
                $this->addUsingAlias(VehiclesTableMap::COL_MILEAGE, $mileage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehiclesTableMap::COL_MILEAGE, $mileage, $comparison);
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
     * @return $this|ChildVehiclesQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehiclesTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the license_plate column
     *
     * Example usage:
     * <code>
     * $query->filterByLicensePlate('fooValue');   // WHERE license_plate = 'fooValue'
     * $query->filterByLicensePlate('%fooValue%', Criteria::LIKE); // WHERE license_plate LIKE '%fooValue%'
     * </code>
     *
     * @param     string $licensePlate The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehiclesQuery The current query, for fluid interface
     */
    public function filterByLicensePlate($licensePlate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($licensePlate)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehiclesTableMap::COL_LICENSE_PLATE, $licensePlate, $comparison);
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
     * @return $this|ChildVehiclesQuery The current query, for fluid interface
     */
    public function filterByStationId($stationId = null, $comparison = null)
    {
        if (is_array($stationId)) {
            $useMinMax = false;
            if (isset($stationId['min'])) {
                $this->addUsingAlias(VehiclesTableMap::COL_STATION_ID, $stationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stationId['max'])) {
                $this->addUsingAlias(VehiclesTableMap::COL_STATION_ID, $stationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehiclesTableMap::COL_STATION_ID, $stationId, $comparison);
    }

    /**
     * Filter the query on the in_service column
     *
     * Example usage:
     * <code>
     * $query->filterByInService(true); // WHERE in_service = true
     * $query->filterByInService('yes'); // WHERE in_service = true
     * </code>
     *
     * @param     boolean|string $inService The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehiclesQuery The current query, for fluid interface
     */
    public function filterByInService($inService = null, $comparison = null)
    {
        if (is_string($inService)) {
            $inService = in_array(strtolower($inService), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(VehiclesTableMap::COL_IN_SERVICE, $inService, $comparison);
    }

    /**
     * Filter the query by a related \Station object
     *
     * @param \Station|ObjectCollection $station The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVehiclesQuery The current query, for fluid interface
     */
    public function filterByStation($station, $comparison = null)
    {
        if ($station instanceof \Station) {
            return $this
                ->addUsingAlias(VehiclesTableMap::COL_STATION_ID, $station->getStationId(), $comparison);
        } elseif ($station instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VehiclesTableMap::COL_STATION_ID, $station->toKeyValue('PrimaryKey', 'StationId'), $comparison);
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
     * @return $this|ChildVehiclesQuery The current query, for fluid interface
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
     * @param   ChildVehicles $vehicles Object to remove from the list of results
     *
     * @return $this|ChildVehiclesQuery The current query, for fluid interface
     */
    public function prune($vehicles = null)
    {
        if ($vehicles) {
            $this->addUsingAlias(VehiclesTableMap::COL_VEHICLE_ID, $vehicles->getVehicleId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the vehicles table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VehiclesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VehiclesTableMap::clearInstancePool();
            VehiclesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VehiclesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VehiclesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VehiclesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VehiclesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VehiclesQuery
