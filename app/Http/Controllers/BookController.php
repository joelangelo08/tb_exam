<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use DB;
use Redirect;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::orderBy('bookname','ASC')->get();

        return view('index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'bookname' => 'required|unique:books|max:255',
            'author' => 'required|max:255',
            'bookcover' => 'required',
        ]);

        $books = new Books();
        $books->bookname = $request->bookname;
        $books->author = $request->author;
        $books->bookcover = $request->bookcover;
        $books->save();

        return Redirect::back()->with('success', 'Success! Book has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $books = Books::find($id);

        if($books)
        {
            return response()->json([
                'status'=>200,
                'books'=>$books,
            ]);
        }
        else {
            return response()->json([
                'status'=>44,
                'books'=>'books not found',
            ]);
        }
        // return view('edit',compact('books'));
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
        $request->validate([
            'bookname' => 'required|max:255|unique:books,bookname,'.$id.',id',
            'author' => 'required|max:255',
            'bookcover' => 'required',
        ]);

        $books = Books::find($id);
        if($books)
        {
            $books->bookname = $request->bookname;
            $books->author = $request->author;
            $books->bookcover = $request->bookcover;
            $books->save();
            return response()->json([
                'status'=>200,
                'books'=>$books,
            ]);
        }
        else {
            return response()->json([
                'status'=>44,
                'books'=>'books not found',
            ]);
        }
        

        return redirect('Bookstore')->with('success', 'Successful Update.');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $books = Books::Where('bookname','LIKE', "%".$search."%")
        ->orWhere('author','LIKE', "%".$search."%")
        ->groupby('bookname','author','bookcover','id','created_at','updated_at')
        ->orderBy('bookname','ASC')
        ->get();

        return view('index',compact('books'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $books = Books::find($id);
        $books->delete();

        return redirect('Bookstore')->with('success', 'Book has been deleted');
    }
}
