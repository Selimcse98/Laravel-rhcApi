<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use JWTAuth; //retrieve our user data from the token
use App\Book; //Book model corresponds to books table in the database
use Dingo\Api\Routing\Helpers; //quickly create every response for outputting to the client in a RESTful manner
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    use Helpers;

    public function index()
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        return $currentUser
            ->books()
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();
    }

    public function store(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $book = new Book;

        $book->title = $request->get('title');
        $book->author_name = $request->get('author_name');
        $book->pages_count = $request->get('pages_count');

        if($currentUser->books()->save($book)) //insert into books table
            return $this->response->created(); //Created 201 default response
        else
            return $this->response->error('could_not_create_book', 500); //custom 500 error response
        //with response headers also will be tweaked accordingly to follow RESTful standards along with body
    }

    public function show($id)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $book = $currentUser->books()->find($id);

        if(!$book)
            throw new NotFoundHttpException;

        return $book;
    }

    public function update(Request $request, $id)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $book = $currentUser->books()->find($id);
        if(!$book)
            throw new NotFoundHttpException;

        $book->fill($request->all());

        if($book->save())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_update_book', 500);
    }

    public function destroy($id)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $book = $currentUser->books()->find($id);

        if(!$book)
            throw new NotFoundHttpException;

        if($book->delete())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_delete_book', 500);
    }
}
