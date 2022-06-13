<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class ParseRssCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:rss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse rss from https://lifehacker.com/rss';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $xmlFile = file_get_contents('https://lifehacker.com/rss');

        $xmlObject = simplexml_load_string($xmlFile, 'SimpleXMLElement', LIBXML_NOCDATA);
        $xmlJson = json_encode($xmlObject);
        $xmlArr = json_decode($xmlJson, 1); // Returns associative array

        if(!isset($xmlArr["channel"]["item"])){
            $this->error('Items not exists!');

            die();
        }

        foreach ($xmlArr["channel"]["item"] as $item) {
            $title = $item['title'] ?? '';
            $link = $item['link'] ?? '';
            $description = $item['description'] ?? '';

            $validator = Validator::make([
                'title' => $title,
                'link' => $link,
                'description' => $description,
            ], [
                'title' => 'required|unique:posts,title',
                'link' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                $this->error('Current item not validated. See error messages below:');

                foreach ($validator->errors()->all() as $error) {
                    $this->error($error);
                }

                continue;
            }

            Post::create($validator->validated());
            $this->info('Command parse:rss done successfully');
        }

        return 0;
    }

}
