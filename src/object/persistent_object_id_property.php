<?php
/**
 * @version //autogen//
 * @copyright Copyright (C) 2005-2007 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 * @package PersistentObject
 */

/**
 * Defines a persistent object id field.
 * The column must be of type int both in PHP and in the database.
 * The default value will always be null.
 *
 * For descriptions for some the constants used in this class see:
 * {@link ezcPersisentObjectProperty}
 *
 * @property string $columnName   The name of the database field that stores the
 *                                value.
 * @property string $propertyName The name of the PersistentObject property
 *                                that holds the value in the PHP object.
 * @property int $propertyType    The type of the PHP property. See class 
 *                                constants ezcPersistentObjectProperty::PHP_TYPE_*.
 * @property int $visibility      The visibility of the property. This property is deprecated!
 * @property ezcPersistentGeneratorDefinition $generator
 *                                The type of generator to use for the identifier.
 *                                The identifier generator must be an object that extends the
 *                                abstract class ezcPersistentIdentifierGenerator. The current
 *                                options that are part of this package are:
 *                                - ezcPersistentSequenceGenerator
 *                                - ezcPersistentManualGenerator
 *                                - ezcPersistentNativeGenerator
 * @package PersistentObject
 * @version //autogen//
 */
class ezcPersistentObjectIdProperty
{
    /**
     * Holds the properties for this class.
     * @var array
     */
    private $properties = array(
        'columnName'   => null,
        'propertyName' => null,
        'propertyType' => ezcPersistentObjectProperty::PHP_TYPE_INT,
        'generator'    => null,
        'visibility'   => null,
    );

    /**
     * Constructs a new PersistentObjectField
     *
     * @param string $columnName The name of the database field that stores the value.
     * @param string $propertyName The name of the class member
     * @param int $visibility See {@link $visibility} for possible values.
     * @param ezcPersistentGeneratorDefinition $generator Definition of the identifier generator
     * @param int $propertyType See {@link ezcPersistentObjectProperty} for possible values.
     */
    public function __construct( $columnName = null,
                                 $propertyName = null,
                                 $visibility = null,
                                 ezcPersistentGeneratorDefinition $generator = null,
                                 $propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT )
    {
        $this->columnName   = $columnName;
        $this->propertyName = $propertyName;
        $this->visibility   = $visibility;
        $this->generator    = $generator;
        $this->propertyType = $propertyType;
    }

    /**
     * Property read access.
     * 
     * @param string $propertyName Name of the property.
     * @return mixed Value of the property or null.
     *
     * @throws ezcBasePropertyNotFoundException
     *         If the the desired property is not found.
     * @ignore
     */
    public function __get( $propertyName )
    {
        if ( $this->__isset( $propertyName ) )
        {
            return $this->properties[$propertyName];
        }
        throw new ezcBasePropertyNotFoundException( $propertyName );
    }

    /**
     * Property write access.
     * 
     * @param string $propertyName Name of the property.
     * @param mixed $propertyValue  The value for the property.
     *
     * @throws ezcBasePropertyNotFoundException
     *         If a the value for the property options is not an instance of
     * @throws ezcBaseValueException
     *         If a the value for a property is out of range.
     * @ignore
     */
    public function __set( $propertyName, $propertyValue )
    {
        switch ( $propertyName )
        {
            case 'columnName':
            case 'propertyName':
                if ( is_string( $propertyValue ) === false && is_null( $propertyValue ) === false )
                {
                    throw new ezcBaseValueException(
                        $propertyName,
                        $propertyValue,
                        'string or null'
                    );
                }
                break;
            case 'propertyType':
            case 'visibility':
                if ( is_int( $propertyValue ) === false && is_null( $propertyValue ) === false )
                {
                    throw new ezcBaseValueException(
                        $propertyName,
                        $propertyValue,
                        'int or null'
                    );
                }
                break;
            case 'generator':
                if ( ( is_object( $propertyValue ) === false || ( $propertyValue instanceof ezcPersistentGeneratorDefinition ) === false ) && is_null( $propertyValue ) === false )
                {
                    throw new ezcBaseValueException(
                        $propertyName,
                        $propertyValue,
                        'ezcPersistentGeneratorDefinition or null'
                    );
                }
                break;
            default:
                throw new ezcBasePropertyNotFoundException( $propertyName );
                break;
        }
        $this->properties[$propertyName] = $propertyValue;
    }

    /**
     * Property isset access.
     * 
     * @param string $propertyName Name of the property.
     * @return bool True is the property is set, otherwise false.
     * @ignore
     */
    public function __isset( $propertyName )
    {
        return array_key_exists( $propertyName, $this->properties );
    }

    /**
     * Returns a new instance of this class with the data specified by $array.
     *
     * $array contains all the data members of this class in the form:
     * array('member_name'=>value).
     *
     * __set_state makes this class exportable with var_export.
     * var_export() generates code, that calls this method when it
     * is parsed with PHP.
     *
     * @param array(string=>mixed) $array
     * @return ezcPersistentObjectIdProperty
     */
    public static function __set_state( array $array )
    {
        if ( isset( $array['properties'] ) && count( $array ) === 1 )
        {
            return new ezcPersistentObjectIdProperty( $array['properties']['columnName'],
                                                      $array['properties']['propertyName'],
                                                      $array['properties']['visibility'],
                                                      $array['properties']['generator'] );
        }
        else
        {
            return new ezcPersistentObjectIdProperty( $array['columnName'],
                                                      $array['propertyName'],
                                                      $array['visibility'],
                                                      $array['generator'] );
        }
    }
}

?>
