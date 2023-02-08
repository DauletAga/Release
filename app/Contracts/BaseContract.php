<?php

namespace App\Contracts;

interface BaseContract
{
	public const FIELD_CREATED_AT = 'created_at';
	public const FIELD_UPDATED_AT = 'updated_at';
	public const FIELD_DELETED_AT = 'deleted_at';

	public const FIELD_ACTIVE     = 1;
	public const FIELD_INACTIVE   = 0;
}