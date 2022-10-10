<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookAPIRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Monolog\Handler\IFTTTHandler;

class BooksAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $books = Book::all();
        return response()->json(
            [
                'status' => true,
                'message' => "Retrieved successfully",
                'data' => [
                    'books' => $books,
                ],
            ],
            200
        );
    }

//    /**
//     * Create a new resource
//     *
//     * @param CreateBookAPIRequest $request
//     * @return JsonResponse
//     */
//    public function create(CreateBookAPIRequest $request)
//    {
//        $validated = $request->validated();
//
//        $book = Book::create($validated);
//
//        return response()->json(
//            [
//                'success' => true,
//                'message' => "Created successfully.",
//                'data' => [
//                    'authors' => $book,
//                ],
//            ],
//            200
//        );
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateBookAPIRequest $request
     * @return JsonResponse
     */
    public function store(CreateBookAPIRequest $request)
    {
        $validated = $request->validated();

        $response = response()->json(
            [
                'status' => false,
                'message' => "Author Not Found, book is not created",
                'authors' => null
            ],
            301  # Not Found
        );

        $surname = $validated['family_or_corporate_name'];
        $givenName = $validated['given_name'] ?? null;
        $author = null;

        if ($givenName == null) {
            $author = Author::query()
                ->where('family_name', $surname)
                ->where('is_company', 1)
                ->first();
        } else {
            $author = Author::query()
                ->where('family_name', $surname)
                ->where('given_name', $givenName)
                ->where('is_company', 0)
                ->first();
        }

//        if ($author != null) {
//            $book = Book::create([
//                'title' => $validated['title'],
//                'subtitle' => $validated['subtitle'],
//                'year_published' => $validated['year_published'],
//                'edition' => $validated['edition'],
//                'isbn_10' => $validated['isbn_10'],
//                'isbn_13' => $validated['isbn_13'],
//                'genre' => $validated['genre'],
//                'sub_genre' => $validated['sub_genre'],
//                'height' => $validated['height'],
//            ]);
//
//            $book->authors()->attach($author);
//
//            $response = response()->json(
//                [
//                    'success' => true,
//                    'message' => "Created successfully.",
//                    'data' => [
//                        'authors' => $book,
//                    ],
//                ],
//                201
//            );
//        }

//        return $response;
        return $validated;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $book = Book::query()->where('id', $id)->get();

        $response = response()->json(
            [
                'status' => false,
                'message' => "Author not found",
                'authors' => null,
            ],
            404
        );

        if ($book->count() > 0) {
            $response = response()->json(
                [
                    'status' => true,
                    'message' => "Retrieved successfully",
                    'book' => $book,
                ],
                200
            );
        }

        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
