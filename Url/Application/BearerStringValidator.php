<?php

namespace Url\Application;

use Url\Domain\Sign\BracketSign;
use Url\Domain\Sign\KeySign;
use Url\Domain\Sign\SignCollection;
use Url\Domain\Sign\SquareBracketSign;

final class BearerStringValidator
{
    private SignCollection $signs;
    private SignCollection $startSigns;
    private SignCollection $endSigns;

    public function __construct(
        KeySign $keySign,
        BracketSign $bracketSign,
        SquareBracketSign $squareBracketSign
    ) {
        $this->signs = SignCollection::from(
            $keySign,
            $bracketSign,
            $squareBracketSign
        );
    }

    public function validate(string $bearer): bool
    {
        if (empty($bearer)) {
            return false;
        }

        $this->startSigns = SignCollection::from();
        $this->endSigns = SignCollection::from();
        $characters = str_split($bearer);
        foreach ($characters as $character) {
            if (false === $this->validateCharacter($character)) {
                return false;
            }
        }

        return $this->validateSigns($bearer);
    }

    private function validateCharacter(string $character): bool
    {
        $startLastSign = $this->startSigns->lastSign();
        $start = $this->signs->getStartSign($character);
        if ($start && $startLastSign && $start->equal($startLastSign)) {
            return false;
        }

        if ($start) {
            $this->startSigns->add($start);
            return true;
        }

        if (0 === $this->startSigns->count()) {
            return false;
        }

        $end = $this->signs->getEndSign($character);
        if ($end && $startLastSign && $end->equal($startLastSign)) {
            $this->endSigns->add($end);
            return true;
        }

        $lastSign = $this->startSigns->lastSignFrom($this->endSigns->count());
        if ($end && $lastSign && $end->equal($lastSign)) {
            $this->endSigns->add($end);
            return true;
        }

        return true;
    }

    private function validateSigns(string $bearer): bool
    {
        $sumSigns = $this->startSigns->count() + $this->endSigns->count();

        return $sumSigns === strlen($bearer);
    }
}
