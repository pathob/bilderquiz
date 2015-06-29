<?php

require_once('zorba_api_wrapper.php');

public abstract class Base {

    protected $_ms;
    protected $_zorba;
    protected $_dm;

    public function __construct($database_name = '') {
        $this->_ms = InMemoryStore::getInstance();
        $this->_zorba = Zorba::getInstance($this->_ms);
        $this->_dm = $this->_zorba->getXmlDataManager();

        if ($database_name != '') {
            $this->_dm->loadDocument($database_name, file_get_contents($database_name));
        }
    }

    public function __destruct() {
        $this->_zorba->shutdown();
        InMemoryStore::shutdown($this->_ms);
    }
}
