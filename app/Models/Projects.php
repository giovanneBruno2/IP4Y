<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_title',
        'description',
        'completion_dates',
    ];
    public function getId() {
        $this->getAttribute('id');
    }

    public function setId($id) {
        $this->setAttribute('id', $id);
    }

    public function getProjectTitle(){
        return $this->getAttribute('project_title');
    }

    public function setProjectTitle($title) {
        $this->setAttribute('project_title', $title);
    }

    public function getDescription(){
        return $this->getAttribute('description');
    }

    public function setDescription($description) {
        $this->setAttribute('description', $description);
    }

    public function getCompletationDate(){
        return $this->getAttribute('completion_dates');
    }

    public function setCompletationDate($date) {
        $this->setAttribute('completion_dates', $date);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
