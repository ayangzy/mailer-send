<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const POSTED = 'posted';
    public const SENT = 'sent';
    public const FAILED = 'failed';

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function recipients()
    {
        return $this->hasMany(Recipient::class);
    }
}
