<?php

namespace Base;

use \PersonnelEquipment as ChildPersonnelEquipment;
use \PersonnelEquipmentQuery as ChildPersonnelEquipmentQuery;
use \Exception;
use \PDO;
use Map\PersonnelEquipmentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'personnel_equipment' table.
 *
 *
 *
 * @method     ChildPersonnelEquipmentQuery orderByPersonnelEquipmentId($order = Criteria::ASC) Order by the personnel_equipment_id column
 * @method     ChildPersonnelEquipmentQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPersonnelEquipmentQuery orderByBrand($order = Criteria::ASC) Order by the brand column
 * @method     ChildPersonnelEquipmentQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildPersonnelEquipmentQuery orderByEquipmentCondition($order = Criteria::ASC) Order by the equipment_condition column
 * @method     ChildPersonnelEquipmentQuery orderBySerialNumber($order = Criteria::ASC) Order by the serial_number column
 * @method     ChildPersonnelEquipmentQuery orderByPersonnelId($order = Criteria::ASC) Order by the personnel_id column
 *
 * @method     ChildPersonnelEquipmentQuery groupByPersonnelEquipmentId() Group by the personnel_equipment_id column
 * @method     ChildPersonnelEquipmentQuery groupByName() Group by the name column
 * @method     ChildPersonnelEquipmentQuery groupByBrand() Group by the brand column
 * @method     ChildPersonnelEquipmentQuery groupByType() Group by the type column
 * @method     ChildPersonnelEquipmentQuery groupByEquipmentCondition() Group by the equipment_condition column
 * @method     ChildPersonnelEquipmentQuery groupBySerialNumber() Group by the serial_number column
 * @method     ChildPersonnelEquipmentQuery groupByPersonnelId() Group by the personnel_id column
 *
 * @method     ChildPersonnelEquipmentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPersonnelEquipmentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPersonnelEquipmentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPersonnelEquipmentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPersonnelEquipmentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPersonnelEquipmentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPersonnelEquipmentQuery leftJoinPersonnel($relationAlias = null) Adds a LEFT JOIN clause to the query using the Personnel relation
 * @method     ChildPersonnelEquipmentQuery rightJoinPersonnel($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Personnel relation
 * @method     ChildPersonnelEquipmentQuery innerJoinPersonnel($relationAlias = null) Adds a INNER JOIN clause to the query using the Personnel relation
 *
 * @method     ChildPersonnelEquipmentQuery joinWithPersonnel($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Personnel relation
 *
 * @method     ChildPersonnelEquipmentQuery leftJoinWithPersonnel() Adds a LEFT JOIN clause and with to the query using the Personnel relation
 * @method     ChildPersonnelEquipmentQuery rightJoinWithPersonnel() Adds a RIGHT JOIN clause and with to the query using the Personnel relation
 * @method     ChildPersonnelEquipmentQuery innerJoinWithPersonnel() Adds a INNER JOIN clause and with to the query using the Personnel relation
 *
 * @method     \PersonnelQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPersonnelEquipment findOne(ConnectionInterface $con = null) Return the first ChildPersonnelEquipment matching the query
 * @method     ChildPersonnelEquipment findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPersonnelEquipment matching the query, or a new ChildPersonnelEquipment object populated from the query conditions when no match is found
 *
 * @method     ChildPersonnelEquipment findOneByPersonnelEquipmentId(int $personnel_equipment_id) Return the first ChildPersonnelEquipment filtered by the personnel_equipment_id column
 * @method     ChildPersonnelEquipment findOneByName(string $name) Return the first ChildPersonnelEquipment filtered by the name column
 * @method     ChildPersonnelEquipment findOneByBrand(string $brand) Return the first ChildPersonnelEquipment filtered by the brand column
 * @method     ChildPersonnelEquipment findOneByType(string $type) Return the first ChildPersonnelEquipment filtered by the type column
 * @method     ChildPersonnelEquipment findOneByEquipmentCondition(string $equipment_condition) Return the first ChildPersonnelEquipment filtered by the equipment_condition column
 * @method     ChildPersonnelEquipment findOneBySerialNumber(string $serial_number) Return the first ChildPersonnelEquipment filtered by the serial_number column
 * @method     ChildPersonnelEquipment findOneByPersonnelId(int $personnel_id) Return the first ChildPersonnelEquipment filtered by the personnel_id column *

 * @method     ChildPersonnelEquipment requirePk($key, ConnectionInterface $con = null) Return the ChildPersonnelEquipment by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnelEquipment requireOne(ConnectionInterface $con = null) Return the first ChildPersonnelEquipment matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPersonnelEquipment requireOneByPersonnelEquipmentId(int $personnel_equipment_id) Return the first ChildPersonnelEquipment filtered by the personnel_equipment_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnelEquipment requireOneByName(string $name) Return the first ChildPersonnelEquipment filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnelEquipment requireOneByBrand(string $brand) Return the first ChildPersonnelEquipment filtered by the brand column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnelEquipment requireOneByType(string $type) Return the first ChildPersonnelEquipment filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnelEquipment requireOneByEquipmentCondition(string $equipment_condition) Return the first ChildPersonnelEquipment filtered by the equipment_condition column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnelEquipment requireOneBySerialNumber(string $serial_number) Return the first ChildPersonnelEquipment filtered by the serial_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPersonnelEquipment requireOneByPersonnelId(int $personnel_id) Return the first ChildPersonnelEquipment filtered by the personnel_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPersonnelEquipment[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPersonnelEquipment objects based on current ModelCriteria
 * @method     ChildPersonnelEquipment[]|ObjectCollection findByPersonnelEquipmentId(int $personnel_equipment_id) Return ChildPersonnelEquipment objects filtered by the personnel_equipment_id column
 * @method     ChildPersonnelEquipment[]|ObjectCollection findByName(string $name) Return ChildPersonnelEquipment objects filtered by the name column
 * @method     ChildPersonnelEquipment[]|ObjectCollection findByBrand(string $brand) Return ChildPersonnelEquipment objects filtered by the brand column
 * @method     ChildPersonnelEquipment[]|ObjectCollection findByType(string $type) Return ChildPersonnelEquipment objects filtered by the type column
 * @method     ChildPersonnelEquipment[]|ObjectCollection findByEquipmentCondition(string $equipment_condition) Return ChildPersonnelEquipment objects filtered by the equipment_condition column
 * @method     ChildPersonnelEquipment[]|ObjectCollection findBySerialNumber(string $serial_number) Return ChildPersonnelEquipment objects filtered by the serial_number column
 * @method     ChildPersonnelEquipment[]|ObjectCollection findByPersonnelId(int $personnel_id) Return ChildPersonnelEquipment objects filtered by the personnel_id column
 * @method     ChildPersonnelEquipment[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PersonnelEquipmentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PersonnelEquipmentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PersonnelEquipment', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPersonnelEquipmentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPersonnelEquipmentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPersonnelEquipmentQuery) {
            return $criteria;
        }
        $query = new ChildPersonnelEquipmentQuery();
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
     * @return ChildPersonnelEquipment|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PersonnelEquipmentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PersonnelEquipmentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPersonnelEquipment A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT personnel_equipment_id, name, brand, type, equipment_condition, serial_number, personnel_id FROM personnel_equipment WHERE personnel_equipment_id = :p0';
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
            /** @var ChildPersonnelEquipment $obj */
            $obj = new ChildPersonnelEquipment();
            $obj->hydrate($row);
            PersonnelEquipmentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPersonnelEquipment|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPersonnelEquipmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PersonnelEquipmentTableMap::COL_PERSONNEL_EQUIPMENT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPersonnelEquipmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PersonnelEquipmentTableMap::COL_PERSONNEL_EQUIPMENT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the personnel_equipment_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonnelEquipmentId(1234); // WHERE personnel_equipment_id = 1234
     * $query->filterByPersonnelEquipmentId(array(12, 34)); // WHERE personnel_equipment_id IN (12, 34)
     * $query->filterByPersonnelEquipmentId(array('min' => 12)); // WHERE personnel_equipment_id > 12
     * </code>
     *
     * @param     mixed $personnelEquipmentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonnelEquipmentQuery The current query, for fluid interface
     */
    public function filterByPersonnelEquipmentId($personnelEquipmentId = null, $comparison = null)
    {
        if (is_array($personnelEquipmentId)) {
            $useMinMax = false;
            if (isset($personnelEquipmentId['min'])) {
                $this->addUsingAlias(PersonnelEquipmentTableMap::COL_PERSONNEL_EQUIPMENT_ID, $personnelEquipmentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($personnelEquipmentId['max'])) {
                $this->addUsingAlias(PersonnelEquipmentTableMap::COL_PERSONNEL_EQUIPMENT_ID, $personnelEquipmentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelEquipmentTableMap::COL_PERSONNEL_EQUIPMENT_ID, $personnelEquipmentId, $comparison);
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
     * @return $this|ChildPersonnelEquipmentQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelEquipmentTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildPersonnelEquipmentQuery The current query, for fluid interface
     */
    public function filterByBrand($brand = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brand)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelEquipmentTableMap::COL_BRAND, $brand, $comparison);
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
     * @return $this|ChildPersonnelEquipmentQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelEquipmentTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the equipment_condition column
     *
     * Example usage:
     * <code>
     * $query->filterByEquipmentCondition('fooValue');   // WHERE equipment_condition = 'fooValue'
     * $query->filterByEquipmentCondition('%fooValue%', Criteria::LIKE); // WHERE equipment_condition LIKE '%fooValue%'
     * </code>
     *
     * @param     string $equipmentCondition The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonnelEquipmentQuery The current query, for fluid interface
     */
    public function filterByEquipmentCondition($equipmentCondition = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($equipmentCondition)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelEquipmentTableMap::COL_EQUIPMENT_CONDITION, $equipmentCondition, $comparison);
    }

    /**
     * Filter the query on the serial_number column
     *
     * Example usage:
     * <code>
     * $query->filterBySerialNumber('fooValue');   // WHERE serial_number = 'fooValue'
     * $query->filterBySerialNumber('%fooValue%', Criteria::LIKE); // WHERE serial_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $serialNumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPersonnelEquipmentQuery The current query, for fluid interface
     */
    public function filterBySerialNumber($serialNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($serialNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelEquipmentTableMap::COL_SERIAL_NUMBER, $serialNumber, $comparison);
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
     * @return $this|ChildPersonnelEquipmentQuery The current query, for fluid interface
     */
    public function filterByPersonnelId($personnelId = null, $comparison = null)
    {
        if (is_array($personnelId)) {
            $useMinMax = false;
            if (isset($personnelId['min'])) {
                $this->addUsingAlias(PersonnelEquipmentTableMap::COL_PERSONNEL_ID, $personnelId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($personnelId['max'])) {
                $this->addUsingAlias(PersonnelEquipmentTableMap::COL_PERSONNEL_ID, $personnelId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PersonnelEquipmentTableMap::COL_PERSONNEL_ID, $personnelId, $comparison);
    }

    /**
     * Filter the query by a related \Personnel object
     *
     * @param \Personnel|ObjectCollection $personnel The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPersonnelEquipmentQuery The current query, for fluid interface
     */
    public function filterByPersonnel($personnel, $comparison = null)
    {
        if ($personnel instanceof \Personnel) {
            return $this
                ->addUsingAlias(PersonnelEquipmentTableMap::COL_PERSONNEL_ID, $personnel->getPersonnelId(), $comparison);
        } elseif ($personnel instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PersonnelEquipmentTableMap::COL_PERSONNEL_ID, $personnel->toKeyValue('PrimaryKey', 'PersonnelId'), $comparison);
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
     * @return $this|ChildPersonnelEquipmentQuery The current query, for fluid interface
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
     * @param   ChildPersonnelEquipment $personnelEquipment Object to remove from the list of results
     *
     * @return $this|ChildPersonnelEquipmentQuery The current query, for fluid interface
     */
    public function prune($personnelEquipment = null)
    {
        if ($personnelEquipment) {
            $this->addUsingAlias(PersonnelEquipmentTableMap::COL_PERSONNEL_EQUIPMENT_ID, $personnelEquipment->getPersonnelEquipmentId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the personnel_equipment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonnelEquipmentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PersonnelEquipmentTableMap::clearInstancePool();
            PersonnelEquipmentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PersonnelEquipmentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PersonnelEquipmentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PersonnelEquipmentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PersonnelEquipmentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PersonnelEquipmentQuery
