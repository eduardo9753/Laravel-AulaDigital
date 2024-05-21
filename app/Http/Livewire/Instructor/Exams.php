<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Exam;
use Livewire\Component;
use Illuminate\Support\Str;

class Exams extends Component
{
    public $exams;

    public $exam_id;
    public $nombre;
    public $slug;
    public $duracion;
    public $estado = Exam::PENDIENTE;
    public $publicacion;


    public function mount()
    {
        $this->exams = Exam::where('user_id', '=', auth()->user()->id)->where('estado', '=', Exam::PENDIENTE)->get();
        $this->duracion = 10;
        $this->publicacion = date('Y-m-d\TH:i:s');
    }

    public function render()
    {
        return view('livewire.instructor.exams');
    }

    public function create()
    {
        $this->validate([
            'nombre' => 'required|string',
            'duracion' => 'required|integer',
            'publicacion' => 'required|date',
        ]);

        Exam::create([
            'nombre' => $this->nombre,
            'slug' => Str::slug($this->nombre),
            'duracion' => $this->duracion,
            'estado' => $this->estado,
            'publicacion' => $this->publicacion,
            'user_id' => auth()->user()->id,
        ]);

        $this->reload();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $exam = Exam::find($id);
        $this->exam_id = $exam->id;
        $this->nombre = $exam->nombre;
        $this->slug = $exam->slug;
        $this->duracion = $exam->duracion;
        $this->estado = $exam->estado;
        $this->publicacion = $exam->publicacion;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required|string',
            'duracion' => 'required|integer',
            'estado' => 'required|string',
            'publicacion' => 'required|date',
        ]);

        $exam = Exam::find($this->exam_id);
        $exam->update([
            'nombre' => $this->nombre,
            'slug' => Str::slug($this->nombre),
            'duracion' => $this->duracion,
            'estado' => $this->estado,
            'publicacion' => $this->publicacion,
        ]);

        $this->reload();
        $this->resetInputFields();
    }


    public function activar($id)
    {
        $exam = Exam::find($id);
        $exam->update([
            'estado' => Exam::ACTIVO,
        ]);

        $this->reload();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $exam = Exam::find($id);
        $exam->delete();
        $this->reload();
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->nombre = '';
        $this->duracion = '';
        $this->exam_id = '';
    }

    public function reload()
    {
        $this->exams = Exam::where('user_id', '=', auth()->user()->id)->where('estado', '=', Exam::PENDIENTE)->get();
    }
}
