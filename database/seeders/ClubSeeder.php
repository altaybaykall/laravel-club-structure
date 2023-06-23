<?php

namespace Database\Seeders;

use App\Models\Clubs;
use App\Models\UserClubs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clubs')->insert([
            'club_name' => 'Yazılım Kulübü',
            'club_content' => 'Yazılım Yarışması',
            'club_department' => 'Mühendislik',
            'club_logo' => 'test.png',
            'club_slug' => 'YZL',
            'club_manager' => '1'
        ]);

    }
}
