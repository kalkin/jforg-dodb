<?php
/**
 * A Couchdb Instance.
 * 
 * @package   JForg_Couchdb
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-01-28
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

class JForg_Couchdb extends Solar_Base
{
    /**
     * 
     * Default configuration values.
     * 
     * @config string host A host to use.
     * 
     * @config string port A port to use.
     * 
     * @config string name A database name to use.
     * 
     * @config string user Username to use for HTTP authenitification
     *
     * @config string pass Password to use for HTTP authenitification
     *
     * @config string encrypted If the database connection should be encrypted
     * 
     * @config string http_requst A config for the Solar_Http_Request_Adapter
     * 
     * @config string default_doc The document class to use if the document
     *                              type is unrecognized
     *
     * @config bool type_safe If couchdb should fall back to default_doc when
     *                          the document type is unrecognized
     *
     * @var array
     * @since 2010-03-18 
     */
	protected $_JForg_Couchdb = array(
	   'host'               => 'localhost',
	   'port'               => '5984',
       'name'               => null,
       'user'               => null,
       'pass'               => null,
	   'encrypted'          => false,
       'default_doc'        => 'JForg_Couchdb_Document',
       'default_collection' => 'JForg_Couchdb_Document',
       'type_safe'          => false,
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
     * Returns if couchdb operates type safe.
     * 
     * @return boolean
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function isTypeSafe()
    {
        return $this->_type_safe;
    }

    /**
     * Fetchs a document by id and returns it as an instance of
     * JForg_Dodb_Document
     * 
     * @param scalar $id The document id
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function fetch($id)
	{
        return $this->arrayToDocument($this->_fetch($id));
	}

    /**
     * Fetchs documents by ids and returns an instance of
     * JForg_Dodb_Collection containing instances of JForg_Dodb_Document
     * 
     * @param array $ids Indexed array containing the documents ids
     * 
     * @return JForg_Dodb_Collection containing all the documents as instances of JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function fetchCollection(array $ids)
	{
        $collection = Solar::factory($this->_config['default_collection']);
        foreach ( $ids as $id )
        {
            $doc = $this->fetch($id);
            $collection->append($doc);
        }

        return $collection;
	}

    /**
     * Saves a document
     * 
     * @param JForg_Dodb_Document $doc The document
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function save(JForg_Dodb_Document $doc)
	{
        $data = $this->_save($this->documentToArray($doc));
        if ( isset($data['ok']) )
        {
            return $this->fetch($data['id']);
        }
	}

    /**
     * Saves all documents in a JForg_Dodb_Collection.
     * 
     * @param JForg_Dodb_Collection $collection A collection of documents
     * @param onlychanged Indicates whether only documents that have changes
     *      should be saved. Default to true
     * 
     * @return JForg_Dodb_Collection with all saved documents
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function saveCollection(JForg_Dodb_Collection $collection, $onlychanged = true)
	{
        foreach ($collection as $doc )
        {
            if (onlychanged && $doc->isDirty())
                $doc->save();
            elseif (!onlychanged)
                $doc->save();
        }
	} 


    /**
     * Reloads a document with up to date data
     * 
     * @param JForg_Dodb_Document $doc The document to reload
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function reload(JForg_Dodb_Document $doc)
	{
        return $this->fetch($doc->fetchDocumentId());
	}

    /**
     * Reloads all the documents in a JForg_Dodb_Collection with up to date data.
     * 
     * @param JForg_Dodb_Collection $collection  The collection to reload
     * 
     * @return JForg_Dodb_Collection
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function reloadCollection(JForg_Dodb_Collection $collection)
	{
        foreach ($collection as $doc )
        {
            $doc->reload();
        }
	}

    /**
     * Deletes a document from the database
     * 
     * @param JForg_Dodb_Document $doc The document to delete
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function delete(JForg_Dodb_Document $doc)
	{
        $this->_delete($doc->fetchDocumentId(), $doc->fetchSpecialProperty('_rev'));
	}

    /**
     * Deletes all documents in a JForg_Dodb_Collection
     * 
     * @param JForg_Dodb_Collection $collection The collection of documents to delete
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function deleteCollection(JForg_Dodb_Collection $collection)
	{
		throw $this->_exception('ERR_METHOD_NOT_IMPLEMENTED', array('name' => __METHOD__));
	}

    /**
     * Returns a JSON representation of a document
     * 
     * @param JForg_Dodb_Document $doc The document
     * 
     * @return string
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function documentToJson(JForg_Dodb_Document $doc)
	{
        return json_encode($this->documentToArray($doc));
	}

    /**
     * Returns a specified number of uuids. NOTE: It does not check for
     * existing document ids; collision-detection happens when you are trying
     * to save a document. 
     * 
     * @param int $count Optional, defaults to 1. How many Uuids should be returned? 
     * 
     * @return array An indexed array with id's
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function getUuid($count = 1) 
    {
        $uri = $this->getUri();
        $uri->path = array(self::UUIDS);
        if ( $count > 1 )
        {
            $uri->query['count'] = $count; 
        }

        $result = $this->query($uri);

        if ($count === 1)
            return $result['uuids'][0];
        return $result['uuids'];
    }

    /**
     * Generates an array from a Document it already formated right for
     * inserting in Couchdb
     * 
     * @param JForg_Dodb_Document $doc  The document to format
     * 
     * @return array
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function documentToArray(JForg_Dodb_Document $doc)
    {
        throw $this->_exception('ERR_TODO_REIMPLEMENT_METHOD', array('name' => __METHOD__));
        $data = $doc->toArray();
        if ( isset($data['id']) )
        {
                $data['special']['_id'] = $data['id'];
                unset($data['id']);
        }


        return array_merge($data['data'], $data['special']);
    }

    /**
     * Generates from a couchdb specific data a JForg_Dodb_Document
     * 
     * @param array $data Couchdb specific data
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function arrayToDocument(array $data)
    {
        throw $this->_exception('ERR_TODO_REIMPLEMENT_METHOD', array('name' => __METHOD__));
        $doc = null;
        if (isset($data['type']))
        {
            try{
                $doc = Solar::factory($data['type']);
                if ( !($doc instanceof JForg_Dodb_Document) )
                {
                    $this->_exception('NO_CLASS_FOR_THIS_TYPE', array('type' => $data['type']));
                }
            } catch (Exception $e )
            {
                if ( $this->_type_safe )
                    $this->_exception('DOC_HAS_NO_TYPE', array('doc' => $data));

                else 
                    $doc = Solar::factory('JForg_Dodb_Document');
            }
        }
        elseif ( !$this->_type_safe )
        {
            $doc = Solar::factory('JForg_Dodb_Document');
        }
        
        if ( isset($data['_id']) )
        {
            $tmp['id'] = $data['_id'];
            unset($data['_id']);
        }

        foreach ( $data as $key => $value )
        {
            if ( in_array($key, $this->_special_propertys, true) )
            {
                $tmp['special'][$key] = $value;
            } else {
                $tmp['data'][$key] = $value;
            }
        }
        
        return $doc->populate($tmp);
    }

    /**
     * Generates from couchdb specific data set a collection containing
     * JForg_Dodb_Documents
     * 
     * @param array $data Couchdb specific data
     * 
     * @return JForg_Dodb_Collection
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function arrayToCollection(array $data)
    {
        $collection = Solar::factory($this->_config['default_collection']);
        foreach ($data as $key => $docData)
        {
            $doc = $this->arrayToDocument($docData);
            $doc->populate($doc)->key = $key;
                
            $collection->append($doc);
        }

    }

    /**
     * Queries the couchdb database directly
     * 
     * @param Solar_Uri          $uri    The uri object to use
     * @param Solar_Http_Request $request The request object to use
     * 
     * @return array the result
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function query(Solar_Uri $uri, Solar_Http_Request_Adapter $request = null) 
    {
        if ( $request == null )
            $request = $this->getHttpRequest();

        //print($uri->get(true)."\n\n");
        //print("\n");
        //Solar::dump($request);
        //print("\n");

        $request->setUri($uri->get(true));
    	$json = $request->fetch()->content;

    	$result =  json_decode($json,true);
        if (isset($result['error']) && isset($result['reason']))
            $this->_createException($result);

        return $result;
    }

    /**
     * Returns a preoared Solar_Uri object for interaction with the database
     * directly via JForg_Couchdb::query()
     * 
     * @see JForg_Couchdb::query()
     * @see JForg_Couchdb::getHttpRequest()
     * @return Solar_Uri
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function getUri()
    {
        $uri = Solar::factory('Solar_Uri');
    	$uri->host = $this->_config['host'];
    	$uri->port = $this->_config['port'];
    	if ($this->_config['encrypted'] == false) {
    		$uri->scheme = 'http';	
    	} else {
    		$uri->scheme = 'https';
    	}

    	if (isset($this->_config['user']) AND (isset($this->_config['password']))) {
    		$uri->user = $this->_config['user'];
    		$uri->pass = $this->_config['password'];
    	}

    	$uri->setPath($this->_dbName);

        return $uri;
    }

    /**
     * Returns a prepared Solar_Http_Request object for interaction with the
     * database directly via JForg_Couchdb::query()
     * 
     * @see JForg_Couchdb::query()
     * @see JForg_Couchdb::getUri();
     * @return Solar_Http_Request
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function getHttpRequest()
    {
        if ( isset($this->_config['http_requst']) && $this->_config['http_requst'] != null )
        {
            $httpClient = Solar::factory('Solar_Http_Request', array('adapter' => 'Solar_Http_Request_Adapter_Curl'));
        }
        else
            $httpClient = Solar::factory('Solar_Http_Request');

        $httpClient->setContent('');

        return $httpClient;
    }

    /**
     * Sets the $_type_safe and $_default_doc
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _postConfig()
    {
        parent::_postConfig();
        $this->_default_doc = $this->_config['default_doc'];
        $this->_type_safe = $this->_config['type_safe'];
        if ( $this->_config['name'] == null)
            throw $this->_exception('ERR_NO_DBNAME_DEFINED');
        else 
            $this->_dbName = $this->_config['name'];
    }


    /**
     * Finds a document by id.
     * 
     * @param scalar $data The document id
     * 
     * @return array result
     * @throws JForg_Dodb_Adapter_Exception_NoSuchDocument
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _fetch($data)
    {
        $request = null; 
        $uri = $this->getUri();

        if ( is_scalar($data) )
        {
            $uri->setPath($uri->getPath().'/'.$data);
        }
        else 
            throw $this->_exception('ERR_NO_SUCH_DOCUMENT', array('id' => $data));

        return  $this->query($uri, $request);
    }

    /**
     * Deletes a document from the database
     * 
     * @param scalar $id The document id
     * @param scalar $rev The document revision
     * 
     * @return bool
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _delete($id, $rev)
    {

        $uri = $this->getUri();

        $request = $this->getHttpRequest();
        $request->setMethod(Solar_Http_Request::METHOD_DELETE);

        $uri->path[] = $id;
        $uri->query = array('rev' => $rev);
        return $this->query($uri, $request);
    }

    /**
     * Saves a document in to database
     * 
     * @param array $data The document data to save
     * 
     * @return array Couchdb response
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _save(array $data)
    {
        $uri = $this->getUri();
        $request = $this->getHttpRequest();

        if ( isset($data['_id']) )
        {
            $request->setMethod(Solar_Http_Request::METHOD_PUT);
            $uri->path[] = $data['_id'];
            //unset($data['_id']);
        } else {
            $request->setMethod(Solar_Http_Request::METHOD_POST);
        }

        $request->setContent(json_encode($data));
        $request->setContentType('application/json');

        return $this->query($uri, $request);

    }

    /**
     * Converts an Couchdb error to an Exception and throws it
     * 
     * @param array $error The response array containing at least 'error' and
     * 'reason' fields
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _createException(array $error)
    {
        if ( $error['error'] === 'not_found' )
            throw Solar::exception($this, 'ERR_NO_SUCH_DOCUMENT', 'ERR_NO_SUCH_DOCUMENT',  $error);
        else 
            throw Solar::exception($this, 'ERR_'.strtoupper($error['error']),
                    'ERR_'.strtoupper($error['error']), $error);
                
    }

}
