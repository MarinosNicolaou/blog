<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    
    protected $appends = ['url', 'avatar'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * URL accessor
     * return a url for the current selected question
     */
    public function getUrlAttribute()
    {
        //return route("questions.show", $this->id);
        return '#';
    }

    /**
     * return avatar for each user
     */
    public function getAvatarAttribute()
    {
        $email = $this->email;        
        $size = 40;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    /**
     * This function is for the many to many relationships
     * So a user can has many favourites questions
     * And a question can been favourited by many users
     */
    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
    }

    /**
     * This function is for a polymorfic relationship
     */
    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'votable');
    }

    /**
     * This function is for a polymorfic relationship
     */
    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'votable');
    }

    /**
     * is this function the user vote a question
     * and then we recount the total number of votes 
     * and  we updated them 
     */
    public function voteQuestion(Question $question, $vote)
    {
        $voteQuestions = $this->voteQuestions();
        //call the functinon vote to recount and update
        $this->_vote($voteQuestions, $question, $vote);
    }

    /**
     * is this function the user vote an answer
     * and then we recount the total number of votes 
     * and  we updated them 
     */
    public function voteAnswer(Answer $answer, $vote)
    {
        $voteAnswers = $this->voteAnswers();
        //call the functinon vote to recount and update
        $this->_vote($voteAnswers, $answer, $vote);
    }    

    private function _vote ($relationship, $model, $vote)
    {   

        if ($relationship->where('votable_id', $model->id)->exists()) {
            $relationship->updateExistingPivot($model, ['vote' => $vote]);
        }
        else {
            $relationship->attach($model, ['vote' => $vote]);
        }
        //refresh the vote relationship
        $model->load('votes');
        //sum the negative votes
        $downVotes = (int) $model->downVotes()->sum('vote');
        //sun the positive votes
        $upVotes = (int) $model->upVotes()->sum('vote');
        //find the votes numbers
        $model->votes_count = $upVotes + $downVotes;
        //save to the database and uplaod
        $model->save();
    }
}
