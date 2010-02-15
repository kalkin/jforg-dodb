<?php

/**
 * Contains an Documents and keys used to find him.
 * 
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @package   JForg_Dodb
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-02-09
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
class JForg_Dodb_Record extends Solar_Base {


    /**
     * Contains some data
     * 
     * @var mixed|JForg_Dodb_Array  Defaults to null. 
     * @since 2010-02-09
     */
    protected $_entry = null;


    /**
     * The key
     * 
     * @var mixed  Defaults to null. 
     * @since 2010-02-09
     */
    public $_key = null;

    /**
     * Populates the record with some data. This function can only be called
     * one time.
     * 
     * @param mixed $key The key for corresponding JForg_Dodb_Document
     * @param JForg_Dodb_Document $data Some data could be a mixed value or a JForg_Dodb_Array instance i.g an JForg_Dodb_Array
     * 
     * @return JForg_Dodb_Record
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function populate($key, $data )
    {
        if ( $this->_entry == null )
        {
            $this->_entry   = $data;
            $this->_key     = $key;
        }
        return $this;
    }
    
    /**
     * If $record->entry is called than the document or an JForg_Dodb_Array is
     * returned;
     * 
     * @param string $name The name of var to get
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function __get($name)
    {
        if ( $name === 'entry')
            return $this->_entry;
    }

    /**
     * Returns the key which was used to find the document
     * 
     * @return mixed
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function getKey()
    {
        return $this->_key;
    }

}
