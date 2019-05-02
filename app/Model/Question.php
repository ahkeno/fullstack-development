<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Reply;
use App\User;
use App\Model\Category;

class Question extends Model
{   
    protected $guarded = []; //to avoid delcare many fileds 

    protected $with = ['replies'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($question){
            $question->slug = str_slug($question->title);
        });
    }
    public function getRouteKeyName(){
        return 'slug';
    }
    // protected $fillable = ['title','slug','body','category_id','user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
       return $this->hasMany(Reply::class);
    }
    public function category(){

        return $this->belongsTo(Category::class);
    }
    public function getPathAttrubute()
    {
        return "question/$this->slug";
    }
}
