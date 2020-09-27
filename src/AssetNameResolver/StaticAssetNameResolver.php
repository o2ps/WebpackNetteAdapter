<?php

declare(strict_types=1);

namespace Oops\WebpackNetteAdapter\AssetNameResolver;


final class StaticAssetNameResolver implements AssetNameResolverInterface
{

	/** @var array<string, string> */
	private $resolutions;


	/**
	 * @param array<string, string> $resolutions
	 */
	public function __construct(array $resolutions)
	{
		$this->resolutions = $resolutions;
	}


	public function resolveAssetName(string $asset): string
	{
		if (isset($this->resolutions[$asset]) === false) {
			throw new CannotResolveAssetNameException(\sprintf(
				"Asset '%s' was not found in the resolutions array",
				$asset
			));
		}

		return $this->resolutions[$asset];
	}
}
