<?php

namespace Mosweed\Mosweed_cms\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminCommand extends Command
{
    protected $signature = 'create:admin';

    protected $description = 'Create a new admin user';

    public function handle()
    {
        $this->info('Creating a new admin user...');

        $firstname = $this->ask('What is your first name?', 'Admin');
        $lastname = $this->ask('What is your last name?', 'User');
        $email = $this->ask('What is your email?', 'admin@admin.com');
        $password = $this->ask('What is your password?', 'password');
        $phonenumber = $this->ask('What is your phone number?', '0612345678');

        if ($firstname != null && $lastname != null && $email != null && $password != null && $phonenumber != null) {
            $validator = Validator::make([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $password,
                'phonenumber' => $phonenumber,
            ], [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'phonenumber' => 'required|string|min:10|max:255|regex:/^([0-9\s\-\+\(\)]*)$/|starts_with:06,+31,04',
            ]);

            if ($validator->fails()) {
                $this->error($validator->errors()->first());
                //sleep(30);

                $this->info('etstttt');
                $this->handle();
            }

            $name = $firstname.' '.$lastname;

            if ($this->confirm("Do you wish to create user {$name} with email {$email}?", true)) {

                $user = User::forceCreate([
                    'name' => $firstname.' '.$lastname,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'role' => '1',
                    'email_verified_at' => now(),
                ]);

                $user->customer()->create([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'phonenumber' => $phonenumber,
                    'email' => $email,
                ]);

                $this->info('Admin user created successfully!');

            } else {
                return $this->warn('Canceling creation of Admin User!');
            }

        }

    }
}