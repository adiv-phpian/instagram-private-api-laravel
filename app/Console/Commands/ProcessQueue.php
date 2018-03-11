<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

       $likes_queue = Queue::where(["onqueue" => 0])->inRandomOrder()->get();

       foreach($likes_queue as $like_queue){

         $users = IPModel::select("instagram_user_id")->where("instagram_user_id", "!=", $like_queue->instagram_user_id)->take($like_queue->count)->inRandomOrder()->get();

         foreach($users as $user){

           $queue = array('instagram_user_id' => $user->instagram_user_id,
                         'target_id' => $like_queue->instagram_user_id,
                         'action_id' => $like_queue->action_id,
                         'media_id' => $like_queue->media_id,
                         'comment' => $like_queue->comment);

           ProcessQueue::updateOrCreate(['instagram_user_id' => $user->instagram_user_id,
                                         'target_user_id' => $like_queue->instagram_user_id,
                                         'action_id' => $like_queue->action_id],
                                          $queue);
         }

         Queue::where("id", $like_queue->id)->update(["onqueue" => 1]);

       }
    }
}
