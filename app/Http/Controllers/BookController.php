<?php

namespace App\Http\Controllers;

use App\Http\Requests\FindBookRequest;
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

    public function filter_by_name(FindBookRequest $request){
        try{
            if($request->validated()){
                $books = Book::where("title", $request->name);
                $books1 = [];
                
                foreach($books as $b){
                    if($b->available == $request->available){
                        array_push($books1, $b);
                    }
                }


                return response()->json(['books' => $books1], 201);
            }else{
                return response()->json(['message' => "No se ingreso un valor de nombre correcto."], 400);
            }
            
        }catch(ValidationException $e){
            return response()->json([
                'message' => 'Error al buscar los libros',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreBookRequest $request){
        try{
            $book = Book::create($request->validated());
            $book = BookResource::class($book);

            return response()->json(['message' => 'Libro creado con éxito', 'book' => $book], 201);
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
