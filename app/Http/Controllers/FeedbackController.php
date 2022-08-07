<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedbacks.index');
    }

    public function store(FeedbackRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $data['user_id'] = $user->id??null;
        $feedback = Feedback::create($data);
        $feedback->addAttachment($request->file, 'file');
        $feedback->addAttachment($request->image, 'image');

        if (Setting::get('email_feedback')) {
            Mail::to(Setting::get('email_feedback_to'))->send(new FeedbackMail($feedback));
        }

        return $this->jsonSuccess('Feedback send successfully', [
            'redirect' => route('feedbacks.index')
        ]);
    }
}
