<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 

class Post extends Model
{
    protected $fillable = ['title', 'body'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
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
     * return a url for the current selected post
     */
    public function getUrlAttribute()
    {
        return route("posts.show", $this->slug);
    }

    /**
     * This to created date of creation
     * fot a post
     */
    public function getCreatedDateAttribute(){
        return $this->created_at->format("d/m/Y");
    }

    /**
     * check the status of eaach post
     */
    public function getStatusAttribute()
    {
        if ($this->posts_count > 0) {
            if ($this->best_post_id) {
                return "posted-accepted";
            }
            return "posted";
        }
        return "unposted";
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    /**
     * call and finds the best comment id
     * 
     */
    public function acceptBestComment(Comment $comment)
    {
        $this->best_comment_id = $comment->id;
        $this->save();
    }

    
}
