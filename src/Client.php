<?php

namespace ConquerAndCommand;

use Ratchet\ConnectionInterface;

class Client
{
    /** @var ConnectionInterface */
    private $conn;

    function __construct(ConnectionInterface $conn)
    {
        $this->conn = $conn;
    }

    public function send($json)
    {
        $this->conn->send($json);
    }
}
