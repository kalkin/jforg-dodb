<?php
/**
 * This is the couchdb low level communication class. It just barely wraps the
 * http db api calls
 * 
 * @package   JForg_Couchdb_Api
 * @author    Bahtiar `kalkin-` Gadimov <bahtiar@gadimov.de>
 * @copyright (c) 2011 Bahtiar Gadimov
 * @since     2011-01-30
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
class JForg_Couchdb_Api_Db extends JForg_Couchdb_Api {



    /**
     * Creates database. The database name must be composed of one or more
     * of the following characters:
     *      Lowercase characters (a-z)
     *      Name must begin with a lowercase letter
     *      Digits (0-9)
     *      Any of the characters _, $, (, ), +, -, and /. 
     * 
     * @access public
     * @param string $db Database Name
     * @throws JForg_Couchdb_Api_Db_Exception_IllegalDatabaseName,
     *      JForg_Couchdb_Api_Db_Exception_DatabaseAlreadyExists
     * @return boolean
     */
    public function create($db)
    {
        if(!is_string($db)){
            $this->_exception('ERR_ILLEGAL_DATABASE_NAME');
        }

        $request = $this->getHttpRequest()
            ->setMethod(Solar_Http_Request::METHOD_PUT);
        
        $uri = $this->getUri();
        $uri->setPath($db);
        $result = $this->query($uri, $request);

        if(isset($result['db_name'])){
            return true;
        } else {
            $this->_exception('ERR_DB_CREATION_FAILED', $result);
        }
        return false;
    }

    /**
     * Deletes the database, and all the documents and attachments contained
     * within it. 
     * 
     * @access public
     * @param string $db Database Name
     * @throws JForg_Couchdb_Api_Db_Exception_DatabaseNotFound,
    *       JForg_Couchdb_Api_Db_Exception_IllegalDatabaseName
     * @return boolean
     */
    public function delete($db)
    {
        if(!is_string($db)){
            $this->_exception('ERR_ILLEGAL_DATABASE_NAME');
        }

        $request = $this->getHttpRequest()
            ->setMethod(Solar_Http_Request::METHOD_DELETE);
        
        $uri = $this->getUri();
        $uri->setPath($db);
        $result = $this->query($uri, $request);

        if(isset($result['ok']) && $result['ok'] === true){
            return true;
        }

        return false;
    }

    /**
     * Request compaction of the database. Compaction compresses the disk
     * database file by performing the following operations:
     *    - Writes a new version of the database file, removing any unused sections
     *      from the new version during write. Because a new file is temporary created
     *      for this purpose, you will need twice the current storage space of the
     *      specified database in order for the compaction routine to complete.
     *
     *    - Removes old revisions of documents from the database, up to the
     *      per-database limit specified by the _revs_limit database parameter.  
     * 
     * @access public
     * @param string $db Database Name
     * @throws JForg_Couchdb_Api_Db_Exception_DbNotFound
     * @return bool
     */
    public function compact($db)
    {
        return false;
    }

    /**
     * Gets information about the database.
     * 
     * @param string $db Database Name
     * @access public
     * @throws JForg_Couchdb_Api_Db_Exception_DbNotFound
     * @return array
     */
    public function getInfo($db)
    {
        return null;
    }

    /**
     * Checks if a result from couchdb is an error message, if so it throws an
     * exception.
     * 
     * @param array $data Result returned from couchdb query
     * @abstract
     * @access public
     * @return void
     */
   public function checkForErrors($data){
       if(isset($data['error'])){
           switch ($data['error']) {
               case 'file_exists':
                   throw $this->_exception('ERR_DATABASE_ALREADY_EXISTS', $data);
                   break;
               case 'not_found':
                    throw $this->_exception('ERR_DATABASE_NOT_FOUND', $data);
                    break;

               default:
                   throw $this->_exception('ERR_'.strtoupper($data['error']), $data);
                   break;
           }

       }
   }

}
