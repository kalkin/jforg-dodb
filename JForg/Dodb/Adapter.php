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

    /**
     * The default document type to use
     * 
     * @var string  Defaults to null. 
     * @since 2010-02-07
     */
    protected $_default_doc = null;

    /**
     * If the adapter should fall back to default_doc if the document type is
     * unrecognized
     * 
     * @var boolean  Defaults to false. 
     * @since 2010-02-07
     */
    protected $_type_safe = false;

    /**
     * Sets the $_type_safe and $_default_doc
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    protected function _postConfig()
    {
        parent::_postConfig();
        $this->_default_doc = $this->_config['default_doc'];
        $this->_type_safe = $this->_config['type_safe'];
    }

    /**
     * TODO: short description.
     * 
     * @return boolean
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public function isTypeSafe()
    {
        return $this->_type_safe;
    }

    /**
     * Fetchs a document by id and returns it as an instance of
     * JForg_Dodb_Document
     * 
     * @param scalar $id The document id
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public abstract function fetch($id);

    /**
     * Fetchs documents by ids and returns an instance of
     * JForg_Dodb_Collection containing instances of JForg_Dodb_Document s
     * 
     * @param array $ids Indexed array containing the documents ids
     * 
     * @return JForg_Dodb_Collection containing all the documents as instances of JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public abstract function fetchCollection(array $ids);

    /**
     * Saves a document
     * 
     * @param JForg_Dodb_Document $doc The document
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public abstract function save(JForg_Dodb_Document $doc);

    /**
     * Saves all documents in a JForg_Dodb_Collection.
     * 
     * @param JForg_Dodb_Collection $collection A collection of documents
     * 
     * @return JForg_Dodb_Collection with all saved documents
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public abstract function saveCollection(JForg_Dodb_Collection $collection);

    /**
     * Reloads a document with up to date data
     * 
     * @param JForg_Dodb_Document $doc The document to reload
     * 
     * @return JForg_Dodb_Document
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public abstract function reload(JForg_Dodb_Document $doc);

    /**
     * Reloads all the documents in a JForg_Dodb_Collection with up to date data.
     * 
     * @param JForg_Dodb_Collection $collection  The collection to reload
     * 
     * @return JForg_Dodb_Collection
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public abstract function reloadCollection(JForg_Dodb_Collection $collection);

    /**
     * Deletes a document from the database
     * 
     * @param JForg_Dodb_Document $doc The document to delete
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public abstract function delete(JForg_Dodb_Document $doc);

    /**
     * Deletes all documents in a JForg_Dodb_Collection
     * 
     * @param JForg_Dodb_Collection $collection The collection of documents to delete
     * 
     * @return void
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public abstract function deleteCollection(JForg_Dodb_Collection $collection);

    /**
     * Returns a database specific string representation of a document
     * 
     * @param JForg_Dodb_Document $doc The document
     * 
     * @return string
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public abstract function documentToString(JForg_Dodb_Document $doc);

    /**
     * Returns one or many uuid. Those can be fetch from the database or just
     * generated in some random way
     * 
     * @param mixed $count Optional, defaults to 1. 
     * 
     * @return array|scalar
     * @author Bahtiar Gadimov <bahtiar@gadimov.de>
     */
    public abstract function getUuid($count = 1);
}
