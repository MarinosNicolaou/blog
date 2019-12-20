<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['body', 'user_id'];

    protected $appends = ['created_date', 'body_html', 'is_best'];


    /**
     * elequent fixed bugs
     */
    public static function boot()
    {
        parent::boot();
        static::created(function ($answer) {
            $answer->question->increment('answers_count');
        });        

        static::deleted(function ($answer) {
            $question = $answer->question;
            $question->decrement('answers_count');
            if ($question->best_answer_id === $answer->id) {
                $question->best_answer_id = NULL;
                $question->save();
            }
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

    /**
     * give the status for the best annswer if
     * it is there
     */
    public function getStatusAttribute()
    {
        return $this->isBest() ? 'vote-accepted' : '';
    }

    /**
     * This function get the is best attribute
     */
    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

    /**
     * return the best answer
     */
    public function isBest()
    {
        return $this->id === $this->question->best_answers_id;
    }

    /**
     * This function is for a polymorfic relationship
     */
    public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }

    public function upVotes()
    {
        return $this->votes()->wherePivot('vote', 1);
    }
    
    public function downVotes()
    {
        return $this->votes()->wherePivot('vote', -1);
    }
}
