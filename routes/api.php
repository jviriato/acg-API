<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/cursos', 'CursoController@index');
Route::get('/alunos', 'AlunoController@index');
Route::get('/aluno/{matricula}', 'AlunoController@aluno');
Route::get('/categorias', 'CategoriaAcgController@index');
Route::get('/acgs', 'AcgController@index');
Route::get('/acg-unica/{id}', 'AcgController@acgUnica');
Route::get('/acgs-aluno/{matricula}', 'AcgController@porAluno');
Route::get('/acgs-horas/{matricula}', 'AcgController@totalHorasAluno');
Route::post('/acg', 'AcgController@store');
Route::post('/acg-atualizar-status', 'AcgController@alterarStatus');
Route::get('/enviar-email', 'EmailController@enviarEmail');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
