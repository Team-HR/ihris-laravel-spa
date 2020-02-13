<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'name',
        'function',
        'level',
        'category',
        'sg',
    ];

    protected $appends = [
        'sorted_list'
    ];

public function getSortedListAttribute()
{
	return ($this->function?$this->function." - ".$this->name: $this->name);
}


}
