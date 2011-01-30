<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_JForg_Couchdb_Api_Document extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_JForg_Couchdb_Api_Document = array(
    );
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('JForg_Couchdb_Api_Document');
        $expect = 'JForg_Couchdb_Api_Document';
        $this->assertInstance($actual, $expect);
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
     * Test -- Returns a prepared Solar_Http_Request object for interaction with the database directly via JForg_Couchdb::query()
     * 
     */
    public function testGetHttpRequest()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a prepared Solar_Uri object for interaction with the database directly via JForg_Couchdb::query()
     * 
     */
    public function testGetUri()
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
     * Test -- Saves a document as a json string to the database
     * 
     */
    public function testSave()
    {
        $this->todo('stub');
    }
}
