<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function parent()
    {
        return $this->belongsTo(Branch::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Branch::class, 'parent_id', 'id');
    }

    public function getSectionTitleAttribute()
    {
        return $this->section->title;
    }

    public function getParentTitleAttribute()
    {
        return $this->parent ? $this->parent->title : 'No Parent';
    }

    public function themes()
    {
        return $this->hasMany(Theme::class, 'branch_id', 'id');
    }
}
