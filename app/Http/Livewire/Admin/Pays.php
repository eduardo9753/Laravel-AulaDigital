<?php

namespace App\Http\Livewire\Admin;

use App\Mail\MailUserCursoAutorizarController;
use App\Mail\MailUserCursoRechazadoController;
use App\Models\Course;
use App\Models\Pay;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
        //$this->pays = Pay::where('estado', '=', 'VALIDAR')->get();
        $this->pays = User::join('pays', 'users.id', '=', 'pays.user_id')
            ->select(
                'users.*',
                'pays.id',
                'pays.payment_id',
                'pays.status',
                'pays.payment_type',
                'pays.preference_id',
                'pays.estado'
            )
            ->where('pays.estado', '=', 'VALIDAR')
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.pays');
    }


    public function edit($id)
    {
        $pay = Pay::find($id);
        $this->pay_id = $pay->id;
        $this->payment_id = $pay->payment_id;
        $this->status = $pay->status;
        $this->payment_type = $pay->payment_type;
        $this->preference_id = $pay->preference_id;
        $this->estado = $pay->estado;
        $this->reload();
    }

    public function update()
    {
        $pay = Pay::find($this->pay_id);

        $pay->update([
            'estado' => 'AUTORIZADO'
        ]);

        $user = User::find($pay->user_id);
        $results = DB::table('course_user')->where('user_id', $user->id)->first();
        $course = Course::find($results->course_id);

        Mail::to([$user->email, auth()->user()->email])->send(new MailUserCursoAutorizarController($course, $user));
        $this->reload();
        $this->resetInputFields();
    }

    //QUITAR EL CURSO AL USUARIO
    public function delete($id)
    {
        $pay = Pay::find($id);

        $pay->update([
            'estado' => 'RECHAZADO'
        ]);

        $user = User::find($pay->user_id);
        $results = DB::table('course_user')->where('user_id', $user->id)->first();
        $course = Course::find($results->course_id);
        $course->students()->detach($user->id);

        Mail::to([$user->email, auth()->user()->email])->send(new MailUserCursoRechazadoController($course, $user));
        $this->reload();
        $this->resetInputFields();
    }

    public function reload()
    {
        $this->pays = User::join('pays', 'users.id', '=', 'pays.user_id')
            ->select(
                'users.*',
                'pays.id',
                'pays.payment_id',
                'pays.status',
                'pays.payment_type',
                'pays.preference_id',
                'pays.estado'
            )
            ->where('pays.estado', '=', 'VALIDAR')
            ->get();
    }

    //LIMPIAR CAJAS
    public function resetInputFields()
    {
        $this->pay_id = '';
        $this->payment_id = '';
        $this->status = '';
        $this->payment_type = '';
        $this->preference_id = '';
        $this->estado = '';
    }
}
