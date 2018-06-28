<?php
namespace App\Services\Messenger;

use Maknz\Slack\Client;
use App\Contracts\Services\Messenger as MessengerInterface;

class Messenger implements MessengerInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var
     */
    private $recipient;

    /**
     * @var
     */
    private $sender;

    /**
     * Slack constructor.
     * @param $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * The recipient of the message, either a channel or a user.
     * @param $recipient
     * @return mixed
     */
    public function to($recipient)
    {
        $this->setRecipient($recipient);

        return $this;
    }

    /**
     * @param $sender
     * @return $this
     */
    public function from($sender)
    {
        $this->setSender($sender);

        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    public function send($message)
    {
        return $this->client->to($this->getRecipient())
                            ->from($this->getSender())
                            ->send($message);
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param mixed $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param mixed $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }
}