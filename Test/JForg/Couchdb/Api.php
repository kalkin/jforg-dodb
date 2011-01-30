<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_JForg_Couchdb_Api extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_JForg_Couchdb_Api = array(
    );

    /**
     * The api
     * 
     * @var JForg_Couchdb_Api
     * @access public
     */
    public $api = null;

    public $savedArr = null;
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct() 
    {
        $actual = Solar::factory('JForg_Couchdb_Api');
        $expect = 'JForg_Couchdb_Api';
        $this->assertInstance($actual, $expect);
    }

    public function preTest(){
        $this->api = Solar::factory('JForg_Couchdb_Api');
    }

    /**
     * 
     * Test -- Returns a prepared Solar_Http_Request object for interaction with the database directly via JForg_Couchdb::query()
     * 
     */
    public function testGetHttpRequest()
    {
        $actual = $this->api->getHttpRequest();
        $this->assertInstance($actual, 'Solar_Http_Request_Adapter');
    }
    
    /**
     * 
     * Test -- Returns a prepared Solar_Uri object for interaction with the database directly via JForg_Couchdb::query()
     * 
     */
    public function testGetUri()
    {
        $api = Solar::factory('JForg_Couchdb_Api');
        $actual = $api->getUri()->get(true);
        $expect = 'http://localhost:5984/';
        $this->assertSame($actual, $expect);

        $api = Solar::factory('JForg_Couchdb_Api',
                array(
                    'encrypted' => true,
                    'host' => 'example.com',
                    'port' => '2342',
                    ));
        $actual = $api->getUri()->get(true);
        $expect = 'https://example.com:2342/';
        $this->assertSame($actual, $expect);

        $api = Solar::factory('JForg_Couchdb_Api',
                array(
                    'encrypted' => false,
                    'host' => 'example.org',
                    ));
        $actual = $api->getUri()->get(true);
        $expect = 'http://example.org:5984/';
        $this->assertSame($actual, $expect);
    }

    
    /**
     * 
     * Test -- Queries the couchdb database directly
     * 
     */
    public function testQuery()
    {
        $this->todo('stub');
    }
}
