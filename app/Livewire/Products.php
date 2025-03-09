<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Events\AdminNotificationEvent;

class Products extends Component
{
    use WithPagination;
    public $user_id;

    public function mount()
    {
        $this->user_id = auth()->user()->id;
    }
    public function deleteProduct($product_id)
    {
        $admin = User::where('is_admin', 1)->first();
        $user = auth()->user();
        $user_name = $user->name;

        $product = Product::where('user_id', $this->user_id)
            ->where('id', $product_id)
            ->first();


        broadcast(new AdminNotificationEvent($product_id, $admin->id, $user->id, $user_name, $product->product_name));
    }



    public function ifAdminGivePermission($product_id, $is_product_delete)
    {
        // dd($is_product_delete);
        $product = Product::findOrFail($product_id);
        if ($is_product_delete === 'YES') {
            if ($product->delete()) {
                flash()->success('Your Product Deleted successfully');
            }
        } else {
            $msg = "You can't delete this product";
            flash()->error($msg);
        }
    }
    public function render()
    {
        $products = Product::where('user_id', auth()->user()->id)->paginate(5);
        return view('livewire.products', [
            'products' => $products
        ])->layout('layouts.app');
    }
}
