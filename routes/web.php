<?php

use Illuminate\Support\Facades\Route;
use \CloudConvert\Laravel\Facades\CloudConvert;
use \CloudConvert\Models\Job;
use \CloudConvert\Models\Task;


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

Route::get('/', function () {
    CloudConvert::jobs()->create(
        (new Job())
        ->setTag('myjob-123')
        ->addTask(
            (new Task('import/url', 'import-my-file'))
                ->set('url','https://bsd.pendidikan.id/data/2013/kelas_11sma/siswa/Kelas_11_SMA_Matematika_Siswa_Semester_1.pdf')
        )
        ->addTask(
            (new Task('convert', 'convert-my-file'))
                ->set('input', 'import-my-file')
                ->set('output_format', 'docx')
                ->set('some_other_option', 'value')
        )
        ->addTask(
            (new Task('export/url', 'export-my-file'))
                ->set('input', 'convert-my-file')
        )
    );
});
