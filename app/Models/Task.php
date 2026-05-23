<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Task extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'project_id',
        'client_id',
        'user_id',
        'deadline',
        'status'
    ];

    public function casts() {
        return [
            'status' => TaskStatus::class,
            'deadline' => 'datetime'
        ];
    }

    public function registerMediaCollections() : void {
        $this->addMediaCollection('attachments')->useDisk('local');
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    #[Scope]
    protected function filerStatus(Builder $query, ?TaskStatus $status = null){
        return $query->when($status, function($query, $status) {
            return $query->where('status', $status);
        });
    }
    
}
