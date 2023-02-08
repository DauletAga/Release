<?php

namespace App\Contracts;

interface ProjectContract extends BaseContract
{
	public const TABLE_NAME = 'projects';

	public const FIELD_ID = 'id';
	public const FIELD_NAME = 'name';
	public const FIELD_IMAGE = 'image';
	public const FIELD_UPDATE_COUNT = 'update_count';
	public const FIELD_VERSION_COUNT = 'version_count';

}
