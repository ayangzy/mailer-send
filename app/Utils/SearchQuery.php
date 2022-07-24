<?php

namespace App\Utils;

use App\Models\Email;
use App\Models\Recipient;
use Illuminate\Http\Request;

class SearchQuery
{
    public function searchEmail(Request $request)
    {
        $searchString = $request->input('search');

        $email = Email::where('from', 'LIKE', '%' . $searchString . '%')
        ->orWhere('subject', 'LIKE', '%' . $searchString . '%')->paginate(10);

        return $email;
       
    }

    public function searchRecipient(Request $request)
    {
        $searchString = $request->input('search');
        $recipient = Recipient::where('to', 'LIKE', '%' . $searchString . '%')->paginate(10);
        return $recipient;
    }

}
