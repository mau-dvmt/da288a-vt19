# Föreläsning 6: Versionshantering och Git

[Föreläsningen hittar ni här](PHP–Ramverk–Lumen.pdf)

## Dagens kod

### routes/web.php

```php
<?php

use App\Http\Controllers\MoviesController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/movies', 'MoviesController@index');
$router->post('/movies', 'MoviesController@create');
$router->get('/movies/{id}', 'MoviesController@show');
$router->delete('/movies/{id}', 'MoviesController@delete');
$router->put('/movies/{id}', 'MoviesController@update');
```

### app/Http/Controllers/MoviesController.php

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoviesController extends Controller
{
    private $fileURL;
    private $movies;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     
    public function __construct()
    {
        $this->fileURL = "../resources/movies.json";

        if (!file_exists($this->fileURL)) {
            file_put_contents($this->fileURL, json_encode([]));
            $this->movies = [];
        } else {
            $this->movies = json_decode(file_get_contents($this->fileURL));
        }
    }

    public function index() {
        return response()->json($this->movies);
    }

    public function create(Request $request) {

        $movie = [];
        $movie["title"] = $request->input("title");
        $movie["rating"] = $request->input("rating");
        $movie["id"] = $request->input("id");

        $this->movies[] = $movie;

        file_put_contents("../resources/movies.json", json_encode($this->movies));

        return response()->json($this->movies);
    }

    public function show($id){
        foreach ($this->movies as $movie) {
            if ($movie->id == $id) {
                return response()->json($movie);
            }
        }
    }

    //
}
```