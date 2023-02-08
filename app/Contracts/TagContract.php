<?php

namespace App\Contracts;

interface TagContract extends BaseContract
{
	public const TABLE_NAME = 'tags';

	public const FIELD_ID = 'id';
	public const FIELD_NAME = 'name';

}
