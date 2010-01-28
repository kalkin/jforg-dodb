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
     * Couchdb config
     * 
     * @var mixed  Defaults to array(            ). 
     * @since 2010-01-27
     */
    protected $_couchdbConfig = array(
            'host' => 'localhost',
            'dbname' => 'testdb',
            'port' => '5900',
            'encrypted' => false,
            );

    /**
     * The Couchdb instance
     * 
     * @var JForg_Couchdb  Defaults to null. 
     * @since 2010-01-27
     */
    protected $_couchdb = null;

    public function preTest()
    {
        $this->_couchdb = Solar::factory('JForg_Couchdb', $this->_couchdbConfig);
    }

    public function postTest()
    {
        $this->_couchdb = null;
    }

    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('JForg_Couchdb', $this->_couchdbConfig);
        $expect = 'JForg_Couchdb';
        $this->assertInstance($actual, JForg_Couchdb);
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
     * Test -- Finds a document by id.
     * 
     */
    public function testFind()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the httpRequest object
     * 
     */
    public function testGetHttpRequest()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- TODO: short description.
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
     * Test -- Queries the couchdb database
     * 
     */
    public function testQuery()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- TODO: short description.
     * 
     */
    public function testSave()
    {
        $this->todo('stub');
    }
}
