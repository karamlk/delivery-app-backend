<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderItemResource;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function show($itemId)
    {
        $orderItem = OrderItem::with('product')
            ->where('id', $itemId)->first();

        if (!$orderItem) {
            return response()->json(['message' => 'item not found or not owned by the user'], 404);
        }

        return new OrderItemResource($orderItem);
    }

    public function update($itemId, Request $request)
    {
        $orderItem = OrderItem::with('product')->where('id', $itemId)
            ->first();

        $order = $orderItem->order;

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if (!$orderItem) {
            return response()->json(['message' => 'Order item not found'], 404);
        }

        $newQuantity = $request->input('quantity');
        $product = $orderItem->product;

        if ($newQuantity > $product->stock + $orderItem->quantity) {
            return response()->json(['message' => 'Not enough stock'], 400);
        }

        $quantityDiff = $newQuantity - $orderItem->quantity;

        $orderItem->update([
            'quantity' => $newQuantity,
            'price' => $product->price,
        ]);

        $order->total = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $order->save();

        if ($quantityDiff < 0) {
            $product->increment('stock', abs($quantityDiff));
        } else {
            $product->decrement('stock', $quantityDiff);
        }
        return new OrderItemResource($orderItem);
    }

    public function destroy($itemId)
    {
        $orderItem = OrderItem::where('id', $itemId)
            ->first();

        $order = $orderItem->order;

        if (!$orderItem) {
            return response()->json(['message' => 'Order item not found'], 404);
        }

        $orderItem->delete();

        $order->total = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $order->save();

        $product = $orderItem->product;
        $product->increment('stock', $orderItem->quantity);

        return response()->json(
            [
                'message' => 'the item got deleted successfully'
            ]
        );
    }
}
