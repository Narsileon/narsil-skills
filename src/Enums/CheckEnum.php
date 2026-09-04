<?php

declare(strict_types=1);

namespace Narsil\Skills\Enums;

enum CheckEnum: string
{
    #region CASES

    /**
     * @var string
     */
    case ENUM_REGIONS = 'check-enum-regions';
    /**
     * @var string
     */
    case METHOD_ORDER = 'check-method-order';
    /**
     * @var string
     */
    case PHPDOC = 'check-phpdoc';
    /**
     * @var string
     */
    case REGION_HIERARCHY = 'check-region-hierarchy';
    /**
     * @var string
     */
    case REGION_ORDER = 'check-region-order';
    /**
     * @var string
     */
    case STYLE = 'check-style';
    /**
     * @var string
     */
    case SYNTAX = 'check-syntax';

    #endregion
}
