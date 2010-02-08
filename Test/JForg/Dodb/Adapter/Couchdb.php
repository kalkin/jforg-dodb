<?php
/**
 * 
 * Concrete adapter class test.
 * 
 */
class Test_JForg_Dodb_Adapter_Couchdb extends Test_JForg_Dodb_Adapter {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_JForg_Dodb_Adapter_Couchdb = array(
    );

    /**
     * TODO: short description.
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function testGetUri()
    {
        $actual = $this->_adapter->getUri();
        $this->assertInstance($actual, 'Solar_Uri');
    }
    
    /**
     * TODO: short description.
     * 
     * @return TODO
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function testGetHttpRequest()
    {
        $actual = $this->_adapter->getHttpRequest();
        $this->assertInstance($actual, 'Solar_Http_Request_Adapter');
    }

    /**
     * TODO: short description.
     * 
     * @return TODO
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    //public function testQuery()
    //{
        //$uri         = $this->_adapter->getUri();
        //$httpRequest = $this->_adapter->getHttpRequest();

        //$data = '{"_id":"231409", "_rev":"4-92f399bb67e63c1306ff6b53784ffb55", "foo":"asd"}'."\n";

        //$uri->path[] = '231409';
        ////$result = $this->_adapter->query($uri, $httpRequest);
        //Solar::dump($uri->get(true));
        //$httpRequest->setContent($data);
        //$httpRequest->setContentType('application/x-www-form-urlencoded');
        //$httpRequest->setHeader('Transfer-Encoding', false);
        //$httpRequest->setUri($uri->get(true));
        //$httpRequest->setMethod('PUT');
        //$result = $httpRequest->fetch()->content;
        //Solar::dump($result);
        ////$this->assertInstance($result, 'JForg_Dodb_Document');

    //}

}
