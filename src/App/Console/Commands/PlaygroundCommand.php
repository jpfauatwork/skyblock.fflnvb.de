<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class PlaygroundCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel:playground';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing Stuff';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = new User();
        $user->password = Hash::make('Kartoffelsalat');
        $user->email = 'offlinevibe@gmail.com';
        $user->name = 'SaintOffline';
        $user->save();
    }
}
