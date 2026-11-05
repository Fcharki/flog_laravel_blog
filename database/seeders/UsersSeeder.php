<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Create non-login author accounts for the seeded sample posts.
     */
    public function run(): void
    {
        $authors = [
            [
                'name' => 'Samira El Amrani',
                'email' => 'samira.author@example.invalid',
                'occupation' => 'Science Writer',
                'bio' => 'Exploring the ideas and discoveries that help explain our world.',
                'avatar' => 'https://picsum.photos/seed/flog-author-samira/160/160',
            ],
            [
                'name' => 'Youssef Bennani',
                'email' => 'youssef.author@example.invalid',
                'occupation' => 'Space Reporter',
                'bio' => 'Writing about the Moon, distant worlds, and the people who study them.',
                'avatar' => 'https://picsum.photos/seed/flog-author-youssef/160/160',
            ],
            [
                'name' => 'Maya Haddad',
                'email' => 'maya.author@example.invalid',
                'occupation' => 'Historian',
                'bio' => 'Connecting events from the past with the questions we ask today.',
                'avatar' => 'https://picsum.photos/seed/flog-author-maya/160/160',
            ],
        ];

        foreach ($authors as $author) {
            User::firstOrCreate(
                ['email' => $author['email']],
                [
                    'name' => $author['name'],
                    'password' => Hash::make(Str::random(64)),
                    'email_verified_at' => now(),
                    'occupation' => $author['occupation'],
                    'bio' => $author['bio'],
                    'avatar' => $author['avatar'],
                ]
            );
        }
    }
}
