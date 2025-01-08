<?php

namespace App\Http\Controllers\visitador\examResponder;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Course;
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
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionUniversitario', $user)) {
            $exams = Exam::where('estado', '=', 'activo')->get();
            $courses = Course::where('status',3)->get();
            return view('visitador.examResponder.index', [
                'exams' => $exams,
                'courses' => $courses
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

        $examUser = ExamUser::where('user_id', '=', auth()->user()->id)
            ->where('exam_id', '=', $exam->id)
            ->first();
        //dd($examUser);
        if ($examUser && $examUser->status == 'Culminado') {
            return redirect()->route('visitador.examenes.show', $exam);
        } else if ($examUser && $examUser->status == 'Pendiente') {
            return redirect()->route('visitador.examenes.status', ['exam' => $exam]);
        } else {
            $examUser = ExamUser::create([
                'calificacion' => '0',
                'observaciones' => '',
                'status' => 'Pendiente',
                'exam_id' => $exam->id,
                'user_id' => auth()->user()->id,
            ]);

            //dirigiendo al alumno para resolver el examen
            return redirect()->route('visitador.examenes.status', ['exam' => $exam]);
        }
    }

    //para resolver el examen
    public function status(Exam $exam)
    {
        $user = auth()->user();
        //SI TIENE SUSCRIPCION VA TENER ACCESO A LOS EXAMENES
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionUniversitario', $user)  && $this->authorize('enrolledExamUser', $exam)) {
            $examUser = ExamUser::where('user_id', '=', auth()->user()->id)
                ->where('exam_id', '=', $exam->id)
                ->first();
            //dd($examUser);
            if ($examUser && $examUser->status == 'Culminado') {
                return redirect()->route('visitador.examenes.show', $exam);
            } else {
                return view('visitador.examResponder.estatus', [
                    'exam' => $exam,
                    'examUser' => $examUser
                ]);
            }
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
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionUniversitario', $user) && $this->authorize('enrolledExamUser', $exam)) {
            $examUser = ExamUser::where('user_id', auth()->user()->id)->where('exam_id', $exam->id)->first();
            $userExamAnswers = ExamUserAnswer::where('exam_user_id', $examUser->id)
                ->with(['answer', 'examQuestion.question.answers'])->get();

            //dd($questions);
            return view('visitador.examResponder.show', [
                'exam' => $exam,
                'examUser' => $examUser,
                'userExamAnswers' => $userExamAnswers
            ]);
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
        //dd($exam);
    }

    // para volver a tomar el examen
    public function reset(Exam $exam, ExamUser $examUser)
    {
        $user = auth()->user();
        //SI TIENE SUSCRIPCION VA TENER ACCESO A LOS EXAMENES Y  //METODO AUTORIZAR ENTRAR AL EXAMEN AL USUARIO AUTENTICADO
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionUniversitario', $user) && $this->authorize('enrolledExamUser', $exam)) {
            try {
                // Encuentra el usuario del examen o lanza una excepción si no existe
                $deleteExmenUser = ExamUser::findOrFail($examUser->id);

                // Elimina las respuestas del usuario del examen
                $deleteExamUserAnswer = ExamUserAnswer::where('exam_user_id', $examUser->id);

                if ($deleteExamUserAnswer->exists()) {
                    $deleteExamUserAnswer->delete();
                }

                // actualizar el registro del usuario del examen
                $deleteExmenUser->update(['status' => 'Pendiente']);

                // Redirige a la ruta indicada con éxito
                return redirect()->route('visitador.examenes.enrolled', ['exam' => $exam]);
            } catch (\Exception $e) {
                // Maneja cualquier excepción y redirige con un mensaje de error
                return redirect()->back()->with('mensaje', 'Ocurrió un error al intentar reiniciar el examen: ' . $e->getMessage());
            }
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }
}
