<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\UrlExpiryEmail;

class ExpiringUrlsChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expiring-urls-checker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command will check for expiring URLs and send an email to the user';


    public function __construct()
    {
        parent::__construct();
    } 


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expirationThreshold = now()->addDays(300);
    
        $expiringURLs = \App\Models\Url::where('expiration_date', '<', $expirationThreshold)
                            ->where('notified', false)
                            ->get();
    

        foreach ($expiringURLs as $url) {

            Mail::to($url->user->email)
            ->send(new UrlExpiryEmail([
                'url' => $url->url,
                'short_url' => $url->short_url,
                'expiration_date' => $url->expiration_date,
                'user' => $url->user->name,
            ]));
    
            $url->update(['notified' => true]); // Update the URL's notified status
        }

    }
    
}
