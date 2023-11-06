<?php

namespace App\Http\Controllers\visitador\read;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $resources = Resource::join('images', 'resources.id', '=', 'images.imageable_id')
            ->select(
                'resources.url',
                'resources.resourceable_type as nombre',
                'resources.id',
                'images.url as img',
                'images.imageable_id',
                'images.imageable_type'
            )
            ->where('resources.resourceable_id', '=', '9999')
            ->get();

        return view('visitador.read.index', [
            'resources' => $resources
        ]);
    }

    public function show(Resource $resource)
    {
        $resource = Resource::join('images', 'resources.id', '=', 'images.imageable_id')
            ->select(
                'resources.url',
                'resources.resourceable_type as nombre',
                'resources.id',
                'images.url as img',
                'images.imageable_id',
                'images.imageable_type'
            )
            ->where('resources.resourceable_id', '=', '9999')
            ->where('resources.id', '=', $resource->id)
            ->first();

           
        return view('visitador.read.show', [
            'resource' => $resource
        ]);
    }
}
