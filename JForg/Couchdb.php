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

class JForg_Couchdb extends Solar_Factory
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
     *   type is unrecognized
     *
     * @config bool type_safe If the adapter should fall back to default_doc if
     *   the document type is unrecognized
     *
     * @var array
     * @since 2010-03-18 
     */
	protected $_JForg_Couchdb = array(
	   'host'       => 'localhost',
	   'port'       => '5984',
       'name'       => null,
       'user'       => null,
       'pass'       => null,
	   'encrypted'  => false,
       'default_doc'=> 'JForg_Couchdb_Document',
       'type_safe'  => false,
       );


}
