<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id'];

    /**
     * elequent fixed bugs
     */
    public static function boot()
    {
        parent::boot();
        static::created(function ($comment) {
            $comment->post->increment('comments_count');
        });        

        static::deleted(function ($comment) {
            $post = $comment->post;
            $post->decrement('comments_count');
            if ($post->best_comment_id === $comment->id) {
                $post->best_comment_id = NULL;
                $post->save();
            }
        });
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

     /**
     * This to created date of creation
     * for a comment
     */
    public function getCreatedDateAttribute(){
        return $this->created_at->format("d/m/Y");
    }

    public function getStatusAttribute()
    {
        return $this->id === $this->post->best_comment_id ? 'like-accepted' : '';
    }
    
}
