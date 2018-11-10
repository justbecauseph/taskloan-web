<?php

namespace TaskLoan\ModelFilters;

use EloquentFilter\ModelFilter;

class TaskFilter extends ModelFilter
{
    public function setup()
    {
        $this->unfulfilled();

        $this->with($this->input('with', []));
    }

    public function category($category)
    {
        return $this->where('category', $category);
    }

    public function claimedBy($id)
    {
        return $this->where('claimed_by_user_id', $id);
    }

    public function amount($amount)
    {
        return $this->where('amount', $amount);
    }
}
