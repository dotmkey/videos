<?php
declare(strict_types=1);

namespace app\src\domain\model\common;

use LogicException;

class PaginatedResult
{
    private array $elements = [];
    private int $total;

    public function __construct(array $elements, int $total)
    {
        $this->setElements($elements);
        $this->setTotal($total);
    }

    public function getElements(): array
    {
        return $this->elements;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    private function setElements(array $elements): void
    {
        $this->elements = $elements;
    }

    private function setTotal(int $total): void
    {
        if ($total < 0) {
            throw new LogicException("Total count can't be less than 0");
        }

        $this->total = $total;
    }
}