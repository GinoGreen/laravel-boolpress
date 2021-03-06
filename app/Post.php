<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $fillable = ['title', 'content', 'slug', 'category_id', 'cover', 'cover_original_name'];

   public function category() {
      return $this->belongsTo('App\Category');
   }

   public function tags() {
      return $this->belongsToMany('App\Tag');
   }

   public static function generateUniqueSlug($string) {
      $slug = Str::slug($string, '-');
      $originalSlug = $slug;
      $foundSlug = Post::where('slug', $slug)->first();
      $count = 1;
      while ($foundSlug) {
         $slug = $originalSlug . '-' . $count++;
         $foundSlug = Post::where('slug', $slug)->first();
      }
      return $slug;
   }
}
