<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Generate an XML Sitemap';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));

SitemapGenerator::create(config('app.url'))->writeToFile('/home/u1649278/public_html/inseleb/sitemap.xml');

        // $artikelsitemap = Sitemap::create();
        // Article::get()->each(function (Article $artikel) use ($artikelsitemap) {
        //     $artikelsitemap->add(
        //         URL::create("/artikel/rlo-{$artikel->id}/{$artikel->slug}")
        //             ->setPriority(0.5)
        //             ->setChangeFrequency(Url::CHANGE_FREQUENCY_HOURLY)
        //     );
        // });
        // $artikelsitemap->writeToFile(public_path('sitemap.xml'));
    }
}
