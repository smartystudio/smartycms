<?php

namespace SmartyStudio\SmartyCms\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
	protected $fillable = [
		'name', 'email', 'password',
	];

	protected $hidden = [
		'password',
	];
}
