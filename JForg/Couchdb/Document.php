<?php
/**
 * A representation of a document
 * 
 * @package   JForg_Couchdb
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-10-17
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 * Copyright (c) 2010, Bahtiar Gadimov All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 
 *     * Redistributions of source code must retain the above copyright notice,
 *       this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright notice,
 *       this list of conditions and the following disclaimer in the documentation
 *       and/or other materials provided with the distribution.
 *     * Neither the name of the cologne.idle nor the names of its contributors
 *       may be used to endorse or promote products derived from this software
 *       without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

class JForg_Couchdb_Document extends JForg_Couchdb_Array implements
    JForg_Couchdb_Document_Saveable, Iterator
{

    /**
     * Constructs JForg_Couchdb_Document. If param is a string, this string is
     * handled as document id, and this object is populated from the values of
     * the corresponding document from database. If the param is an array and it
     * contains a field called data than this object is populated from the field
     * data
     *
     * @param array $config Config array
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
     public function __construct($config){
         parent::__construct($conf);
     }

    /**
     * Magic call implements "get...()" and "set...()" for
     * params listed in the method name.
     * 
     * @param mixed $name   The name of the called function 
     * @param array $arguments The function arguments
     * 
     * @return JForg_Couchdb_Document|mixed
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function __call($name, $arguments){}

	/**
	 * Get a property value
	 * 
	 * @param string $name The property name
	 * 
	 * @return mixed
	 * @author Bahtiar Gadimov <bahtiar@gadimov.de>
	 */
	public function __get($name){}

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
	 * Set a property value
	 * 
	 * @param string $name  The paramter to set
	 * @param mixed $value  The value to which the property is set
	 * 
	 * @return JForg_Couchdb_Document
	 * @author Bahtiar Gadimov <bahtiar@gadimov.de>
	 */
	public function __set($name, $value)
    {
        $setterMethod = 'set'.ucfirst($name);
        return $this->$setterMethod($value);
    }

	/**
	 * Returns a string representation of the object.
	 * 
	 * @return string
	 * @author Bahtiar Gadimov <bahtiar@gadimov.de>
	 */
	public function __toString(){}
    
    /**
     * Checks if a property is unset
     * 
     * @param string $name  Unsets the $name property
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function __unset($name){}

    /**
     * Deletes the document from the database
     * 
     * @return JForg_Couchdb_Document the deleted document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function delete()
    {
        $this->_dodb->delete($this);
        return $this;
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
        return $this->fetchSpecialProperty('_id');
    }

    /**
     * Returns the document sheme.
     * 
     * @return array Document sheme
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function fetchDocumentSheme()
    {
        return $this->_sheme;
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
     * @see JForg_Couchdb_Document::fetchSpecialProperties()
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
     * @see JForg_Couchdb_Document::fetchProperties()
     * @return array Indexed array with all document special properties.
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function fetchSpecialPropertiesNames()
    {
        return array_keys($this->_special);
    }

    /**
     * Returns a value of a special property
     * 
     * @param mixed $name Property name
     * 
     * @return mixed Property value
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function fetchSpecialProperty($name)
    {
        if ( isset($this->_special[$name]) )
            return $this->_special[$name];
        else
            throw $this->_exception('NO_SUCH_SPECIAL_PROPERTY', array('property', $name));
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
     * Returns the value at specified offset. This method is executed when
     * checking if offset is empty(). The method calls a get$Offset() function.
     * 
     * @param mixed $offset The offset to retrieve. 
     * 
     * @return mixed
     * @see ArrayAccess
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function offsetGet($offset)
    {
        $method = 'get'.ucfirst($offset);
        return $this->$method();
    }

    /**
     * Assigns a value to the specified offset. The method calls a set$Offset() function.
     * 
     * @param mixed $offset The offset to assign the value to.
     * @param mixed $value  The value to set. 
     * 
     * @return void
     * @see ArrayAccess
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function offsetSet($offset, $value)
    {
        $method = 'get'.ucfirst($offset);
        return $this->$method($value);
    }

    /**
     * Populates the document with data. Note: It won't create a new document
     * it will only overwrite the properties values of this document. If no id
     * is given the JForg_Couchdb_Document let the adapter generate one
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
     * @param array $values Populate the document with given data
     * 
     * @return JForg_Couchdb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function populate(array $values){}

    /**
     * Reloads the Document from the database and updates it's values
     * 
     * @return JForg_Couchdb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function reload()
    {
        if ( $this->_is_dirty )
            throw $this->_exception('ERR_DOC_IS_DIRTY');
        return $this->_dodb->fetch($this->fetchDocumentId());
    }

    /**
     * Saves the document to the dodb
     * 
     * @return JForg_Couchdb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function save()
    {
        return $this->_dodb->save($this);
    }

    /**
     * Sets a special property to the document. Note: It doesn't check if the
     * key already exists
     * 
     * @param string $name  Name of the special property
     * @param mixed $value Value of the special property
     * 
     * @return JForg_Couchdb_Document $this document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function setSpecialProperty($name, $value)
    {
    }

    /**
     * Returns an array with document data. The structure is prepared for
     * inserting a document in to couchdb
     * 
     * @return array
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function toArray()
    {}

    /**
     * Generates a document id. This function can be overriden on need
     * 
     * @return string
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _generateDocumentId()
    {}
}
