<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookmark;

class BookmarksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookmarks = Bookmark::where('user_id', auth()->user()->id)->get();

        return view('home')->with('bookmarks', $bookmarks);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'url' => 'required',
        ]);

        // create bookmark
        $bookmark = new Bookmark;
        $bookmark->name = $request->input('name');
        $bookmark->url = $request->input('url');
        $bookmark->description = $request->input('description');
        $bookmark->user_id = auth()->user()->id;

        $bookmark->save();

        return redirect('/home')->with('success', 'Bookmark Added');
    }
    public function destroy($id){
        $bookmark = Bookmark::find($id);
        $bookmark->delete();

        return;
    }
}
