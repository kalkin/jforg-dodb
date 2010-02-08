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
        Solar_Registry::set('dodb', $this->_adapter);
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
     * Test -- Fetchs a document by id and returns it as an instance of JForg_Dodb_Document
     * 
     */
    public function testFetch()
    {
        $result = $this->_adapter->fetch('15a34caf9838799012f967b401acf944');
        print($result);
        $this->assertInstance($result, 'JForg_Dodb_Document');
    }

    /**
     * 
     * Test -- Saves a document
     * 
     */
    public function testSavePost()
    {
        $data = array(
                'data' => array ('bar' => 'foo'),
                'spcial' => null,
                );

        $doc = Solar::factory('JForg_Dodb_Document');
        $doc->populate($data);
        $result = $doc->save();
        print("$result\n\n");
        $this->assertInstance($result, 'JForg_Dodb_Document');
        
    }
    

    public function testSavePut()
    {
        $doc = Solar::factory('JForg_Dodb_Document');
        $doc->populate(array('id' => "".rand(999, 999999), 'data' =>
                    array('foo' => 'asd'),));
        $doc->setFrucht('Himbere');
        $result = $doc->save();
        Solar::dump($result);
        print("$result\n\n");
        $this->assertInstance($result, 'JForg_Dodb_Document');
        
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
     * Test -- Saves all documents in a JForg_Dodb_Document_Collection.
     * 
     */
    public function testSaveCollection()
    {
        $this->skip('abstract method');
    }
    
    /**
     * 
     * Test -- TODO: short description.
     * 
     */
    public function testIsTypeSafe()
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
        $this->skip('abstract method');
    }
}
