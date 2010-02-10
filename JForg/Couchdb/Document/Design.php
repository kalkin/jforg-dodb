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
     * Calls a view with given params
     * 
     * @param string $viewName 
     * @param array $params   
     * 
     * @return TODO
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _callView($viewName, array $params = null)
    {
        $uri = $this->_dodb->getUri();
        $uri->path[] = $this->_documentId.'/_view'.$viewName;
        foreach($params as $key => $value )
        {
            $uri->query[$key] = $value;
        }

        $result = $this->_dodb->query($uri);

        $collection = Solar::factory('JForg_Dodb_Collection');
        foreach( $data['rows'] as $row )
        {
            $doc = Solar::factory('JForg_Dodb_Document')->populate($row['value']);
            $record = Solar::factory('JForg_Dodb_Record')->populate($key, $doc);
            $collection->append($record);
        }
        
        return $collection;
    }

}
