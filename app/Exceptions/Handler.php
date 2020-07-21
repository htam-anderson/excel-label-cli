<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Str;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Symfony\Component\Console\Exception\RuntimeException::class,
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        if ($exception instanceof RuntimeException) {
            if (Str::contains($exception->getMessage(), ['Not enough arguments'])) {
                return;
            }
        }

        if ($exception instanceof \PhpOffice\PhpSpreadsheet\Exception) {
            if (Str::contains($exception->getMessage(),['not found!'])) {
                echo PHP_EOL;
                print('The label image is not found. Please contact the developer for help.');
                die;
            }
        }

        if (Str::contains($exception->getMessage(),['mkdir(): File exists'])){
            echo PHP_EOL;
            print('The Output folder already exist! Please remove it and try again.');
            die;
        }

        if (Str::contains($exception->getMessage(),['Formula Error'])){
            echo PHP_EOL;
            print('Your excel files have Formular Error:');echo PHP_EOL;
            print($exception->getMessage());echo PHP_EOL;
            print('Please recheck it and try again.');echo PHP_EOL;
            die;
        }
    
        parent::report($exception);
    }
}