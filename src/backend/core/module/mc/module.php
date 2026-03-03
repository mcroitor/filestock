<?php

namespace Mc;

class Module
{

	public static function loadAll(string $extensionsDir): void
	{
		if (!is_dir($extensionsDir)) {
			return;
		}

		$moduleDirs = glob($extensionsDir . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);
		if (!is_array($moduleDirs)) {
			return;
		}

		sort($moduleDirs, SORT_STRING);

		$definitions = [];
		foreach ($moduleDirs as $moduleDir) {
			$definition = self::buildDefinition($moduleDir);
			$moduleName = $definition['name'];

			if (isset($definitions[$moduleName])) {
				error_log(sprintf(
					'Module "%s" is duplicated. Path "%s" is ignored.',
					$moduleName,
					$moduleDir
				));
				continue;
			}

			$definitions[$moduleName] = $definition;
		}

		$loaded = [];
		$pending = [];

		foreach ($definitions as $moduleName => $definition) {
			if (!$definition['enabled']) {
				continue;
			}
			$pending[$moduleName] = $definition;
		}

		$hasProgress = true;
		while (!empty($pending) && $hasProgress) {
			$hasProgress = false;

			foreach ($pending as $moduleName => $definition) {
				$dependencyStatus = self::checkDependencies($definition, $definitions, $loaded);

				if (!empty($dependencyStatus['missing'])) {
					error_log(sprintf(
						'Module "%s" skipped: missing dependencies: %s',
						$moduleName,
						implode(', ', $dependencyStatus['missing'])
					));
					unset($pending[$moduleName]);
					$hasProgress = true;
					continue;
				}

				if (!empty($dependencyStatus['disabled'])) {
					error_log(sprintf(
						'Module "%s" skipped: disabled dependencies: %s',
						$moduleName,
						implode(', ', $dependencyStatus['disabled'])
					));
					unset($pending[$moduleName]);
					$hasProgress = true;
					continue;
				}

				if (!empty($dependencyStatus['waiting'])) {
					continue;
				}

				self::loadOne($definition);
				$loaded[$moduleName] = true;
				unset($pending[$moduleName]);
				$hasProgress = true;
			}
		}

		if (!empty($pending)) {
			error_log(sprintf(
				'Module load stopped: unresolved dependency graph for: %s',
				implode(', ', array_keys($pending))
			));
		}
	}

	private static function buildDefinition(string $moduleDir): array
	{
		$manifestPath = $moduleDir . DIRECTORY_SEPARATOR . 'manifest.json';
		$moduleName = basename($moduleDir);
		$bootstrapFileName = 'bootstrap.php';
		$enabled = true;
		$dependencies = [];

		if (is_file($manifestPath)) {
			$manifestRaw = file_get_contents($manifestPath);
			if (is_string($manifestRaw) && $manifestRaw !== '') {
				$manifest = json_decode($manifestRaw, true);
				if (is_array($manifest)) {
					if (!empty($manifest['name']) && is_string($manifest['name'])) {
						$moduleName = trim($manifest['name']);
					}
					if (array_key_exists('enabled', $manifest)) {
						$enabled = (bool) $manifest['enabled'];
					}
					if (!empty($manifest['bootstrap']) && is_string($manifest['bootstrap'])) {
						$bootstrapFileName = trim($manifest['bootstrap']);
					}
					if (!empty($manifest['dependencies']) && is_array($manifest['dependencies'])) {
						$dependencies = self::normalizeDependencies($manifest['dependencies']);
					}
				} else {
					error_log(sprintf('Module manifest parse error in "%s"', $manifestPath));
				}
			}
		}

		if ($moduleName === '') {
			$moduleName = basename($moduleDir);
		}

		if ($bootstrapFileName === '') {
			$bootstrapFileName = 'bootstrap.php';
		}

		return [
			'name' => $moduleName,
			'dir' => $moduleDir,
			'bootstrap' => $bootstrapFileName,
			'enabled' => $enabled,
			'dependencies' => $dependencies
		];
	}

	private static function normalizeDependencies(array $dependencies): array
	{
		$normalized = [];
		foreach ($dependencies as $dependency) {
			if (!is_string($dependency)) {
				continue;
			}

			$dependencyName = trim($dependency);
			if ($dependencyName === '') {
				continue;
			}

			$normalized[$dependencyName] = true;
		}

		return array_keys($normalized);
	}

	private static function checkDependencies(array $definition, array $definitions, array $loaded): array
	{
		$missing = [];
		$disabled = [];
		$waiting = [];

		foreach ($definition['dependencies'] as $dependencyName) {
			if (!isset($definitions[$dependencyName])) {
				$missing[] = $dependencyName;
				continue;
			}

			if (!$definitions[$dependencyName]['enabled']) {
				$disabled[] = $dependencyName;
				continue;
			}

			if (!isset($loaded[$dependencyName])) {
				$waiting[] = $dependencyName;
			}
		}

		return [
			'missing' => $missing,
			'disabled' => $disabled,
			'waiting' => $waiting
		];
	}

	private static function loadOne(array $definition): void
	{
		$moduleDir = $definition['dir'];
		$bootstrapFileName = $definition['bootstrap'];

		$bootstrapPath = $moduleDir . DIRECTORY_SEPARATOR . $bootstrapFileName;
		if (!is_file($bootstrapPath)) {
			error_log(sprintf(
				'Module "%s" skipped: bootstrap file not found: %s',
				$definition['name'],
				$bootstrapPath
			));
			return;
		}

		try {
			include_once $bootstrapPath;
		} catch (\Throwable $error) {
			error_log(sprintf(
				'Module bootstrap error in "%s": %s',
				$bootstrapPath,
				$error->getMessage()
			));
		}
	}
}
