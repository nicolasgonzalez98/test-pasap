<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use \Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    public function show(){
        $books = Book::all();
        return BookResource::collection($books);
    }

    // public function filter_by_name(Request $request, string $nombre){
    //     try{
    //         $books = Book::findOrFail()
    //     }catch(ValidationException $e){
    //         return response()->json([
    //             'message' => 'Error al buscar los libros',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function store(StoreBookRequest $request){
        try{
            $book = Book::create($request->validated());

            return response()->json(['message' => 'Libro creado con éxito', 'product' => $book], 201);
        }catch(ValidationException $e){
            return response()->json([
                'message' => 'Error al crear el libro',
                'error' => $e->getMessage()
            ], 500);
        } 
    }

    public function update(){}

    public function delete(Request $request, string $id){

        try{
            $book = Book::findOrFail($id)->toResource();
            $book->delete();

            return response()->json(['message' => 'Libro eliminado con éxito'], 201);
        }catch(ValidationException $e){
            return response()->json([
                'message' => 'Error al eliminar el libro',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
