<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\EmailService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\EmailRequest;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    /**
     * Display a listing of Emails sent.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $emails = (new EmailService())->getEmails();

        return $this->successResponse('Email retrieved successfully', $emails);
    }
    
     /**
     * Store a newly created email.
     *
     * @param  \App\Http\Requests\EmailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailRequest $request): JsonResponse
    {
        $email = (new EmailService())->sendEmail($request);

        return $this->successResponse('Email posted successfully');
    }
}
