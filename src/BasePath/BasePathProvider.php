<?php

declare(strict_types=1);

namespace Oops\WebpackNetteAdapter\BasePath;


interface BasePathProvider
{
	public function getBasePath(): string;
}
