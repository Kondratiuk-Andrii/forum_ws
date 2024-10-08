<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function branches()
    {
        return $this->hasMany(Branch::class, 'section_id', 'id');
    }

    public function parentBranches()
    {
        return $this->hasMany(Branch::class, 'section_id', 'id')
            ->whereNull('parent_id');
    }
}
