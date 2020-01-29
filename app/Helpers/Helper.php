<?php
function imageStoragePath($image = null)
{
	return Storage::url($image);
}

function dateFormat($date, string $format = 'n F Y')
{
	return Carbon\Carbon::create($date)->format($format);
}

function rememberUserCache()
{
	return cache()->remember('user', now()->addMonths(1), function(){
			return auth()->user() ? auth()->user()->load([
            	'transactions', 
            	'transaction_details', 
            	'role',
            	'profile',
            ]) : null;	
        });
}

function putUserCache($user)
{
	cache()->put('user', $user->load([
		'transactions', 
		'transaction_details', 
		'role',
		'profile',
	]), now()->addMonths(1));
}
?>