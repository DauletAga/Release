<?php

namespace App\Contracts;

interface ReleaseTagContract extends BaseContract
{
	public const TABLE_NAME = 'release_tag';

	public const FIELD_ID = 'id';
	public const FIELD_RELEASE_ID = 'release_id';
	public const FIELD_TAG_ID = 'tag_id';

}
