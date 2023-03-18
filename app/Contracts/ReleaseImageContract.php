<?php

namespace App\Contracts;

interface ReleaseImageContract extends BaseContract
{
	public const TABLE_NAME = 'release_images';

	public const FIELD_ID = 'id';
	public const FIELD_RELEASE_ID = 'release_id';
	public const FIELD_IMAGE = 'image';
}
