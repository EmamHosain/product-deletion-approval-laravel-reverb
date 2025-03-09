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
    public function deleteProduct($id)
    {
        $admin = User::where('is_admin', 1)->first();
        $user_id = auth()->user()->id;
        broadcast(new AdminNotificationEvent($id, $admin->id, $user_id));
    }



    public function ifAdminGivePermission($product_id, $is_product_delete)
    {
        // dd($is_product_delete);
        $product = Product::findOrFail($product_id);
        if ($is_product_delete === 'YES') {
            if ($product->delete()) {
                flash()->success('Product Delete successfully');
            }
        } else {
            $msg = $product->product_name . " " . "You can't delete";
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
