<?php

namespace App\Helper;

class Link
{
	public static function isActive(string $uri): bool
	{
		$string = explode("|", $uri);
		return in_array(request()->route()->getName(), $string);
	}
}
