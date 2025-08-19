<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Bill;

class BillShow extends Component
{
    public  $bill;

    public function mount(Bill $bill)
    {
        $this->bill = $bill;
    }

    public function render()
    {
        return view('livewire.bill-show');
    }
}
