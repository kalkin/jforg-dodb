<?php
/**
 * A collection of JForg_Dodb_Records 
 * 
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @package   JForg_Dodb
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-02-08
 */
class JForg_Dodb_Collection extends JForg_Dodb_Array
{

	/**
	 * TODO: description.
	 * 
	 * @var mixed
	 * @since 2010-02-08
	 */
	protected $_JForg_Dodb_Array = array(
            'dodb'  => 'dodb',
            );

    /**
     * Appends a JForg_Dodb_Record to the Collection
     * 
     * @param JForg_Dodb_Record $record The record to add
     * 
     * @return JForg_Dodb_Collection
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function append(JForg_Dodb_Record $record)
    {
        $this->_data[] = $record;
        return $this;
    }

    /**
     * TODO: short description.
     * 
     * @return JForg_Dodb_Collection
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function deleteAll()
    {
        $this->_data = array();        
    }

    /**
     * Removes a JForg_Dodb_Record from the Collection by the documentId
     * 
     * @param scalar $id The documentid
     * 
     * @return JForg_Dodb_Collection
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function removeByDocId($id)
    {
        foreach( $this->_data as $key => $record )
            if ( $record->document->fetchDocumentId() === $id )
                unset($this->_data[$key]);
        return $this;
    }

    /**
     * Returns all the keys of the Records in this collection
     * 
     * @return array
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function getKeys()
    {
        $keys = array();
        foreach ($this->_data as $record)
        {
            $keys[] = $record->getKey();
        }
        return $keys;
    }

    /**
     * Is the collection empty?
     * 
     * @return boolean
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function isEmpty()
    {
        return empty($this->_data);
    }

    /**
     * Is this Collection dirty?
     * 
     * @return boolean
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function isDirty()
    {

        foreach($this->_data as $record)
            if ( $record->document->isDirtu() )
            {
                return true;
            }

        return false;
    }

    /**
     * Saves all
     * 
     * @return JForg_Dodb_Collection
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function save()
    {
        foreach( $this->_data as $record )
            $record->document->save();
        return $this;
    }

    /**
     * Calls a user given function on each JForg_Dodb_Record
     * 
     * @param function $func A lambda function
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function doForEach($func)
    {
        foreach( $this->_data as $record )
            $func($record);
    }
}
