<?php
namespace IMDBParser\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model {
    protected $fillable = array('name');
    protected $guarded = array('id', 'updated_at', 'created_at');

    public function movies() {
        return $this->belongsToMany('\IMDBParser\Models\Movie');
    }
}