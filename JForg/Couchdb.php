<?php
/**
 * Adapter class for Couchdb
 * 
 * @package JForg_Dodb 
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-01-26
 */
class JForg_Couchdb extends Solar_Base
{

	protected $_JForg_Dodb_Adapter_CouchDb = array(
	   'host' => 'localhost',
       'dbname' => null,
	   'port' => '5984',
	   'encrypted' => false,
       'http_requst' => null,
	);

    const ALL_DOCS  = '_all_docs';
    const UUIDS      = '_uuids';
	
    /**
     * Database name
     * 
     * @var string  Defaults to null. 
     * @since 2010-01-26
     */
    protected $_dbName = null;


    /**
     * Post config
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _postConfig()
    {
        if ( $this->_config['dbname'] != null)
            throw $this->_exception('NO_DBNAME_DEFINED');
        else 
            $this->_dbName = $this->_config['dbname'];

    }

    /**
     * Finds a document by id.
     * 
     * @param string|array $data The document id
     * 
     * @return array result
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function find($data)
    {

        $request = null; 
        $uri = $this->getUri();

        if ( is_array($data) )
        {
            foreach ($data as $id)
            {
                $tmp .= '"'.$id.'",';
            }
            $tmp = substr($tmp, 0, -1);
            $content = '{"keys":['.$tmp.']}';

            $request = $this->getHttpRequest();
            $request->content = $content;

            $uri->path[] = self::ALL_DOCS;
            $uri->query['include_docs'] = 'true';

        } elseif ( is_scalar($data) )
        {
            $uri->path[] = $data;
        }
        else 
            throw $this->_exception('BAD_PARAMS');

        return  $this->_query($uri, $request);
    }

    /**
     * Deletes a document from the database
     * 
     * @param string|array $data The document id
     * 
     * @return bool
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function delete($data)
    {
        $uri = $this->getUri();

        $request = $this->getHttpRequest();
        $request->setMethod(Solar_Http_Request::METHOD_DELETE);


        if ( is_array($data))
        {
            $uri->path[] = $data['_id'];
            if ( isset($data['_rev']) )
                $uri->query = array('rev' => $data['_rev']);
        } elseif ( is_scalar($data) )
        {
            $uri->path[] = $data;
        }
        else 
            throw $this->_exception('BAD_PARAMS');
        return $this->query($uri, $request);
    }

    /**
     * TODO: short description.
     * 
     * @param double $data 
     * 
     * @return TODO
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function save(array $data)
    {
        $uri = $this->getUri();
        $request = $this->getHttpRequest();

        if ( isset($data['_id']) )
        {
            $request->setMethod(Solar_Http_Request::METHOD_PUT);
            $uri->path[] = $data['_id'];
        } else {
            $request->setMethod(Solar_Http_Request::METHOD_POST);
        }

        return $this->query($uri, $request);

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
        $uri->path[] = self::UUIDS;
        if ( $count > 1 )
        {
            $uri->query['count'] = $count; 
        }

        return $this->query($uri);
    }

    /**
     * Queries the couchdb database
     * 
     * @param Solar_Uri          $uri    
     * @param Solar_Http_Request $client 
     * 
     * @return array the result
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function query(Solar_Uri $uri, Solar_Http_Request $request = null) 
    {
        if ( $request == null )
            $request = $this->getHttpRequest();
            
        $request->setUri($uri->get(true));
    	$json = $request->fetch()->content;
    	return json_decode($json,true);
    }

    /**
     * TODO: short description.
     * 
     * @return TODO
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
     * Returns the httpRequest object
     * 
     * @return Solar_Http_Request
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function getHttpRequest($aconfig)
    {
        if ( $this->_config['http_requst'] != null )
            $httpClient = Solar::factory('Solar_Http_Request', $this->_config['http_requst']);
        else
            $httpClient = Solar::factory('Solar_Http_Request');

        $httpClient->setContent('');

        return $httpClient;
    }

}
