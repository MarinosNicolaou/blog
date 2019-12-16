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
        return route("questions.show", $this->id);
    }

    /**
     * This to created date of creation
     * fot a question
     */
    public function getCreatedDateAttribute(){
        return $this->created_at->format("d/m/Y");
    }
}
