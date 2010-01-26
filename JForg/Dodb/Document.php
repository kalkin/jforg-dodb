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
     * @var array
	 * @since 2010-01-26
	 */
	protected $_JForg_Dodb_Document = array(
            'document_adapter' => 'document_adapter',
            'basedocument' => 'JForg_Dodb_Document',
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
     * @var string Default to null
     * @since 2010-01-26
     */
    protected $_id = null;

	/**
	 * The revision of the document
	 * 
	 * @var string  Defaults to null. 
	 * @since 2010-01-26
	 */
	protected $_revision = null;

	/**
	 * TODO: description.
	 * 
	 * @var string Defaults to null
	 * @since 2010-01-26
	 */
	protected $_type = null;


	/**
	 * The document data
	 * 
	 * @var array  Defaults to array(). 
	 * @since 2010-01-26
	 */
	protected $_data = array();

	/**
	 * Contains a JForg_Dodb_Document_Adapter instance
	 * 
	 * @var double  Defaults to null. 
	 * @since 2010-01-26
	 */
	protected $_document_adapter = null;

    /**
     * Post-construction tasks to complete object construction.
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _postConstruct()
    {
        parent::_postConstruct();

        $this->_preSetup();

        $this->_setup();
    }

    /**
     * User-defined setup.
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _setup()
    {
    }

    /**
     * Gets the document adapter
     * 
     * @return TODO
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _preSetup()
    {
        if ( Solar_Registry::exists($this->_config['document_adapter']) )
                $this->_document_adapter = Solar_Registry::get($this->_config['document_adapter']);
        else 
            throw $this->_exception('NO_DOCUMENT_ADAPTER');
    }

    /**
     * Populates the document with data
     * 
     * @param array
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function populate(array $values = array())
    {
        print_r(apd_callstack());
        die();

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
        print_r(apd_callstack());
        die();

        return $this;
    }

    /**
     * Reloads the Document from the database and updates it's values
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function reload($force = false)
    {
        print_r(apd_callstack());
        die();
    }

	/**
	 * Returns the type of the document
	 * 
	 * @return string
	 * @author Bahtiar Gadimov <bahtiar@gadimov.de>
	 */
	public function getType()
    {
        print_r(apd_callstack());
        die();
    }

    /**
     * Checks if a parameter is set
     * 
     * @param string $name 
     * 
     * @return bool
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function __isset($name)
    {
        return isset($this->_data[$name]);
    }

    /**
     * Checks if a parameter is unset
     * 
     * @param string $name 
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
     * @param mixed $name      
     * @param array $arguments 
     * 
     * @return JForg_Dodb_Document|string
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function __call($name, $arguments)
    {

        return $this;
    }


	/**
	 * Get a parameter value
	 * 
	 * @param string $name
	 * 
	 * @return mixed
	 * @author Bahtiar Gadimov <bahtiar@gadimov.de>
	 */
	public function __get($name)
    {
        return $this->_data[$name];
    }


	/**
	 * Set a parameter value
	 * 
	 * @param string $name
	 * @param mixed $value
	 * 
	 * @return JForg_Dodb_Document
	 * @author Bahtiar Gadimov <bahtiar@gadimov.de>
	 */
	public function __set($name, $value)
    {
        $this->_data[$name] = $value;
        $this->_is_dirty = true;
        return $this;
    }

	/**
	 * Returns a string json representation of the object.
	 * 
	 * @return TODO
	 * @author Bahtiar Gadimov <bahtiar@gadimov.de>
	 */
	public function __toString()
    {
		return json_encode($this->fetchRawData(),true);
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
     * Returns an array representation of this document
     * 
     * @return array
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function fetchRawData()
    {
        print_r(apd_callstack());
        die();
    }

    /**
     * Returns the parameter names
     * 
     * @return array
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function fetchParameterNames()
    {
        print_r(apd_callstack());
        die();
    }

    /**
     * Return the current element
     * 
     * @return mixed
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function current()
    {
        print_r(apd_callstack());
        die();
    }

    /**
     * Return the key of the current element
     * 
     * @return scalar
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function key()
    {
        print_r(apd_callstack());
        die();
    }

    /**
     * Move forward to next element
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function next()
    {
        print_r(apd_callstack());
        die();
    }

    /**
     * Rewind the Iterator to the first element
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function rewind()
    {
        print_r(apd_callstack());
        die();
    }

    /**
     * Checks if current position is valid
     * 
     * @return boolean
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function valid()
    {
        print_r(apd_callstack());
        die();
    }
}
