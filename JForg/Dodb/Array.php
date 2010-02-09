<?php
/**
 * An solar like class which represents an Array
 * 
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @package   JForg_Dodb_Array
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-02-08
 */
class JForg_Dodb_Array extends Solar_Base implements Iterator
{

	/**
	 * The document data
	 * 
	 * @var array  Defaults to array(). 
	 * @since 2010-01-26
	 */
	protected $_data = array();

    /**
     * The iterator position
     *
     * @see JForg_Dodb_Array::rewinddir()
     * @see JForg_Dodb_Array::current() 
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
     * Populates JForg_Dodb_Array with data
     * 
     * @param array $data Array which is used to populate JForg_Dodb_Array
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function populate(array $data)
    {
        $this->_data = $data;
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
