<?php

namespace Bitrock;
use Bitrock\Models\Singleton;
use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

class LetsEnv extends Singleton
{
    /** @var array $envArray */
    private $envArray = [];

    public function parseConfiguration(string $envPath, bool $force = false): bool
    {
        if (empty($envPath)) return false;

        if (empty($this->envArray) || $force) {
            $config = Dotenv::createImmutable($envPath);

            try {
                $config->load();
            } catch (InvalidPathException $e) {
                die($e->getMessage());
            }

            $this->envArray = $_ENV;
        }

        return true;
    }

    public function getEnv(string $value)
    {
        if (empty($value)) return false;

        return $this->envArray[$value];
    }
}