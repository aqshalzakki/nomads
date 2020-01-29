<?php
function imageStoragePath($image = null)
{
	return Storage::url($image);
}

function dateFormat($date, string $format = 'n F Y')
{
	return Carbon\Carbon::create($date)->format($format);
}

?>