<?php

declare(strict_types=1);

namespace Oops\WebpackNetteAdapter\AssetNameResolver;


final class IdentityAssetNameResolver implements AssetNameResolverInterface
{
	public function resolveAssetName(string $asset): string
	{
		return $asset;
	}
}
