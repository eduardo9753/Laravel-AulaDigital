<?php

namespace App\Http\Controllers\visitador\examResponder;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamUser;
use App\Models\ExamUserAnswer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ExamResponderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //para inscribirme al examen
    public function index()
    {
        $user = auth()->user();
        //SI TIENE SUSCRIPCION VA TENER ACCESO A LOS EXAMENES
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionUniversitario', $user) || Gate::allows('viewSubscriptionEscolar', $user)) {
            $exams = Exam::where('estado', '=', 'activo')->get();
            return view('visitador.examResponder.index', [
                'exams' => $exams
            ]);
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }

    //para matricularse y dirigirlo a la ruta del componente en donde estan las preguntas
    public function enrolled(Exam $exam)
    {
        //agregado al alumno con el examen
        //dd($exam);
        $examUser = ExamUser::create([
            'calificacion' => '0',
            'observaciones' => '',
            'status' => 'Pendiente',
            'exam_id' => $exam->id,
            'user_id' => auth()->user()->id,
        ]);

        //dirigiendo al alumno para resolver el examen
        return redirect()->route('visitador.examenes.status', ['exam' => $exam, 'examUser' => $examUser]);
    }

    //para resolver el examen
    public function status(Exam $exam)
    {
        $user = auth()->user();
        //SI TIENE SUSCRIPCION VA TENER ACCESO A LOS EXAMENES
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionUniversitario', $user) || Gate::allows('viewSubscriptionEscolar', $user)  && $this->authorize('enrolledExamUser', $exam)) {
            $examUser = ExamUser::where('user_id', '=', auth()->user()->id)
                ->where('exam_id', '=', $exam->id)
                ->first();
            //dd($examUser);

            return view('visitador.examResponder.estatus', [
                'exam' => $exam,
                'examUser' => $examUser
            ]);
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }


    //para mostrar el examen las respuestas y su calificacion
    public function show(Exam $exam)
    {
        $user = auth()->user();
        //SI TIENE SUSCRIPCION VA TENER ACCESO A LOS EXAMENES Y  //METODO AUTORIZAR ENTRAR AL EXAMEN AL USUARIO AUTENTICADO
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionUniversitario', $user) || Gate::allows('viewSubscriptionEscolar', $user) && $this->authorize('enrolledExamUser', $exam)) {
            //examen usuario
            $examUser = ExamUser::where('user_id', '=', auth()->user()->id)->where('exam_id', '=', $exam->id)->first();
            //dd($examUser);

            // Recorrido de las respuestas del alumno
            $examUserAnswer = ExamUserAnswer::where('exam_user_id', $examUser->id)->get();

            //ids de las preguntas y las preguntas
            $idsAnswer = $examUserAnswer->pluck('answer_id')->toArray();
            $answers = Answer::find($idsAnswer);

            //ids de las respuestas tabla "exam_questions"
            $idsExamQuestion = $examUserAnswer->pluck('exam_question_id')->toArray();
            $examQuestion = ExamQuestion::find($idsExamQuestion);

            //ids de la tabla questions
            $idsQuestion = $examQuestion->pluck('question_id')->toArray();
            $questions = Question::find($idsQuestion);

            //dd($questions);
            return view('visitador.examResponder.show', [
                'exam' => $exam,
                'examUser' => $examUser,
                'answers' => $answers,
                'questions' => $questions
            ]);
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
        //dd($exam);
    }
}
