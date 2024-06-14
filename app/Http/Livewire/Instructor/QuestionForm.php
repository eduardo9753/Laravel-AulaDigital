<?php

namespace App\Http\Livewire\Instructor;

use Livewire\Component;
use App\Models\Topic; // Asegúrate de importar el modelo Topic
use App\Models\Question; // Asegúrate de importar el modelo Question
use App\Models\Answer; // Asegúrate de importar el modelo Answer
use App\Models\Exam;
use Illuminate\Support\Facades\DB;

class QuestionForm extends Component
{
    //tabla 
    public $questions = [];
    public $exams;


    public $exam_id;

    public $selectedTopicId;

    public $titulo;
    public $comentario;
    public $dificultad = 'Facil';
    public $puntos = 1;
    public $estado;
    public $topic_id;
    public $respuestas = [];


    public function mount()
    {
        $this->firstExam();
        $this->firstTopic();

        $this->selectedTopicId = $this->topic_id;

        $this->loadQuestions();
        $this->exams = Exam::where('user_id', '=', auth()->user()->id)->where('estado', '=', 'pendiente')->get();
    }


    public function render()
    {
        $topics = Topic::where('estado', '=', 'activo')->get();
        return view('livewire.instructor.question-form', compact('topics'));
    }


    private function loadQuestions()
    {
        $this->questions = Question::join('topics', 'questions.topic_id', '=', 'topics.id')
            ->select(
                'questions.id',
                'questions.titulo',
                'questions.dificultad',
                'questions.puntos'
            )
            ->where('questions.user_id', '=', auth()->user()->id)
            ->where('questions.topic_id', '=', $this->selectedTopicId)
            ->where('topics.estado', '=', 'activo')
            ->get();
    }


    public function updatedSelectedTopicId()
    {
        $this->loadQuestions();
    }


    //Obtener el primer tema y asignar su id a $exam_id
    public function firstExam()
    {
        $firstExam = Exam::where('user_id', '=', auth()->user()->id)->where('estado', '=', 'pendiente')->latest()->first();
        $this->exam_id = $firstExam ? $firstExam->id : null;
    }

    // Obtener el primer tema y asignar su id a $topic_id
    public function firstTopic()
    {
        $firstTopic = Topic::where('estado', '=', 'activo')->latest()->first();
        $this->topic_id = $firstTopic ? $firstTopic->id : null;
    }

    //PARA AÑADIR UNA NUEVA RESPUESTA
    public function addAnswer()
    {
        $this->respuestas[] = ['titulo' => '', 'es_correcta' => false];
        $this->emit('ckeditorReady');
    }

    //PARA QUITAR UNA RESPUESTA
    public function removeAnswer($index)
    {
        unset($this->respuestas[$index]);
        $this->respuestas = array_values($this->respuestas);
        $this->emit('ckeditorReady');
    }

    //PARA GUARDAR LA PREGUNTA - RESPUESTA EN LAS TABLAS 
    public function saveQuestion()
    {
        // Validar los datos según tus necesidades
        $this->validate([
            'titulo' => 'required',
            'exam_id' => 'required',
            'topic_id' => 'required',
            'respuestas.*.titulo' => 'required', // Validar que al menos una respuesta tenga un título
            'respuestas.*.es_correcta' => 'nullable|boolean', // Validar que al menos una respuesta sea marcada como correcta
        ], [
            'respuestas.*.titulo.required' => 'Debes agregar al menos una respuesta.', // Mensaje personalizado de error para respuestas sin título
            'respuestas.*.es_correcta.boolean' => 'Debes marcar al menos una respuesta como correcta.', // Mensaje personalizado de error para respuestas sin marcar como correcta
        ]);

        // Guardar la pregunta
        $question = Question::create([
            'titulo' => $this->titulo,
            'comentario' => 'algun comentario',
            'dificultad' => $this->dificultad,
            'puntos' => $this->puntos,
            'estado' => 'activo',
            'topic_id' => $this->selectedTopicId,
            'user_id' => auth()->user()->id
        ]);

        // Insertar en la tabla pivot "exam_question"
        DB::table('exam_questions')->insert([
            'exam_id' => $this->exam_id,
            'question_id' => $question->id,
        ]);

        // Insertando las respuestas
        foreach ($this->respuestas as $respuesta) {
            Answer::create([
                'titulo' => $respuesta['titulo'],
                'es_correcta' => $respuesta['es_correcta'],
                'question_id' => $question->id,
            ]);
        }

        // Limpiar campos después de guardar
        $this->reload();
        $this->resetInputFields();
    }


    public function delete($id)
    {
        $question = Question::find($id);
        $question->delete();
        // Limpiar campos después de guardar
        $this->reload();
    }

    //RECARGAR DATOS
    public function reload()
    {
        $this->updatedSelectedTopicId();
        $this->exams = Exam::where('user_id', '=', auth()->user()->id)->where('estado', '=', 'pendiente')->get();
    }

    //PARA PUBLICAR EL EXAMEN
    public function publishExam($topic_id, $exam_id)
    {
        $topic = Topic::find($topic_id);
        $topic->update([
            'estado' => 'inactivo',
        ]);

        $exam = Exam::find($exam_id);
        $exam->update([
            'estado' => Exam::ACTIVO,
        ]);

        return redirect()->route('admin.instructor.exam.index');
    }

    //PARA ANULAR EL EXAMEN
    public function deleteExamen($topic_id, $exam_id)
    {
        $topic = Topic::find($topic_id);
        $topic->delete();

        $exam = Exam::find($exam_id);
        $exam->delete();
    }

    public function resetInputFields()
    {
        $this->titulo = '';
        $this->reset(['titulo']);
    }
}
