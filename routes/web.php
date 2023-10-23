<?php

use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\admin\auth\LogoutController;
use App\Http\Controllers\admin\auth\RegisterController;
use App\Http\Controllers\visitador\course\CourseController;
use App\Http\Controllers\visitador\home\HomeController;
use Illuminate\Support\Facades\Route;


//COMPONENTE LIVEWIRE PARA SEGUIR EL CURSO
use App\Http\Livewire\CourseStatus;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*RUTAS DEL VISITADOR "ESCOLARES" */
Route::get('/', [HomeController::class, 'index'])->name('visitador.home.index');
Route::get('/contenido/{course:title}', [HomeController::class , 'contenido'])->name('visitador.contenido');



//LOGIN Y REGISTER
Route::get('/admin/SingIn', [LoginController::class, 'index'])->name('login');
Route::post('/admin/SingIn', [LoginController::class, 'store'])->name('admin.login.store');

Route::get('/admin/Register', [RegisterController::class, 'index'])->name('admin.register.index');
Route::post('/admin/Register/store', [RegisterController::class, 'store'])->name('admin.register.store');


Route::post('/admin/logout', [LogoutController::class, 'logout'])->name('admin.logout');

//BUSQUEDA DEL CURSO Y MOSTRAR CURSO CON SU CONTENIDO
Route::get('/course', [CourseController::class, 'index'])->name('visitador.course.index');
Route::get('/course/show/{course:slug}', [CourseController::class, 'show'])->name('visitador.course.show');


//PERSONAS MATRICULADAS AL CURSO Y SEGUIMIENTO DEL CURSO
Route::post('/course/{course}/enrolled', [CourseController::class, 'enrolled'])->middleware('auth')->name('visitador.course.enrolled');
Route::get('/course-status/{course:slug}', [CourseController::class, 'status'])->middleware('auth')->name('visitador.course.status');
Route::get('/list/course/student', [CourseController::class , 'courses'])->middleware('auth')->name('visitador.course.list');





//RUTAS PARA EL ADMIN
require base_path('routes/admin.php');


//RUTAS PARA EL INSTRUCTOR "profesor"
require base_path('routes/instructor.php');


//RUTAS PARA EL PAGO
require base_path('routes/payment.php');