<?php

namespace App\Http\Livewire\Admin;

use App\Models\Archive;
use App\Models\Course;
use App\Models\Image;
use App\Models\Resource;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reads extends Component
{
    public $courses;

    public $archives;
    public $archive_id;
    public $course_id;
    public $name;
    public $image;
    public $cita;
    public $url;
    public $description;



    //
    public function mount()
    {
        $this->archives =  Course::join('archives', 'courses.id', '=', 'archives.course_id')
            ->select(
                'courses.title',
                'archives.id',
                'archives.url',
                'archives.name',
                'archives.image',
                'archives.url'
            )
            ->get();
        $this->course_id = Course::first()->id; //ASIGNAMOS EL PRIMER ID DE LA TABLA A LA VARIABLE PARA QUE NO DEE NULL
        //@dump($url, $resourceable_id)
    }


    public function render()
    {
        $this->courses = Course::all();
        return view('livewire.admin.reads');
    }

    public function create()
    {
        $this->validate([
            'name' => 'required',
            'image' => 'required',
            'cita' => 'required',
            'url' => 'required',
            'description' => 'required'
        ]);

        Archive::create([
            'course_id' => $this->course_id,
            'name' => $this->name,
            'image' => $this->image,
            'cita' => $this->cita,
            'url' => $this->url,
            'description' => $this->description
        ]);

        $this->reload();
        $this->resetInputFields();
    }


    public function edit($id)
    {
        $archives = Archive::find($id);
        $this->archive_id = $archives->id;
        $this->course_id = $archives->course_id;
        $this->name = $archives->name;
        $this->image = $archives->image;
        $this->cita = $archives->cita;
        $this->url = $archives->url;
        $this->description = $archives->description;

        $this->reload();
    }


    public function update()
    {
        $this->validate([
            'name' => 'required',
            'image' => 'required',
            'cita' => 'required',
            'url' => 'required',
            'description' => 'required'
        ]);

        $archives = Archive::find($this->archive_id);
        $archives->update([
            'course_id' => $this->course_id,
            'name' => $this->name,
            'image' => $this->image,
            'cita' => $this->cita,
            'url' => $this->url,
            'description' => $this->description
        ]);

        $this->reload();
        $this->resetInputFields();
    }


    public function delete($id)
    {
        $archives = Archive::find($id);
        $archives->delete();
        $this->reload();
        $this->resetInputFields();
    }

    public function reload()
    {
        $this->archives =  Course::join('archives', 'courses.id', '=', 'archives.course_id')
            ->select(
                'courses.title',
                'archives.id',
                'archives.url',
                'archives.name',
                'archives.image',
                'archives.url'
            )
            ->get();
    }

    //LIMPIAR CAJAS
    public function resetInputFields()
    {
        $this->name = '';
        $this->image = '';
        $this->cita = '';
        $this->url = '';
        $this->description = '';
    }
}
