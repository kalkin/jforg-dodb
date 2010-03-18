<?php
/**
 * A collection of JForg_Dodb_Records 
 * 
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @package   JForg_Dodb
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
class JForg_Dodb_Collection extends JForg_Dodb_Array
{


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
     * Deletes documents stored in the records in this collection from the
     * database
     * 
     * @return JForg_Dodb_Collection
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function deleteAll()
    {
        foreach ($this->_data as $record)
            $record->document->delete();
    }

    /**
     * Empties the Collection
     * 
     * @return JForg_Dodb_Collection
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function removeAll()
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
