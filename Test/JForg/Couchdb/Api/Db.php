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
     * Test -- Gets information about the specified database.
     * 
     */
    public function testGetInfo()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Request compaction of the database.
     * 
     */
    public function testCompact()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Creates database.
     * 
     */
    public function testCreate()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Deletes the database, and all the documents and attachments contained within it.
     * 
     */
    public function testDelete()
    {
        $this->todo('stub');
    }
}
