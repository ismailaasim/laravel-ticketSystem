<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;
use App\Models\Email;

class FetchEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch emails from IMAP server';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $client = Client::account('default');
        $client->connect();

        $folder = $client->getFolder('INBOX');
        $messages = $folder->messages()->unseen()->get();

        foreach ($messages as $message) {
            Email::create([
                'uid' => $message->getUid(),
                'subject' => $message->getSubject(),
                'body' => $message->getHTMLBody(),
                'from' => $message->getFrom()[0]->mail,
                'to' => implode(', ', $message->getTo()),
                'received_at' => $message->getDate(),
            ]);
        }

        $client->disconnect();
    }
}
