<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 

class Question extends Model
{
    protected $fillable = ['title', 'body'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Mutator method to set up the slug
     * automatically
     */
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * URL accessor
     * return a url for the current selected question
     */
    public function getUrlAttribute()
    {
        return route("questions.show", $this->slug);
    }

    /**
     * This to created date of creation
     * fot a question
     */
    public function getCreatedDateAttribute(){
        return $this->created_at->format("d/m/Y");
    }

    /**
     * check the status of eaach question
     */
    public function getStatusAttribute()
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    /**
     * transform the text that wa enter
     * to html to be able to display in the 
     * bronswer in html
     */
    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    /**
     * Set the best answer for a specific post
     * and save it to the database
     */
    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answers_id = $answer->id;
        $this->save();
    }

    /**
     * 
     *  The many to many relationship
     * a question can been favourited by many user
     * and vice versa
     */
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps(); 
    }

    /**
     * Retur the colleciton of favourided questions if there exist = true
     * if not false
     */
    public function isFavorited()
    {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    /**
     * accesor
     * Get and reutrn if the question has
     * been favourited by the user or not
     */
    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    /**
     * Accesor
     * countes the favourites question of a user
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    /**
     * A poymorpihc relation set up
     */
    public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }

    /**
     * if the user have give the positive thumbs up
     * add a +1 vote and return it
     */
    public function upVotes()
    {
        return $this->votes()->wherePivot('vote', 1);
    }

    /**
     * if the user have give the negative thumbs down
     * add a -1 vote and return it
     */
    public function downVotes()
    {
        return $this->votes()->wherePivot('vote', -1);
    }
}
