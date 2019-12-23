<?php

function isActiveUrl($currentRequest)
{
    return request()->is($currentRequest) ? 'active' : '';
}

?>