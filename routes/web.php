<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursosController;


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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cursos', [App\Http\Controllers\CursosController::class,'index'])->name('cursos');
Route::get('/autoCompleteCursos', [App\Http\Controllers\CursosController::class, 'autoComplete'])->name('autocomplete');
Route::get('/datatableCursos', [App\Http\Controllers\CursosController::class, 'datatableCursos'])->name('datatableCursos');
Route::get('/getCurso', [App\Http\Controllers\CursosController::class, 'getCurso'])->name('getCurso');
Route::delete('/deleteCurso', [App\Http\Controllers\CursosController::class, 'deleteCurso'])->name('deleteCurso');
Route::post('/upload-xml', [App\Http\Controllers\CursosController::class, 'uploadXmlCursos'])->name('uploadXmlCursos');
Route::post('/salvarCurso', [App\Http\Controllers\CursosController::class, 'salvarCurso'])->name('salvarCurso');

Route::get('/autoCompleteSituacao', [App\Http\Controllers\AlunoController::class, 'autoCompleteSituacao'])->name('autoCompleteSituacao');
Route::get('/cadastrar-aluno', [App\Http\Controllers\AlunoController::class, 'index'])->name('alunos');
Route::get('/datatableAlunos', [App\Http\Controllers\AlunoController::class, 'datatableAlunos'])->name('datatableAlunos');
Route::get('/getAluno', [App\Http\Controllers\AlunoController::class, 'getAluno'])->name('getAluno');
Route::post('/cadastrar-aluno', [App\Http\Controllers\AlunoController::class, 'cadastrarAluno'])->name('cadastrarPost');
Route::delete('/deleteAluno', [App\Http\Controllers\AlunoController::class, 'deleteAluno'])->name('deleteAluno');


// 'HomeController@reportRegister'