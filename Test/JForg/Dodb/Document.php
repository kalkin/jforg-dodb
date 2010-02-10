<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_JForg_Dodb_Document extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_JForg_Dodb_Document = array(
    );
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('JForg_Dodb_Document');
        $expect = 'JForg_Dodb_Document';
        $this->assertInstance($actual, $expect);
    }

    /**
     * Sets JForg_Dodb_Adapter_Couchdb as dodb in to registry
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _postConfig()
    {
        parent::_postConfig();
        Solar_Registry::set('dodb', 'JForg_Dodb_Adapter_Couchdb');
    }
    
    /**
     * 
     * Test -- Magic call implements "get...()" and "set...()" for params listed in the method name.
     * 
     */
    public function test__call()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Get a parameter value
     * 
     */
    public function test__get()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Checks if a parameter is set
     * 
     */
    public function test__isset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Set a parameter value
     * 
     */
    public function test__set()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a string json representation of the object.
     * 
     */
    public function test__toString()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Checks if a parameter is unset
     * 
     */
    public function test__unset()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the parameter names
     * 
     */
    public function testFetchParameterNames()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns an array representation of this document
     * 
     */
    public function testFetchRawData()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the type of the document
     * 
     */
    public function testGetType()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Are there some unsaved changes?
     * 
     */
    public function testIsDirty()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Populates the document with data
     * 
     */
    public function testPopulate()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Reloads the Document from the database and updates it's values
     * 
     */
    public function testReload()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Saves the document to the dodb
     * 
     */
    public function testSave()
    {
        $this->todo('stub');
    }

    /**
     * 
     * Test -- Adds a special property to the document.
     * 
     */
    public function testAddSpecialProperty()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the document id.
     * 
     */
    public function testFetchDocumentId()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns all properties with values of a document.
     * 
     */
    public function testFetchProperties()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the name of the properties of a document
     * 
     */
    public function testFetchPropetiesNames()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns all special properties with values of a document.
     * 
     */
    public function testFetchSpecialProperties()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the names of the special properties of a document
     * 
     */
    public function testFetchSpecialPropertiesNames()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a value of a special propertu
     * 
     */
    public function testFetchSpecialProperty()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Checks if the document is final
     * 
     */
    public function testIsFinal()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Is the document already populated?
     * 
     */
    public function testIsPopulated()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns the document sheme.
     * 
     */
    public function testReturnDocumentSheme()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns an array with document data.
     * 
     */
    public function testToArray()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Updates/Sets the special property.
     * 
     */
    public function testUpdateSpecialProperty()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Deletes the document from the database
     * 
     */
    public function testDelete()
    {
        $this->todo('stub');
    }
}
