<?php

declare(strict_types=1);

namespace Oops\WebpackNetteAdapter\Manifest\Mapper;


use Oops\WebpackNetteAdapter\Manifest\ManifestMapper;

/**
 * Default identity mapper compatible with webpack-manifest-mapper's flat structure.
 */
class WebpackManifestPluginMapper extends ManifestMapper
{
	public function map(array $manifest): array
	{
		return $manifest;
	}
}
