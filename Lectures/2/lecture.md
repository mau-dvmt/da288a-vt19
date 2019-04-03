# Föreläsning 2: Mer PHP samt paket- och beroendehantering med Composer

- [Introduktion till PHP](php.pdf)

## Kod från dagens föreläsning

För att komma igång med filerna nedan, navigera till mappen där ni sparat filerna och kör:

```bash
php -S localhost:8080
```

Surfa sedan till adressen `localhost:8080` i din webbläsare. (**OBS**, ni behöver ha installerat PHP för att detta ska fungera).

### index.php

```php
<?php

require("guestbook.php");

use App\Guestbook;

$guestbook = New Guestbook("gb.json");

if (isset($_POST["name"]) and isset($_POST["message"])) {
    $guestbook->createPost($_POST["name"], $_POST["message"]);
}

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gästbok</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>Gästbok</h1>
            <form action="index.php" method="post">
                <label for="name">Namn</label>
                <input name="name" id="name" type="text" class="form-control">
                <label for="message">Meddelande</label>
                <textarea name="message" id="message" class="form-control"></textarea>
                <hr>
                <input type="submit" value="Skicka meddelande" class="btn btn-success">
            </form>

            <hr>

            <h2>Inlägg</h2>

            <?php
            foreach ($guestbook->getPosts() as $post) {
                echo "<div class=\"card\">
                <div class=\"card-header\">
                   $post->name
                </div>
                <div class=\"card-body\">
                  <blockquote class=\"blockquote mb-0\">
                    <p>$post->message</p>
                    <footer class=\"blockquote-footer\">$post->timestamp</footer>
                  </blockquote>
                </div>
              </div>";
            }
            ?>
        </div>
    </body>
</html>
```

### guestbook.php

```php
<?php

namespace App;

class Guestbook
{
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;

        if(!file_exists($this->filename)) {
            file_put_contents($this->filename, json_encode([]));
        }
    }

    public function getPosts()
    {
        $fileContent = file_get_contents($this->filename);
        $posts = json_decode($fileContent);
        return $posts;
    }

    public function createPost($name, $message)
    {
        $posts = $this->getPosts();

        $posts[] = [
            "name" => $name,
            "message" => $message,
            "timestamp" => date("Y-m-d H:i:s")
        ];

        file_put_contents($this->filename, json_encode($posts, JSON_PRETTY_PRINT));
    }
}
```

### gb.json (exempelvis)

```json
[
    {
        "name": "Anton",
        "message": "Mitt första inlägg!",
        "timestamp": "2019-04-03 11:01:17"
    },
    {
        "name": "Anton",
        "message": "... och ett till!",
        "timestamp": "2019-04-03 11:01:32"
    },
    {
        "name": "Anton",
        "message": "Snart dags f\u00f6r Johans del!",
        "timestamp": "2019-04-03 11:06:36"
    }
]
``` 