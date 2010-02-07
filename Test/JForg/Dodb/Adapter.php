<?php
/**
 * 
 * Abstract adapter class test.
 * 
 */
abstract class Test_JForg_Dodb_Adapter extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_JForg_Dodb_Adapter = array(
    );
    
    /**
     * 
     * The adapter class to instantiate.
     * 
     * @var array
     * 
     */
    protected $_adapter_class;
    
    /**
     * 
     * The adapter instance.
     * 
     * @var array
     * 
     */
    protected $_adapter;
    
    /**
     * 
     * Sets $_adapter_class based on the test class name.
     * 
     * @return void
     * 
     */
    protected function _postConstruct()
    {
        parent::_postConstruct();
        
        // Test_Vendor_Foo => Vendor_Foo
        $this->_adapter_class = substr(get_class($this), 5);
    }
    
    /**
     * 
     * Creates an adapter instance.
     * 
     * @return void
     * 
     */
    public function preTest()
    {
        parent::preTest();
        $this->_adapter = Solar::factory(
            $this->_adapter_class,
            $this->_config
        );
    }
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $this->assertInstance($this->_adapter, $this->_adapter_class);
    }
    
    /**
     * 
     * Test -- Deletes a document from the database
     * 
     */
    public function testDelete()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Deletes all documents in a JForg_Dodb_Document_Collection
     * 
     */
    public function testDeleteCollection()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Returns a database specific string representation of a document
     * 
     */
    public function testDocumentToString()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Fetchs a document by id and returns it as an instance of JForg_Dodb_Document
     * 
     */
    public function testFetch()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Fetchs documents by ids and returns an instance of JForg_Dodb_Document_Collection containing instances of JForg_Dodb_Document s
     * 
     */
    public function testFetchCollection()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Returns one or many uuid.
     * 
     */
    public function testGetUuid()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Reloads a document with up to date data
     * 
     */
    public function testReload()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Reloads all the documents in a JForg_Dodb_Document_Collection with up to date data.
     * 
     */
    public function testReloadCollection()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Saves a document
     * 
     */
    public function testSave()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- Saves all documents in a JForg_Dodb_Document_Collection.
     * 
     */
    public function testSaveCollection()
    {
        $this->skip('abstract method');
    }
}
