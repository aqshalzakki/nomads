<?php

function isActiveUrl($currentRequest)
{
    return request()->is($currentRequest) ? 'active' : '';
}

function imageStoragePath($image = null)
{
	return $image ? Storage::url($image) : Storage::url('profiles/default.jpg');
}

?>