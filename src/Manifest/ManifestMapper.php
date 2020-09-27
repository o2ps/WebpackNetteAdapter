<?php

declare(strict_types=1);

namespace Oops\WebpackNetteAdapter\Manifest;

abstract class ManifestMapper
{
	final public function __construct()
	{
	}


	/**
	 * Modifies manifest contents
	 *
	 * @param array<mixed> $manifest
	 * @return array<string, string>
	 */
	abstract public function map(array $manifest): array;
}
