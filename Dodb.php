<?php
/**
 * Factory class for document oriented database connections
 * 
 * @package JForg_Dodb
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-01-26
 */
class JForg_Dodb extends Solar_Factory
{
    /**
     * 
     * Default configuration values.
     * 
     * @config string adapter The class to factory, for example
     * 'JForg_Dodb_Adapter_Couchdb'.
     * 
     * @var array
     * 
     */
	protected $_JForg_Dodb = array(
	   'adapter' => 'JForg_Dodb_Adapter_Printr'
	);

}
