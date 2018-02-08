<?php
namespace ConquerAndCommand;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Server implements MessageComponentInterface
{
    /** @var Client[] */
    private $clients;

    function __construct()
    {
        $this->clients = [];
    }

    public function onOpen(ConnectionInterface $conn)
    {
        echo "Open";
        $client = new Client($conn);
        $clientId = count($this->clients);
        $this->clients[] = $client;

        /** @var Client $client */
        foreach ($this->clients as $client) {
            $client->send(json_encode(
                [
                    'action' => 'newClient',
                    'value' => $clientId
                ]
            ));
        }
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $json = json_decode($msg);
        echo "Message";
        print_r($json);
    }

    public function onClose(ConnectionInterface $conn)
    {
        echo "Connection";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error";
    }
}
