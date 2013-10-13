<?php
namespace Application\Filter;

use Application\Comparison\ComparisonInterface;
use Iterator;

class AssociativeArrayFilter extends \FilterIterator
{
    /**
     * @var string key Key of the associative array
     */
    protected $key;

    /**
     * @var mixed left  Left side of the comparison expression
     */
    protected $left;
    /**
     * @var \Application\Comparison\ComparisonInterface Comparison object
     */
    protected $comparison;

    /**
     * @param Iterator $iterator
     * @param string $key key of the associative array
     * @param ComparisonInterface $comparison
     * @param mixed $left Left side of the comparison expression
     */
    public function __construct(Iterator $iterator , $key, ComparisonInterface $comparison, $left)
    {
        parent::__construct($iterator);
        $this->key = $key;
        $this->left = $left;
        $this->comparison = $comparison;

    }

    /**
     * Filter method of FilterIterator
     *
     * @return bool
     * @throws \RuntimeException
     */
    public function accept()
    {
        $array = $this->getInnerIterator()->current();
        $key = $this->key;

        if (!isset($array[$key])) {
            throw new \RuntimeException(sprintf('%s key does not exist', $key));
        }

        $left = $this->left;
        $right = $array[$key];
        if ($this->comparison->process($left, $right)) {
            return true;
        }

        return false;
    }
}