<?php
class MyCartRepository
{
    /**
     * @param MyCart $mycart
     */
    public function __construct(MyCart $mycart)
    {
        $this->mycart = $mycart;
    }
    /**
     * @param $itemId
     */
    public function insertItemId($itemId)
    {

        $mycart = new MyCart;
        $mycart->insert(array('item_id' => $itemId));
    }
    /**
     * @return mixed
     */
    public function dispFromCart()
    {
        return $this->mycart->distinct()->get();
    }

    /**
     * @param $itemId
     * @param $itemName
     * @param $quantity
     * @param $price
     * @param $total
     */
    public function pushItem($itemId, $itemName, $quantity, $price, $total)
    {
        $this->mycart->insert(array('item_id' => $itemId, 'quantity' => $quantity, 'price' => $price, 'name' => $itemName, 'status' => 'unpaid'));
    }
    /**
     * @return mixed
     */
    public function displayAllCartItemsRepo()
    {
        return $this->mycart->get();
    }

}
