<?php

namespace App\Feed;

use App\Database\Connection;

class PostFeed
{
    public function __construct(
        private int $postsNumber = 10
    ) {
    }

    public function run()
    {
        $databaseConnection = new Connection();
        $connection = $databaseConnection->setup();
        $connection->exec("CREATE TABLE IF NOT EXISTS post (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(100),
            content TEXT,
            user_id INT,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES user(id)
        )");

        $faker = \Faker\Factory::create();
        try {
            $connection->beginTransaction();
            while ($this->postsNumber > 0) {
                $title= $faker->sentence(3);
                $content = $faker->realText;
                $user_id = 6;
                $sth = $connection->prepare("INSERT INTO post (title, content, user_id) VALUES (?, ?, ?)");
                $sth->bindParam(1,$title);
                $sth->bindParam(2, $content);
                $sth->bindParam(3, $user_id);
                $sth->execute();
                $this->postsNumber--;
            }
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }
}