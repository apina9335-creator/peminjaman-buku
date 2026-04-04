<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ReviewReply extends Model
{
    protected $fillable = ['user_id', 'review_id', 'reply_text'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}