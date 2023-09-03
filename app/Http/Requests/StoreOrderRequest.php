<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Scopes\TenantScope;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'table_id' => ['required', 'exists:tables,id'],
//            'customer_id' => ['nullable', 'exists:customers,id'],
//            'preparation_time' => ['nullable', 'integer'],
            'deliver_method' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
            'sub_total' => ['required', 'numeric'],
            'discount' => ['nullable', 'integer'],
            'tax' => ['nullable', 'integer'],
            'shipping' => ['nullable', 'numeric'],
            'grand_total' => ['nullable', 'numeric'],
            'menu_items' => ['required', 'array'],
            'menu_items.*.menu_item_id' => ['required', 'exists:menu_items,id'],
            'menu_items.*.qty' => ['required', 'integer'],
        ];
    }

    public function hasNotExceededOrderLimit($tenant): bool
    {
        $total_orders = Order::count();
        $tenant = Restaurant::withoutGlobalScope(TenantScope::class )
            ->with('plan')
            ->findOrFail($tenant);
        if($total_orders < $tenant->plan->orders) {
            return true;
        }
        return false;
    }
}
