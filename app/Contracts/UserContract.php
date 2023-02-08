<?php

namespace App\Contracts;

interface UserContract extends BaseContract
{
	public const TABLE_NAME                    = 'users';

	public const FIELD_ID                      = 'id';
	public const FIELD_FIRST_NAME              = 'first_name';
	public const FIELD_LAST_NAME               = 'last_name';
	public const FIELD_EMAIL                   = 'email';
	public const FIELD_AVATAR                  = 'avatar';
	public const FIELD_PASSWORD                = 'password';
	public const FIELD_REMEMBER_TOKEN          = 'remember_token';
	public const FIELD_LAST_LOGIN_DATE         = 'last_login_date';

	public const LOCAL_NAME         = 'name';

}
