<?php

declare(strict_types=1);

namespace Narsil\Skills\Enums;

enum RegionEnum: string
{
    #region CASES

    /**
     * @var string
     */
    case CASES = 'CASES';
    /**
     * @var string
     */
    case CONSTRUCTOR = 'CONSTRUCTOR';
    /**
     * @var string
     */
    case CONSTANTS = 'CONSTANTS';
    /**
     * @var string
     */
    case PRIVATE_METHODS = 'PRIVATE METHODS';
    /**
     * @var string
     */
    case PROPERTIES = 'PROPERTIES';
    /**
     * @var string
     */
    case PROTECTED_METHODS = 'PROTECTED METHODS';
    /**
     * @var string
     */
    case PUBLIC_METHODS = 'PUBLIC METHODS';
    /**
     * @var string
     */
    case RELATIONSHIPS = 'RELATIONSHIPS';
    /**
     * @var string
     */
    case USE = 'USE';

    #endregion

    #region PUBLIC METHODS

    /**
     * @return boolean
     */
    public function isMember(): bool
    {
        return match ($this)
        {
            self::CONSTRUCTOR,
            self::CONSTANTS,
            self::PROPERTIES,
            self::PUBLIC_METHODS,
            self::PROTECTED_METHODS,
            self::PRIVATE_METHODS => true,
            default => false,
        };
    }

    /**
     * @return boolean
     */
    public function isMethod(): bool
    {
        return match ($this)
        {
            self::PUBLIC_METHODS,
            self::PROTECTED_METHODS,
            self::PRIVATE_METHODS => true,
            default => false,
        };
    }

    /**
     * @return string
     */
    public function pattern(): string
    {
        return preg_quote($this->value, '/');
    }

    /**
     * @return integer
     */
    public function sortOrder(): int
    {
        return match ($this)
        {
            self::USE => 10,
            self::CASES => 20,
            self::CONSTRUCTOR => 30,
            self::CONSTANTS => 40,
            self::PROPERTIES => 50,
            self::RELATIONSHIPS => 60,
            self::PUBLIC_METHODS => 70,
            self::PROTECTED_METHODS => 80,
            self::PRIVATE_METHODS => 90,
        };
    }

    /**
     * @return string[]
     */
    public static function memberValues(): array
    {
        return array_map(static function (self $region): string
        {
            return $region->value;
        }, array_filter(self::cases(), static function (self $region): bool
        {
            return $region->isMember();
        }));
    }

    /**
     * @return string
     */
    public static function memberPattern(): string
    {
        return implode('|', array_map(static function (self $region): string
        {
            return $region->pattern();
        }, array_filter(self::cases(), static function (self $region): bool
        {
            return $region->isMember();
        })));
    }

    #endregion
}
