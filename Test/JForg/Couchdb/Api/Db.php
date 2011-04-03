<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_JForg_Couchdb_Api_Db extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_JForg_Couchdb_Api_Db = array(
    );

    /**
     * Db name which should be used for deletion
     * 
     * @var string
     * @access public
     */
    public $dbToDelete = null;

    public function preTest(){
        $this->api = Solar::factory('JForg_Couchdb_Api_Db');
    }
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('JForg_Couchdb_Api_Db');
        $expect = 'JForg_Couchdb_Api_Db';
        $this->assertInstance($actual, $expect);
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
        $api = Solar::factory('JForg_Couchdb_Api_Db');
        $actual = $api->getUri()->get(true);
        $expect = 'http://localhost:5984/';
        $this->assertSame($actual, $expect);

        $api = Solar::factory('JForg_Couchdb_Api_Db',
                array(
                    'encrypted' => true,
                    'host' => 'example.com',
                    'port' => '2342',
                    ));
        $actual = $api->getUri()->get(true);
        $expect = 'https://example.com:2342/';
        $this->assertSame($actual, $expect);

        $api = Solar::factory('JForg_Couchdb_Api_Db',
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
     * Test -- Creates database.
     * 
     */
    public function testCreate()
    {
        $this->assertTrue($this->api->create('example23'));

        // This should fail with an exception
        try{
            $this->api->create('123asd');
            $this->fail( 'Tried to create db with illegal name, no exception was thrown');
        }catch (JForg_Couchdb_Api_Db_Exception_IllegalDatabaseName $e){
            $this->assertInstance($e,
                    'JForg_Couchdb_Api_Db_Exception_IllegalDatabaseName');
        }

        // This should also fail
        try{
            $this->api->create('example23');
            $this->fail( 'Tried to create db wich already exists, no exception was thrown');
        }catch (JForg_Couchdb_Api_Db_Exception_DatabaseAlreadyExists $e){
            $this->assertInstance($e,
                    'JForg_Couchdb_Api_Db_Exception_DatabaseAlreadyExists');
        }
    }

    /**
     * 
     * Test -- Gets information about the specified database.
     * 
     */
    public function testGetInfo()
    {
        $actual = $this->api->getInfo('example23');
        $this->assertSame($actual['db_name'], 'example23');
        

        try{
            $this->api->getInfo('as23');
            $this->fail('Tried to get info of not existent db, an exception should be thrown'); 
        }catch (JForg_Couchdb_Api_Db_Exception_DatabaseNotFound $e)
        {
            $this->assertInstance($e,
                    'JForg_Couchdb_Api_Db_Exception_DatabaseNotFound');
        }
    }
    
    /**
     * 
     * Test -- Request compaction of the database.
     * 
     */
    public function testCompact()
    {
        $actual = $this->api->compact('example23');
        $this->assertTrue($actual);
    }

    /**
     * 
     * Test -- Deletes the database, and all the documents and attachments contained within it.
     * 
     */
    public function testDelete()
    {
        $this->assertTrue($this->api->delete('example23'));

        try{
            $this->api->delete('as23');
            $this->fail('Tried to delete not existent db, an exception should be thrown'); 
        }catch (JForg_Couchdb_Api_Db_Exception_DatabaseNotFound $e)
        {
            $this->assertInstance($e,
                    'JForg_Couchdb_Api_Db_Exception_DatabaseNotFound');
        }
    }

    /**
     * 
     * Test -- Compacts the view indexes associated with the specified design document.
     * 
     */
    public function testCompactDesignDocs()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Obtains a list of the changes made to a database.
     * 
     */
    public function testGetChanges()
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
