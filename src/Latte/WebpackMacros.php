<?php

declare(strict_types=1);

namespace Oops\WebpackNetteAdapter\Latte;


use Latte\Compiler;
use Latte\MacroNode;
use Latte\Macros\MacroSet;
use Latte\PhpWriter;

/**
 * - {webpack 'asset.name.js'}
 */
final class WebpackMacros extends MacroSet
{
	public static function install(Compiler $compiler): void
	{
		$me = new self($compiler);
		$me->addMacro('webpack', [$me, 'macroWebpackAsset']);
	}


	public function macroWebpackAsset(MacroNode $node, PhpWriter $writer): string
	{
		return $writer->write('echo %escape(%modify($this->global->webpackAssetLocator->locateInPublicPath(%node.word)))');
	}
}
