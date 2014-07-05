<?php
namespace IMDBParser\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {
    protected $fillable = array('title', 'year', 'season', 'episode_number', 'episode_name');
    protected $guarded = array('id', 'updated_at', 'created_at');


    public function genres() {
        return $this->belongsToMany('\IMDBParser\Models\Genre');
    }

    // public function people() {
    //     return $this->belongsToMany('\Models\Person', 'movie_people');
    // }

    public static function allByAttributes($attributes) {
        $query = static::query();

        foreach ($attributes as $key => $value)
        {
            $query->where($key, $value);
        }

        return $query->get()->all() ?: null;
    }

    public function hasGenre($name = '') {
        return !$this->genres->filter(function($genre) use ($name) {
            return $genre->name == $name;
        })->isEmpty();
    }
}