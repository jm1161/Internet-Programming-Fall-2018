<?php

namespace Base;

use \Incident as ChildIncident;
use \IncidentQuery as ChildIncidentQuery;
use \Inventory as ChildInventory;
use \InventoryQuery as ChildInventoryQuery;
use \Jurisdiction as ChildJurisdiction;
use \JurisdictionQuery as ChildJurisdictionQuery;
use \Personnel as ChildPersonnel;
use \PersonnelQuery as ChildPersonnelQuery;
use \Shift as ChildShift;
use \ShiftQuery as ChildShiftQuery;
use \Station as ChildStation;
use \StationQuery as ChildStationQuery;
use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \Vehicles as ChildVehicles;
use \VehiclesQuery as ChildVehiclesQuery;
use \Exception;
use \PDO;
use Map\IncidentTableMap;
use Map\InventoryTableMap;
use Map\PersonnelTableMap;
use Map\ShiftTableMap;
use Map\StationTableMap;
use Map\UserTableMap;
use Map\VehiclesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'station' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Station implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\StationTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the station_id field.
     *
     * @var        int
     */
    protected $station_id;

    /**
     * The value for the station_name field.
     *
     * @var        string
     */
    protected $station_name;

    /**
     * The value for the address field.
     *
     * @var        string
     */
    protected $address;

    /**
     * The value for the jurisdiction_id field.
     *
     * @var        int
     */
    protected $jurisdiction_id;

    /**
     * @var        ChildJurisdiction
     */
    protected $aJurisdiction;

    /**
     * @var        ObjectCollection|ChildIncident[] Collection to store aggregation of ChildIncident objects.
     */
    protected $collIncidents;
    protected $collIncidentsPartial;

    /**
     * @var        ObjectCollection|ChildInventory[] Collection to store aggregation of ChildInventory objects.
     */
    protected $collInventories;
    protected $collInventoriesPartial;

    /**
     * @var        ObjectCollection|ChildPersonnel[] Collection to store aggregation of ChildPersonnel objects.
     */
    protected $collPersonnels;
    protected $collPersonnelsPartial;

    /**
     * @var        ObjectCollection|ChildShift[] Collection to store aggregation of ChildShift objects.
     */
    protected $collShifts;
    protected $collShiftsPartial;

    /**
     * @var        ObjectCollection|ChildUser[] Collection to store aggregation of ChildUser objects.
     */
    protected $collUsers;
    protected $collUsersPartial;

    /**
     * @var        ObjectCollection|ChildVehicles[] Collection to store aggregation of ChildVehicles objects.
     */
    protected $collVehicless;
    protected $collVehiclessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildIncident[]
     */
    protected $incidentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildInventory[]
     */
    protected $inventoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPersonnel[]
     */
    protected $personnelsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildShift[]
     */
    protected $shiftsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUser[]
     */
    protected $usersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVehicles[]
     */
    protected $vehiclessScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Station object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Station</code> instance.  If
     * <code>obj</code> is an instance of <code>Station</code>, delegates to
     * <code>equals(Station)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Station The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [station_id] column value.
     *
     * @return int
     */
    public function getStationId()
    {
        return $this->station_id;
    }

    /**
     * Get the [station_name] column value.
     *
     * @return string
     */
    public function getStationName()
    {
        return $this->station_name;
    }

    /**
     * Get the [address] column value.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [jurisdiction_id] column value.
     *
     * @return int
     */
    public function getJurisdictionId()
    {
        return $this->jurisdiction_id;
    }

    /**
     * Set the value of [station_id] column.
     *
     * @param int $v new value
     * @return $this|\Station The current object (for fluent API support)
     */
    public function setStationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->station_id !== $v) {
            $this->station_id = $v;
            $this->modifiedColumns[StationTableMap::COL_STATION_ID] = true;
        }

        return $this;
    } // setStationId()

    /**
     * Set the value of [station_name] column.
     *
     * @param string $v new value
     * @return $this|\Station The current object (for fluent API support)
     */
    public function setStationName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->station_name !== $v) {
            $this->station_name = $v;
            $this->modifiedColumns[StationTableMap::COL_STATION_NAME] = true;
        }

        return $this;
    } // setStationName()

    /**
     * Set the value of [address] column.
     *
     * @param string $v new value
     * @return $this|\Station The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[StationTableMap::COL_ADDRESS] = true;
        }

        return $this;
    } // setAddress()

    /**
     * Set the value of [jurisdiction_id] column.
     *
     * @param int $v new value
     * @return $this|\Station The current object (for fluent API support)
     */
    public function setJurisdictionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->jurisdiction_id !== $v) {
            $this->jurisdiction_id = $v;
            $this->modifiedColumns[StationTableMap::COL_JURISDICTION_ID] = true;
        }

        if ($this->aJurisdiction !== null && $this->aJurisdiction->getJurisdictionId() !== $v) {
            $this->aJurisdiction = null;
        }

        return $this;
    } // setJurisdictionId()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : StationTableMap::translateFieldName('StationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->station_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : StationTableMap::translateFieldName('StationName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->station_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : StationTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : StationTableMap::translateFieldName('JurisdictionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->jurisdiction_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = StationTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Station'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aJurisdiction !== null && $this->jurisdiction_id !== $this->aJurisdiction->getJurisdictionId()) {
            $this->aJurisdiction = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StationTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildStationQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aJurisdiction = null;
            $this->collIncidents = null;

            $this->collInventories = null;

            $this->collPersonnels = null;

            $this->collShifts = null;

            $this->collUsers = null;

            $this->collVehicless = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Station::setDeleted()
     * @see Station::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(StationTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildStationQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(StationTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                StationTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aJurisdiction !== null) {
                if ($this->aJurisdiction->isModified() || $this->aJurisdiction->isNew()) {
                    $affectedRows += $this->aJurisdiction->save($con);
                }
                $this->setJurisdiction($this->aJurisdiction);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->incidentsScheduledForDeletion !== null) {
                if (!$this->incidentsScheduledForDeletion->isEmpty()) {
                    \IncidentQuery::create()
                        ->filterByPrimaryKeys($this->incidentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->incidentsScheduledForDeletion = null;
                }
            }

            if ($this->collIncidents !== null) {
                foreach ($this->collIncidents as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->inventoriesScheduledForDeletion !== null) {
                if (!$this->inventoriesScheduledForDeletion->isEmpty()) {
                    \InventoryQuery::create()
                        ->filterByPrimaryKeys($this->inventoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->inventoriesScheduledForDeletion = null;
                }
            }

            if ($this->collInventories !== null) {
                foreach ($this->collInventories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->personnelsScheduledForDeletion !== null) {
                if (!$this->personnelsScheduledForDeletion->isEmpty()) {
                    \PersonnelQuery::create()
                        ->filterByPrimaryKeys($this->personnelsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->personnelsScheduledForDeletion = null;
                }
            }

            if ($this->collPersonnels !== null) {
                foreach ($this->collPersonnels as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->shiftsScheduledForDeletion !== null) {
                if (!$this->shiftsScheduledForDeletion->isEmpty()) {
                    \ShiftQuery::create()
                        ->filterByPrimaryKeys($this->shiftsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->shiftsScheduledForDeletion = null;
                }
            }

            if ($this->collShifts !== null) {
                foreach ($this->collShifts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->usersScheduledForDeletion !== null) {
                if (!$this->usersScheduledForDeletion->isEmpty()) {
                    \UserQuery::create()
                        ->filterByPrimaryKeys($this->usersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->usersScheduledForDeletion = null;
                }
            }

            if ($this->collUsers !== null) {
                foreach ($this->collUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->vehiclessScheduledForDeletion !== null) {
                if (!$this->vehiclessScheduledForDeletion->isEmpty()) {
                    \VehiclesQuery::create()
                        ->filterByPrimaryKeys($this->vehiclessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->vehiclessScheduledForDeletion = null;
                }
            }

            if ($this->collVehicless !== null) {
                foreach ($this->collVehicless as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[StationTableMap::COL_STATION_ID] = true;
        if (null !== $this->station_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . StationTableMap::COL_STATION_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(StationTableMap::COL_STATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'station_id';
        }
        if ($this->isColumnModified(StationTableMap::COL_STATION_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'station_name';
        }
        if ($this->isColumnModified(StationTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'address';
        }
        if ($this->isColumnModified(StationTableMap::COL_JURISDICTION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'jurisdiction_id';
        }

        $sql = sprintf(
            'INSERT INTO station (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'station_id':
                        $stmt->bindValue($identifier, $this->station_id, PDO::PARAM_INT);
                        break;
                    case 'station_name':
                        $stmt->bindValue($identifier, $this->station_name, PDO::PARAM_STR);
                        break;
                    case 'address':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case 'jurisdiction_id':
                        $stmt->bindValue($identifier, $this->jurisdiction_id, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setStationId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = StationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getStationId();
                break;
            case 1:
                return $this->getStationName();
                break;
            case 2:
                return $this->getAddress();
                break;
            case 3:
                return $this->getJurisdictionId();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Station'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Station'][$this->hashCode()] = true;
        $keys = StationTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getStationId(),
            $keys[1] => $this->getStationName(),
            $keys[2] => $this->getAddress(),
            $keys[3] => $this->getJurisdictionId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aJurisdiction) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'jurisdiction';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'jurisdiction';
                        break;
                    default:
                        $key = 'Jurisdiction';
                }

                $result[$key] = $this->aJurisdiction->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collIncidents) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'incidents';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'incidents';
                        break;
                    default:
                        $key = 'Incidents';
                }

                $result[$key] = $this->collIncidents->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collInventories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'inventories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'inventories';
                        break;
                    default:
                        $key = 'Inventories';
                }

                $result[$key] = $this->collInventories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPersonnels) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'personnels';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'personnels';
                        break;
                    default:
                        $key = 'Personnels';
                }

                $result[$key] = $this->collPersonnels->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collShifts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'shifts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'shifts';
                        break;
                    default:
                        $key = 'Shifts';
                }

                $result[$key] = $this->collShifts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'users';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'users';
                        break;
                    default:
                        $key = 'Users';
                }

                $result[$key] = $this->collUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVehicless) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'vehicless';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'vehicless';
                        break;
                    default:
                        $key = 'Vehicless';
                }

                $result[$key] = $this->collVehicless->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Station
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = StationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Station
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setStationId($value);
                break;
            case 1:
                $this->setStationName($value);
                break;
            case 2:
                $this->setAddress($value);
                break;
            case 3:
                $this->setJurisdictionId($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = StationTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setStationId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setStationName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAddress($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setJurisdictionId($arr[$keys[3]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Station The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(StationTableMap::DATABASE_NAME);

        if ($this->isColumnModified(StationTableMap::COL_STATION_ID)) {
            $criteria->add(StationTableMap::COL_STATION_ID, $this->station_id);
        }
        if ($this->isColumnModified(StationTableMap::COL_STATION_NAME)) {
            $criteria->add(StationTableMap::COL_STATION_NAME, $this->station_name);
        }
        if ($this->isColumnModified(StationTableMap::COL_ADDRESS)) {
            $criteria->add(StationTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(StationTableMap::COL_JURISDICTION_ID)) {
            $criteria->add(StationTableMap::COL_JURISDICTION_ID, $this->jurisdiction_id);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildStationQuery::create();
        $criteria->add(StationTableMap::COL_STATION_ID, $this->station_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getStationId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getStationId();
    }

    /**
     * Generic method to set the primary key (station_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setStationId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getStationId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Station (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setStationName($this->getStationName());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setJurisdictionId($this->getJurisdictionId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getIncidents() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addIncident($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getInventories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addInventory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPersonnels() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPersonnel($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getShifts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addShift($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVehicless() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVehicles($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setStationId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Station Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildJurisdiction object.
     *
     * @param  ChildJurisdiction $v
     * @return $this|\Station The current object (for fluent API support)
     * @throws PropelException
     */
    public function setJurisdiction(ChildJurisdiction $v = null)
    {
        if ($v === null) {
            $this->setJurisdictionId(NULL);
        } else {
            $this->setJurisdictionId($v->getJurisdictionId());
        }

        $this->aJurisdiction = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildJurisdiction object, it will not be re-added.
        if ($v !== null) {
            $v->addStation($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildJurisdiction object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildJurisdiction The associated ChildJurisdiction object.
     * @throws PropelException
     */
    public function getJurisdiction(ConnectionInterface $con = null)
    {
        if ($this->aJurisdiction === null && ($this->jurisdiction_id != 0)) {
            $this->aJurisdiction = ChildJurisdictionQuery::create()->findPk($this->jurisdiction_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aJurisdiction->addStations($this);
             */
        }

        return $this->aJurisdiction;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Incident' == $relationName) {
            $this->initIncidents();
            return;
        }
        if ('Inventory' == $relationName) {
            $this->initInventories();
            return;
        }
        if ('Personnel' == $relationName) {
            $this->initPersonnels();
            return;
        }
        if ('Shift' == $relationName) {
            $this->initShifts();
            return;
        }
        if ('User' == $relationName) {
            $this->initUsers();
            return;
        }
        if ('Vehicles' == $relationName) {
            $this->initVehicless();
            return;
        }
    }

    /**
     * Clears out the collIncidents collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addIncidents()
     */
    public function clearIncidents()
    {
        $this->collIncidents = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collIncidents collection loaded partially.
     */
    public function resetPartialIncidents($v = true)
    {
        $this->collIncidentsPartial = $v;
    }

    /**
     * Initializes the collIncidents collection.
     *
     * By default this just sets the collIncidents collection to an empty array (like clearcollIncidents());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initIncidents($overrideExisting = true)
    {
        if (null !== $this->collIncidents && !$overrideExisting) {
            return;
        }

        $collectionClassName = IncidentTableMap::getTableMap()->getCollectionClassName();

        $this->collIncidents = new $collectionClassName;
        $this->collIncidents->setModel('\Incident');
    }

    /**
     * Gets an array of ChildIncident objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildStation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildIncident[] List of ChildIncident objects
     * @throws PropelException
     */
    public function getIncidents(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collIncidentsPartial && !$this->isNew();
        if (null === $this->collIncidents || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collIncidents) {
                // return empty collection
                $this->initIncidents();
            } else {
                $collIncidents = ChildIncidentQuery::create(null, $criteria)
                    ->filterByStation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collIncidentsPartial && count($collIncidents)) {
                        $this->initIncidents(false);

                        foreach ($collIncidents as $obj) {
                            if (false == $this->collIncidents->contains($obj)) {
                                $this->collIncidents->append($obj);
                            }
                        }

                        $this->collIncidentsPartial = true;
                    }

                    return $collIncidents;
                }

                if ($partial && $this->collIncidents) {
                    foreach ($this->collIncidents as $obj) {
                        if ($obj->isNew()) {
                            $collIncidents[] = $obj;
                        }
                    }
                }

                $this->collIncidents = $collIncidents;
                $this->collIncidentsPartial = false;
            }
        }

        return $this->collIncidents;
    }

    /**
     * Sets a collection of ChildIncident objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $incidents A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildStation The current object (for fluent API support)
     */
    public function setIncidents(Collection $incidents, ConnectionInterface $con = null)
    {
        /** @var ChildIncident[] $incidentsToDelete */
        $incidentsToDelete = $this->getIncidents(new Criteria(), $con)->diff($incidents);


        $this->incidentsScheduledForDeletion = $incidentsToDelete;

        foreach ($incidentsToDelete as $incidentRemoved) {
            $incidentRemoved->setStation(null);
        }

        $this->collIncidents = null;
        foreach ($incidents as $incident) {
            $this->addIncident($incident);
        }

        $this->collIncidents = $incidents;
        $this->collIncidentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Incident objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Incident objects.
     * @throws PropelException
     */
    public function countIncidents(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collIncidentsPartial && !$this->isNew();
        if (null === $this->collIncidents || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collIncidents) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getIncidents());
            }

            $query = ChildIncidentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStation($this)
                ->count($con);
        }

        return count($this->collIncidents);
    }

    /**
     * Method called to associate a ChildIncident object to this object
     * through the ChildIncident foreign key attribute.
     *
     * @param  ChildIncident $l ChildIncident
     * @return $this|\Station The current object (for fluent API support)
     */
    public function addIncident(ChildIncident $l)
    {
        if ($this->collIncidents === null) {
            $this->initIncidents();
            $this->collIncidentsPartial = true;
        }

        if (!$this->collIncidents->contains($l)) {
            $this->doAddIncident($l);

            if ($this->incidentsScheduledForDeletion and $this->incidentsScheduledForDeletion->contains($l)) {
                $this->incidentsScheduledForDeletion->remove($this->incidentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildIncident $incident The ChildIncident object to add.
     */
    protected function doAddIncident(ChildIncident $incident)
    {
        $this->collIncidents[]= $incident;
        $incident->setStation($this);
    }

    /**
     * @param  ChildIncident $incident The ChildIncident object to remove.
     * @return $this|ChildStation The current object (for fluent API support)
     */
    public function removeIncident(ChildIncident $incident)
    {
        if ($this->getIncidents()->contains($incident)) {
            $pos = $this->collIncidents->search($incident);
            $this->collIncidents->remove($pos);
            if (null === $this->incidentsScheduledForDeletion) {
                $this->incidentsScheduledForDeletion = clone $this->collIncidents;
                $this->incidentsScheduledForDeletion->clear();
            }
            $this->incidentsScheduledForDeletion[]= clone $incident;
            $incident->setStation(null);
        }

        return $this;
    }

    /**
     * Clears out the collInventories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addInventories()
     */
    public function clearInventories()
    {
        $this->collInventories = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collInventories collection loaded partially.
     */
    public function resetPartialInventories($v = true)
    {
        $this->collInventoriesPartial = $v;
    }

    /**
     * Initializes the collInventories collection.
     *
     * By default this just sets the collInventories collection to an empty array (like clearcollInventories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initInventories($overrideExisting = true)
    {
        if (null !== $this->collInventories && !$overrideExisting) {
            return;
        }

        $collectionClassName = InventoryTableMap::getTableMap()->getCollectionClassName();

        $this->collInventories = new $collectionClassName;
        $this->collInventories->setModel('\Inventory');
    }

    /**
     * Gets an array of ChildInventory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildStation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildInventory[] List of ChildInventory objects
     * @throws PropelException
     */
    public function getInventories(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collInventoriesPartial && !$this->isNew();
        if (null === $this->collInventories || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collInventories) {
                // return empty collection
                $this->initInventories();
            } else {
                $collInventories = ChildInventoryQuery::create(null, $criteria)
                    ->filterByStation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collInventoriesPartial && count($collInventories)) {
                        $this->initInventories(false);

                        foreach ($collInventories as $obj) {
                            if (false == $this->collInventories->contains($obj)) {
                                $this->collInventories->append($obj);
                            }
                        }

                        $this->collInventoriesPartial = true;
                    }

                    return $collInventories;
                }

                if ($partial && $this->collInventories) {
                    foreach ($this->collInventories as $obj) {
                        if ($obj->isNew()) {
                            $collInventories[] = $obj;
                        }
                    }
                }

                $this->collInventories = $collInventories;
                $this->collInventoriesPartial = false;
            }
        }

        return $this->collInventories;
    }

    /**
     * Sets a collection of ChildInventory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $inventories A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildStation The current object (for fluent API support)
     */
    public function setInventories(Collection $inventories, ConnectionInterface $con = null)
    {
        /** @var ChildInventory[] $inventoriesToDelete */
        $inventoriesToDelete = $this->getInventories(new Criteria(), $con)->diff($inventories);


        $this->inventoriesScheduledForDeletion = $inventoriesToDelete;

        foreach ($inventoriesToDelete as $inventoryRemoved) {
            $inventoryRemoved->setStation(null);
        }

        $this->collInventories = null;
        foreach ($inventories as $inventory) {
            $this->addInventory($inventory);
        }

        $this->collInventories = $inventories;
        $this->collInventoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Inventory objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Inventory objects.
     * @throws PropelException
     */
    public function countInventories(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collInventoriesPartial && !$this->isNew();
        if (null === $this->collInventories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collInventories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getInventories());
            }

            $query = ChildInventoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStation($this)
                ->count($con);
        }

        return count($this->collInventories);
    }

    /**
     * Method called to associate a ChildInventory object to this object
     * through the ChildInventory foreign key attribute.
     *
     * @param  ChildInventory $l ChildInventory
     * @return $this|\Station The current object (for fluent API support)
     */
    public function addInventory(ChildInventory $l)
    {
        if ($this->collInventories === null) {
            $this->initInventories();
            $this->collInventoriesPartial = true;
        }

        if (!$this->collInventories->contains($l)) {
            $this->doAddInventory($l);

            if ($this->inventoriesScheduledForDeletion and $this->inventoriesScheduledForDeletion->contains($l)) {
                $this->inventoriesScheduledForDeletion->remove($this->inventoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildInventory $inventory The ChildInventory object to add.
     */
    protected function doAddInventory(ChildInventory $inventory)
    {
        $this->collInventories[]= $inventory;
        $inventory->setStation($this);
    }

    /**
     * @param  ChildInventory $inventory The ChildInventory object to remove.
     * @return $this|ChildStation The current object (for fluent API support)
     */
    public function removeInventory(ChildInventory $inventory)
    {
        if ($this->getInventories()->contains($inventory)) {
            $pos = $this->collInventories->search($inventory);
            $this->collInventories->remove($pos);
            if (null === $this->inventoriesScheduledForDeletion) {
                $this->inventoriesScheduledForDeletion = clone $this->collInventories;
                $this->inventoriesScheduledForDeletion->clear();
            }
            $this->inventoriesScheduledForDeletion[]= clone $inventory;
            $inventory->setStation(null);
        }

        return $this;
    }

    /**
     * Clears out the collPersonnels collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPersonnels()
     */
    public function clearPersonnels()
    {
        $this->collPersonnels = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPersonnels collection loaded partially.
     */
    public function resetPartialPersonnels($v = true)
    {
        $this->collPersonnelsPartial = $v;
    }

    /**
     * Initializes the collPersonnels collection.
     *
     * By default this just sets the collPersonnels collection to an empty array (like clearcollPersonnels());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPersonnels($overrideExisting = true)
    {
        if (null !== $this->collPersonnels && !$overrideExisting) {
            return;
        }

        $collectionClassName = PersonnelTableMap::getTableMap()->getCollectionClassName();

        $this->collPersonnels = new $collectionClassName;
        $this->collPersonnels->setModel('\Personnel');
    }

    /**
     * Gets an array of ChildPersonnel objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildStation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPersonnel[] List of ChildPersonnel objects
     * @throws PropelException
     */
    public function getPersonnels(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPersonnelsPartial && !$this->isNew();
        if (null === $this->collPersonnels || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPersonnels) {
                // return empty collection
                $this->initPersonnels();
            } else {
                $collPersonnels = ChildPersonnelQuery::create(null, $criteria)
                    ->filterByStation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPersonnelsPartial && count($collPersonnels)) {
                        $this->initPersonnels(false);

                        foreach ($collPersonnels as $obj) {
                            if (false == $this->collPersonnels->contains($obj)) {
                                $this->collPersonnels->append($obj);
                            }
                        }

                        $this->collPersonnelsPartial = true;
                    }

                    return $collPersonnels;
                }

                if ($partial && $this->collPersonnels) {
                    foreach ($this->collPersonnels as $obj) {
                        if ($obj->isNew()) {
                            $collPersonnels[] = $obj;
                        }
                    }
                }

                $this->collPersonnels = $collPersonnels;
                $this->collPersonnelsPartial = false;
            }
        }

        return $this->collPersonnels;
    }

    /**
     * Sets a collection of ChildPersonnel objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $personnels A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildStation The current object (for fluent API support)
     */
    public function setPersonnels(Collection $personnels, ConnectionInterface $con = null)
    {
        /** @var ChildPersonnel[] $personnelsToDelete */
        $personnelsToDelete = $this->getPersonnels(new Criteria(), $con)->diff($personnels);


        $this->personnelsScheduledForDeletion = $personnelsToDelete;

        foreach ($personnelsToDelete as $personnelRemoved) {
            $personnelRemoved->setStation(null);
        }

        $this->collPersonnels = null;
        foreach ($personnels as $personnel) {
            $this->addPersonnel($personnel);
        }

        $this->collPersonnels = $personnels;
        $this->collPersonnelsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Personnel objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Personnel objects.
     * @throws PropelException
     */
    public function countPersonnels(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPersonnelsPartial && !$this->isNew();
        if (null === $this->collPersonnels || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPersonnels) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPersonnels());
            }

            $query = ChildPersonnelQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStation($this)
                ->count($con);
        }

        return count($this->collPersonnels);
    }

    /**
     * Method called to associate a ChildPersonnel object to this object
     * through the ChildPersonnel foreign key attribute.
     *
     * @param  ChildPersonnel $l ChildPersonnel
     * @return $this|\Station The current object (for fluent API support)
     */
    public function addPersonnel(ChildPersonnel $l)
    {
        if ($this->collPersonnels === null) {
            $this->initPersonnels();
            $this->collPersonnelsPartial = true;
        }

        if (!$this->collPersonnels->contains($l)) {
            $this->doAddPersonnel($l);

            if ($this->personnelsScheduledForDeletion and $this->personnelsScheduledForDeletion->contains($l)) {
                $this->personnelsScheduledForDeletion->remove($this->personnelsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPersonnel $personnel The ChildPersonnel object to add.
     */
    protected function doAddPersonnel(ChildPersonnel $personnel)
    {
        $this->collPersonnels[]= $personnel;
        $personnel->setStation($this);
    }

    /**
     * @param  ChildPersonnel $personnel The ChildPersonnel object to remove.
     * @return $this|ChildStation The current object (for fluent API support)
     */
    public function removePersonnel(ChildPersonnel $personnel)
    {
        if ($this->getPersonnels()->contains($personnel)) {
            $pos = $this->collPersonnels->search($personnel);
            $this->collPersonnels->remove($pos);
            if (null === $this->personnelsScheduledForDeletion) {
                $this->personnelsScheduledForDeletion = clone $this->collPersonnels;
                $this->personnelsScheduledForDeletion->clear();
            }
            $this->personnelsScheduledForDeletion[]= clone $personnel;
            $personnel->setStation(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Station is new, it will return
     * an empty collection; or if this Station has previously
     * been saved, it will retrieve related Personnels from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Station.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPersonnel[] List of ChildPersonnel objects
     */
    public function getPersonnelsJoinShift(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPersonnelQuery::create(null, $criteria);
        $query->joinWith('Shift', $joinBehavior);

        return $this->getPersonnels($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Station is new, it will return
     * an empty collection; or if this Station has previously
     * been saved, it will retrieve related Personnels from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Station.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPersonnel[] List of ChildPersonnel objects
     */
    public function getPersonnelsJoinCertifications(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPersonnelQuery::create(null, $criteria);
        $query->joinWith('Certifications', $joinBehavior);

        return $this->getPersonnels($query, $con);
    }

    /**
     * Clears out the collShifts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addShifts()
     */
    public function clearShifts()
    {
        $this->collShifts = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collShifts collection loaded partially.
     */
    public function resetPartialShifts($v = true)
    {
        $this->collShiftsPartial = $v;
    }

    /**
     * Initializes the collShifts collection.
     *
     * By default this just sets the collShifts collection to an empty array (like clearcollShifts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initShifts($overrideExisting = true)
    {
        if (null !== $this->collShifts && !$overrideExisting) {
            return;
        }

        $collectionClassName = ShiftTableMap::getTableMap()->getCollectionClassName();

        $this->collShifts = new $collectionClassName;
        $this->collShifts->setModel('\Shift');
    }

    /**
     * Gets an array of ChildShift objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildStation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildShift[] List of ChildShift objects
     * @throws PropelException
     */
    public function getShifts(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collShiftsPartial && !$this->isNew();
        if (null === $this->collShifts || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collShifts) {
                // return empty collection
                $this->initShifts();
            } else {
                $collShifts = ChildShiftQuery::create(null, $criteria)
                    ->filterByStation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collShiftsPartial && count($collShifts)) {
                        $this->initShifts(false);

                        foreach ($collShifts as $obj) {
                            if (false == $this->collShifts->contains($obj)) {
                                $this->collShifts->append($obj);
                            }
                        }

                        $this->collShiftsPartial = true;
                    }

                    return $collShifts;
                }

                if ($partial && $this->collShifts) {
                    foreach ($this->collShifts as $obj) {
                        if ($obj->isNew()) {
                            $collShifts[] = $obj;
                        }
                    }
                }

                $this->collShifts = $collShifts;
                $this->collShiftsPartial = false;
            }
        }

        return $this->collShifts;
    }

    /**
     * Sets a collection of ChildShift objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $shifts A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildStation The current object (for fluent API support)
     */
    public function setShifts(Collection $shifts, ConnectionInterface $con = null)
    {
        /** @var ChildShift[] $shiftsToDelete */
        $shiftsToDelete = $this->getShifts(new Criteria(), $con)->diff($shifts);


        $this->shiftsScheduledForDeletion = $shiftsToDelete;

        foreach ($shiftsToDelete as $shiftRemoved) {
            $shiftRemoved->setStation(null);
        }

        $this->collShifts = null;
        foreach ($shifts as $shift) {
            $this->addShift($shift);
        }

        $this->collShifts = $shifts;
        $this->collShiftsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Shift objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Shift objects.
     * @throws PropelException
     */
    public function countShifts(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collShiftsPartial && !$this->isNew();
        if (null === $this->collShifts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collShifts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getShifts());
            }

            $query = ChildShiftQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStation($this)
                ->count($con);
        }

        return count($this->collShifts);
    }

    /**
     * Method called to associate a ChildShift object to this object
     * through the ChildShift foreign key attribute.
     *
     * @param  ChildShift $l ChildShift
     * @return $this|\Station The current object (for fluent API support)
     */
    public function addShift(ChildShift $l)
    {
        if ($this->collShifts === null) {
            $this->initShifts();
            $this->collShiftsPartial = true;
        }

        if (!$this->collShifts->contains($l)) {
            $this->doAddShift($l);

            if ($this->shiftsScheduledForDeletion and $this->shiftsScheduledForDeletion->contains($l)) {
                $this->shiftsScheduledForDeletion->remove($this->shiftsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildShift $shift The ChildShift object to add.
     */
    protected function doAddShift(ChildShift $shift)
    {
        $this->collShifts[]= $shift;
        $shift->setStation($this);
    }

    /**
     * @param  ChildShift $shift The ChildShift object to remove.
     * @return $this|ChildStation The current object (for fluent API support)
     */
    public function removeShift(ChildShift $shift)
    {
        if ($this->getShifts()->contains($shift)) {
            $pos = $this->collShifts->search($shift);
            $this->collShifts->remove($pos);
            if (null === $this->shiftsScheduledForDeletion) {
                $this->shiftsScheduledForDeletion = clone $this->collShifts;
                $this->shiftsScheduledForDeletion->clear();
            }
            $this->shiftsScheduledForDeletion[]= clone $shift;
            $shift->setStation(null);
        }

        return $this;
    }

    /**
     * Clears out the collUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUsers()
     */
    public function clearUsers()
    {
        $this->collUsers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUsers collection loaded partially.
     */
    public function resetPartialUsers($v = true)
    {
        $this->collUsersPartial = $v;
    }

    /**
     * Initializes the collUsers collection.
     *
     * By default this just sets the collUsers collection to an empty array (like clearcollUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsers($overrideExisting = true)
    {
        if (null !== $this->collUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserTableMap::getTableMap()->getCollectionClassName();

        $this->collUsers = new $collectionClassName;
        $this->collUsers->setModel('\User');
    }

    /**
     * Gets an array of ChildUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildStation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUser[] List of ChildUser objects
     * @throws PropelException
     */
    public function getUsers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUsersPartial && !$this->isNew();
        if (null === $this->collUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsers) {
                // return empty collection
                $this->initUsers();
            } else {
                $collUsers = ChildUserQuery::create(null, $criteria)
                    ->filterByStation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUsersPartial && count($collUsers)) {
                        $this->initUsers(false);

                        foreach ($collUsers as $obj) {
                            if (false == $this->collUsers->contains($obj)) {
                                $this->collUsers->append($obj);
                            }
                        }

                        $this->collUsersPartial = true;
                    }

                    return $collUsers;
                }

                if ($partial && $this->collUsers) {
                    foreach ($this->collUsers as $obj) {
                        if ($obj->isNew()) {
                            $collUsers[] = $obj;
                        }
                    }
                }

                $this->collUsers = $collUsers;
                $this->collUsersPartial = false;
            }
        }

        return $this->collUsers;
    }

    /**
     * Sets a collection of ChildUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $users A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildStation The current object (for fluent API support)
     */
    public function setUsers(Collection $users, ConnectionInterface $con = null)
    {
        /** @var ChildUser[] $usersToDelete */
        $usersToDelete = $this->getUsers(new Criteria(), $con)->diff($users);


        $this->usersScheduledForDeletion = $usersToDelete;

        foreach ($usersToDelete as $userRemoved) {
            $userRemoved->setStation(null);
        }

        $this->collUsers = null;
        foreach ($users as $user) {
            $this->addUser($user);
        }

        $this->collUsers = $users;
        $this->collUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related User objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related User objects.
     * @throws PropelException
     */
    public function countUsers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUsersPartial && !$this->isNew();
        if (null === $this->collUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsers());
            }

            $query = ChildUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStation($this)
                ->count($con);
        }

        return count($this->collUsers);
    }

    /**
     * Method called to associate a ChildUser object to this object
     * through the ChildUser foreign key attribute.
     *
     * @param  ChildUser $l ChildUser
     * @return $this|\Station The current object (for fluent API support)
     */
    public function addUser(ChildUser $l)
    {
        if ($this->collUsers === null) {
            $this->initUsers();
            $this->collUsersPartial = true;
        }

        if (!$this->collUsers->contains($l)) {
            $this->doAddUser($l);

            if ($this->usersScheduledForDeletion and $this->usersScheduledForDeletion->contains($l)) {
                $this->usersScheduledForDeletion->remove($this->usersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUser $user The ChildUser object to add.
     */
    protected function doAddUser(ChildUser $user)
    {
        $this->collUsers[]= $user;
        $user->setStation($this);
    }

    /**
     * @param  ChildUser $user The ChildUser object to remove.
     * @return $this|ChildStation The current object (for fluent API support)
     */
    public function removeUser(ChildUser $user)
    {
        if ($this->getUsers()->contains($user)) {
            $pos = $this->collUsers->search($user);
            $this->collUsers->remove($pos);
            if (null === $this->usersScheduledForDeletion) {
                $this->usersScheduledForDeletion = clone $this->collUsers;
                $this->usersScheduledForDeletion->clear();
            }
            $this->usersScheduledForDeletion[]= clone $user;
            $user->setStation(null);
        }

        return $this;
    }

    /**
     * Clears out the collVehicless collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVehicless()
     */
    public function clearVehicless()
    {
        $this->collVehicless = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVehicless collection loaded partially.
     */
    public function resetPartialVehicless($v = true)
    {
        $this->collVehiclessPartial = $v;
    }

    /**
     * Initializes the collVehicless collection.
     *
     * By default this just sets the collVehicless collection to an empty array (like clearcollVehicless());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVehicless($overrideExisting = true)
    {
        if (null !== $this->collVehicless && !$overrideExisting) {
            return;
        }

        $collectionClassName = VehiclesTableMap::getTableMap()->getCollectionClassName();

        $this->collVehicless = new $collectionClassName;
        $this->collVehicless->setModel('\Vehicles');
    }

    /**
     * Gets an array of ChildVehicles objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildStation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVehicles[] List of ChildVehicles objects
     * @throws PropelException
     */
    public function getVehicless(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVehiclessPartial && !$this->isNew();
        if (null === $this->collVehicless || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVehicless) {
                // return empty collection
                $this->initVehicless();
            } else {
                $collVehicless = ChildVehiclesQuery::create(null, $criteria)
                    ->filterByStation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVehiclessPartial && count($collVehicless)) {
                        $this->initVehicless(false);

                        foreach ($collVehicless as $obj) {
                            if (false == $this->collVehicless->contains($obj)) {
                                $this->collVehicless->append($obj);
                            }
                        }

                        $this->collVehiclessPartial = true;
                    }

                    return $collVehicless;
                }

                if ($partial && $this->collVehicless) {
                    foreach ($this->collVehicless as $obj) {
                        if ($obj->isNew()) {
                            $collVehicless[] = $obj;
                        }
                    }
                }

                $this->collVehicless = $collVehicless;
                $this->collVehiclessPartial = false;
            }
        }

        return $this->collVehicless;
    }

    /**
     * Sets a collection of ChildVehicles objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $vehicless A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildStation The current object (for fluent API support)
     */
    public function setVehicless(Collection $vehicless, ConnectionInterface $con = null)
    {
        /** @var ChildVehicles[] $vehiclessToDelete */
        $vehiclessToDelete = $this->getVehicless(new Criteria(), $con)->diff($vehicless);


        $this->vehiclessScheduledForDeletion = $vehiclessToDelete;

        foreach ($vehiclessToDelete as $vehiclesRemoved) {
            $vehiclesRemoved->setStation(null);
        }

        $this->collVehicless = null;
        foreach ($vehicless as $vehicles) {
            $this->addVehicles($vehicles);
        }

        $this->collVehicless = $vehicless;
        $this->collVehiclessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Vehicles objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Vehicles objects.
     * @throws PropelException
     */
    public function countVehicless(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVehiclessPartial && !$this->isNew();
        if (null === $this->collVehicless || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVehicless) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVehicless());
            }

            $query = ChildVehiclesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStation($this)
                ->count($con);
        }

        return count($this->collVehicless);
    }

    /**
     * Method called to associate a ChildVehicles object to this object
     * through the ChildVehicles foreign key attribute.
     *
     * @param  ChildVehicles $l ChildVehicles
     * @return $this|\Station The current object (for fluent API support)
     */
    public function addVehicles(ChildVehicles $l)
    {
        if ($this->collVehicless === null) {
            $this->initVehicless();
            $this->collVehiclessPartial = true;
        }

        if (!$this->collVehicless->contains($l)) {
            $this->doAddVehicles($l);

            if ($this->vehiclessScheduledForDeletion and $this->vehiclessScheduledForDeletion->contains($l)) {
                $this->vehiclessScheduledForDeletion->remove($this->vehiclessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVehicles $vehicles The ChildVehicles object to add.
     */
    protected function doAddVehicles(ChildVehicles $vehicles)
    {
        $this->collVehicless[]= $vehicles;
        $vehicles->setStation($this);
    }

    /**
     * @param  ChildVehicles $vehicles The ChildVehicles object to remove.
     * @return $this|ChildStation The current object (for fluent API support)
     */
    public function removeVehicles(ChildVehicles $vehicles)
    {
        if ($this->getVehicless()->contains($vehicles)) {
            $pos = $this->collVehicless->search($vehicles);
            $this->collVehicless->remove($pos);
            if (null === $this->vehiclessScheduledForDeletion) {
                $this->vehiclessScheduledForDeletion = clone $this->collVehicless;
                $this->vehiclessScheduledForDeletion->clear();
            }
            $this->vehiclessScheduledForDeletion[]= clone $vehicles;
            $vehicles->setStation(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aJurisdiction) {
            $this->aJurisdiction->removeStation($this);
        }
        $this->station_id = null;
        $this->station_name = null;
        $this->address = null;
        $this->jurisdiction_id = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collIncidents) {
                foreach ($this->collIncidents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collInventories) {
                foreach ($this->collInventories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPersonnels) {
                foreach ($this->collPersonnels as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collShifts) {
                foreach ($this->collShifts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsers) {
                foreach ($this->collUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVehicless) {
                foreach ($this->collVehicless as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collIncidents = null;
        $this->collInventories = null;
        $this->collPersonnels = null;
        $this->collShifts = null;
        $this->collUsers = null;
        $this->collVehicless = null;
        $this->aJurisdiction = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(StationTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
