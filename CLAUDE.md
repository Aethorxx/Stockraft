# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

**Stockraft** is a PHP project, configured with PhpStorm. The codebase is in early development — update this file as architecture and tooling are established.

## PHP Toolchain

The following static analysis and style tools are preconfigured in the PhpStorm project (`.idea/php.xml`). Once installed via Composer, the expected commands are:

- **PHP CS Fixer** — `vendor/bin/php-cs-fixer fix`
- **PHP CodeSniffer** — `vendor/bin/phpcs`
- **PHPStan** — `vendor/bin/phpstan analyse`
- **Psalm** — `vendor/bin/psalm`
- **Mess Detector** — `vendor/bin/phpmd`

Add the actual project-specific configs (e.g. `phpstan.neon`, `.php-cs-fixer.php`, `psalm.xml`) and update this file with the correct commands and levels once they exist.
