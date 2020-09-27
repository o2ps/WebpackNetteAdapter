<?php

declare(strict_types=1);

namespace Oops\WebpackNetteAdapter\AssetNameResolver;


interface AssetNameResolverInterface
{
	public function resolveAssetName(string $asset): string;
}
