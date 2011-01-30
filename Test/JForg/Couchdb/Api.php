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
        try{
            Solar::factory('JForg_Couchdb_Api', array('dbname' => null));
            $this->fail('JForg_Couchdb_Exception_NoDbName should be thrown');
        }catch(JForg_Couchdb_Exception_NoDbName $e){
            $this->assertInstance($e, 'JForg_Couchdb_Exception_NoDbName');
        }

        $actual = Solar::factory('JForg_Couchdb_Api', array(
                    'dbname' => 'example',
                    'encrypted' => false,
                    'host' => 'localhost',
                    'port' => '5984',
                    'logging'    => false,
                ));
        $expect = 'JForg_Couchdb_Api';
        $this->assertInstance($actual, $expect);
    }

    public function preTest(){
        $this->api = Solar::factory('JForg_Couchdb_Api', array(
                    'dbname' => 'example',
                    'encrypted' => false,
                    'host' => 'localhost',
                    'port' => '5984',
                    'logging'    => false,
                ));
    }

    /**
     * 
     * Test -- Returns a prepared Solar_Http_Request object for interaction with the database directly via JForg_Couchdb::query()
     * 
     */
    public function testGetHttpRequest()
    {
        $actual = $this->api->getHttpRequest();
        $this->assertInstance($actual, 'Solar_Http_Request');
    }
    
    /**
     * 
     * Test -- Returns a prepared Solar_Uri object for interaction with the database directly via JForg_Couchdb::query()
     * 
     */
    public function testGetUri()
    {
        $api = Solar::factory('JForg_apidb',
                array(
                    'dbname' => 'foo',
                    ));
        $actual = $api->getUri()->get(true);
        $expect = 'http://localhost:5984/foo';
        $this->assertSame($actual, $expect);

        $api = Solar::factory('JForg_apidb',
                array(
                    'dbname' => 'foo',
                    'encrypted' => true,
                    'host' => 'example.com',
                    'port' => '2342',
                    ));
        $actual = $api->getUri()->get(true);
        $expect = 'https://example.com:2342/foo';
        $this->assertSame($actual, $expect);

        $api = Solar::factory('JForg_apidb',
                array(
                    'dbname' => 'bar',
                    'encrypted' => false,
                    'host' => 'example.org',
                    ));
        $actual = $api->getUri()->get(true);
        $expect = 'http://example.org:5984/bar';
        $this->assertSame($actual, $expect);
    }

    /**
     * 
     * Test -- Saves a document as a json string to the database
     * 
     */
    public function testSave()
    {
        $api = $this->api;
        $expect = array(
                '_id'    => sha1(rand(0, 1231231)),
                'example_array'     => array(
                    'array_example_bool'      => true,
                    'array_example_int'       => rand(0, 255),
                    'array_example_null'      => null,
                    'array_example_string'    => 'buz',
                    ),
                'example_bool'      => false,
                'example_int'       => rand(0, 255),
                'example_null'      => null,
                'example_string'    => 'lore ipsum',
                );
        $this->dump($api->_save(json_encode($expect)));
        $this->savedArr = $expect;

        //$this->dump($expect['_id']);


        // check conflict exception
        $this->dump($api->_save($expect));
        $this->fail();

    }

    
    /**
     * 
     * Test -- Deletes a document by id and it's revision
     * 
     */
    public function testDelete()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a document as array by id
     * 
     */
    public function testFetch()
    {
        $this->todo('stub');
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
