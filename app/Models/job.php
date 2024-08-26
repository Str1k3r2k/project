<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class job extends Model {
    protected $table = 'job_listings';

    protected $fillable = ['title', 'salary'];

    public function employer() {
        return $this->belongsTo(Employer::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, foreignPivotKey: "job_listing_id");
    }
}