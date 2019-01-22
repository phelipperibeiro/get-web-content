<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It is a breeze. Simply tell Lumen the URIs it should respond to
  | and give it the Closure to call when that URI is requested.
  |
 */

use Illuminate\Http\Request;
use GuzzleHttp\Client;


$router->get('/', function () use ($router) {
    return view('home', []);
});

$router->get('/download-file/{file}', function ($file) use ($router) {
       
    $path = storage_path("app/files/$file.jpeg");

    return response()->download($path);
});

$router->delete('/delete-file', function (Request $request) use ($router) {

    $file = $request->input('file');
    
    if (!Storage::exists($file)) {
        return 'File not found';
    }
    
    Storage::delete($file);
    
    return 'file deleted successfully';
    
});

$router->get('/load-files', function (Request $request) use ($router) {

    return array_filter(Storage::disk('local')->files(), function ($item) {
        return strpos($item, 'jpeg');
    });
});

$router->post('/save-file', function (Request $request) use ($router) {

    $this->validate($request, [
        'link' => 'required'
    ]);

    $link = $request->input('link');
    $fileName = $request->input('fileName');
    $fileName = empty($fileName) ? md5(uniqid(rand(), true)) : $fileName;
    $fileName = "$fileName.jpeg";


    $GuzzleHttp = new Client();
    $response = $GuzzleHttp->request('GET', $link);
    $contents = $response->getBody()->getContents();


    if (Storage::exists($fileName)) {
        //abort(422, 'file already exists');
        return 'file already exists';
    }

    Storage::disk('local')->put($fileName, $contents);

    return 'file successfully downloaded';
});
