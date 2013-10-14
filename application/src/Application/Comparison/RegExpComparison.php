<?php
namespace Application\Comparison;

use Iterator;

/**
 * A class to compare with regexp.
 */
class RegExpComparison implements ComparisonInterface
{
    /**
     * @param string $left  Left side of the comparison expression. It is a regexp.
     * @param string $right Right side of the comparison expression
     *
     * @return bool
     */
    public function process($left, $right)
    {
        return (bool) preg_match($left, $right);
    }
}
