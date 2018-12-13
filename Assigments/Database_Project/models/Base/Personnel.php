<?php

namespace Base;

use \Certifications as ChildCertifications;
use \CertificationsQuery as ChildCertificationsQuery;
use \Personnel as ChildPersonnel;
use \PersonnelEquipment as ChildPersonnelEquipment;
use \PersonnelEquipmentQuery as ChildPersonnelEquipmentQuery;
use \PersonnelQuery as ChildPersonnelQuery;
use \Shift as ChildShift;
use \ShiftQuery as ChildShiftQuery;
use \Station as ChildStation;
use \StationQuery as ChildStationQuery;
use \Supervisors as ChildSupervisors;
use \SupervisorsQuery as ChildSupervisorsQuery;
use \Exception;
use \PDO;
use Map\PersonnelEquipmentTableMap;
use Map\PersonnelTableMap;
use Map\SupervisorsTableMap;
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
 * Base class that represents a row from the 'personnel' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Personnel implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\PersonnelTableMap';


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
     * The value for the personnel_id field.
     *
     * @var        int
     */
    protected $personnel_id;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the address field.
     *
     * @var        string
     */
    protected $address;

    /**
     * The value for the height field.
     *
     * @var        string
     */
    protected $height;

    /**
     * The value for the weight field.
     *
     * @var        int
     */
    protected $weight;

    /**
     * The value for the ssn field.
     *
     * @var        string
     */
    protected $ssn;

    /**
     * The value for the phone_number field.
     *
     * @var        string
     */
    protected $phone_number;

    /**
     * The value for the shift_id field.
     *
     * @var        int
     */
    protected $shift_id;

    /**
     * The value for the certification_id field.
     *
     * @var        int
     */
    protected $certification_id;

    /**
     * The value for the station_id field.
     *
     * @var        int
     */
    protected $station_id;

    /**
     * @var        ChildShift
     */
    protected $aShift;

    /**
     * @var        ChildCertifications
     */
    protected $aCertifications;

    /**
     * @var        ChildStation
     */
    protected $aStation;

    /**
     * @var        ObjectCollection|ChildPersonnelEquipment[] Collection to store aggregation of ChildPersonnelEquipment objects.
     */
    protected $collPersonnelEquipments;
    protected $collPersonnelEquipmentsPartial;

    /**
     * @var        ObjectCollection|ChildSupervisors[] Collection to store aggregation of ChildSupervisors objects.
     */
    protected $collSupervisorss;
    protected $collSupervisorssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPersonnelEquipment[]
     */
    protected $personnelEquipmentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSupervisors[]
     */
    protected $supervisorssScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Personnel object.
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
     * Compares this with another <code>Personnel</code> instance.  If
     * <code>obj</code> is an instance of <code>Personnel</code>, delegates to
     * <code>equals(Personnel)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Personnel The current object, for fluid interface
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
     * Get the [personnel_id] column value.
     *
     * @return int
     */
    public function getPersonnelId()
    {
        return $this->personnel_id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Get the [height] column value.
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Get the [weight] column value.
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Get the [ssn] column value.
     *
     * @return string
     */
    public function getSsn()
    {
        return $this->ssn;
    }

    /**
     * Get the [phone_number] column value.
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * Get the [shift_id] column value.
     *
     * @return int
     */
    public function getShiftId()
    {
        return $this->shift_id;
    }

    /**
     * Get the [certification_id] column value.
     *
     * @return int
     */
    public function getCertificationId()
    {
        return $this->certification_id;
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
     * Set the value of [personnel_id] column.
     *
     * @param int $v new value
     * @return $this|\Personnel The current object (for fluent API support)
     */
    public function setPersonnelId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->personnel_id !== $v) {
            $this->personnel_id = $v;
            $this->modifiedColumns[PersonnelTableMap::COL_PERSONNEL_ID] = true;
        }

        return $this;
    } // setPersonnelId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\Personnel The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[PersonnelTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [address] column.
     *
     * @param string $v new value
     * @return $this|\Personnel The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[PersonnelTableMap::COL_ADDRESS] = true;
        }

        return $this;
    } // setAddress()

    /**
     * Set the value of [height] column.
     *
     * @param string $v new value
     * @return $this|\Personnel The current object (for fluent API support)
     */
    public function setHeight($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->height !== $v) {
            $this->height = $v;
            $this->modifiedColumns[PersonnelTableMap::COL_HEIGHT] = true;
        }

        return $this;
    } // setHeight()

    /**
     * Set the value of [weight] column.
     *
     * @param int $v new value
     * @return $this|\Personnel The current object (for fluent API support)
     */
    public function setWeight($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->weight !== $v) {
            $this->weight = $v;
            $this->modifiedColumns[PersonnelTableMap::COL_WEIGHT] = true;
        }

        return $this;
    } // setWeight()

    /**
     * Set the value of [ssn] column.
     *
     * @param string $v new value
     * @return $this|\Personnel The current object (for fluent API support)
     */
    public function setSsn($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ssn !== $v) {
            $this->ssn = $v;
            $this->modifiedColumns[PersonnelTableMap::COL_SSN] = true;
        }

        return $this;
    } // setSsn()

    /**
     * Set the value of [phone_number] column.
     *
     * @param string $v new value
     * @return $this|\Personnel The current object (for fluent API support)
     */
    public function setPhoneNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone_number !== $v) {
            $this->phone_number = $v;
            $this->modifiedColumns[PersonnelTableMap::COL_PHONE_NUMBER] = true;
        }

        return $this;
    } // setPhoneNumber()

    /**
     * Set the value of [shift_id] column.
     *
     * @param int $v new value
     * @return $this|\Personnel The current object (for fluent API support)
     */
    public function setShiftId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->shift_id !== $v) {
            $this->shift_id = $v;
            $this->modifiedColumns[PersonnelTableMap::COL_SHIFT_ID] = true;
        }

        if ($this->aShift !== null && $this->aShift->getShiftId() !== $v) {
            $this->aShift = null;
        }

        return $this;
    } // setShiftId()

    /**
     * Set the value of [certification_id] column.
     *
     * @param int $v new value
     * @return $this|\Personnel The current object (for fluent API support)
     */
    public function setCertificationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->certification_id !== $v) {
            $this->certification_id = $v;
            $this->modifiedColumns[PersonnelTableMap::COL_CERTIFICATION_ID] = true;
        }

        if ($this->aCertifications !== null && $this->aCertifications->getCertificationId() !== $v) {
            $this->aCertifications = null;
        }

        return $this;
    } // setCertificationId()

    /**
     * Set the value of [station_id] column.
     *
     * @param int $v new value
     * @return $this|\Personnel The current object (for fluent API support)
     */
    public function setStationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->station_id !== $v) {
            $this->station_id = $v;
            $this->modifiedColumns[PersonnelTableMap::COL_STATION_ID] = true;
        }

        if ($this->aStation !== null && $this->aStation->getStationId() !== $v) {
            $this->aStation = null;
        }

        return $this;
    } // setStationId()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PersonnelTableMap::translateFieldName('PersonnelId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->personnel_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PersonnelTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PersonnelTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PersonnelTableMap::translateFieldName('Height', TableMap::TYPE_PHPNAME, $indexType)];
            $this->height = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PersonnelTableMap::translateFieldName('Weight', TableMap::TYPE_PHPNAME, $indexType)];
            $this->weight = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PersonnelTableMap::translateFieldName('Ssn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ssn = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PersonnelTableMap::translateFieldName('PhoneNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PersonnelTableMap::translateFieldName('ShiftId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shift_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PersonnelTableMap::translateFieldName('CertificationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->certification_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PersonnelTableMap::translateFieldName('StationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->station_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = PersonnelTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Personnel'), 0, $e);
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
        if ($this->aShift !== null && $this->shift_id !== $this->aShift->getShiftId()) {
            $this->aShift = null;
        }
        if ($this->aCertifications !== null && $this->certification_id !== $this->aCertifications->getCertificationId()) {
            $this->aCertifications = null;
        }
        if ($this->aStation !== null && $this->station_id !== $this->aStation->getStationId()) {
            $this->aStation = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(PersonnelTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPersonnelQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aShift = null;
            $this->aCertifications = null;
            $this->aStation = null;
            $this->collPersonnelEquipments = null;

            $this->collSupervisorss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Personnel::setDeleted()
     * @see Personnel::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PersonnelTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPersonnelQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PersonnelTableMap::DATABASE_NAME);
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
                PersonnelTableMap::addInstanceToPool($this);
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

            if ($this->aShift !== null) {
                if ($this->aShift->isModified() || $this->aShift->isNew()) {
                    $affectedRows += $this->aShift->save($con);
                }
                $this->setShift($this->aShift);
            }

            if ($this->aCertifications !== null) {
                if ($this->aCertifications->isModified() || $this->aCertifications->isNew()) {
                    $affectedRows += $this->aCertifications->save($con);
                }
                $this->setCertifications($this->aCertifications);
            }

            if ($this->aStation !== null) {
                if ($this->aStation->isModified() || $this->aStation->isNew()) {
                    $affectedRows += $this->aStation->save($con);
                }
                $this->setStation($this->aStation);
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

            if ($this->personnelEquipmentsScheduledForDeletion !== null) {
                if (!$this->personnelEquipmentsScheduledForDeletion->isEmpty()) {
                    \PersonnelEquipmentQuery::create()
                        ->filterByPrimaryKeys($this->personnelEquipmentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->personnelEquipmentsScheduledForDeletion = null;
                }
            }

            if ($this->collPersonnelEquipments !== null) {
                foreach ($this->collPersonnelEquipments as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->supervisorssScheduledForDeletion !== null) {
                if (!$this->supervisorssScheduledForDeletion->isEmpty()) {
                    \SupervisorsQuery::create()
                        ->filterByPrimaryKeys($this->supervisorssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->supervisorssScheduledForDeletion = null;
                }
            }

            if ($this->collSupervisorss !== null) {
                foreach ($this->collSupervisorss as $referrerFK) {
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

        $this->modifiedColumns[PersonnelTableMap::COL_PERSONNEL_ID] = true;
        if (null !== $this->personnel_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PersonnelTableMap::COL_PERSONNEL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PersonnelTableMap::COL_PERSONNEL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'personnel_id';
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'address';
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_HEIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'height';
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_WEIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'weight';
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_SSN)) {
            $modifiedColumns[':p' . $index++]  = 'ssn';
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_PHONE_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'phone_number';
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_SHIFT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'shift_id';
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_CERTIFICATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'certification_id';
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_STATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'station_id';
        }

        $sql = sprintf(
            'INSERT INTO personnel (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'personnel_id':
                        $stmt->bindValue($identifier, $this->personnel_id, PDO::PARAM_INT);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'address':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case 'height':
                        $stmt->bindValue($identifier, $this->height, PDO::PARAM_STR);
                        break;
                    case 'weight':
                        $stmt->bindValue($identifier, $this->weight, PDO::PARAM_INT);
                        break;
                    case 'ssn':
                        $stmt->bindValue($identifier, $this->ssn, PDO::PARAM_STR);
                        break;
                    case 'phone_number':
                        $stmt->bindValue($identifier, $this->phone_number, PDO::PARAM_STR);
                        break;
                    case 'shift_id':
                        $stmt->bindValue($identifier, $this->shift_id, PDO::PARAM_INT);
                        break;
                    case 'certification_id':
                        $stmt->bindValue($identifier, $this->certification_id, PDO::PARAM_INT);
                        break;
                    case 'station_id':
                        $stmt->bindValue($identifier, $this->station_id, PDO::PARAM_INT);
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
        $this->setPersonnelId($pk);

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
        $pos = PersonnelTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPersonnelId();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getAddress();
                break;
            case 3:
                return $this->getHeight();
                break;
            case 4:
                return $this->getWeight();
                break;
            case 5:
                return $this->getSsn();
                break;
            case 6:
                return $this->getPhoneNumber();
                break;
            case 7:
                return $this->getShiftId();
                break;
            case 8:
                return $this->getCertificationId();
                break;
            case 9:
                return $this->getStationId();
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

        if (isset($alreadyDumpedObjects['Personnel'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Personnel'][$this->hashCode()] = true;
        $keys = PersonnelTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getPersonnelId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getAddress(),
            $keys[3] => $this->getHeight(),
            $keys[4] => $this->getWeight(),
            $keys[5] => $this->getSsn(),
            $keys[6] => $this->getPhoneNumber(),
            $keys[7] => $this->getShiftId(),
            $keys[8] => $this->getCertificationId(),
            $keys[9] => $this->getStationId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aShift) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'shift';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'shift';
                        break;
                    default:
                        $key = 'Shift';
                }

                $result[$key] = $this->aShift->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCertifications) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'certifications';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'certifications';
                        break;
                    default:
                        $key = 'Certifications';
                }

                $result[$key] = $this->aCertifications->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aStation) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'station';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'station';
                        break;
                    default:
                        $key = 'Station';
                }

                $result[$key] = $this->aStation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPersonnelEquipments) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'personnelEquipments';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'personnel_equipments';
                        break;
                    default:
                        $key = 'PersonnelEquipments';
                }

                $result[$key] = $this->collPersonnelEquipments->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSupervisorss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'supervisorss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'supervisorss';
                        break;
                    default:
                        $key = 'Supervisorss';
                }

                $result[$key] = $this->collSupervisorss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Personnel
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PersonnelTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Personnel
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setPersonnelId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setAddress($value);
                break;
            case 3:
                $this->setHeight($value);
                break;
            case 4:
                $this->setWeight($value);
                break;
            case 5:
                $this->setSsn($value);
                break;
            case 6:
                $this->setPhoneNumber($value);
                break;
            case 7:
                $this->setShiftId($value);
                break;
            case 8:
                $this->setCertificationId($value);
                break;
            case 9:
                $this->setStationId($value);
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
        $keys = PersonnelTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setPersonnelId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAddress($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setHeight($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setWeight($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSsn($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPhoneNumber($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setShiftId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCertificationId($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setStationId($arr[$keys[9]]);
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
     * @return $this|\Personnel The current object, for fluid interface
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
        $criteria = new Criteria(PersonnelTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PersonnelTableMap::COL_PERSONNEL_ID)) {
            $criteria->add(PersonnelTableMap::COL_PERSONNEL_ID, $this->personnel_id);
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_NAME)) {
            $criteria->add(PersonnelTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_ADDRESS)) {
            $criteria->add(PersonnelTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_HEIGHT)) {
            $criteria->add(PersonnelTableMap::COL_HEIGHT, $this->height);
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_WEIGHT)) {
            $criteria->add(PersonnelTableMap::COL_WEIGHT, $this->weight);
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_SSN)) {
            $criteria->add(PersonnelTableMap::COL_SSN, $this->ssn);
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_PHONE_NUMBER)) {
            $criteria->add(PersonnelTableMap::COL_PHONE_NUMBER, $this->phone_number);
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_SHIFT_ID)) {
            $criteria->add(PersonnelTableMap::COL_SHIFT_ID, $this->shift_id);
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_CERTIFICATION_ID)) {
            $criteria->add(PersonnelTableMap::COL_CERTIFICATION_ID, $this->certification_id);
        }
        if ($this->isColumnModified(PersonnelTableMap::COL_STATION_ID)) {
            $criteria->add(PersonnelTableMap::COL_STATION_ID, $this->station_id);
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
        $criteria = ChildPersonnelQuery::create();
        $criteria->add(PersonnelTableMap::COL_PERSONNEL_ID, $this->personnel_id);

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
        $validPk = null !== $this->getPersonnelId();

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
        return $this->getPersonnelId();
    }

    /**
     * Generic method to set the primary key (personnel_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setPersonnelId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getPersonnelId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Personnel (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setHeight($this->getHeight());
        $copyObj->setWeight($this->getWeight());
        $copyObj->setSsn($this->getSsn());
        $copyObj->setPhoneNumber($this->getPhoneNumber());
        $copyObj->setShiftId($this->getShiftId());
        $copyObj->setCertificationId($this->getCertificationId());
        $copyObj->setStationId($this->getStationId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPersonnelEquipments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPersonnelEquipment($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSupervisorss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSupervisors($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPersonnelId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Personnel Clone of current object.
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
     * Declares an association between this object and a ChildShift object.
     *
     * @param  ChildShift $v
     * @return $this|\Personnel The current object (for fluent API support)
     * @throws PropelException
     */
    public function setShift(ChildShift $v = null)
    {
        if ($v === null) {
            $this->setShiftId(NULL);
        } else {
            $this->setShiftId($v->getShiftId());
        }

        $this->aShift = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildShift object, it will not be re-added.
        if ($v !== null) {
            $v->addPersonnel($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildShift object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildShift The associated ChildShift object.
     * @throws PropelException
     */
    public function getShift(ConnectionInterface $con = null)
    {
        if ($this->aShift === null && ($this->shift_id != 0)) {
            $this->aShift = ChildShiftQuery::create()->findPk($this->shift_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aShift->addPersonnels($this);
             */
        }

        return $this->aShift;
    }

    /**
     * Declares an association between this object and a ChildCertifications object.
     *
     * @param  ChildCertifications $v
     * @return $this|\Personnel The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCertifications(ChildCertifications $v = null)
    {
        if ($v === null) {
            $this->setCertificationId(NULL);
        } else {
            $this->setCertificationId($v->getCertificationId());
        }

        $this->aCertifications = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCertifications object, it will not be re-added.
        if ($v !== null) {
            $v->addPersonnel($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCertifications object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCertifications The associated ChildCertifications object.
     * @throws PropelException
     */
    public function getCertifications(ConnectionInterface $con = null)
    {
        if ($this->aCertifications === null && ($this->certification_id != 0)) {
            $this->aCertifications = ChildCertificationsQuery::create()->findPk($this->certification_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCertifications->addPersonnels($this);
             */
        }

        return $this->aCertifications;
    }

    /**
     * Declares an association between this object and a ChildStation object.
     *
     * @param  ChildStation $v
     * @return $this|\Personnel The current object (for fluent API support)
     * @throws PropelException
     */
    public function setStation(ChildStation $v = null)
    {
        if ($v === null) {
            $this->setStationId(NULL);
        } else {
            $this->setStationId($v->getStationId());
        }

        $this->aStation = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildStation object, it will not be re-added.
        if ($v !== null) {
            $v->addPersonnel($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildStation object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildStation The associated ChildStation object.
     * @throws PropelException
     */
    public function getStation(ConnectionInterface $con = null)
    {
        if ($this->aStation === null && ($this->station_id != 0)) {
            $this->aStation = ChildStationQuery::create()->findPk($this->station_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aStation->addPersonnels($this);
             */
        }

        return $this->aStation;
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
        if ('PersonnelEquipment' == $relationName) {
            $this->initPersonnelEquipments();
            return;
        }
        if ('Supervisors' == $relationName) {
            $this->initSupervisorss();
            return;
        }
    }

    /**
     * Clears out the collPersonnelEquipments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPersonnelEquipments()
     */
    public function clearPersonnelEquipments()
    {
        $this->collPersonnelEquipments = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPersonnelEquipments collection loaded partially.
     */
    public function resetPartialPersonnelEquipments($v = true)
    {
        $this->collPersonnelEquipmentsPartial = $v;
    }

    /**
     * Initializes the collPersonnelEquipments collection.
     *
     * By default this just sets the collPersonnelEquipments collection to an empty array (like clearcollPersonnelEquipments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPersonnelEquipments($overrideExisting = true)
    {
        if (null !== $this->collPersonnelEquipments && !$overrideExisting) {
            return;
        }

        $collectionClassName = PersonnelEquipmentTableMap::getTableMap()->getCollectionClassName();

        $this->collPersonnelEquipments = new $collectionClassName;
        $this->collPersonnelEquipments->setModel('\PersonnelEquipment');
    }

    /**
     * Gets an array of ChildPersonnelEquipment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPersonnel is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPersonnelEquipment[] List of ChildPersonnelEquipment objects
     * @throws PropelException
     */
    public function getPersonnelEquipments(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPersonnelEquipmentsPartial && !$this->isNew();
        if (null === $this->collPersonnelEquipments || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPersonnelEquipments) {
                // return empty collection
                $this->initPersonnelEquipments();
            } else {
                $collPersonnelEquipments = ChildPersonnelEquipmentQuery::create(null, $criteria)
                    ->filterByPersonnel($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPersonnelEquipmentsPartial && count($collPersonnelEquipments)) {
                        $this->initPersonnelEquipments(false);

                        foreach ($collPersonnelEquipments as $obj) {
                            if (false == $this->collPersonnelEquipments->contains($obj)) {
                                $this->collPersonnelEquipments->append($obj);
                            }
                        }

                        $this->collPersonnelEquipmentsPartial = true;
                    }

                    return $collPersonnelEquipments;
                }

                if ($partial && $this->collPersonnelEquipments) {
                    foreach ($this->collPersonnelEquipments as $obj) {
                        if ($obj->isNew()) {
                            $collPersonnelEquipments[] = $obj;
                        }
                    }
                }

                $this->collPersonnelEquipments = $collPersonnelEquipments;
                $this->collPersonnelEquipmentsPartial = false;
            }
        }

        return $this->collPersonnelEquipments;
    }

    /**
     * Sets a collection of ChildPersonnelEquipment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $personnelEquipments A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPersonnel The current object (for fluent API support)
     */
    public function setPersonnelEquipments(Collection $personnelEquipments, ConnectionInterface $con = null)
    {
        /** @var ChildPersonnelEquipment[] $personnelEquipmentsToDelete */
        $personnelEquipmentsToDelete = $this->getPersonnelEquipments(new Criteria(), $con)->diff($personnelEquipments);


        $this->personnelEquipmentsScheduledForDeletion = $personnelEquipmentsToDelete;

        foreach ($personnelEquipmentsToDelete as $personnelEquipmentRemoved) {
            $personnelEquipmentRemoved->setPersonnel(null);
        }

        $this->collPersonnelEquipments = null;
        foreach ($personnelEquipments as $personnelEquipment) {
            $this->addPersonnelEquipment($personnelEquipment);
        }

        $this->collPersonnelEquipments = $personnelEquipments;
        $this->collPersonnelEquipmentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PersonnelEquipment objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PersonnelEquipment objects.
     * @throws PropelException
     */
    public function countPersonnelEquipments(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPersonnelEquipmentsPartial && !$this->isNew();
        if (null === $this->collPersonnelEquipments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPersonnelEquipments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPersonnelEquipments());
            }

            $query = ChildPersonnelEquipmentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPersonnel($this)
                ->count($con);
        }

        return count($this->collPersonnelEquipments);
    }

    /**
     * Method called to associate a ChildPersonnelEquipment object to this object
     * through the ChildPersonnelEquipment foreign key attribute.
     *
     * @param  ChildPersonnelEquipment $l ChildPersonnelEquipment
     * @return $this|\Personnel The current object (for fluent API support)
     */
    public function addPersonnelEquipment(ChildPersonnelEquipment $l)
    {
        if ($this->collPersonnelEquipments === null) {
            $this->initPersonnelEquipments();
            $this->collPersonnelEquipmentsPartial = true;
        }

        if (!$this->collPersonnelEquipments->contains($l)) {
            $this->doAddPersonnelEquipment($l);

            if ($this->personnelEquipmentsScheduledForDeletion and $this->personnelEquipmentsScheduledForDeletion->contains($l)) {
                $this->personnelEquipmentsScheduledForDeletion->remove($this->personnelEquipmentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPersonnelEquipment $personnelEquipment The ChildPersonnelEquipment object to add.
     */
    protected function doAddPersonnelEquipment(ChildPersonnelEquipment $personnelEquipment)
    {
        $this->collPersonnelEquipments[]= $personnelEquipment;
        $personnelEquipment->setPersonnel($this);
    }

    /**
     * @param  ChildPersonnelEquipment $personnelEquipment The ChildPersonnelEquipment object to remove.
     * @return $this|ChildPersonnel The current object (for fluent API support)
     */
    public function removePersonnelEquipment(ChildPersonnelEquipment $personnelEquipment)
    {
        if ($this->getPersonnelEquipments()->contains($personnelEquipment)) {
            $pos = $this->collPersonnelEquipments->search($personnelEquipment);
            $this->collPersonnelEquipments->remove($pos);
            if (null === $this->personnelEquipmentsScheduledForDeletion) {
                $this->personnelEquipmentsScheduledForDeletion = clone $this->collPersonnelEquipments;
                $this->personnelEquipmentsScheduledForDeletion->clear();
            }
            $this->personnelEquipmentsScheduledForDeletion[]= clone $personnelEquipment;
            $personnelEquipment->setPersonnel(null);
        }

        return $this;
    }

    /**
     * Clears out the collSupervisorss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSupervisorss()
     */
    public function clearSupervisorss()
    {
        $this->collSupervisorss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSupervisorss collection loaded partially.
     */
    public function resetPartialSupervisorss($v = true)
    {
        $this->collSupervisorssPartial = $v;
    }

    /**
     * Initializes the collSupervisorss collection.
     *
     * By default this just sets the collSupervisorss collection to an empty array (like clearcollSupervisorss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSupervisorss($overrideExisting = true)
    {
        if (null !== $this->collSupervisorss && !$overrideExisting) {
            return;
        }

        $collectionClassName = SupervisorsTableMap::getTableMap()->getCollectionClassName();

        $this->collSupervisorss = new $collectionClassName;
        $this->collSupervisorss->setModel('\Supervisors');
    }

    /**
     * Gets an array of ChildSupervisors objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPersonnel is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSupervisors[] List of ChildSupervisors objects
     * @throws PropelException
     */
    public function getSupervisorss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSupervisorssPartial && !$this->isNew();
        if (null === $this->collSupervisorss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSupervisorss) {
                // return empty collection
                $this->initSupervisorss();
            } else {
                $collSupervisorss = ChildSupervisorsQuery::create(null, $criteria)
                    ->filterByPersonnel($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSupervisorssPartial && count($collSupervisorss)) {
                        $this->initSupervisorss(false);

                        foreach ($collSupervisorss as $obj) {
                            if (false == $this->collSupervisorss->contains($obj)) {
                                $this->collSupervisorss->append($obj);
                            }
                        }

                        $this->collSupervisorssPartial = true;
                    }

                    return $collSupervisorss;
                }

                if ($partial && $this->collSupervisorss) {
                    foreach ($this->collSupervisorss as $obj) {
                        if ($obj->isNew()) {
                            $collSupervisorss[] = $obj;
                        }
                    }
                }

                $this->collSupervisorss = $collSupervisorss;
                $this->collSupervisorssPartial = false;
            }
        }

        return $this->collSupervisorss;
    }

    /**
     * Sets a collection of ChildSupervisors objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $supervisorss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPersonnel The current object (for fluent API support)
     */
    public function setSupervisorss(Collection $supervisorss, ConnectionInterface $con = null)
    {
        /** @var ChildSupervisors[] $supervisorssToDelete */
        $supervisorssToDelete = $this->getSupervisorss(new Criteria(), $con)->diff($supervisorss);


        $this->supervisorssScheduledForDeletion = $supervisorssToDelete;

        foreach ($supervisorssToDelete as $supervisorsRemoved) {
            $supervisorsRemoved->setPersonnel(null);
        }

        $this->collSupervisorss = null;
        foreach ($supervisorss as $supervisors) {
            $this->addSupervisors($supervisors);
        }

        $this->collSupervisorss = $supervisorss;
        $this->collSupervisorssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Supervisors objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Supervisors objects.
     * @throws PropelException
     */
    public function countSupervisorss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSupervisorssPartial && !$this->isNew();
        if (null === $this->collSupervisorss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSupervisorss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSupervisorss());
            }

            $query = ChildSupervisorsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPersonnel($this)
                ->count($con);
        }

        return count($this->collSupervisorss);
    }

    /**
     * Method called to associate a ChildSupervisors object to this object
     * through the ChildSupervisors foreign key attribute.
     *
     * @param  ChildSupervisors $l ChildSupervisors
     * @return $this|\Personnel The current object (for fluent API support)
     */
    public function addSupervisors(ChildSupervisors $l)
    {
        if ($this->collSupervisorss === null) {
            $this->initSupervisorss();
            $this->collSupervisorssPartial = true;
        }

        if (!$this->collSupervisorss->contains($l)) {
            $this->doAddSupervisors($l);

            if ($this->supervisorssScheduledForDeletion and $this->supervisorssScheduledForDeletion->contains($l)) {
                $this->supervisorssScheduledForDeletion->remove($this->supervisorssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSupervisors $supervisors The ChildSupervisors object to add.
     */
    protected function doAddSupervisors(ChildSupervisors $supervisors)
    {
        $this->collSupervisorss[]= $supervisors;
        $supervisors->setPersonnel($this);
    }

    /**
     * @param  ChildSupervisors $supervisors The ChildSupervisors object to remove.
     * @return $this|ChildPersonnel The current object (for fluent API support)
     */
    public function removeSupervisors(ChildSupervisors $supervisors)
    {
        if ($this->getSupervisorss()->contains($supervisors)) {
            $pos = $this->collSupervisorss->search($supervisors);
            $this->collSupervisorss->remove($pos);
            if (null === $this->supervisorssScheduledForDeletion) {
                $this->supervisorssScheduledForDeletion = clone $this->collSupervisorss;
                $this->supervisorssScheduledForDeletion->clear();
            }
            $this->supervisorssScheduledForDeletion[]= clone $supervisors;
            $supervisors->setPersonnel(null);
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
        if (null !== $this->aShift) {
            $this->aShift->removePersonnel($this);
        }
        if (null !== $this->aCertifications) {
            $this->aCertifications->removePersonnel($this);
        }
        if (null !== $this->aStation) {
            $this->aStation->removePersonnel($this);
        }
        $this->personnel_id = null;
        $this->name = null;
        $this->address = null;
        $this->height = null;
        $this->weight = null;
        $this->ssn = null;
        $this->phone_number = null;
        $this->shift_id = null;
        $this->certification_id = null;
        $this->station_id = null;
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
            if ($this->collPersonnelEquipments) {
                foreach ($this->collPersonnelEquipments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSupervisorss) {
                foreach ($this->collSupervisorss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPersonnelEquipments = null;
        $this->collSupervisorss = null;
        $this->aShift = null;
        $this->aCertifications = null;
        $this->aStation = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PersonnelTableMap::DEFAULT_STRING_FORMAT);
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
