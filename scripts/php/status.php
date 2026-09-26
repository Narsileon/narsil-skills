<?php

declare(strict_types=1);

/**
 * @param boolean $passed
 * @param string $label
 * @param boolean $toStandardError
 *
 * @return void
 */
function printStatusBadge(bool $passed, string $label, bool $toStandardError = false): void
{
    $badge = $passed ? '  PASS  ' : '  FAIL  ';
    $outputStream = $toStandardError ? STDERR : STDOUT;

    if (stream_isatty($outputStream) && getenv('NO_COLOR') === false && getenv('TERM') !== 'dumb')
    {
        $backgroundColor = $passed ? '42' : '41';
        $badge = sprintf("\033[90;%s;1m%s\033[39;49;22m", $backgroundColor, $badge);
    }

    fwrite($outputStream, sprintf("%s %s\n", $badge, $label));
}
