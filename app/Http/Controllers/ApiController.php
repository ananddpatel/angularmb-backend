<?php

namespace App\Http\Controllers;

use Validator;

class ApiController extends Controller
{
	/**
	 * validates if model already exists
	 * @param  array $rules the validation rules
	 * @return Validator
	 */
    protected function validateStore($rules)
    {
        return Validator::make(request()->all(), $rules); 
    }

    /**
     * base respond method
     * @param  array $data the data to respond with
     * @param  int $code the status code
     */
    protected function respond($data, $code, $headers = [])
    {
        return response($data, $code, $headers);
    }

    protected function respondCreated($msg = 'Created Successfully')
    {
        return $this->respond(['status' => $msg], 201);
    }

    public function respondBadRequest($msg = 'Bad Request')
    {
        return $this->respond(['status' => $msg], 400);
    }

    public function respondNotFound($msg = 'Resource Not Found')
    {
        return $this->respond(['status' => $msg], 404);
    }

    public function respondOk($data, $msg = 'Ok')
    {
        return $this->respond(['status' => $msg], 200);
    }

    public function respondOkWithData($data, $msg = 'Ok')
    {
        $newData = [
            'data' => $data,
            'status' => $msg
        ];
        return $this->respond($newData, 200);
    }

}