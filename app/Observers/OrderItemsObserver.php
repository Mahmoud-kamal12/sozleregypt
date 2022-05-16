<?php

namespace App\Observers;

use App\OrderItems;

class OrderItemsObserver
{

    /**
     * Handle the order items "created" event.
     *
     * @param  \App\OrderItems  $orderItems
     * @return void
     */
    public function created(OrderItems $orderItems)
    {
        $orderItems->amount_cents = $orderItems->book->price_le_after_discount * 100 * $orderItems->quantity;
        $orderItems->name = $orderItems->book->name;
        $orderItems->update();
    }

    /**
     * Handle the order items "updated" event.
     *
     * @param  \App\OrderItems  $orderItems
     * @return void
     */
    public function updated(OrderItems $orderItems)
    {
        //
    }

    /**
     * Handle the order items "deleted" event.
     *
     * @param  \App\OrderItems  $orderItems
     * @return void
     */
    public function deleted(OrderItems $orderItems)
    {
        //
    }

    /**
     * Handle the order items "restored" event.
     *
     * @param  \App\OrderItems  $orderItems
     * @return void
     */
    public function restored(OrderItems $orderItems)
    {
        //
    }

    /**
     * Handle the order items "force deleted" event.
     *
     * @param  \App\OrderItems  $orderItems
     * @return void
     */
    public function forceDeleted(OrderItems $orderItems)
    {
        //
    }
}
