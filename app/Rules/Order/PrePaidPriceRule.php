<?php

namespace App\Rules\Order;

use App\Models\Order;
use Illuminate\Contracts\Validation\Rule;

class PrePaidPriceRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($orderId)
    {
        $this->order = Order::with('dresses')->findOrFail($orderId);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $total_after_VAT = $this->order->dresses()->where('status',1)->sum('grandTotal');
        $total_after_discount = $total_after_VAT - ($total_after_VAT * $this->order?->discount);
        return $value <= $total_after_discount && $value >= $total_after_discount /2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('exceptions.prePaidPriceInvalid');
    }
}
