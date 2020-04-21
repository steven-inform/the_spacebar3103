<?php
namespace App\Service;

use App\Helper\LoggerTrait;
use Nexy\Slack\Client;

class SlackClient
{
    use LoggerTrait;

    private $slack;

    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    public function sendMessage( $from, $message )
    {
        $this->logInfo('Beaming a message to Slack', [
            'message' => 'Beaming a message to Slack'
        ]);

        $slackMessage = $this->slack->createMessage();

        $slackMessage
            //->to('#test')
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($message);

        $this->slack->sendMessage($slackMessage);
    }

}