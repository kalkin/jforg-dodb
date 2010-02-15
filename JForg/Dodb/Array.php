<?php
/**
 * An solar like class which represents an Array
 * 
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @package   JForg_Dodb_Array
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
class JForg_Dodb_Array extends Solar_Base implements Iterator, Countable
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
     * @return JForg_Dodb_Array
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function populate(array $data)
    {
        $this->_data = $data;
        return $this;
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
        $this->_iterator_keys = array_keys($this->_data);
    }

    /**
     * Checks if current position is valid
     * 
     * @return boolean
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function valid()
    {
        if ( count($this->_data) > $this->_iterator_position )
            return true;
        return false;
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



}
