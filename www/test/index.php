<?php

$basedir = dirname(__FILE__) . '/../../lib/';
require $basedir . 'Test.php';

$args = array(
    'page'      => 1,
    'limit'     => 3,
    'order'     => 'name',
    'dir'       => 'asc',
    'format'    => ''  // can be '', 'array, 'json', 'xml'
);

$test = new Test($args);
$test->methodHandler();

?>
