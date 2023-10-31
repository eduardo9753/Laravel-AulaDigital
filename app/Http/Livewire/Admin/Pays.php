<?php

namespace App\Http\Livewire\Admin;

use App\Models\Pay;
use Livewire\Component;

class Pays extends Component
{
    public $pays;

    public $pay_id;
    public $payment_id;
    public $status;
    public $payment_type;
    public $preference_id;
    public $estado;


    public function mount()
    {
        $this->pays = Pay::all();
    }

    public function render()
    {
        return view('livewire.admin.pays');
    }
}
