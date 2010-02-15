<?php 
/**
 * Represents a design document
 * 
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @copyright (c) 2010 Bahtiar Gadimov
 * @package   JForg_Couchdb
 * @since     2010-02-10
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
class JForg_Couchdb_Document_Design extends JForg_Dodb_Document
{


    /**
     * Magic call implements "view...()" for executing the views
     * Calls parent:__call();
     *
     * @param mixed $name   The name of the called function 
     * @param array $arguments The function arguments
     * 
     * @return JForg_Dodb_Collection
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function __call($name, $arguments)
    {
        $methodPrefix = substr($name,0,4);

        if ( $methodPrefix === 'view' )
        {
            $valueName = substr($name,4);
            $valueName{0} = strtolower($valueName{0});
            return $this->_callView($valueName, $arguments[0]);
        } else {
            parent::__call($name, $arguments);
        }

    }


    /**
     * Locks sheme to a standart design document sheme after calling paraent
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _postConfig()
    {
        parent::_postConfig();
        $this->_sheme = array('language' => 'string');
    }

    /**
     * Calls a view with given params
     * 
     * @param string $viewName 
     * @param array $params   
     * 
     * @return JForg_Dodb_Collection|JForg_Dodb_Array
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _callView($viewName, array $params = null)
    {
        $uri = $this->_dodb->getUri();
        $uri->setPath($uri->getPath().'/'.$this->_documentId.'/_view/'.$viewName);
        foreach($params as $key => $value )
        {
            $uri->query[$key] = $value;
        }

        $data = $this->_dodb->query($uri);

        // Is the result empty?
        if ( empty($data['rows']) )
        {
            return Solar::factory('JForg_Dodb_Collection');
        } elseif (isset($data['rows'][0]['value']) &&    // Contains the result
                is_array($data['rows'][0]['value']) &&   //documents? If so then
                isset($data['rows'][0]['value']['_id'])) // return a JForg_Dodb_Collection
        {
            $collection = Solar::factory('JForg_Dodb_Collection');
            foreach( $data['rows'] as $row )
            {
                $doc = $this->_dodb->arrayToDocument($row['value']);
                $record = Solar::factory('JForg_Dodb_Record')->populate($row['key'], $doc);
                $collection->append($record);
            }

            return $collection;
        } else {
            // The document contains only some bunch of data so we generate an JForg_Dodb_Array
            $tmp = array();
            foreach( $data['rows'] as $row )
            {
                $tmp[] = $row;
            }
            return Solar::factory('JForg_Dodb_Array')->populate($tmp);
        }
    }

}
