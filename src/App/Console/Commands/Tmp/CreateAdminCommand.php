<?php

namespace App\Console\Commands\Tmp;

use Domain\Authentication\Models\User;
use Illuminate\Console\Command;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmp:management:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin User';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        User::create([
            'name' => env('ADMIN_USER_NAME'),
            'email' => env('ADMIN_USER_EMAIL'),
            'password' => bcrypt(env('ADMIN_USER_PASSWORD')),
        ]);

    }
}
