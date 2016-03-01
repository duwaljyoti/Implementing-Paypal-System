<?php
class ItemRepository
{
    /**
     * @param Items $items
     */
    public function __construct(Items $items)
    {
        $this->item = $items;
    }

    /**
     * @return mixed
     */
    public function getAllItems()
    {
        return $allItems = Items::get();
        dd($allItems->toArray());
    }
}
