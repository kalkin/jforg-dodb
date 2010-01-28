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
            'host' => 'st010.kalkin.de',
            'dbname' => 'testdb',
            'port' => '5900',
            'encrypted' => false,
            'http_request' => array('adapter' => 'Solar_Http_Request_Adapter_Curl'),
            );

    /**
     * doc to delete
     * 
     * @var double  Defaults to null. 
     * @since 2010-01-27
     */
    protected $_delete_doc = null;

    /**
     * The Couchdb instance
     * 
     * @var JForg_Couchdb  Defaults to null. 
     * @since 2010-01-27
     */
    protected $_couchdb = null;

    /**
     * Some post construct stuff
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _postConstruct()
    {
        if ( !extension_loaded('json') )
            throw $this->_exception('ERR_EXTENSION_NOT_LOADDE',
                    array('extension' => 'json')
                    );

        $this->_couchdb = Solar::factory('JForg_Couchdb', $this->_couchdbConfig);

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
        $this->assertInstance($actual, 'JForg_Couchdb');
    }
    
    /**
     * 
     * Test -- Test save with couchdb generated id. The save function uses the
     * HTTP method POST to save the document
     * @return void
     */
    public function testSave()
    {
        $data = array ( 'foo' => 'bar', 'buz' => array('asd', 'asdf'));
        $response = $this->_couchdb->save($data);
        
        Solar::dump($response);
        print("\n");
        $this->_delete_doc = $response;
        return $this->assertTrue($response['ok']);
    }


    /**
     * Test save with preset id. The save function uses the HTTP method PUT to
     * save the document
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function testSavePut()
    {
        $data = array ('_id' => rand(10000, 999999), 'foo' => 'bar', 'buz' => array('asd', 'asdf'));

        $response = $this->_couchdb->save($data);
        
        Solar::dump($response);
        print("\n");
        $this->_delete_doc = $response;
        return $this->assertTrue($response['ok']);
    }

    /**
     * 
     * Test -- Deletes a document from the database
     * 
     */
    public function testDelete()
    {
        if ( $this->_delete_doc == null )
            $this->testSave();
        $actual = $this->_couchdb->delete($this->_delete_doc['id'], $this->_delete_doc['rev']);
        print_r($actual);
        return $this->assertTrue($actual['ok']);
    }
    
    /**
     * 
     * Test -- for find() with one id given as string
     * 
     */
    public function testFind()
    {
        $expect = unserialize('a:4:{s:3:"_id";s:32:"7983535144c8661447699257296f0939";s:4:"_rev";s:34:"1-f04460a8ae0ee47c2d1a3670f7fd7a2b";s:3:"foo";s:3:"bar";s:3:"buz";a:3:{i:0;s:3:"bar";i:1;s:3:"foo";i:2;s:4:"asdd";}}');


        $actual = $this->_couchdb->find('7983535144c8661447699257296f0939');
        Solar::dump($actual);

        return $this->assertSame($actual, $expect);

    }

    /**
    
    /**
     * 
     * Test -- Returns the httpRequest object
     * 
     */
    public function testGetHttpRequest()
    {
        $actual = $this->_couchdb->getHttpRequest();
        $this->assertInstance($actual, 'Solar_Http_Request_Adapter');
    }
    
    /**
     * 
     * Test -- TODO: short description.
     * 
     */
    public function testGetUri()
    {
        $actual = $this->_couchdb->getUri();
        $this->assertInstance($actual, 'Solar_Uri');
    }
    
    /**
     * 
     * Test -- Returns one uuid
     * 
     */
    public function testGetUuid()
    {
        $actual = $this->_couchdb->getUuid();
        Solar::dump($actual);
        return $this->assertStringLength($actual['uuids'][0], 32);
    }
    
    /**
     * TODO: short description.
     * 
     * @return TODO
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function testGetUuids()
    {
        $size = rand(2, 23);
        $actual = $this->_couchdb->getUuid($size);
        Solar::dump($actual);
        $this->assertArrayLenght($actual['uuids'], $size);
        return $this->assertStringLength($actual['uuids'][0], 32);
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

    public function assertStringLength($actual, $expected)
    {
        $this->_assert_count ++;

        if ( !is_string($actual) )
            $this->fail('Expected string, actualy '.gettype($actual));
        elseif( strlen($actual) !== $expected )
            $this->fail('Expected a string with a '.$expected.' characters, but got '.strlen($actual));

        return true;
    }

    /**
     * Counts elements of an array and test if it has a specified length
     * 
     * @param array $actual   
     * @param int $expected 
     * 
     * @return bool
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function assertArrayLenght(array $actual, $expected)
    {
        if ( count($actual) !== $expected )
            $this->fail('Wrong array size');

    }
    
}
