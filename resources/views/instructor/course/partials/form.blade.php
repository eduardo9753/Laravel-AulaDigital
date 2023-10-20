<div class="mb-4">
    {{-- PRIMER PARAMETRO : son los campos del modelo mejor dicho de la tabla --}}
    {!! Form::label('title', 'titulo del curso') !!}
    {!! Form::text('title', null, ['class' => 'form-control block']) !!}

    @error('title')
        <span class="text-danger"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="mb-4">
    {{-- PRIMER PARAMETRO : son los campos del modelo mejor dicho de la tabla --}}
    {!! Form::label('subtitle', 'Subtitulo del curso') !!}
    {!! Form::text('subtitle', null, ['class' => 'form-control block']) !!}

    @error('subtitle')
        <span class="text-danger"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="mb-4">
    {{-- PRIMER PARAMETRO : son los campos del modelo mejor dicho de la tabla --}}
    {!! Form::label('description', 'Description del curso') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control block']) !!}

    @error('description')
        <span class="text-danger"><strong>{{ $message }}</strong></span>
    @enderror
</div>

<div class="row">
    <div class="col-md-4">
        {!! Form::label('category_id', 'Categorias') !!}
        {!! Form::select('category_id', $categories, null, ['class' => 'form-select']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('level_id', 'Niveles') !!}
        {!! Form::select('level_id', $levels, null, ['class' => 'form-select']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('price_id', 'Precio') !!}
        {!! Form::select('price_id', $prices, null, ['class' => 'form-select']) !!}
    </div>
</div>

<h3 class="lead mt-4">Imagen del Curso</h3>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <figure>
                    {{-- VALIDA SI EXISTE LA VARIABLE CURSO --}}
                    @isset($course)
                        @if ($course->image)
                            <img src="{{ $course->image->url }}" class="" alt="...">
                        @endif
                    @else
                        <img src="https://images.pexels.com/photos/7509366/pexels-photo-7509366.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            class="" alt="...">
                    @endisset
                </figure>
            </div>
            <div class="col-md-8">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab explicabo ea modi
                    temporibus fuga cumque obcaecati nihil similique? Facere, cupiditate.</p>
                {!! Form::text('photo', null, ['class' => 'form-control', 'placeholder' => 'por favor de subir con extenciones validas ".png|.jpg"']) !!}
            </div>
        </div>
    </div>
</div>
