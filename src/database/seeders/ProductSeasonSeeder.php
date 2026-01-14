<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Season;

class ProductSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kiwi = Product::where('name', 'キウイ')->first();
        $seasons = Season::whereIn('name', ['秋', '冬'])->pluck('id');
        $kiwi->seasons()->sync($seasons);

        $strawberry = Product::where('name', 'ストロベリー')->first();
        $seasons = Season::whereIn('name', ['春'])->pluck('id');
        $strawberry->seasons()->sync($seasons);

        $orange = Product::where('name', 'オレンジ')->first();
        $seasons = Season::whereIn('name', ['冬'])->pluck('id');
        $orange->seasons()->sync($seasons);

        $watermelon = Product::where('name', 'スイカ')->first();
        $seasons = Season::whereIn('name', ['夏'])->pluck('id');
        $watermelon->seasons()->sync($seasons);

        $peach = Product::where('name', 'ピーチ')->first();
        $seasons = Season::whereIn('name', ['夏'])->pluck('id');
        $peach->seasons()->sync($seasons);

        $muscat = Product::where('name', 'シャインマスカット')->first();
        $seasons = Season::whereIn('name', ['夏', '秋'])->pluck('id');
        $muscat->seasons()->sync($seasons);

        $pineapple = Product::where('name', 'パイナップル')->first();
        $seasons = Season::whereIn('name', ['春', '夏'])->pluck('id');
        $pineapple->seasons()->sync($seasons);

        $grape = Product::where('name', 'ブドウ')->first();
        $seasons = Season::whereIn('name', ['夏', '秋'])->pluck('id');
        $grape->seasons()->sync($seasons);

        $banana = Product::where('name', 'バナナ')->first();
        $seasons = Season::whereIn('name', ['夏'])->pluck('id');
        $banana->seasons()->sync($seasons);

        $melon = Product::where('name', 'メロン')->first();
        $seasons = Season::whereIn('name', ['春', '夏'])->pluck('id');
        $melon->seasons()->sync($seasons);
    }
}
