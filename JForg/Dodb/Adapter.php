<?php

/**
 * This is an abstract adapter class. It's should provide an interface for
 * interaction between the JForg_Dodb_Document and the document oriented
 * database.
 * 
 * @package   JForg_Dodb
 * @author    Bahtiar Gadimov <bahtiar@gadimov.de>
 * @copyright (c) 2010 Bahtiar Gadimov
 * @since     2010-01-28
 */
abstract class JForg_Dodb_Adapter extends Solar_Base
{
	/**
     * Default configuration values.
	 * 
     * @config string default_doc The document class to use if the document
     *   type is unrecognized
     *
     * @config bool type_safe If the adapter should fall back to default_doc if
     *   the document type is unrecognized
     *
     * @var array
	 * @since 2010-01-26
	 */
    protected $_JForg_Dodb_Document_Adapter = array(
            'default_doc'   => 'JForg_Dodb_Document',
            'type_safe'     => false,
            );

    public abstract function fetch($doc);

    public abstract function fetchCollection(array $docs);

    public abstract function save(JForg_Dodb_Document $doc);

    public abstract function saveCollection(JForg_Dodb_Document_Collection $collection);

    public abstract function reload(JForg_Dodb_Document $doc);

    public abstract function reloadCollection(JForg_Dodb_Document_Collection $collection);

    public abstract function delete(JForg_Dodb_Document $doc);

    public abstract function deleteCollection(JForg_Dodb_Document_Collection $collection);

    public abstract function documentToArray(JForg_Dodb_Document $doc);

    public abstract function documentToString(JForg_Dodb_Document $doc);
}
