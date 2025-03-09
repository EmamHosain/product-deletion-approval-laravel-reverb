<?php


namespace App\Livewire;

use App\Models\User;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Events\ProductDeleteEvent;

class AdminDashboard extends Component
{
    public $user_id;
    public $users;
    public function mount()
    {
        $this->user_id = auth()->user()->id;
        $this->users = User::whereNot('is_admin', 1)->latest()->get();
    }


    public function callFun($product_id)
    {

        $product = Product::find($product_id);
        $msg = $product->product_name . " " . "deleted!";
        flash()->success($msg);
    }

    public function sendProductDeletePermission($user_id, $product_id, $is_product_delete)
    {
        // dd("hello");
        broadcast(new ProductDeleteEvent($user_id, $product_id, $is_product_delete))->toOthers();
    }

    public function render()
    {
        return view('livewire.admin-dashboard')->layout('layouts.app');
    }
}
