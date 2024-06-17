<?php

namespace Url\Domain\Sign;

final class SignCollection implements \Countable
{
    /**
     * @var Sign[]
     */
    private array $signs = [];

    /**
     * @var array<string, string>
     */
    private array $startSigns = [];

    /**
     * @var array<string, string>
     */
    private array $endSigns = [];

    private function __construct(Sign ...$signs)
    {
        $this->add(...$signs);
    }

    public static function from(Sign ...$signs): self
    {
        return new self(...$signs);
    }

    public function add(Sign ...$signs): void
    {
        foreach ($signs as $sign) {
            $this->signs[] = $sign;
        }
    }

    public function lastSign(): ?Sign
    {
        $count = $this->count();
        if (0 === $count) {
            return null;
        }

        $lastPosition = ($count - 1);

        return array_key_exists($lastPosition, $this->signs) ? $this->signs[$lastPosition] : null;
    }

    public function lastSignFrom(int $position): ?Sign
    {
        $count = $this->count();
        if (0 === $count) {
            return null;
        }

        $lastPosition = ($count - 1) - $position;

        return array_key_exists($lastPosition, $this->signs) ? $this->signs[$lastPosition] : null;
    }

    public function getStartSign(string $sign): ?Sign
    {
        $startSigns = $this->getStartSigns();

        return $startSigns[$sign] ?? null;
    }

    public function getEndSign(string $sign): ?Sign
    {
        $endSigns = $this->getEndSigns();

        return $endSigns[$sign] ?? null;
    }

    private function getStartSigns(): array
    {
        if (count($this->startSigns)) {
            return $this->startSigns;
        }

        $this->startSigns = [];
        foreach ($this->signs as $sign) {
            $this->startSigns[$sign->start()] = $sign;
        }

        return $this->startSigns;
    }

    private function getEndSigns(): array
    {
        if (count($this->endSigns)) {
            return $this->endSigns;
        }

        $this->endSigns = [];
        foreach ($this->signs as $sign) {
            $this->endSigns[$sign->end()] = $sign;
        }

        return $this->endSigns;
    }

    public function count(): int
    {
        return count($this->signs);
    }
}
