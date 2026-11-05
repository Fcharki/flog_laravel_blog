<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Create nine sample posts across three authors and categories.
     */
    public function run(): void
    {
        $posts = [
            [
                'author' => 'samira.author@example.invalid',
                'title' => 'Why the Seasons Change',
                'category' => 'Science',
                'image' => 'https://picsum.photos/seed/flog-seasons/800/500',
                'body' => '<p>The seasons are shaped by Earth’s tilted axis. As our planet travels around the Sun, each hemisphere takes turns leaning toward or away from it. The hemisphere tilted toward the Sun receives more direct light and longer days, bringing summer. The other receives less direct light and shorter days, bringing winter.</p><p>Earth’s distance from the Sun changes slightly during its orbit, but that is not what causes the seasons. The tilt is the key. It also explains why the Northern and Southern Hemispheres experience opposite seasons at the same time.</p>',
            ],
            [
                'author' => 'samira.author@example.invalid',
                'title' => 'How Trees Record Their Growing Conditions',
                'category' => 'Science',
                'image' => 'https://picsum.photos/seed/flog-tree-rings/800/500',
                'body' => '<p>A tree’s annual rings preserve clues about the conditions in which it grew. In many species, a wide ring points to a year with favorable growing conditions, while a narrow ring can reflect drought, cold, or other stresses.</p><p>Researchers compare ring patterns from living trees, historical timber, and old buildings to build long records of past climates. This field, called dendrochronology, can help date wooden objects and add context to written histories. Each ring is only one piece of evidence, but together they can reveal patterns across centuries.</p>',
            ],
            [
                'author' => 'samira.author@example.invalid',
                'title' => 'The Hidden Science of Fermentation',
                'category' => 'Science',
                'image' => 'https://picsum.photos/seed/flog-fermentation/800/500',
                'body' => '<p>Fermentation is a way that microorganisms transform food. Yeasts and bacteria consume sugars and produce new compounds, changing flavor, texture, and sometimes how long a food keeps. Bread rises as yeast releases carbon dioxide; yogurt becomes tangy as bacteria produce lactic acid.</p><p>People learned to rely on fermentation long before they could see microbes. Today, scientists study the communities of organisms involved and how temperature, salt, and time influence the result. The process links everyday cooking with microbiology, chemistry, and a long history of food traditions around the world.</p>',
            ],
            [
                'author' => 'youssef.author@example.invalid',
                'title' => 'What Makes the Moon Change Shape?',
                'category' => 'Space',
                'image' => 'https://picsum.photos/seed/flog-moon-phases/800/500',
                'body' => '<p>The Moon does not make its own visible light. Sunlight illuminates half of it, and as the Moon orbits Earth we see different portions of that sunlit half. Those changing views create the familiar phases, from new Moon to full Moon and back again.</p><p>The cycle takes about a month. The Moon’s appearance depends on the positions of the Sun, Earth, and Moon, not on Earth’s shadow. Earth’s shadow falls on the Moon only during a lunar eclipse. Watching the phases is a simple way to notice the geometry of our place in the solar system.</p>',
            ],
            [
                'author' => 'youssef.author@example.invalid',
                'title' => 'How Scientists Search for Ancient Life on Mars',
                'category' => 'Space',
                'image' => 'https://picsum.photos/seed/flog-mars-life/800/500',
                'body' => '<p>Mars is cold and dry at its surface today, but its rocks preserve signs that liquid water once flowed there. Rovers study layers of stone, minerals, and sediment for clues about past environments that might have supported microbial life.</p><p>Finding evidence of habitability is not the same as finding life. Scientists look for multiple lines of evidence and try to rule out explanations that do not involve biology. That careful process is why missions collect detailed measurements and why returning samples to Earth could help answer questions that a rover cannot resolve on its own.</p>',
            ],
            [
                'author' => 'youssef.author@example.invalid',
                'title' => 'Why Space Telescopes See Different Things',
                'category' => 'Space',
                'image' => 'https://picsum.photos/seed/flog-space-telescopes/800/500',
                'body' => '<p>Telescopes are designed to observe different kinds of light. Visible-light telescopes show the colors people can see, while infrared instruments detect heat and can look through some clouds of dust. Radio telescopes reveal signals with much longer wavelengths.</p><p>No single telescope tells the whole story. Astronomers combine observations from several instruments to study objects such as stars, galaxies, and planets. It is a little like learning about a place through photographs, sound recordings, and temperature readings: each method adds information that the others cannot provide.</p>',
            ],
            [
                'author' => 'maya.author@example.invalid',
                'title' => 'The Silk Roads Were Networks, Not One Road',
                'category' => 'History',
                'image' => 'https://picsum.photos/seed/flog-silk-roads/800/500',
                'body' => '<p>The Silk Roads were a changing network of routes that connected communities across Asia, the Middle East, North Africa, and Europe. Merchants carried silk and many other goods, while travelers, diplomats, and scholars moved ideas and skills between regions.</p><p>Different routes rose and declined as political borders, trade centers, and technologies changed. The network mattered because people adapted what they encountered: languages, artistic styles, scientific knowledge, and religious traditions all traveled in multiple directions. Thinking of the Silk Roads as a network helps show how connected histories developed through many local exchanges.</p>',
            ],
            [
                'author' => 'maya.author@example.invalid',
                'title' => 'How Historians Read an Everyday Object',
                'category' => 'History',
                'image' => 'https://picsum.photos/seed/flog-everyday-history/800/500',
                'body' => '<p>A familiar object can become a historical source. A cooking pot, a handwritten receipt, or a worn tool may reveal how people worked, what materials they could obtain, and which habits shaped daily life.</p><p>Historians ask who made an object, who used it, and what evidence supports each interpretation. They compare it with written records and other objects from the same place and time. The goal is not to make one artifact answer every question, but to use it as a starting point for understanding the people and choices behind it.</p>',
            ],
            [
                'author' => 'maya.author@example.invalid',
                'title' => 'The Printing Press and the Spread of Ideas',
                'category' => 'History',
                'image' => 'https://picsum.photos/seed/flog-printing-press/800/500',
                'body' => '<p>Printing with movable type made it possible to produce many copies of a text more quickly than copying each one by hand. As printing spread through Europe in the fifteenth century, books and pamphlets reached more readers, although access still depended on literacy, cost, and local conditions.</p><p>Printing did not make ideas travel by itself. Printers, translators, booksellers, teachers, and readers all shaped what was published and how it was understood. The technology changed the scale of communication, while people determined how to use it.</p>',
            ],
        ];

        foreach ($posts as $post) {
            $author = User::where('email', $post['author'])->firstOrFail();
            $category = Category::firstOrCreate(['category_name' => $post['category']]);

            Post::firstOrCreate(
                ['title' => $post['title']],
                [
                    'user_id' => $author->id,
                    'body' => $post['body'],
                    'image' => $post['image'],
                    'category_id' => $category->id,
                ]
            );
        }
    }
}
