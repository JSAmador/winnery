<?php

namespace App\Http\Controllers;

use App\Wine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;

class AdminWinesController extends Controller
{

    public function index()
    {
        //
        $wines = Wine::all();
        return view('admin.wines', ['wines' => $wines]);
    }



    public function bulkStore()
    {
        //
        $feed = file_get_contents('https://www.winespectator.com/rss/rss?t=dwp');
        $content = new SimpleXMLElement($feed);
        foreach($content->channel->item as $entry) {
            $name = $entry->title;
            $link = $entry->link;
            $date = date('Y-m-d H:i:s', strtotime($entry->pubDate));
            DB::table('wines')->insert(
                [
                    'name' => $name,
                    'link' => $link,
                    'date' => $date,
                    'is_available' => true
                ]
            );

        }

    }
}
