<?php

namespace App\Models\DTO;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Date;

class ProjectRequestDTO
{
    public string $id;
    public string $name;
    public User $user_id;
    public string $description;
    public string $status;
    public string $deadline;
    public date $created_at;
    public date $updated_at;

    public static function from($project)
    {
        $dto = new self();
        $dto->id = $project->id;
        $dto->name = $project->name;
        $dto->user_id = $project->user_id;
        $dto->description = $project->description;
        $dto->status = $project->status;
        $dto->deadline = $project->deadline;
        $dto->created_at = $project->created_at;
        $dto->updated_at = $project->updated_at;
        return $dto;
    }

    public static function all()
    {
        return new self();
    }
}