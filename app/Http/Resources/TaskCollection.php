<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($task) {
            return [
                'id' => $task->id,
                'creator_id' => $task->creator_id,
                'title' => $task->title,
                'is_done' => $task->is_done,
                'status' => $task->is_done ? 'Done' : 'Pending',
                // Ajoutez d'autres champs de tâche ici si nécessaire
            ];
        });
    }
}
