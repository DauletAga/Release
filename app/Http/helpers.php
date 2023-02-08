<?php

if (!function_exists('user'))
{
	function user(): \App\Models\User | \Illuminate\Contracts\Auth\Authenticatable
	{
		return auth()->user();
	}
}