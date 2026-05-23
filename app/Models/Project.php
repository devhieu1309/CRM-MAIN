<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'status',
        'deadline',
        'client_id',
        'user_id'
    ];

    public function casts(){
        return [
            'status' => ProjectStatus::class,
            'deadline' => 'datetime'
        ];
    }

    public function registerMediaCollections() : void {
        $this->addMediaCollection('attachments')->useDisk('local');
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    // #[Scope]
    // protected function filerStatus(Builder $query, ?TaskStatus $status = null){
    //     return $query->when($status, function($query, $status) {
    //         return $query->where('status', $status);
    //     });
    // }

   #[Scope] 
   protected function filterStatus(Builder $query, ?ProjectStatus $status = null){
        return $query->when($status, function($query, $status){
            return $query->where('status', $status);
        });
   }
}
