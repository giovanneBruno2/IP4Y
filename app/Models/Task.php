<?php

namespace App\Models;

use App\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'conclusion_date',
        'projects_id',
        'assigned_to',
    ];
    public function getTitle() {
        return $this->getAttribute('title');
    }

    public function setTitle($title) {
        return $this->setAttribute('title', $title);
    }

    public function getDescription()
    {
        return $this->getAttribute('description');
    }

    public function setDescription($description){
        return $this->setAttribute('description', $description);
    }

    public function getStatus(){
        return $this->getAttribute('status');
    }

    public function setStatus($status){
        return $this->setAttribute('status', $status);
    }

    public function getDueDate(){
        return $this->getAttribute('due_date');
    }

    public function setDueDate($due_date){
        return $this->setAttribute('due_date', $due_date);
    }

    public function getConclusionDate(){
        return $this->getAttribute('conclusion_date');
    }

    public function setConclusionDate($conclusion_date){
        return $this->setAttribute('conclusion_date', $conclusion_date);
    }

    public function setProjectsId($projectId){
        return $this->setAttribute('projects_id', $projectId);
    }

    public function getProjectId(){
        return $this->getAttribute('projects_id');
    }

    public function setAssignedTo($assignedTo){
        return $this->setAttribute('assigned_to', $assignedTo);
    }

    public function getAssignedTo(){
        return $this->getAttribute('assigned_to');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }


}
