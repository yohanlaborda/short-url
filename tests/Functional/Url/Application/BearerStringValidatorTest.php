<?php

namespace Tests\Url\Application;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Url\Application\BearerStringValidator;
use Url\Domain\Sign\BracketSign;
use Url\Domain\Sign\KeySign;
use Url\Domain\Sign\SquareBracketSign;

#[CoversClass(BearerStringValidator::class)]
final class BearerStringValidatorTest extends TestCase
{
    private BearerStringValidator $bearerStringValidator;

    protected function setUp(): void
    {
        $this->bearerStringValidator = new BearerStringValidator(
            new KeySign(),
            new BracketSign(),
            new SquareBracketSign()
        );
    }

    #[DataProvider('stringProvider')]
    public function testValidate(string $bearer, bool $result): void
    {
        self::assertSame(
            $result,
            $this->bearerStringValidator->validate($bearer)
        );
    }

    public static function stringProvider(): array
    {
        return [
            ['{}', true],
            ['{}[]()', true],
            ['{)', false],
            ['[{]}', false],
            ['{([])}', true],
            ['(((((((()', false],
        ];
    }
}
