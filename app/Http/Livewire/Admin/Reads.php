<?php

namespace App\Http\Livewire\Admin;

use App\Models\Image;
use App\Models\Resource;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reads extends Component
{
    public $resources;

    public $resource_id;
    public $url;
    public $resourceable_type; //SERA EL NOMBRE DEL LIBRO

    public $image_id;
    public $img;              //resourceable_id PARA LAS LECTURAS SERA DE  9999


    //
    public function mount()
    {
        $this->resources =  Resource::join('images', 'resources.id', '=', 'images.imageable_id')
            ->select(
                'resources.url',
                'resources.resourceable_type',
                'resources.id',
                'images.url as img',
                'images.imageable_id',
                'images.imageable_type'
            )
            ->where('resources.resourceable_id', '=', '9999')
            ->get();
        //@dump($url, $resourceable_id)
    }


    public function render()
    {
        return view('livewire.admin.reads');
    }

    public function create()
    {
        $this->validate([
            'resourceable_type' => 'required',
            'img' => 'required',
            'url' => 'required'
        ]);

        $resource = Resource::create([
            'url' => $this->url,
            'resourceable_id' => '9999',
            'resourceable_type' => $this->resourceable_type
        ]);

        Image::create([
            'url' => $this->img,
            'imageable_id' => $resource->id,
            'imageable_type' => 'App\Models\Resource'
        ]);

        $this->reload();
        $this->resetInputFields();
    }


    public function edit($id)
    {
        $resource = Resource::find($id);
        $this->resource_id = $resource->id;
        $this->url = $resource->url;
        $this->resourceable_type = $resource->resourceable_type;

        $image = DB::table('images')->where('imageable_id', $resource->id)->first();
        $this->image_id = $image->id;
        $this->img = $image->url;
    }


    public function update()
    {
        $this->validate([
            'resourceable_type' => 'required',
            'img' => 'required',
            'url' => 'required'
        ]);

        $resource = Resource::find($this->resource_id);
        $resource->update([
            'url' => $this->url,
            'resourceable_id' => '9999',
            'resourceable_type' => $this->resourceable_type
        ]);

        $image = Image::find($this->image_id);
        $image->update([
            'url' => $this->img,
            'imageable_id' => $resource->id,
            'imageable_type' => 'App\Models\Resource'
        ]);

        $this->reload();
        $this->resetInputFields();
    }


    public function delete($id)
    {

    }

    public function reload()
    {
        $this->resources =  Resource::join('images', 'resources.id', '=', 'images.imageable_id')
            ->select(
                'resources.url',
                'resources.resourceable_type',
                'resources.id',
                'images.url as img',
                'images.imageable_id',
                'images.imageable_type'
            )
            ->where('resources.resourceable_id', '=', '9999')
            ->get();
    }

    //LIMPIAR CAJAS
    public function resetInputFields()
    {
        $this->resource_id = '';
        $this->img = '';
        $this->resourceable_type = '';
        $this->url = '';
    }
}
