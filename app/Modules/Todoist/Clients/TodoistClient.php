<?php

namespace App\Modules\Todoist\Clients;


use Illuminate\Support\Facades\Http;

class TodoistClient
{
    private string $hostName;

    private string $commentsEndpoint;

    private string $token;

    private string $taskId;

    public function __construct() {
        $this->token = config('services.todoist.token');
        $this->hostName = config('services.todoist.host_name');
        $this->commentsEndpoint = config('services.todoist.comments_endpoint');
        $this->taskId = config('services.todoist.task_id');
    }

    public function addCommentToTask(): void
    {
        Http::withToken($this->token)
            ->post($this->hostName.$this->commentsEndpoint, [
                "content"=> "I am a comment",
                "task_id"=> $this->taskId
            ]);
    }
}
