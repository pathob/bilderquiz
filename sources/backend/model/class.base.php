<?php

include('zorba_api_wrapper.php');

abstract class Base {
    
    abstract public function asArray();
    
}

abstract class BaseDao {

    protected $_ms;
    protected $_zorba;
    protected $_dm;

    public function __construct() {
        $this->_ms = InMemoryStore::getInstance();
        $this->_zorba = Zorba::getInstance($this->_ms);
        $this->_dm = $this->_zorba->getXmlDataManager();
    }

    public function __destruct() {
        $this->_zorba->shutdown();
        InMemoryStore::shutdown($this->_ms);
    }
}
