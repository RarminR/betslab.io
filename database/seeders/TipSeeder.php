<?php

namespace Database\Seeders;

use App\Models\Tip;
use App\Models\TipSelection;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('is_admin', true)->first();
        
        if (!$admin) {
            $admin = User::factory()->create([
                'name' => 'BetsLab Admin',
                'email' => 'admin@betslab.io',
                'is_admin' => true,
            ]);
        }

        $tips = [
            // Won Tips
            [
                'title' => 'Premier League Weekend Special',
                'sport' => 'Football',
                'stake' => 7,
                'channel_type' => 'vip',
                'result' => 'won',
                'status' => 'won',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(7),
                'analysis' => 'Arsenal have been dominant at home this season with 8 wins in 9 games. Liverpool missing key players in defense.',
                'selections' => [
                    ['event_name' => 'Arsenal vs Liverpool', 'league' => 'Premier League', 'prediction' => 'Arsenal to Win', 'odds' => 2.10, 'result' => 'won', 'days_ago' => 7],
                    ['event_name' => 'Man City vs Chelsea', 'league' => 'Premier League', 'prediction' => 'Over 2.5 Goals', 'odds' => 1.65, 'result' => 'won', 'days_ago' => 7],
                ],
            ],
            [
                'title' => 'La Liga Value Picks',
                'sport' => 'Football',
                'stake' => 6,
                'channel_type' => 'vip',
                'result' => 'won',
                'status' => 'won',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
                'analysis' => 'Real Madrid in excellent form, Barcelona struggling away from home.',
                'selections' => [
                    ['event_name' => 'Real Madrid vs Sevilla', 'league' => 'La Liga', 'prediction' => 'Real Madrid -1.5', 'odds' => 1.85, 'result' => 'won', 'days_ago' => 5],
                    ['event_name' => 'Athletic Bilbao vs Barcelona', 'league' => 'La Liga', 'prediction' => 'Both Teams to Score', 'odds' => 1.75, 'result' => 'won', 'days_ago' => 5],
                ],
            ],
            [
                'title' => 'NBA Accumulator',
                'sport' => 'Basketball',
                'stake' => 5,
                'channel_type' => 'vip',
                'result' => 'won',
                'status' => 'won',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(4),
                'analysis' => 'Lakers on a 5-game winning streak. Celtics dominant at home.',
                'selections' => [
                    ['event_name' => 'LA Lakers vs Golden State', 'league' => 'NBA', 'prediction' => 'Lakers ML', 'odds' => 1.90, 'result' => 'won', 'days_ago' => 4],
                    ['event_name' => 'Boston Celtics vs Miami Heat', 'league' => 'NBA', 'prediction' => 'Celtics -5.5', 'odds' => 1.85, 'result' => 'won', 'days_ago' => 4],
                ],
            ],
            [
                'title' => 'Tennis ATP Finals Pick',
                'sport' => 'Tennis',
                'stake' => 8,
                'channel_type' => 'vip',
                'result' => 'won',
                'status' => 'won',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(3),
                'analysis' => 'Sinner in incredible form, hasn\'t dropped a set in last 4 matches.',
                'selections' => [
                    ['event_name' => 'Sinner vs Alcaraz', 'league' => 'ATP Finals', 'prediction' => 'Sinner to Win', 'odds' => 2.20, 'result' => 'won', 'days_ago' => 3],
                ],
            ],
            [
                'title' => 'Bundesliga Goals Fest',
                'sport' => 'Football',
                'stake' => 6,
                'channel_type' => 'free',
                'result' => 'won',
                'status' => 'won',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(6),
                'analysis' => 'Both teams averaging over 3 goals per game.',
                'selections' => [
                    ['event_name' => 'Bayern Munich vs Dortmund', 'league' => 'Bundesliga', 'prediction' => 'Over 3.5 Goals', 'odds' => 2.00, 'result' => 'won', 'days_ago' => 6],
                ],
            ],

            // Lost Tips
            [
                'title' => 'Serie A Double',
                'sport' => 'Football',
                'stake' => 5,
                'channel_type' => 'vip',
                'result' => 'lost',
                'status' => 'lost',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(8),
                'analysis' => 'Inter looking strong but Napoli pulled off an upset.',
                'selections' => [
                    ['event_name' => 'Inter Milan vs Napoli', 'league' => 'Serie A', 'prediction' => 'Inter Milan to Win', 'odds' => 1.70, 'result' => 'lost', 'days_ago' => 8],
                    ['event_name' => 'Juventus vs AC Milan', 'league' => 'Serie A', 'prediction' => 'Under 2.5 Goals', 'odds' => 1.80, 'result' => 'won', 'days_ago' => 8],
                ],
            ],
            [
                'title' => 'Champions League Night',
                'sport' => 'Football',
                'stake' => 7,
                'channel_type' => 'vip',
                'result' => 'lost',
                'status' => 'lost',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(10),
                'analysis' => 'Unexpected red card changed the game completely.',
                'selections' => [
                    ['event_name' => 'PSG vs Bayern Munich', 'league' => 'Champions League', 'prediction' => 'PSG to Win', 'odds' => 2.40, 'result' => 'lost', 'days_ago' => 10],
                ],
            ],

            // Pending Tips (Today/Tomorrow)
            [
                'title' => 'Today\'s Premier League Picks',
                'sport' => 'Football',
                'stake' => 7,
                'channel_type' => 'vip',
                'result' => 'pending',
                'status' => 'pending',
                'is_published' => true,
                'published_at' => Carbon::now()->subHours(2),
                'analysis' => 'United have won last 5 home games. Spurs struggling on the road.',
                'selections' => [
                    ['event_name' => 'Man United vs Tottenham', 'league' => 'Premier League', 'prediction' => 'Man United to Win', 'odds' => 2.05, 'result' => 'pending', 'days_ago' => 0, 'hours_from_now' => 3],
                    ['event_name' => 'Newcastle vs Aston Villa', 'league' => 'Premier League', 'prediction' => 'Both Teams to Score', 'odds' => 1.70, 'result' => 'pending', 'days_ago' => 0, 'hours_from_now' => 5],
                ],
            ],
            [
                'title' => 'NBA Tonight',
                'sport' => 'Basketball',
                'stake' => 6,
                'channel_type' => 'vip',
                'result' => 'pending',
                'status' => 'pending',
                'is_published' => true,
                'published_at' => Carbon::now()->subHours(1),
                'analysis' => 'Nuggets at home are nearly unbeatable. Expect high scoring game.',
                'selections' => [
                    ['event_name' => 'Denver Nuggets vs Phoenix Suns', 'league' => 'NBA', 'prediction' => 'Nuggets -4.5', 'odds' => 1.90, 'result' => 'pending', 'days_ago' => 0, 'hours_from_now' => 6],
                    ['event_name' => 'Milwaukee Bucks vs Cleveland Cavaliers', 'league' => 'NBA', 'prediction' => 'Over 225.5 Points', 'odds' => 1.85, 'result' => 'pending', 'days_ago' => 0, 'hours_from_now' => 7],
                ],
            ],
            [
                'title' => 'Free Pick of the Day',
                'sport' => 'Football',
                'stake' => 5,
                'channel_type' => 'free',
                'result' => 'pending',
                'status' => 'pending',
                'is_published' => true,
                'published_at' => Carbon::now()->subMinutes(30),
                'analysis' => 'Free sample pick for our community!',
                'selections' => [
                    ['event_name' => 'Brentford vs Wolves', 'league' => 'Premier League', 'prediction' => 'Over 2.5 Goals', 'odds' => 1.95, 'result' => 'pending', 'days_ago' => 0, 'hours_from_now' => 4],
                ],
            ],

            // More historical won tips for better stats
            [
                'title' => 'Ligue 1 Combo',
                'sport' => 'Football',
                'stake' => 6,
                'channel_type' => 'vip',
                'result' => 'won',
                'status' => 'won',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(12),
                'analysis' => 'PSG dominant domestically.',
                'selections' => [
                    ['event_name' => 'PSG vs Lyon', 'league' => 'Ligue 1', 'prediction' => 'PSG & Over 2.5', 'odds' => 1.95, 'result' => 'won', 'days_ago' => 12],
                ],
            ],
            [
                'title' => 'EuroLeague Basketball',
                'sport' => 'Basketball',
                'stake' => 5,
                'channel_type' => 'vip',
                'result' => 'won',
                'status' => 'won',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(9),
                'analysis' => 'Real Madrid basketball team in top form.',
                'selections' => [
                    ['event_name' => 'Real Madrid vs Fenerbahce', 'league' => 'EuroLeague', 'prediction' => 'Real Madrid -3.5', 'odds' => 1.80, 'result' => 'won', 'days_ago' => 9],
                ],
            ],
            [
                'title' => 'CS2 Major Pick',
                'sport' => 'Esports',
                'stake' => 7,
                'channel_type' => 'vip',
                'result' => 'won',
                'status' => 'won',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(14),
                'analysis' => 'FaZe on incredible LAN form.',
                'selections' => [
                    ['event_name' => 'FaZe vs Navi', 'league' => 'CS2 Major', 'prediction' => 'FaZe to Win', 'odds' => 2.15, 'result' => 'won', 'days_ago' => 14],
                ],
            ],
            [
                'title' => 'ATP Melbourne',
                'sport' => 'Tennis',
                'stake' => 6,
                'channel_type' => 'vip',
                'result' => 'won',
                'status' => 'won',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(11),
                'analysis' => 'Djokovic historically dominant in Australia.',
                'selections' => [
                    ['event_name' => 'Djokovic vs Medvedev', 'league' => 'Australian Open', 'prediction' => 'Djokovic in 4 Sets', 'odds' => 3.20, 'result' => 'won', 'days_ago' => 11],
                ],
            ],
            [
                'title' => 'MMA UFC Fight Night',
                'sport' => 'MMA',
                'stake' => 5,
                'channel_type' => 'vip',
                'result' => 'won',
                'status' => 'won',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(15),
                'analysis' => 'Great value on the underdog here.',
                'selections' => [
                    ['event_name' => 'Pereira vs Adesanya', 'league' => 'UFC', 'prediction' => 'Pereira by KO/TKO', 'odds' => 2.80, 'result' => 'won', 'days_ago' => 15],
                ],
            ],
        ];

        foreach ($tips as $tipData) {
            $selections = $tipData['selections'];
            unset($tipData['selections']);

            // Calculate total odds
            $totalOdds = 1;
            foreach ($selections as $sel) {
                $totalOdds *= $sel['odds'];
            }

            $tip = Tip::create([
                'created_by' => $admin->id,
                'title' => $tipData['title'],
                'sport' => $tipData['sport'],
                'stake' => $tipData['stake'],
                'channel_type' => $tipData['channel_type'],
                'analysis' => $tipData['analysis'] ?? null,
                'total_odds' => round($totalOdds, 2),
                'status' => $tipData['status'],
                'result' => $tipData['result'],
                'is_published' => $tipData['is_published'],
                'published_at' => $tipData['published_at'],
                'telegram_sent' => true,
            ]);

            foreach ($selections as $index => $selection) {
                $eventDate = isset($selection['hours_from_now']) 
                    ? Carbon::now()->addHours($selection['hours_from_now'])
                    : Carbon::now()->subDays($selection['days_ago'])->setHour(rand(14, 21))->setMinute(0);

                TipSelection::create([
                    'tip_id' => $tip->id,
                    'event_name' => $selection['event_name'],
                    'event_date' => $eventDate,
                    'league' => $selection['league'] ?? null,
                    'prediction' => $selection['prediction'],
                    'odds' => $selection['odds'],
                    'result' => $selection['result'],
                    'sort_order' => $index,
                ]);
            }
        }

        $this->command->info('Created ' . count($tips) . ' tips with selections!');
    }
}

