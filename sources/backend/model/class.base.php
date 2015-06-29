<?php

include('zorba_api_wrapper.php');

class Base {

    protected $_ms;
    protected $_zorba;
    protected $_dm;

    public function __construct($database_name = '') {
        $this->_ms = InMemoryStore::getInstance();
        $this->_zorba = Zorba::getInstance($this->_ms);
        $this->_dm = $this->_zorba->getXmlDataManager();
        echo "base __construct";

        if ($database_name != '' && file_exists($database_name)) {
            echo "loadDocument";
            $this->_dm->parseXml(elpath(database_name));
        }
    }

    public function __destruct() {
        $this->_zorba->shutdown();
        InMemoryStore::shutdown($this->_ms);
    }
}
