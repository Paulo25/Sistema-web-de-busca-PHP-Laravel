<?php
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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

/******** ROTAS DE SITE ********/
route::middleware('checkRequest')->group(function () {
    Route::get('/', 'BuscaController@index')->name('site.buscaController.index');
    Route::get('/buscar', 'BuscaController@buscar')->name('site.buscaController.buscar');
    Route::get('/busca-associada/{nome}', 'BuscaController@buscarPalavraAssociada')->name('site.buscaController.buscarPalavraAssociada');
});


/******** ROTAS DE SYSTEM ********/
Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'system'], function () {
        Route::get('/', 'AdminController@home')->name('system.adminController.home');
        Route::get('/index', 'AdminController@index')->name('system.adminController.index');
        Route::get('/search', 'AdminController@search')->name('system.adminController.search');
        Route::get('/create', 'AdminController@create')->name('system.adminController.create');
        Route::post('/store', 'AdminController@store')->name('system.adminController.store');
        Route::get('/edit/{id}', 'AdminController@edit')->name('system.adminController.edit')->middleware('CheckId:system');
        Route::post('/update/{id}', 'AdminController@update')->name('system.adminController.update');
        Route::get('/delete/{id}', 'AdminController@delete')->name('system.adminController.delete');
        Route::delete('/destroy/{id}', 'AdminController@destroy')->name('system.adminController.destroy');

        Route::get('/show-imagem', 'AdminController@imagem')->name('system.adminController.imagem');
        Route::get('/deleteImagem/{id}', 'AdminController@imagemDelete')->name('system.adminController.imagemDelete');
        Route::delete('/ImagemDestroy/{id}', 'AdminController@imagemDestroy')->name('system.adminController.imagemDestroy');
        Route::get('/imagem-download/{id}', 'AdminController@imagemDownload')->name('system.adminController.imagemDownload');

        Route::get('/exportacao', 'AdminController@export')->name('system.adminController.export');

        Route::get('/dashboard', 'DashboardController@index')->name('system.dashboardController.index');

        Route::get('/notificacao', 'NotificacaoController@index')->name('system.notificacaoController.index');
        Route::post('/envio-notificao', 'NotificacaoController@sendNotify')->name('system.notificacaoController.sendNotify');

        Route::group(['prefix' => 'user'], function () {
            Route::get('/index', 'UsuarioController@index')->name('system.usuarioController.index');
            Route::get('/edit/{id}', 'UsuarioController@edit') ->name('system.usuarioController.edit');
            Route::put('/update/{id}', 'UsuarioController@update')->name('system.usuarioController.update');
            Route::post('/edit-status-user/{idUser}', 'UsuarioController@alterStatusUser')->name('system.usuarioController.alterStatusUser');
        });
    });
});

/******** ROTAS DE AUTENTICAÇÃO ********/
Route::group(['prefix' => 'le'], function () {
    Auth::routes();

    //Route::get('login', 'Auth\LoginController@showLoginForm')->name('system.login');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/resetar/senha', 'Auth\ForgotPasswordController@sendNewPassword')->name('password.reset');
});

/******** ROTAS DE NOTIFICAÇÃO COM FCM FIREBASE ********/
Route::post('/saveToken', 'NotificacaoController@saveToken')->name('notificacao.saveToken');



Route::get('storage', function (Request $request) {
    $path = storage_path('/app/public/' . $request->path);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->name('storage');

