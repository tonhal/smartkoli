<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ShoppingController extends Controller
{
    public function getShoppingItems() {

        $shopping_items = Item::all()->toJson();

        return $shopping_items;

    }

    public function addNewShoppingItems(Request $request) {

        $new_item = new Item;
        $new_item->name = $request->name;
        $new_item->user_id = auth()->id();
        $new_item->save();

        $context = array(
            "new_item_id" => $new_item->id,
            "user_id" => $new_item->user_id,
        );

        return response($context, 200);

    }

    public function changeShoppingItem(Request $request, $item_id) {

        $changed_item = Item::find($item_id);
        $changed_item->is_purchased = !$changed_item->is_purchased;
        $changed_item->save();

        return response(200);
    }
}
