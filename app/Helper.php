<?php

function dp($data = null, $stop = 0)
{
    echo '<pre>';
    print_r($data);
    if ($stop == 1) {
        exit('</pre>');
    }

}
