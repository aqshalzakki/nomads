<?php

function isActiveUrl($currentRequest)
{
    return request()->is($currentRequest) ? 'active' : '';
}

function imageStoragePath($image)
{
	return Storage::url($image);
}

?>