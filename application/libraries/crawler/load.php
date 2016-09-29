<?php
$files = array(
    'simple_html_dom.php',
    'helper.php'
);

foreach($files as $file){
    include_once __DIR__ . DS . $file;
}