<?php

namespace TaskLoan\ModelFilters;

use EloquentFilter\ModelFilter;

class TaskFilter extends ModelFilter
{
    public function setup()
    {
        $this->unfulfilled();
    }

    public function category($category)
    {
        return $this->where('category', $category);
    }
}
