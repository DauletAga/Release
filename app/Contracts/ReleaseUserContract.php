<?php

namespace App\Contracts;

interface ReleaseUserContract extends BaseContract
{
	public const TABLE_NAME = 'release_user';

	public const FIELD_ID = 'id';
	public const FIELD_RELEASE_ID = 'release_id';
	public const FIELD_USER_ID = 'user_id';

}
