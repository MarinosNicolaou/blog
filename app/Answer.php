<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * elequent fixed bugs
     */
    public static function boot()
    {
        parent::boot();
        static::created(function ($answer) {
            $answer->question->increment('answers_count');
            $answer->question->save();            
        });        
    }
    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

     /**
     * This to created date of creation
     * for a answers
     */
    public function getCreatedDateAttribute(){
        return $this->created_at->format("d/m/Y");
    }
}
