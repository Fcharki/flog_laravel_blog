<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Insert 6 demo users (with bio + occupation + avatar).
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Amina El Idrissi',
                'email' => 'amina.elidrissi@example.com',
                'occupation' => 'Software Engineer',
                'bio' => 'Turning coffee into clean, maintainable code and sharing what I learn along the way.',
            ],
            [
                'name' => 'Omar Benali',
                'email' => 'omar.benali@example.com',
                'occupation' => 'Data Scientist',
                'bio' => 'I translate messy data into clear stories and love explaining the math behind the magic.',
            ],
            [
                'name' => 'Sofia Marquez',
                'email' => 'sofia.marquez@example.com',
                'occupation' => 'Product Designer',
                'bio' => 'Designer who believes great products start with empathy and end with delightful details.',
            ],
            [
                'name' => 'James Carter',
                'email' => 'james.carter@example.com',
                'occupation' => 'Journalist & Blogger',
                'bio' => 'Chasing stories that matter, one byline at a time. Journalism with a human touch.',
            ],
            [
                'name' => 'Layla Hasnaoui',
                'email' => 'layla.hasnaoui@example.com',
                'occupation' => 'Content Strategist',
                'bio' => 'Helping brands find their voice and audiences find their next favorite read.',
            ],
            [
                'name' => 'Noah Williams',
                'email' => 'noah.williams@example.com',
                'occupation' => 'Photographer',
                'bio' => 'Documenting the world through a lens — light, shadow, and everything in between.',
            ],
        ];

        foreach ($users as $index => $user) {
            $email = $user['email'];

            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $user['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'occupation' => $user['occupation'],
                    'bio' => $user['bio'],
                    'avatar' => 'https://picsum.photos/seed/flog-user-'.($index + 1).'/160/160',
                ]
            );
        }
    }
}