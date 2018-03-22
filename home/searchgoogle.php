<?php
    $url = 'http://www.google.com/search?hl=en&q=';
    $output = file_get_contents($url . urlencode('wibble'));       
    echo $output;