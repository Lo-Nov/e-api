<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 5/20/2019
 * Time: 11:39 AM
 */


namespace App\Exceptions;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;


trait ExceptionTrait{
    public function apiException($request, $e){
        if ($this->isModel($e)){
            return $this->modelResponse($e);
        }

            if ($this->isHttp($e)){
                return $this->HttpResponse($e);
            }

                return parent::render($request, $exception);

    }

    protected  function isModel($e){
        return $e instanceof ModelNotFoundException;
    }
    public function isHttp($e){
        return $e instanceof NotFoundHttpException;
    }

    protected function modelResponse($e){
        return response()->json([
            'errors'=> 'Model Product not found'
        ],Response::HTTP_NOT_FOUND);
    }

    protected function HttpResponse($e){
        return response()->json([
            'errors'=>'Incorrect route'
        ],Response::HTTP_NOT_FOUND);
    }

}