<?php

namespace App\Contracts;

interface ReleaseContract extends BaseContract
{
	public const TABLE_NAME = 'releases';

	public const FIELD_ID = 'id';
	public const FIELD_NAME = 'name';
	public const FIELD_TEXT = 'text';
	public const FIELD_DATE = 'date';
	public const FIELD_PROJECT_ID = 'project_id';
	public const FIELD_AUTHOR_ID = 'author_id';
	public const FIELD_IMAGE = 'image';

    public const LIST_TAGS = 'tags';
    public const LIST_USERS = 'users';
}
