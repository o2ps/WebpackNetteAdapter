<?php

declare(strict_types=1);

namespace Oops\WebpackNetteAdapter;


use Oops\WebpackNetteAdapter\AssetNameResolver\AssetNameResolverInterface;

class AssetLocator
{

	/** @var BuildDirectoryProvider */
	private $directoryProvider;

	/** @var PublicPathProvider */
	private $publicPathProvider;

	/** @var AssetNameResolverInterface */
	private $assetResolver;

	/** @var DevServer */
	private $devServer;

	/** @var string[] */
	private $ignoredAssetNames;


	/**
	 * @param string[] $ignoredAssetNames
	 */
	public function __construct(BuildDirectoryProvider $directoryProvider, PublicPathProvider $publicPathProvider, AssetNameResolverInterface $assetResolver, DevServer $devServer, array $ignoredAssetNames)
	{
		$this->directoryProvider = $directoryProvider;
		$this->publicPathProvider = $publicPathProvider;
		$this->assetResolver = $assetResolver;
		$this->devServer = $devServer;
		$this->ignoredAssetNames = $ignoredAssetNames;
	}


	public function locateInPublicPath(string $asset): string
	{
		if ($this->devServer->isAvailable() && \in_array($asset, $this->ignoredAssetNames, true)) {
			return 'data:,';
		}

		return \rtrim($this->publicPathProvider->getPublicPath(), '/') . '/' . \ltrim($this->assetResolver->resolveAssetName($asset), '/');
	}


	public function locateInBuildDirectory(string $asset): string
	{
		if ($this->devServer->isAvailable() && \in_array($asset, $this->ignoredAssetNames, true)) {
			return 'data:,';
		}

		return \rtrim($this->directoryProvider->getBuildDirectory(), '/') . '/' . \ltrim($this->assetResolver->resolveAssetName($asset), '/');
	}
}
