<?php

use App\Services\PdfWrapper;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Spatie\Browsershot\Browsershot;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $pdf = (new PdfWrapper())
        ->loadView('pdfs.charts', [
            'title' => 'pie chart',
        ]);

    Mail::send('emails.test', [], function ($message) use ($pdf) {
        $message->to('abc@gmail.com');
        $message->attachData($pdf->generate()->pdf(), 'doc.pdf', [
            'mime' => 'application/pdf',
        ]);
    });

    dd('done');
});
