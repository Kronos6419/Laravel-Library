<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin account (required by assignment brief) ───────────────────
        $admin = User::create([
            'username' => 'admin',
            'email'    => 'admin@thereadingroom.test',
            'password' => bcrypt('admin'),
            'role'     => 'admin',
        ]);

        // ── Author accounts ────────────────────────────────────────────────
        $authors = [
            User::create([
                'username' => 'eleanor_voss',
                'email'    => 'eleanor@thereadingroom.test',
                'password' => bcrypt('password'),
                'role'     => 'user',
            ]),
            User::create([
                'username' => 'marcus_reid',
                'email'    => 'marcus@thereadingroom.test',
                'password' => bcrypt('password'),
                'role'     => 'user',
            ]),
            User::create([
                'username' => 'sofia_lane',
                'email'    => 'sofia@thereadingroom.test',
                'password' => bcrypt('password'),
                'role'     => 'user',
            ]),
            User::create([
                'username' => 'james_okoro',
                'email'    => 'james@thereadingroom.test',
                'password' => bcrypt('password'),
                'role'     => 'user',
            ]),
        ];

        // ── Curated book catalogue ─────────────────────────────────────────
        $books = [

            // Fantasy
            ['title' => 'The Lord of the Rings', 'author' => 'J.R.R. Tolkien', 'genre' => 'Fantasy',
             'description' => 'An epic high-fantasy novel following the hobbit Frodo Baggins and the Fellowship on a quest to destroy the One Ring and defeat the Dark Lord Sauron. A foundational work of modern fantasy literature.',
             'user_id' => $authors[0]->id],

            ['title' => 'The Name of the Wind', 'author' => 'Patrick Rothfuss', 'genre' => 'Fantasy',
             'description' => 'The first book in the Kingkiller Chronicle, told in the voice of Kvothe — a legendary figure recounting his extraordinary life from gifted student at a magical university to celebrated adventurer.',
             'user_id' => $authors[0]->id],

            ['title' => 'A Wizard of Earthsea', 'author' => 'Ursula K. Le Guin', 'genre' => 'Fantasy',
             'description' => 'A young boy with extraordinary magical talent attends a school for wizards, where his pride leads him to unleash a terrible shadow upon the world. A classic coming-of-age tale set in the archipelago of Earthsea.',
             'user_id' => $authors[1]->id],

            ['title' => 'The Way of Kings', 'author' => 'Brandon Sanderson', 'genre' => 'Fantasy',
             'description' => 'The opening volume of the Stormlight Archive, set in a world battered by devastating storms. Three characters are drawn together by ancient forces in this sweeping epic of war, politics, and magic.',
             'user_id' => $authors[1]->id],

            // Science Fiction
            ['title' => 'Dune', 'author' => 'Frank Herbert', 'genre' => 'Science Fiction',
             'description' => 'Set on the desert planet Arrakis, the only source of the most valuable substance in the universe. A sweeping saga of politics, religion, and ecology following Paul Atreides as his family assumes control of the planet.',
             'user_id' => $authors[2]->id],

            ['title' => 'Neuromancer', 'author' => 'William Gibson', 'genre' => 'Science Fiction',
             'description' => 'The novel that defined cyberpunk. A washed-up hacker is hired to pull off the ultimate heist, navigating a future of corporate intrigue, artificial intelligence, and virtual reality.',
             'user_id' => $authors[2]->id],

            ['title' => 'The Left Hand of Darkness', 'author' => 'Ursula K. Le Guin', 'genre' => 'Science Fiction',
             'description' => 'A human envoy travels to the planet Gethen, whose inhabitants have no fixed biological sex. A landmark work exploring gender, politics, and humanity through the lens of an alien world.',
             'user_id' => $authors[3]->id],

            ['title' => "Ender's Game", 'author' => 'Orson Scott Card', 'genre' => 'Science Fiction',
             'description' => 'Gifted child Andrew Wiggin is recruited to a military school in space to prepare for an alien invasion. A gripping exploration of genius, manipulation, and the moral cost of war told through the eyes of a child.',
             'user_id' => $authors[3]->id],

            // Mystery
            ['title' => 'And Then There Were None', 'author' => 'Agatha Christie', 'genre' => 'Mystery',
             'description' => 'Ten strangers are lured to an isolated island and murdered one by one. With no apparent killer among them, the survivors must unravel the mystery before they too are claimed. The best-selling mystery novel of all time.',
             'user_id' => $authors[0]->id],

            ['title' => 'The Girl with the Dragon Tattoo', 'author' => 'Stieg Larsson', 'genre' => 'Mystery',
             'description' => 'A disgraced journalist and a brilliant hacker investigate the decades-old disappearance of a wealthy patriarch\'s niece, uncovering dark family secrets and a trail of violence in contemporary Sweden.',
             'user_id' => $authors[1]->id],

            ['title' => 'In the Woods', 'author' => 'Tana French', 'genre' => 'Mystery',
             'description' => 'A Dublin detective investigating the murder of a girl on an ancient archaeological site discovers disturbing connections to a childhood incident he has never been able to fully remember.',
             'user_id' => $authors[2]->id],

            ['title' => 'The Hound of the Baskervilles', 'author' => 'Arthur Conan Doyle', 'genre' => 'Mystery',
             'description' => 'Sherlock Holmes investigates the legend of a supernatural hound haunting the Baskerville family on the Devon moors. Perhaps the most celebrated mystery novel ever written, combining gothic atmosphere with brilliant deduction.',
             'user_id' => $authors[3]->id],

            // Romance
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'genre' => 'Romance',
             'description' => 'The story of Elizabeth Bennet and her complicated relationship with the proud and wealthy Mr. Darcy. A sharp, witty comedy of manners that remains the most beloved romance in the English language.',
             'user_id' => $authors[0]->id],

            ['title' => 'Outlander', 'author' => 'Diana Gabaldon', 'genre' => 'Romance',
             'description' => 'A British combat nurse in 1945 is swept back in time to 1743 Scotland, caught between two worlds and two men — her twentieth-century husband and a fierce young Highland warrior.',
             'user_id' => $authors[1]->id],

            ['title' => 'Jane Eyre', 'author' => 'Charlotte Bronte', 'genre' => 'Romance',
             'description' => 'An orphaned girl of strong principle finds employment as a governess at Thornfield Hall, falling in love with the mysterious Mr. Rochester while confronting the dark secret he keeps hidden.',
             'user_id' => $authors[2]->id],

            // Horror
            ['title' => 'The Shining', 'author' => 'Stephen King', 'genre' => 'Horror',
             'description' => 'Jack Torrance takes a job as winter caretaker of the isolated Overlook Hotel with his wife and young son Danny, who possesses a psychic ability. As winter sets in, the hotel\'s evil presence begins to consume Jack.',
             'user_id' => $authors[3]->id],

            ['title' => 'Dracula', 'author' => 'Bram Stoker', 'genre' => 'Horror',
             'description' => 'The definitive vampire novel, told through journals and letters as a group of friends battle the ancient Transylvanian count who has come to England. A masterpiece of gothic horror that defined the vampire myth.',
             'user_id' => $authors[0]->id],

            ['title' => 'Frankenstein', 'author' => 'Mary Shelley', 'genre' => 'Horror',
             'description' => 'Young scientist Victor Frankenstein creates a sentient creature in an unorthodox experiment. Explores themes of creation, responsibility, and the consequences of playing god. The founding text of science fiction and horror.',
             'user_id' => $authors[1]->id],

            ['title' => 'Mexican Gothic', 'author' => 'Silvia Moreno-Garcia', 'genre' => 'Horror',
             'description' => 'A glamorous socialite travels to the Mexican countryside to rescue her cousin, discovering the crumbling High Place estate hides dark gothic secrets that threaten to consume everyone within its walls.',
             'user_id' => $authors[2]->id],

            // Non-Fiction
            ['title' => 'Sapiens: A Brief History of Humankind', 'author' => 'Yuval Noah Harari', 'genre' => 'Non-Fiction',
             'description' => 'A sweeping narrative of humanity\'s creation and evolution, exploring how Homo sapiens came to dominate the planet through language, agriculture, science, and the shared myths that bind societies together.',
             'user_id' => $authors[3]->id],

            ['title' => 'The Body: A Guide for Occupants', 'author' => 'Bill Bryson', 'genre' => 'Non-Fiction',
             'description' => 'A witty and fascinating tour of the human body, covering everything from the skin and brain to the immune system and the mysteries of sleep. Complex science made entertaining and accessible.',
             'user_id' => $authors[0]->id],

            ['title' => 'Thinking, Fast and Slow', 'author' => 'Daniel Kahneman', 'genre' => 'Non-Fiction',
             'description' => 'Nobel Prize-winning psychologist Daniel Kahneman explores the two systems that drive the way we think — the fast intuitive System 1 and the slow deliberate System 2 — and how they shape our decisions.',
             'user_id' => $authors[1]->id],

            // Biography
            ['title' => 'The Diary of a Young Girl', 'author' => 'Anne Frank', 'genre' => 'Biography',
             'description' => 'The wartime diary kept by Anne Frank while hiding with her family in Nazi-occupied Amsterdam. Written between 1942 and 1944, it is one of the most widely read accounts of the Holocaust.',
             'user_id' => $authors[2]->id],

            ['title' => 'Leonardo da Vinci', 'author' => 'Walter Isaacson', 'genre' => 'Biography',
             'description' => 'Drawing on thousands of pages of Leonardo\'s notebooks, Isaacson weaves a narrative connecting his art to his science, showing how his insatiable curiosity made him history\'s most inspired and innovative mind.',
             'user_id' => $authors[3]->id],

            ['title' => 'Just Kids', 'author' => 'Patti Smith', 'genre' => 'Biography',
             'description' => 'Patti Smith\'s memoir of her formative years in New York City with photographer Robert Mapplethorpe, tracing their deep friendship and artistic development against a transformative era in American culture.',
             'user_id' => $authors[0]->id],

            // Poetry
            ['title' => 'Leaves of Grass', 'author' => 'Walt Whitman', 'genre' => 'Poetry',
             'description' => 'Whitman\'s landmark collection celebrating democracy, nature, love, and friendship. Song of Myself — its most celebrated poem — is a joyous meditation on identity and the American spirit, first published in 1855.',
             'user_id' => $authors[1]->id],

            ['title' => 'Milk and Honey', 'author' => 'Rupi Kaur', 'genre' => 'Poetry',
             'description' => 'A collection of poetry and prose about survival — violence, abuse, love, loss, and femininity — divided into four chapters that each explore a different pain and the journey of healing through it.',
             'user_id' => $authors[2]->id],

            ['title' => 'The Waste Land', 'author' => 'T.S. Eliot', 'genre' => 'Poetry',
             'description' => 'First published in 1922, this modernist masterpiece is one of the most important poems of the twentieth century — a fragmented meditation on spiritual dryness and cultural disillusionment after the First World War.',
             'user_id' => $authors[3]->id],
        ];

        foreach ($books as $data) {
            Book::create($data);
        }
    }
}
