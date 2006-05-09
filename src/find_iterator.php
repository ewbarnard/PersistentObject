<?php
/**
 * File containing the ezcPersistentFindIterator class
 *
 * @package PersistentObject
 * @version //autogen//
 * @copyright Copyright (C) 2005, 2006 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */

/**
 * This class provides functionality to iterate over a database
 * result set in the form of persistent objects.
 *
 * ezcPersistentFindIterator only instantiates one object which
 * is reused for each iteration. This saves memory and is faster
 * than fetching and instantiating the result set in one go.
 *
 * Note that if you are using MySQL you need to iterate through the
 * complete result set of the iterator. This is because of a limitation
 * in PHP.
 *
 * @package PersistentObject
 */
class ezcPersistentFindIterator implements Iterator
{
    /**
     * Stores the current object of the iterator.
     *
     * This variable is null if there is no current object.
     *
     * @var object
     */
    private $object = null;

    /**
     * The statement to retrieve data from.
     *
     * @var PDOStatement
     */
    private $stmt = null;

    /**
     * The definition of the persistent object type.
     *
     * $var ezcPersistentObjectDefinition
     */
    private $def = null;

    /**
     * Initializes the iterator with the statement $stmt and the definition $def..
     *
     * The statement $stmt must be executed but not used to retrieve any results yet.
     * The iterator will return objects with they persistent object type provided by
     * $def.
     */
    public function __construct( PDOStatement $stmt, ezcPersistentObjectDefinition $def )
    {
        $this->stmt = $stmt;
        $this->def = $def;
    }

    /**
     * Sets the iterator to point to the first object in the result set.
     *
     * @todo What happens if you call rewind twice?
     *
     * @returns void
     */
    public function rewind()
    {
        if ( $this->object === null )
        {
            $this->next();
        }
    }

    /**
     * Returns the current object of this iterator.
     *
     * Returns null if there is no current object.
     *
     * @returns object
     */
    public function current()
    {
        return $this->object;
    }

    /**
     * Returns null.
     *
     * Persistent objects do not have a key. Hence, this method always returns
     * null.
     *
     * @returns null
     */
    public function key()
    {
        return null;
    }

    /**
     * Returns the next persistent object in the result set.
     *
     * The next object is set to the current object of the iterator.
     * Returns null and sets the current object to null if there
     * are no more results in the result set.
     *
     * @returns object
     */
    public function next()
    {
        $row = false;
        try
        {
            $row = $this->stmt->fetch( PDO::FETCH_ASSOC );
        }
        catch ( PDOException $e ) // MySQL 5.0 throws this if the statement is not executed.
        {
            $this->object = null;
            return;
        }

        if ( $row !== false )
        {
            if ( $this->object == null ) // no object yet
            {
                $this->object = new $this->def->class;
            }
            $this->object->setState( ezcPersistentStateTransformer::rowToStateArray( $row, $this->def ) );
        }
        else // no more objects in the result set
        {
            $this->object = null;
        }
        return $this->object;
    }

    /**
     * Returns true if there is a current object.
     *
     * @returns bool
     */
    public function valid()
    {
        return $this->object !== null ? true : false;
    }
}
?>