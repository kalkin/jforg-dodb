<?php
/**
 * An adapter for Document interaction with the Couchdb database
 * 
 * @package   JForg_Couchdb
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-01-28
 */
class JForg_Dodb_Adapter_Couchdb extends JForg_Dodb_Adapter
{

    /**
     * 
     * Default configuration values.
     * 
     * @config string host A host to use.
     * 
     * @config string port A port to use.
     * 
     * @config string dbname A database name to use.
     * 
     * @config string encrypted If the database connection should be encrypted
     * 
     * @config string http_requst A config for the Solar_Http_Request_Adapter
     * 
     * @var array
     * 
     */
	protected $_JForg_Dodb_Adapter_Couchdb = array(
	   'host' => 'localhost',
       'dbname' => null,
	   'port' => '5984',
	   'encrypted' => false,
       'http_requst' => null,
       );

    /**
     * Database name
     * 
     * @var string  Defaults to null. 
     * @since 2010-01-26
     */
    protected $_dbName = null;

    const SPECIAL_ATTACHMENT        = '_attachment';
    const SPECIAL_CONFLICTS         = '_conflicts';
    const SPECIAL_DELETED_CONFLICTS = '_deleted_conflicts';
    const SPECIAL_DELETED           = '_deleted';
    const SPECIAL_ID                = '_id';
    const SPECIAL_REV_INFO          = '_rev_info';
    const SPECIAL_REVISIONS         = '_revisions';
    const SPECIAL_REV               = '_rev';

    const ALL_DOCS  = '_all_docs';
    const UUIDS      = '_uuids';

    protected $_special_propertys = array ( self::SPECIAL_ATTACHMENT,
            self::SPECIAL_CONFLICTS, self:: SPECIAL_DELETED_CONFLICTS, 
            self::SPECIAL_DELETED, self::SPECIAL_ID, self:: SPECIAL_REV_INFO,
            self::SPECIAL_REVISIONS, self:: SPECIAL_REV);

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
		$data = $this->_fetch($id);
        return $this->_arrayToDoc($data);
	}

    /**
     * Fetchs documents by ids and returns an instance of
     * JForg_Dodb_Document_Collection containing instances of JForg_Dodb_Document s
     * 
     * @param array $ids Indexed array containing the documents ids
     * 
     * @return JForg_Dodb_Document_Collection containing all the documents as instances of JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function fetchCollection(array $ids)
	{
		$this->_exception('ERR_METHOD_NOT_IMPLEMENTED', array('name' => __METHOD__));
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
        $data = $this->_save($this->_docToArray($doc));
        if ( isset($data['ok']) )
        {
                return $this->fetch($data['id']);
        }
	}

    /**
     * Saves all documents in a JForg_Dodb_Document_Collection.
     * 
     * @param JForg_Dodb_Document_Collection $collection A collection of documents
     * 
     * @return JForg_Dodb_Document_Collection with all saved documents
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function saveCollection(JForg_Dodb_Document_Collection $collection)
	{
		$this->_exception('ERR_METHOD_NOT_IMPLEMENTED', array('name' => __METHOD__));
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
		$this->_exception('ERR_METHOD_NOT_IMPLEMENTED', array('name' => __METHOD__));
	}

    /**
     * Reloads all the documents in a JForg_Dodb_Document_Collection with up to date data.
     * 
     * @param JForg_Dodb_Document_Collection $collection  The collection to reload
     * 
     * @return JForg_Dodb_Document_Collection
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function reloadCollection(JForg_Dodb_Document_Collection $collection)
	{
		$this->_exception('ERR_METHOD_NOT_IMPLEMENTED', array('name' => __METHOD__));
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
		$this->_exception('ERR_METHOD_NOT_IMPLEMENTED', array('name' => __METHOD__));
	}

    /**
     * Deletes all documents in a JForg_Dodb_Document_Collection
     * 
     * @param JForg_Dodb_Document_Collection $collection The collection of documents to delete
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function deleteCollection(JForg_Dodb_Document_Collection $collection)
	{
		$this->_exception('ERR_METHOD_NOT_IMPLEMENTED', array('name' => __METHOD__));
	}

    /**
     * Returns a database specific string representation of a document
     * 
     * @param JForg_Dodb_Document $doc The document
     * 
     * @return string
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function documentToString(JForg_Dodb_Document $doc)
	{
        return json_encode($this->_docToArray($doc));
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

        return $this->query($uri);
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
    protected function _docToArray(JForg_Dodb_Document $doc)
    {
        $data = $doc->toArray();
        if ( isset($data['id']) )
        {
                $data['special']['_id'] = $data['id'];
                unset($data['id']);
        }


        return array_merge($data['data'], $data['special']);
    }


    /**
     * Populates a document with data
     * 
     * @param array $data The array containing document data
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _arrayToDoc(array $data)
    {
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
        
        $tmp['id'] = $data['_id'];
        unset($data['_id']);
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
     * Post config
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _postConfig()
    {
        if ( $this->_config['dbname'] == null)
            throw $this->_exception('NO_DBNAME_DEFINED');
        else 
            $this->_dbName = $this->_config['dbname'];

    }

    /**
     * Finds a document by id.
     * 
     * @param scalar $data The document id
     * 
     * @return array result
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _fetch($data)
    {

        $request = null; 
        $uri = $this->getUri();

        // Strange bugs on couchdb site search for 3 keys get 5 docs...
        //if ( is_array($data) )
        //{
            //$tmp = '';
            //foreach ($data as $id)
            //{
                //$tmp .= '"'.$id.'",';
            //}
            //$tmp = substr($tmp, 0, -1);
            //$content = '{"keys":['.$tmp.']}';

            //$request = $this->getHttpRequest();
            //$request->content = $content;
            //$request->method = Solar_Http_Request::METHOD_POST;

            //$uri->path[] = self::ALL_DOCS;
            //$uri->query['include_docs'] = 'true';

        //} else
            
        if ( is_scalar($data) )
        {
            $uri->path[] = $data;
        }
        else 
            throw $this->_exception('BAD_PARAMS');

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
        print($uri->get(true)."\n\n");
        return $this->query($uri, $request);
    }

    /**
     * Saves a document in to couchdb
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

    	return json_decode($json,true);
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
}
