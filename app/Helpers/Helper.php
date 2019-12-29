<?php

function isActiveUrl($currentRequest)
{
    return request()->is($currentRequest) ? 'active' : '';
}

function imageStoragePath($image = null)
{
	return Storage::url($image);
}

?>