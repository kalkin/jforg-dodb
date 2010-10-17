<?php
/**
 * An solar like class which represents an Array
 * 
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @package   JForg_Couchdb_Array
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-02-08
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
class JForg_Couchdb_Array extends Solar_Base implements Iterator, Countable, ArrayAccess
{

	/**
	 * The document data
	 * 
	 * @var array  Defaults to array(). 
	 * @since 2010-01-26
	 */
	protected $_data = array();

    /**
     * Constructor
     * 
     * @param array $conf Array value datais used to populate JForg_Couchdb_Array
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function __construct(array $conf = null)
    {
        if (is_array($conf) && isset($conf['data'])){
            $this->_data = $conf['data'];
            $this->rewind();
        }
    }

    /**
     * Return the current element
     * 
     * @return mixed
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function current()
    {
        return current($this->_data);
    }

    /**
     * Return the key of the current element
     * 
     * @return scalar
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function key()
    {
        return key($this->_data);
    }

    /**
     * Move forward to next element
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function next()
    {
        return next($this->_data);
    }

    /**
     * Rewind the Iterator to the first element
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function rewind()
    {
        return reset($this->_data);
    }

    /**
     * Checks if current position is valid
     * 
     * @return boolean
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function valid()
    {
        return $this->current() !== false;
    }

    /**
     * Implementation of Countable interface
     * 
     * @return int
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function count()
    {
        return count($this->_data);
    }

    /**
     * Whether a offset exists
     * 
     * @param mixed $offset An offset to check for. 
     * 
     * @return boolean
     * @see ArrayAccess
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function offsetExists($offset)
    {
        return isset($this->_data[$offset]);
    }

    /**
     * Returns the value at specified offset. This method is executed when
     * checking if offset is empty(). 
     * 
     * @param mixed $offset The offset to retrieve. 
     * 
     * @return mixed
     * @see ArrayAccess
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function offsetGet($offset)
    {
        return $this->_data[$offset];
    }

    /**
     * Assigns a value to the specified offset. 
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
        $this->_data[$offset] = $value;
    }

    /**
     * Unsets an offset.
     * 
     * @param object $offset The offset to unset
     * 
     * @return void
     * @see ArrayAccess
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function offsetUnset($offset)
    {
        unset($this->_data[$offset]);
    }

}
