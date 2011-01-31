<?php
/**
 * This is the couchdb low level communication class. It just have three methods
 * 
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
abstract class JForg_Couchdb_Api extends Solar_Base
{
    /**
     * 
     * Default configuration values.
     * 
     * @config string encrypted If the database connection should be encrypted
     * 
     * @config string host A host to use.
     * 
     * @config string port A port to use.
     * 
     * @config bool logging If logging should be activated
     * 
     * @var array
     * 
     */
    protected $_JForg_Couchdb_Api = array(
	   'encrypted' => false,
	   'host' => 'localhost',
	   'port' => '5984',
       'logging'    => false,
            );

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
        $httpClient = Solar::factory('Solar_Http_Request', array('adapter' =>
                'Solar_Http_Request_Adapter_Stream'));

        $httpClient->setContent('');

        return $httpClient;
    }

    /**
     * Returns a prepared Solar_Uri object for interaction with the database
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

        return $uri;
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
    public function query(Solar_Uri $uri, 
            Solar_Http_Request_Adapter $request = null) 
    {
        if(is_null($request)){
            $request = $this->getHttpRequest();
        }

        $this->_log($uri->get(true));
        $this->_log($request);


        $request->setUri($uri);
    	$json = $request->fetch()->content;
        $this->_log($json);

    	$result =  json_decode($json,true);
        $this->_log($result);

        $this->checkForErrors($result);

        return $result;
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
   public abstract function checkForErrors($data);

   /**
    * Logs to the logger if config field logging is true
    * 
    * @param mixed $msg The message
    * @param string $event Event type
    * @access protected
    * @return void
    */
   protected function _log($msg, $event = 'DEBUG')
   {
       if($this->_config['logging']){
           if( is_string($msg) )
               Solar_Registry::get('log')->save(get_class($this), $event, $msg);
           else 
           {
               $msg = Solar_Registry::get('log_out')->fetch($msg);
               Solar_Registry::get('log')->save(get_class($this), $event, $msg);
           }
       }
   }
}
