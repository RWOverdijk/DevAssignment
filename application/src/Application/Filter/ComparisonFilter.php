<?php
namespace Application\Filter;

use Application\Comparison\ComparisonInterface;
use Iterator;
use FilterIterator;

class ComparisonFilter extends FilterIterator
{
    /**
     * @var mixed left Left side of the comparison expression
     */
    protected $left;

    /**
     * @var \Application\Comparison\ComparisonInterface Comparison object
     */
    protected $comparison;

    /**
     * @param Iterator            $iterator
     * @param ComparisonInterface $comparison Comparison object
     * @param mixed               $left       Left side of the comparison expression
     */
    public function __construct(Iterator $iterator , ComparisonInterface $comparison, $left)
    {
        parent::__construct($iterator);

        $this->left       = $left;
        $this->comparison = $comparison;
    }

    /**
     * Filter method of FilterIterator
     *
     * @return bool
     */
    public function accept()
    {
        $left  = $this->left;
        $right = $this->getInnerIterator()->current();

        return (bool) $this->comparison->process($left, $right);
    }
}
