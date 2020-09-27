<?php

declare(strict_types=1);

namespace Oops\WebpackNetteAdapter\Debugging;


use Oops\WebpackNetteAdapter\AssetNameResolver\DebuggerAwareAssetNameResolver;
use Oops\WebpackNetteAdapter\DevServer;
use Oops\WebpackNetteAdapter\PublicPathProvider;
use Tracy\IBarPanel;

final class WebpackPanel implements IBarPanel
{

	/** @var PublicPathProvider */
	private $pathProvider;

	/** @var DebuggerAwareAssetNameResolver */
	private $assetResolver;

	/** @var DevServer */
	private $devServer;


	public function __construct(PublicPathProvider $pathProvider, DebuggerAwareAssetNameResolver $assetResolver, DevServer $devServer)
	{
		$this->pathProvider = $pathProvider;
		$this->assetResolver = $assetResolver;
		$this->devServer = $devServer;
	}


	public function getTab(): ?string
	{
		\ob_start(function () {});
		$devServer = $this->devServer;
		$assets = $this->assetResolver->getResolvedAssets();
		require __DIR__ . '/templates/WebpackPanel.tab.phtml';

		return (string) \ob_get_clean();
	}


	public function getPanel(): ?string
	{
		\ob_start(function () {});
		$devServer = $this->devServer;
		$path = $this->pathProvider->getPublicPath();
		$assets = $this->assetResolver->getResolvedAssets();
		require __DIR__ . '/templates/WebpackPanel.panel.phtml';

		return (string) \ob_get_clean();
	}
}
