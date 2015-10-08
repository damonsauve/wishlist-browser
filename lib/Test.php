<?php

class Test
{
    public $_params = NULL;

    function __construct($params)
    {
        print_r($params);

        $this->_params = $params;

    }

    public function methodHandler()
    {
        print_r($this->_params);
    }
}

?>
