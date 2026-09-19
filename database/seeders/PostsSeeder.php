<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Insert 12 demo posts (2 per seeded user) with rich HTML bodies and covers.
     */
    public function run(): void
    {
        $authors = User::whereIn('email', [
            'amina.elidrissi@example.com',
            'omar.benali@example.com',
            'sofia.marquez@example.com',
            'james.carter@example.com',
            'layla.hasnaoui@example.com',
            'noah.williams@example.com',
        ])->get();

        $posts = [
            [
                'email' => 'amina.elidrissi@example.com',
                'title' => 'Building Habits That Actually Stick',
                'category' => 'Psychology',
                'body' => '<h2>Why willpower is overrated</h2>'
                    .'<p>Most people fail to build new habits because they rely on motivation instead of systems. '
                    .'Motivation fades, but a well-designed environment keeps you moving forward.</p>'
                    .'<ul><li>Start tiny: make the habit so easy you cannot say no.</li>'
                    .'<li>Anchor it to an existing routine.</li>'
                    .'<li>Track progress and celebrate small wins.</li></ul>'
                    .'<p>Consistency beats intensity every single time.</p>',
            ],
            [
                'email' => 'amina.elidrissi@example.com',
                'title' => 'A Beginners Roadmap to Modern Web Development',
                'category' => 'Web Development',
                'body' => '<h2>Where do you even start?</h2>'
                    .'<p>The web moves fast, but the fundamentals never change. Master HTML, CSS and JavaScript '
                    .'before reaching for any framework.</p>'
                    .'<ul><li>Learn the basics of the browser and the DOM.</li>'
                    .'<li>Build three small projects with vanilla code.</li>'
                    .'<li>Only then explore React, Vue or Laravel.</li></ul>'
                    .'<p>A solid foundation makes every new tool easier to learn.</p>',
            ],
            [
                'email' => 'omar.benali@example.com',
                'title' => 'Why Data-Driven Decisions Win',
                'category' => 'Business',
                'body' => '<h2>Intuition has limits</h2>'
                    .'<p>Gut feeling gets you started, but data keeps you honest. Teams that measure their '
                    .'decisions consistently outperform those that guess.</p>'
                    .'<p>The goal is not to remove judgment — it is to inform it.</p>',
            ],
            [
                'email' => 'omar.benali@example.com',
                'title' => 'Understanding Neural Networks in Plain English',
                'category' => 'Artificial Intelligence',
                'body' => '<h2>No PhD required</h2>'
                    .'<p>A neural network is just a function that learns. You give it examples, it adjusts its '
                    .'internal numbers, and eventually it recognizes patterns on its own.</p>'
                    .'<p>Think of it as tuning an instrument by ear — practice makes it sharper.</p>',
            ],
            [
                'email' => 'sofia.marquez@example.com',
                'title' => 'Designing Interfaces Users Love',
                'category' => 'Arts',
                'body' => '<h2>Great design is invisible</h2>'
                    .'<p>When a product just works, no one notices the design — and that is the point. '
                    .'Clarity, hierarchy and feedback are the real ingredients.</p>'
                    .'<ul><li>Remove everything that does not help.</li>'
                    .'<li>Make the important things obvious.</li>'
                    .'<li>Let every action respond.</li></ul>',
            ],
            [
                'email' => 'sofia.marquez@example.com',
                'title' => 'The Subtle Art of Color in Product Design',
                'category' => 'Arts',
                'body' => '<h2>Color communicates before words do</h2>'
                    .'<p>Color sets the emotional tone of a product. Warm hues invite, cool tones reassure, '
                    .'and contrast guides attention exactly where it should go.</p>'
                    .'<p>Choose a palette with intention, not by accident.</p>',
            ],
            [
                'email' => 'james.carter@example.com',
                'title' => 'Lessons From Field Reporting',
                'category' => 'Culture',
                'body' => "<h2>Showing up is the story</h2>"
                    .'<p>The most honest reporting happens when you simply show up, listen closely, and let '
                    .'people tell their own stories in their own words.</p>'
                    ."<p>Empathy is the reporter's most underrated tool.</p>",
            ],
            [
                'email' => 'james.carter@example.com',
                'title' => 'The Rise of Slow Journalism',
                'category' => 'Culture',
                'body' => '<h2>Less noise, more meaning</h2>'
                    .'<p>In an age of 24-hour headlines, slow journalism trades speed for depth. The result is '
                    .'reporting that still matters weeks after it is published.</p>',
            ],
            [
                'email' => 'layla.hasnaoui@example.com',
                'title' => 'Crafting Editorial Calendars That Resonate',
                'category' => 'Business',
                'body' => '<h2>Plan ahead, publish with purpose</h2>'
                    .'<p>An editorial calendar turns scattered ideas into a steady rhythm. Map topics to '
                    .'audience needs and let data guide the next move.</p>'
                    .'<ul><li>Keep a running backlog of ideas.</li>'
                    .'<li>Batch similar work together.</li>'
                    .'<li>Review what resonated each month.</li></ul>',
            ],
            [
                'email' => 'layla.hasnaoui@example.com',
                'title' => 'Storytelling as a Growth Strategy',
                'category' => 'Entertainment',
                'body' => '<h2>People remember stories, not features</h2>'
                    .'<p>Facts inform but stories move. When a brand shares a real journey, audiences lean in, '
                    .'trust builds, and growth follows as a side effect.</p>',
            ],
            [
                'email' => 'noah.williams@example.com',
                'title' => 'Chasing Light: Basics of Outdoor Photography',
                'category' => 'Arts',
                'body' => '<h2>The golden hour is your friend</h2>'
                    .'<p>Great outdoor photographs are less about expensive gear and more about finding the '
                    .'right light at the right moment.</p>'
                    .'<ul><li>Shoot during sunrise and sunset.</li>'
                    .'<li>Use shadows to add depth.</li>'
                    .'<li>Be patient — the scene will reward you.</li></ul>',
            ],
            [
                'email' => 'noah.williams@example.com',
                'title' => 'Documentary Photography Ethics',
                'category' => 'Culture',
                'body' => '<h2>With great power comes responsibility</h2>'
                    .'<p>Every frame you publish changes how people see a subject. Respect dignity, seek '
                    .'consent, and let the truth guide your edits.</p>',
            ],
        ];

        foreach ($posts as $index => $post) {
            $author = $authors->firstWhere('email', $post['email']);

            if (! $author) {
                continue;
            }

            $categoryId = Category::where('category_name', $post['category'])->value('id');
            $image = 'https://picsum.photos/seed/flog-post-'.($index + 1).'/800/500';

            Post::updateOrCreate(
                ['title' => $post['title']],
                [
                    'user_id' => $author->id,
                    'body' => $post['body'],
                    'image' => $image,
                    'category_id' => $categoryId ?: null,
                ]
            );
        }
    }
}