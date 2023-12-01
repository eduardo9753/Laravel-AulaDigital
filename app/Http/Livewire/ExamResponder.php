<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamUser;
use App\Models\ExamUserAnswer;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ExamResponder extends Component
{
    public $exam;
    public $examUser;
    public $examenes;

    protected $rules = [];
    public $idsPreguntas = [];
    public $respuestasSeleccionadas = [];
    public $openedAccordions = [];

    protected $listeners = ['tiempoFuera'];
    public $respuestas;

    public $botonDesactivado = false;


    public function mount(Exam $exam, ExamUser $examUser)
    {
        $this->exam = $exam;
        $this->examUser = $examUser;
        $this->examenes = ExamQuestion::with('question.answers')
            ->where('exam_id', $this->exam->id)
            ->get();

        // Inicializar el array de IDs de preguntas - Asignar los ids de la tabla "exam_questions" al array
        $this->idsPreguntas = [];
        foreach ($this->examenes as $examen) {
            $this->idsPreguntas[] = $examen->id;
        }


        // Inicializar las respuestas seleccionadas con la primera respuesta de cada pregunta
        foreach ($this->examenes as $examen) {
            $this->respuestasSeleccionadas[$examen->question->id] = $examen->question->answers->first()->id;
        }

        // Escuchar el evento tiempoFuera
        $this->listeners = ['tiempoFuera'];

        // Inicializa la propiedad $botonDesactivado
        $this->botonDesactivado = false;
    }

    public function render()
    {
        return view('livewire.exam-responder');
    }

    //REGLA PARA VALIDAR EL RADIO BUTON
    public function rules()
    {
        $validationRules = [];
        foreach ($this->examenes as $examen) {
            // Add validation rule for each question
            $validationRules["respuestasSeleccionadas.{$examen->question->id}"] = 'required';
        }
        return $validationRules;
    }


    //METODO PARA CUANDO SE ACABE EL TIEMPO SE GUARDE LAS RESPUESTAS QUE MARCO EL USUARIO
    public function tiempoFuera()
    {
        // Validate the form
        $this->validate();
        $this->guardarPreguntaRespuestas();

        // Desactiva el botón después de culminar el examen
        $this->botonDesactivado = true;
    }


    //METODO PARA CUANDO EL USUARIO LE DA CLICK A "Culminar Examen"
    public function culminarExamen()
    {
        // Validate the form
        $this->validate();
        $this->guardarPreguntaRespuestas();

        // Desactiva el botón después de culminar el examen
        $this->botonDesactivado = true;
    }

    //PARA GUARDAR LAS PREGUNTAS Y RESPUESTAS QUE EL USUARIO SELECCIONA
    public function guardarPreguntaRespuestas()
    {
        // Array para almacenar las respuestas seleccionadas
        $respuestasSeleccionadasArray = [];

        foreach ($this->respuestasSeleccionadas as $respuestaSeleccionada) {
            // Encuentra la respuesta por ID
            $respuesta = Answer::find($respuestaSeleccionada);

            if ($respuesta->es_correcta == 0) {
                $puntos = 0;
            } else {
                $puntos = $respuesta->es_correcta;
            }

            // Asegurarse de que haya preguntas disponibles
            if (!empty($this->idsPreguntas)) {
                // Asigna el ID de la pregunta actual
                $examenQuestionId = array_shift($this->idsPreguntas);

                // Almacena solo los atributos necesarios
                $respuestaData = [
                    'exam_user_id' => $this->examUser->id,
                    'exam_question_id' => $examenQuestionId,
                    'answer_id' => $respuesta->id,
                    'puntos' => $puntos,
                ];

                // Almacena los datos en el array
                $respuestasSeleccionadasArray[] = $respuestaData;
            }
        }

        // Guarda los datos en la tabla exam_user_answers
        ExamUserAnswer::insert($respuestasSeleccionadasArray);

        // Calcula la calificación sumando los puntos
        $calificacion = array_sum(array_column($respuestasSeleccionadasArray, 'puntos'));

        $ExamStatus = ExamUser::where('user_id', auth()->user()->id)->where('exam_id', $this->exam->id)->first();

        if ($ExamStatus->status == 'Pendiente') {
            $ExamStatus->update([
                'calificacion' => $calificacion,
                'status' => 'Culminado'
            ]);

            return redirect()->route('visitador.examenes.index');
        } else {
            return redirect()->route('visitador.examenes.index');
        }
    }


    public function toggleAccordion($questionId)
    {
        $this->openedAccordions = in_array($questionId, $this->openedAccordions)
            ? array_diff($this->openedAccordions, [$questionId])
            : array_merge($this->openedAccordions, [$questionId]);

        $this->dispatchBrowserEvent('toggleAccordion', ['questionId' => $questionId]);
    }
}
