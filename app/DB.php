<?php

namespace APP;

use PDO;


class DB
{
    /**
     * @var PDO
     */
    private $db;

    public function __construct($filename)
    {
        $this->db = new PDO('sqlite:' . $filename);
    }

    /**
     * @return PDO
     */
    public function get()
    {
        return $this->db;
    }
}

