<?php
/**
 * 
 * Concrete class test.
 * 
 */
class Test_JForg_Couchdb_Document extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_JForg_Couchdb_Document = array(
    );
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        $actual = Solar::factory('JForg_Couchdb_Document');
        $expect = 'JForg_Couchdb_Document';
        $this->assertInstance($actual, $expect);

        try {
            Solar::factory('JForg_Couchdb_Document', "asdasdasdasdasd");
        } catch (JForg_Couchdb_Exception_NoSuchDocument $e)
        {
            $actual = $e;
        }
        $this->assertInstance($actual,
                'JForg_Couchdb_Exception_NoSuchDocument');

        try {
            Solar::factory('JForg_Couchdb_Document', array(
                        'data' => array(
                            "_id"=> "76ff882fa8720370f632c40e3a032835",
                            "_rev"=> "1-211c37537c043fcb1c4b4936b843966c",
                            "a"=> 4,
                            "b"=> 16                       
                            ), 
                        'sheme' => array(
                            "a" => "string",
                            "b" => "int",
                            ),
                        ));
        } catch (JForg_Couchdb_Document_Exception_InvalidSheme $e){
            $actual = $e;
        }
        $this->assertInstance($actual,
                'JForg_Couchdb_Document_Exception_InvalidSheme');
        $actual = Solar::factory('JForg_Couchdb_Document',
                "76ff882fa8720370f632c40e3a032835")->getA();
        $this->assertSame($actual, 4);
    }
    
    /**
     * 
     * Test -- Implementation of Countable interface
     * 
     */
    public function testCount()
    {
        $actual = coung($this->_instanceOne);
        $this->assertSame($actual, 2);

        $actual = count($this->_instanceTwo);
        $this->assertSame($actual, 2);

        $actual = count($this->_instanceThree);
        $this->assertSame($actual, 0);
    }
    
    /**
     * 
     * Test -- Return the current element
     * 
     */
    public function testCurrent()
    {
        $actual = current($this->_instanceOne);
        $this->assertSame($actual, 4);
        $actual = current($this->_instanceThree);
        $this->assertSame($actual, 4);
        $actual = current($this->_instanceThree);
        $this->assertFalse($actual);
    }
    
    /**
     * 
     * Test -- Return the key of the current element
     * 
     */
    public function testKey()
    {
        $actual = key($this->_instanceOne);
        $this->assertSame($actual, 'a');

        $actual = key($this->_instanceTwo);
        $this->assertSame($actual, 'a');

        $actual = key($this->_instanceThree);
        $this->assertNull($actual);
    }
    
    /**
     * 
     * Test -- Move forward to next element
     * 
     */
    public function testNext()
    {
        $actual = next($this->_instanceOne);
        $this->assertSame($actual, 16);
        
        $actual = next($this->_instanceTwo);
        $actual = next($this->_instanceTwo);
        $this->assertFalse($actual);

        $actual = next($this->_instanceThree);
        $this->assertFalse($actual);
    }
    
    /**
     * 
     * Test -- Whether a offset exists
     * 
     */
    public function testOffsetExists()
    {
        $actual = isset($this->_instanceOne['a']);
        $this->assertTrue($actual);

        $actual = isset($this->_instanceOne['d']);
        $this->assertFalse($actual);

        $actual = isset($this->_instanceThree['d']);
        $this->assertFalse($actual);


    }
    
    /**
     * 
     * Test -- Returns the value at specified offset.
     * 
     */
    public function testOffsetGet()
    {
        $this->skip("Tested everywhere else");
    }
    
    /**
     * 
     * Test -- Assigns a value to the specified offset.
     * 
     */
    public function testOffsetSet()
    {
        $this->_instanceOne['a'] = 23;
        $actual = $this->_instanceOne['a'];
        $this->assertSame($actual, 23);


        $this->_instanceTwo['d'] = "hanf";
        $actual = $this->_instanceTwo['d'];
        $this->assertSame($actual, "hanf");

        $this->_instanceThree['d'] = "hanf";
        $actual = $this->_instanceTwo['d'];
        $this->assertSame($actual, "hanf");

        
        $doc = Solar::factory('JForg_Couchdb_Document', array(
                        'data' => array(
                            "_id"=> "76ff882fa8720370f632c40e3a032835",
                            "_rev"=> "1-211c37537c043fcb1c4b4936b843966c",
                            "a"=> "asd",
                            "b"=> 16                       
                            ), 
                        'sheme' => array(
                            "a" => "string",
                            "b" => "int",
                            ),
                        ));
        try {
            $doc['a'] = 23;
        } catch (JForg_Couchdb_Document_Exception_InvalidSheme $e){
            $actual = $e;
        }
        $this->assertInstance($actual,
                'JForg_Couchdb_Document_Exception_InvalidSheme');

        $doc = solar::factory('jforg_couchdb_document', array(
                        'data' => array(
                            "_id"=> "76ff882fa8720370f632c40e3a032835",
                            "_rev"=> "1-211c37537c043fcb1c4b4936b843966c",
                            "a"=> "asd",
                            "b"=> 16                       
                            ), 
                        'final' => true,
                        ));
        try{
            $doc['f'] = 23;
        } catch (jforg_couchdb_document_exception_docfinal $e) {
            $actual = $e;
        }

        $this->assertInstance($actual,'JForg_Couchdb_Document_Exception_DocFinal');

    }
    
    /**
     * 
     * Test -- Unsets an offset.
     * 
     */
    public function testOffsetUnset()
    {
        unset($this->_instanceOne['a']);
        $actual = isset($this->_instanceOne['a']);
        $this->assertFalse($actual);
    }
    
    /**
     * 
     * Test -- Rewind the Iterator to the first element
     * 
     */
    public function testRewind()
    {
        $actual = current($this->_instanceOne);
        $this->assertSame($actual, 4);

        next($this->_instanceOne);
        $actual = current($this->_instanceOne);
        $this->assertSame($actual, 16);


        reset($this->_instanceOne);
        $actual = current($this->_instanceOne);
        $this->assertSame($actual, 4);
    }
    
    /**
     * 
     * Test -- 
     * 
     */
    public function testToArray()
    {
        $actual = $this->_instanceTwo->toArray();
        $expected = array(
                "_id"=> "76ff882fa8720370f632c40e3a032835", 
                "_rev"=> "1-211c37537c043fcb1c4b4936b843966c", 
                "a"=> 4, 
                "b"=> 16
                );
        $this->assertSame($actual, $expected);

        $actual = $this->_instanceOne()->toArray();
        $this->assertSame($actual, $expected);
    }
    
    /**
     * 
     * Test -- Checks if current position is valid
     * 
     */
    public function testValid()
    {
        $actual = $this->_instanceOne()->valid();
        $this->assertTrue($actual);

        next($this->_instanceOne);
        next($this->_instanceOne);

        $actual = $this->_instanceOne()->valid();
        $this->assertFalse($actual);
    }
    
    /**
     * 
     * Test -- Magic call implements "get...()" and "set...()" for params listed in the method name.
     * 
     */
    public function test__call()
    {
        $actual = $this->_instanceOne->__call('getA');
        $this->assertSame($actual, 4);
        $actual = $this->_instanceOne->__call('setA', 23)->getA();
        $this->assertSame($actual, 23);
    }
    
    /**
     * 
     * Test -- Get a property value
     * 
     */
    public function test__get()
    {
        $actual = $this->_instanceOne->a;
        $this->assertSame($actual, 4);

        $actual = $this->_instanceOne->foo;
        $this->assertFalse($actual);
    }
    
    /**
     * 
     * Test -- Checks if a document property is set.
     * 
     */
    public function test__isset()
    {
        $actual = isset($this->_instanceOne['a']);
        $this->assertTrue($actual);

        $actual = isset($this->_instanceThree->foo);
        $this->assertFalse($actual);

        $actual = isset($this->_instanceThree['a']);
        $this->assertFalse($actual);

    }
    
    /**
     * 
     * Test -- Set a property value
     * 
     */
    public function test__set()
    {
        $this->_instanceThree->baz = 'asd';
        $actual = $this->_instanceThree->baz;
        $this->assertSame($actual, 'asd');

        $doc = Solar::factory('JForg_Couchdb_Document', array(
                        'data' => array(
                            "_id"=> "76ff882fa8720370f632c40e3a032835",
                            "_rev"=> "1-211c37537c043fcb1c4b4936b843966c",
                            "a"=> "asd",
                            "b"=> 16                       
                            ), 
                        'sheme' => array(
                            "a" => "string",
                            "b" => "int",
                            ),
                        ));
        try {
            $doc['a'] = 23;
        } catch (JForg_Couchdb_Document_Exception_InvalidSheme $e){
            $actual = $e;
        }
        $this->assertInstance($actual,
                'JForg_Couchdb_Document_Exception_InvalidSheme');

    }
    
    /**
     * 
     * Test -- Returns a string representation of the object.
     * 
     */
    public function test__toString()
    {
        $this->skip("same as toArray() with json_decode");
    }
    
    /**
     * 
     * Test -- Checks if a property is unset
     * 
     */
    public function test__unset()
    {
        unset($this->_instanceOne['a']);
        $actual = isset($this->_instanceOne->a);
        $this->assertFalse($actual);
        
    }
    
    /**
     * 
     * Test -- Deletes the document from the database
     * 
     */
    public function testDelete()
    {

        $doc = Solar::factory('JForg_Couchdb_Document', array(
                    'data' => array(
                        "_id"=> "testdoc",
                        "a"=> 4,
                        "b"=> 16                       
                        ), 
                    ));
        $doc->save();
        $doc->delete();

        try {
            Solar::factory('JForg_Couchdb_Document', 'testdoc');
        } catch (JForg_Couchdb_Exception_NoSuchDocument $e)
        {
            $actual = $e;
        }
        $this->assertInstance($actual,'JForg_Couchdb_Exception_NoSuchDocument');

        $doc = Solar::factory('JForg_Couchdb_Document', array(
                    'data' => array(
                        "_id"=> "testdoc",
                        "a"=> 4,
                        "b"=> 16                       
                        ), 
                    ));
        try {
        } catch(JForg_Couchdb_Document_Exception_NotSaved $e)
        {
            $actual = $e;
        }

        $this->assertInstance($actual,
                'JForg_Couchdb_Document_Exception_NotSaved');
        
    }
    
    /**
     * 
     * Test -- Returns the document id.
     * 
     */
    public function testFetchDocumentId()
    {
        $actual = $this->_instanceOne->fetchDocumentId();
        $expect = "76ff882fa8720370f632c40e3a032835";
        $this->assertSame($actual, $expect);

        $actual = is_string($this->_instanceThree->fetchDocumentId());
        $this->assertTrue($actual);
    }
    
    /**
     * 
     * Test -- Returns the document sheme.
     * 
     */
    public function testFetchDocumentSheme()
    {
        $doc = Solar::factory('JForg_Couchdb_Document', array(
                        'data' => array(
                            "_id"=> "76ff882fa8720370f632c40e3a032835",
                            "_rev"=> "1-211c37537c043fcb1c4b4936b843966c",
                            "a"=> "asd",
                            "b"=> 16                       
                            ), 
                        'sheme' => array(
                            "a" => "string",
                            "b" => "int",
                            ),
                        ));

        $expect = array(
                "a" => "string",
                "b" => "int",
                );
        $this->assertSame($actual, $expect);
    }
    
    /**
     * 
     * Test -- Returns all properties with values of a document.
     * 
     */
    public function testFetchProperties()
    {
        $actual = $this->_instanceOne-fetchProperties();
        $expect = array("a" => 4, "b" => 16); 
        $this->assertSame($actual, $expect);

        $actual = $this->_instanceThree-fetchProperties();
        $this->assertSame($actual, array());
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
     * Test -- Returns the names of the special properties of a document
     * 
     */
    public function testFetchSpecialPropertiesNames()
    {
        $this->todo('stub');
    }
    
    /**
     * 
     * Test -- Returns a value of a special property
     * 
     */
    public function testFetchSpecialProperty()
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
     * Test -- Populates the document with data.
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
     * Test -- Sets a special property to the document.
     * 
     */
    public function testSetSpecialProperty()
    {
        $this->todo('stub');
    }

    public function preTest()
    {
        $this->_instanceOne = Solar::factory('JForg_Couchdb_Document', array(
                    'data' => array(
                        "_id"=> "76ff882fa8720370f632c40e3a032835",
                        "_rev"=> "1-211c37537c043fcb1c4b4936b843966c",
                        "a"=> 4,
                        "b"=> 16                       
                        ), 
                    ));
        $this->_instanceTwo = Solar::factory('JForg_Couchdb_Document',
                '76ff882fa8720370f632c40e3a032835');

        $this->_instanceThree = Solar::factory('JForg_Couchdb_Document');
    }
}
