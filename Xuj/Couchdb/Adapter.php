<?php

/**
 * This is an abstract adapter class. 
 * 
 * @package   Xuj_Couchdb
 * @author    Bahtiar `kalkin-` Gadimov <bahtiar@gadimov.de>
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-10-16
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
 
class Xuj_Couchdb_Adapter extends Solar_Base
{

    /**
     * 
     * Default configuration values.
     * 
     * @config string dbname A database name to use.
     * 
     * @config string default_doc The document class to use if the document
     *   the document type is unrecognized
     * 
     * @config string encrypted If the database connection should be encrypted
     * 
     * @config string host A host to use.
     * 
     * @config string http_requst A config for the Solar_Http_Request_Adapter
     * 
     * @config string port A port to use.
     * 
     * @config bool type_safe If the adapter should fall back to default_doc if
     *   type is unrecognized
     * 
     * 
     * @var array
     * 
     */
    protected $_Xuj_Couchdb_Adapter = array (
            
       'dbname' => null,
       'default_doc'   => 'JForg_Dodb_Document',
	   'encrypted' => false,
	   'host' => 'localhost',
       'http_requst' => null,
	   'port' => '5984',
       'type_safe'     => false,
            
            );

    /**
     * The default document type to use
     * 
     * @var string  Defaults to null. 
     * @since 2010-02-07
     */
    protected $_default_doc = null;

    /**
     * If the adapter should fall back to default_doc if the document type is
     * unrecognized
     * 
     * @var boolean  Defaults to false. 
     * @since 2010-02-07
     */
    protected $_type_safe = false;

    /**
     * Database name
     * 
     * @var string  Defaults to null. 
     * @since 2010-01-26
     */
    protected $_dbName = null;

    const SPECIAL_ATTACHMENT        = '_attachments';
    const SPECIAL_CONFLICTS         = '_conflicts';
    const SPECIAL_DELETED_CONFLICTS = '_deleted_conflicts';
    const SPECIAL_DELETED           = '_deleted';
    const SPECIAL_ID                = '_id';
    const SPECIAL_REV_INFO          = '_rev_info';
    const SPECIAL_REVISIONS         = '_revisions';
    const SPECIAL_REV               = '_rev';

    const ALL_DOCS  = '_all_docs';
    const UUIDS      = '_uuids';

    /**
     * Contains all the special proprtys a couchdb document could have.
     *
     * @var array Default contains all SPECIAL_* consts
     */
    protected $_special_propertys = array ( self::SPECIAL_ATTACHMENT,
            self::SPECIAL_CONFLICTS, self:: SPECIAL_DELETED_CONFLICTS, 
            self::SPECIAL_DELETED, self::SPECIAL_ID, self:: SPECIAL_REV_INFO,
            self::SPECIAL_REVISIONS, self:: SPECIAL_REV);

    /**
     * Sets the $_type_safe and $_default_doc
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _postConfig()
    {
        parent::_postConfig();

        if (isset($this->_config['dbname'])) {
            throw $this->_exception('NO_DBNAME_DEFINED');
        } else {
            $this->_dbName = $this->_config['dbname'];
        }

        if (isset($this->_config['default_doc'])) {
            if (Interface_exists($this->_config['default_doc'])){
                $this->_default_doc = $this->_config['default_doc'];
            } else {
                throw $this->_exception('NO_SUCH_DEFAULT_DOC'); 
            }

        }

        if (isset($this->_config['type_safe'])){
            $this->_type_safe = $this->_config['type_safe'];
        }
    }
}
