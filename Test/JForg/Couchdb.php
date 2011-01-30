<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_JForg_Couchdb extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_JForg_Couchdb = array(
    );

    /**
     * @var JForg_Couchdb 
     */
    protected $dodb = null;

    public function preTest(){
        $this->dodb = Solar::factory('JForg_Couchdb');
    }
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('JForg_Couchdb');
        $expect = 'JForg_Couchdb';
        $this->assertInstance($actual, $expect);
    }
    
    /**
     * 
     * Test -- Generates from a database specific output a JForg_Couchdb_Document
     * 
     */
    public function testArrayToDocument()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Deletes a document from the database
     * 
     */
    public function testDelete()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Fetchs a document by id and returns it as an instance of JForg_Couchdb_Document
     * 
     */
    public function testFetch()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a prepared Solar_Http_Request object for interaction with the database directly via JForg_Couchdb::query()
     * 
     */
    public function testGetHttpRequest()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a preoared Solar_Uri object for interaction with the database directly via JForg_Couchdb::query()
     * 
     */
    public function testGetUri()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a specified number of uuids.
     * 
     */
    public function testGetUuid()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Parses a couchdb error, creates an Exception from it and throws it
     * 
     */
    public function testParseError()
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
    
    /**
     * 
     * Test -- Saves a document
     * 
     */
    public function testSave()
    {
        $this->todo('stub');
    }
}
