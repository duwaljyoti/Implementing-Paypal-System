<?php
class ItemController extends BaseController
{
    /**
     * @param ItemRepository $items
     * @param MyCartRepository $mycart
     */
    public function __construct(ItemRepository $items, MyCartRepository $mycart)
    {
        $this->item = $items;
        $this->mycart = $mycart;
    }
    public function home()
    {
        $allItems = $this->item->getAllItems();
        // dd($allItems->toArray());
        return View::make('payPal/index', ['allItems' => $allItems]);
        // return View::make('payPal/duphome');
    }
    public function addToCartCon()
    {
        $itemId = Input::get('id');
        // dd($itemId);
        $itemName = Input::get('name');
        // dd($itemName);
        $quantity = Input::get('quantity');
        $price = Input::get('price');
        $total = $quantity * $price;
        $this->mycart->pushItem($itemId, $itemName, $quantity, $price, $total);
        return Redirect::Back();
        // $this->mycart->insertItem($itemId);
        // $myCartItems=$this->mycart->dispFromCart();
        // return View::make('payPal/mycart',['myCartItems'=>$myCartItems]);
    }
    public function mycart()
    {
        $items = $this->mycart->displayAllCartItemsRepo();
        return View::make('payPal/mycart', ['items' => $items]);
    }

}
