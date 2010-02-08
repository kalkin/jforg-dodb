<?php
/**
 * A representation of a document
 * 
 * @package   JForg_Dodb
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-01-26
 */
class JForg_Dodb_Document extends Solar_Base implements Iterator
{

	/**
     * Default configuration values.
	 * 
     * @config string dodb  The registered JForg_Dodb object
     *
     * @config array sheme  This defines which properties a document should at
     *   least have and which type they have. If it's set and the document data
     *   doesn't match the sheme then an exception is thrown.
     *
     * @config bool final   If it's true than it's not possible to add any
     *   further parameter to a document an  or change the type (int, string...)
     *   of the parameter. You still can change the value as long the type doesn't
     *   change.
     *
     * @var array
	 * @since 2010-01-26
	 */
	protected $_JForg_Dodb_Document = array(
            'dodb'  => 'dodb',
            'sheme' => null,
            'final' => false,
            );

	/**
     * Is the Document already populated?
	 * 
	 * @var bool  Defaults to false. 
	 * @since 2010-01-26
	 */
	protected $_populated = false;

    /**
     * 
     * Notes if one or more data elements has been changed after
     * initialization.
     * 
	 * @var bool  Defaults to false. 
	 * @since 2010-01-26
     */
    protected $_is_dirty = false;

    /**
     * The id of the document
     * 
     * @var scalar Default to null
     * @since 2010-01-26
     */
    protected $_documentId = null;

    /**
     * If true, it's not possible to add any further properties to the
     * document. Of course all properties are stil editable.
     * 
     * @var bool  Defaults to false. 
     * @since 2010-01-28
     */
    protected $_final = false;

    /**
     * The document sheme
     * 
     * @see JForg_Dodb_Document::$_JForg_Dodb_Document
     * @var array  Defaults to null. 
     * @since 2010-01-28
     */
    protected $_sheme = null;

	/**
	 * The document data
	 * 
	 * @var array  Defaults to array(). 
	 * @since 2010-01-26
	 */
	protected $_data = array();

    /**
     * Contains special properties of a document, i.g. for Couchdb this would
     * be stuff like _rev, _attachment ect..
     * 
     * @var array  Defaults to array(). 
     * @since 2010-01-28
     */
    protected $_special = array();

	/**
	 * Contains a JForg_Dodb instance
	 * 
	 * @var JForg_Dodb  Defaults to null. 
	 * @since 2010-01-26
	 */
	protected $_dodb = null;

    /**
     * The iterator position
     *
     * @see JForg_Dodb_Document::rewinddir()
     * @see JForg_Dodb_Document::current() 
     * @var int  Defaults to 0. 
     * @since 2010-02-07
     */
    protected $_iterator_position = 0;

    /**
     * An array containing all property names, used for the Iterator interface.
     * 
     * @var int  Defaults to 0. 
     * @since 2010-02-07
     */
    protected $_iterator_keys   = null;

    /**
     * Post-construction tasks to complete object construction.
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */

    /**
     * Checks if the registered JForg_Dodb exists, sets some vars
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _postConfig()
    {
        if ( Solar_Registry::exists($this->_config['dodb']) )
                $this->_dodb = Solar_Registry::get($this->_config['dodb']);
        else 
            throw $this->_exception('NO_DOCUMENT_ADAPTER');

        if ( isset($this->_config['sheme']) )
        {
            if ( !is_array($this->_config['sheme']) )
                throw $this->_exception('SHEME_SHOULD_BE_ARRAY');

            $this->_sheme = $this->_config['sheme'];
        }

        if ( isset($this->_config['final']) )
        {
            if ( !is_bool($this->_config['final']) )
                throw $this->_exception('FINAL_SHOULD_BE_BOOL');

            $this->_final = $this->_config['final'];
        }
    }

    /**
     * Populates the document with data. Note: It won't create a new document
     * it will only overwrite the properties values of this document.
     *
     * A values array should look something like this:
     *
     * {{code: php
     *      array(  
     *          'id'        => 'e8d901298e856b9ff40656f30a6c036d',
     *          'data'      => array('foo' => 'bar', 'buz' => 'fuz'),
     *          'special'   => array('_rev' => '1', 'zum' => 'asd')
     *      );
     * }}
     * 
     * @param arrau $values Populate the document with given data
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function populate(array $values)
    {
        if ( $this->_sheme != null )
        {
            if (!$this->_checkSheme($values['data']))
                throw $this->_exception('NOT_EQUATES_SHEME');
        }

        $this->_data = $values['data'];
        if ( isset($values['id']) )
            $this->_documentId = $values['id'];

        if ( isset($values['special'] ) )
            $this->_special = $values['special'];

        $this->_populated = true;

        return $this;
    }

    /**
     * Saves the document to the dodb
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function save()
    {
        return $this->_dodb->save($this);
    }

    /**
     * Reloads the Document from the database and updates it's values
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function reload()
    {
        if ( $this->_is_dirty )
            throw $this->_exception('DOC_IS_DIRTY');
        return $this->_dodb->reload($this);
    }

    /**
     * Returns the document sheme.
     * 
     * @return array Document sheme
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function returnDocumentSheme()
    {
        return $this->_sheme;
    }

    /**
     * Checks if the document is final 
     * 
     * @return boolean whether it's final or not
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function isFinal()
    {
        return $this->_final;
    }

    /**
     * Is the document already populated?
     * 
     * @return boolean 
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function isPopulated()
    {
        return $this->_populated;
    }


    /**
     * Checks if a dpcument property is set. Note: the special protpertys are
     * not checked with isset
     * 
     * @param string $name Tests if the document parmater $name is set
     * 
     * @return boolean true or false
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function __isset($name)
    {
        return isset($this->_data[$name]);
    }

    /**
     * Deletes the document from the database
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function delete()
    {
        $this->_dodb($this);
    }

    /**
     * Checks if a property is unset
     * 
     * @param string $name  Unsets the $name property
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function __unset($name)
    {
        unset($this->_data[$name]);
        $this->_is_dirty = true;
    }

    /**
     * Magic call implements "get...()" and "set...()" for
     * params listed in the method name.
     * 
     * @param mixed $name   The name of the called function 
     * @param array $arguments The function arguments
     * 
     * @return JForg_Dodb_Document|mixed
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function __call($name, $arguments)
    {

        $methodPrefix = substr($name,0,3);
        if ($methodPrefix === 'get') {
            $valueName = strtolower(substr($name,3));
            return $this->_data[$valueName];
        } elseif ($methodPrefix === 'set') {
            $valueName = strtolower(substr($name,3));
            $this->_data[$valueName] = $arguments[0];
            return $this;
        } else {
            throw new Solar_Exception_MethodNotImplemented();
        }
    }


	/**
	 * Get a property value
	 * 
	 * @param string $name The property name
	 * 
	 * @return mixed
	 * @author Bahtiar Gadimov <bahtiar@gadimov.de>
	 */
	public function __get($name)
    {
        $getterMethod = 'get'.ucfirst($name);
        return $this->$getterMethod();
    }


	/**
	 * Set a property value
	 * 
	 * @param string $name  The paramter to set
	 * @param mixed $value  The value to which the property is set
	 * 
	 * @return JForg_Dodb_Document
	 * @author Bahtiar Gadimov <bahtiar@gadimov.de>
	 */
	public function __set($name, $value)
    {
        $setterMethod = 'set'.ucfirst($name);
        return $this->$setterMethod();
    }

	/**
	 * Returns a string representation of the object.
	 * 
	 * @return string
	 * @author Bahtiar Gadimov <bahtiar@gadimov.de>
	 */
	public function __toString()
    {
		return $this->_dodb->documentToString($this);
	}

    /**
     * Returns an array with document data. The structure is the same as used
     * in $JForg_Dodb_Document::populate()
     * 
     * @return array
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function toArray()
    {
        return array('id' => $this->_documentId, 
                'data' => $this->_data,
                'special' => $this->_special,);

    }

    /**
     * Are there some unsaved changes?
     * 
     * @return boolean
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function isDirty()
    {
        return $this->_is_dirty;
    }

    /**
     * Returns the document id. Not to be confused with getId(), because thre
     * could be a normal property called 'id' and a special property like
     * '_id' in Couchdb in a document
     * 
     * @return scalar Document id
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function fetchDocumentId()
    {
        return $this->_documentId;
    }

    /**
     * Returns all properties with values of a document.
     * 
     * @return array All data
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function fetchProperties()
    {
        return $this->_data;
    }

    /**
     * Returns the name of the properties of a document
     * 
     * @see JForg_Dodb_Document::fetchSpecialProperties()
     * @return array Indexed array with all document properties.
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function fetchPropetiesNames()
    {
        return array_keys($this->_data);
    }

    /**
     * Returns the names of the special properties of a document
     * 
     * @see JForg_Dodb_Document::fetchProperties()
     * @return array Indexed array with all document special properties.
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function fetchSpecialPropertiesNames()
    {
        return array_keys($this->_special);
    }

    /**
     * Returns a value of a special propertu
     * 
     * @param mixed $name Property name
     * 
     * @return mixed Property value
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function fetchSpecialProperty($name)
    {
        if ( array_key_exists($this->_special[$name]) )
            return $this->_special[$name];
        else
            throw $this->_exception('NO_SUCH_SPECIAL_PROPERTY', array('property', $name));
    }

    /**
     * Returns all special properties with values of a document.
     * 
     * @return array All special data
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function fetchSpecialProperties()
    {
        return $this->_special;
    }

    /**
     * Adds a special property to the document. Note: It doesn't check if the
     * key already exists
     * 
     * @param string $name  Name of the special property
     * @param mixed $value Value of the special property
     * 
     * @return JForg_Dodb_Document $this document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function addSpecialProperty($name, $value)
    {
        $this->_special[$name] = $values;
        return $this;
    }

    /**
     * Updates/Sets the special property. Note: If a property doesn't exists,
     * it will be added to the document. Actually it's just a wrapper around
     * JForg_Dodb_Document::addSpecialProperty()
     * 
     * @param string $name  Name of the special property
     * @param mixed $value Value of the special property
     * 
     * @see JForg_Dodb_Document::addSpecialProperty()
     * @return JForg_Dodb_Document $this document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function updateSpecialProperty($name, $value)
    {
        return $this->addSpecialProperty($name, $value);
    }

    /**
     * Return the current element
     * 
     * @return mixed
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function current()
    {
        return $this->_data[$this->_iterator_keys[$this->_iterator_position]];
    }

    /**
     * Return the key of the current element
     * 
     * @return scalar
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function key()
    {
        return $this->_iterator_keys[$this->_iterator_position];
    }

    /**
     * Move forward to next element
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function next()
    {
        $this->_iterator_position++;
    }

    /**
     * Rewind the Iterator to the first element
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function rewind()
    {
        $this->_iterator_position = 0;
        $this->_iterator_keys = $this->fetchPropetiesNames();
    }

    /**
     * Checks if current position is valid
     * 
     * @return boolean
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function valid()
    {
        if ( count($this->_iterator_position) > $this->_iterator_position )
            return true;
        return false;
    }
}
