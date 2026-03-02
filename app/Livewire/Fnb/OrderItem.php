<?php

namespace App\Livewire\Fnb;


use App\Models\FnbOrderItem;
use App\Models\FnbOrder;
use App\Models\FnbMenu;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Food and Beverage | Manage Order Items')]

class OrderItem extends Component
{
    public $order_items;
    public $orders;
    public $menus;
    public $order_item_id;
    public $order_id, $menu_id, $quantity, $subtotal;
    public $modal_flag = false;
    public $modal_title = 'Create New Order Item.';

    protected $rules = [
        'order_id' => 'required',
        'menu_id' => 'required',
        'quantity' => 'required|integer|min:1',
        'subtotal' => 'required|numeric|min:0',
    ];

    public function render()
    {
        $this->order_items = FnbOrderItem::all();
        $this->menus = FnbMenu::all();
        $this->orders = FnbOrder::all();
        return view('livewire.fnb.order-item')->layout('layouts.fnb');
    }

    // Reset form fields
    public function exit()
    {
        $this->reset();
    }

    // Save a new or updated order
    public function save()
    {
        $this->validate();

        FnbOrderItem::updateOrCreate(
            ['id' => $this->order_item_id],
            [
                'order_id' => $this->order_id,
                'menu_id' => $this->menu_id,
                'quantity' => $this->quantity,
                'subtotal' => $this->subtotal,
            ]
        );

        toastr()->info( $this->order_item_id ? 'Order item  updated successfully!' : 'Order item  created successfully!');
        $this->reset();
    }

    // Edit an existing order
    public function edit($id)
    {
        $order_item = FnbOrderItem::findOrFail($id);
        $this->order_item_id = $order_item->id;
        $this->order_id = $order_item->order_id;
        $this->menu_id = $order_item->menu_id;
        $this->quantity = $order_item->quantity;
        $this->subtotal = $order_item->subtotal;
        $this->modal_flag = true;
        $this->modal_title = 'Update Order Item';
    }

    // Delete an order
    public function delete($id)
    {
        FnbOrderItem::findOrFail($id)->delete();
        toastr()->info( 'Order item  deleted successfully!');
    }
}
