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
    
    /**
     * 
     * Test -- Create a new document in the database, using the supplied JSON document structure.
     * 
     */
    public function testCreate()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Deletes the attachment attachment to the specified doc.
     * 
     */
    public function testDeleteDocAttachment()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a document as array by id and revision
     * 
     */
    public function testFetchByIdAndRev()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the file attachment attachment associated with the document doc.
     * 
     */
    public function testFetchDocAttachment()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Return a list of detailed revision information for the document
     * 
     */
    public function testFetchRevsInfo()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Upload the supplied content as an attachment to the specified document.
     * 
     */
    public function testSaveDocAttachment()
    {
        $this->todo('stub');
    }
    
    
    /**
     * 
     * Test -- Checks if a result from couchdb is an error message, if so it throws an exception.
     * 
     */
    public function testCheckForErrors()
    {
        $this->skip('no reasonable tests for this');
    }
}
