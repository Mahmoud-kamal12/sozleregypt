<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Character;
use App\Classification;
use App\Edition;
use App\Http\Controllers\Controller;
use App\Order;
use App\Sandbox;
use App\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BookController extends Controller
{

    public function home(){
        return view('dashboard.home');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $books = Book::paginate(15);

        return view('dashboard.books.index' , compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $editions = Edition::all();
        $classifications = Classification::all();
//        $topics = Topic::all();
        $authors = Character::where('type' , Character::Author)->get();
        $translators = Character::where('type' , Character::Translator)->get();
        $investigators = Character::where('type' , Character::Investigator)->get();
        $publishers = Character::where('type' , Character::Publisher)->get();


        return view('dashboard.books.create' , compact(
            'editions' ,
            'classifications' ,

            'authors',
            'translators',
            'investigators',
            'publishers'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $slug = Str::slug($request->en['name']);

        if(Book::where('slug' , $slug)->first()){
            session()->flash('error' , __('admin.added_before'));
            return redirect()->route('admin.books.index');
        }

        $images = [];
        $request_data = $request->except('_token' , '_method');

        if ($request->hasFile('images')){
            foreach ($request->images as $img){
                $path= Storage::disk('public_uploads')->putFile('books', $img);
                array_push($images , $path );
            }
            $request_data['images'] =  $images;
        }else{
            $request_data['images'] = null;
        }

        $request_data['slug'] = $slug;

        $book = Book::create($request_data);
        session()->flash('success' , __('admin.added_successfuly'));
        return redirect()->route('admin.books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$slug)
    {
//        dd(session('locale'));
        $book = Book::where('slug' , $slug)->first();
        return $book;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $book = Book::where('id' , $id)->first();

        $editions = Edition::all();
        $classifications = Classification::all();
//        $topics = Topic::all();
        $authors = Character::where('type' , Character::Author)->get();
        $translators = Character::where('type' , Character::Translator)->get();
        $investigators = Character::where('type' , Character::Investigator)->get();
        $publishers = Character::where('type' , Character::Publisher)->get();


        return view('dashboard.books.edit' , compact(
            'editions' ,
            'classifications' ,

            'authors',
            'translators',
            'investigators',
            'publishers',
            'book'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slug = Str::slug($request->en['name']);

        if(Book::where('slug' , $slug)->where('id' , '!=' , $id)->first()){
            session()->flash('error' , __('admin.added_before'));
            return redirect()->route('admin.books.index');
        }

        $images = [];
        $request_data = $request->except('_token' , '_method');

        if ($request->hasFile('images')){
            Storage::disk('public_uploads')->delete(Book::where('id' , $id)->pluck('images')->toArray()[0]);
            foreach ($request->images as $img){
                $path = Storage::disk('public_uploads')->putFile('books', $img);
                array_push($images , $path );
            }
            $request_data['images'] =  $images;
        }

        $book = Book::where('id' , $id)->first();
        $book->update($request_data);
        session()->flash('success' , __('admin.edited_successfuly'));
        return redirect()->route('admin.books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $edition = Book::where('id' , $id)->first();
        $edition->delete();
        return redirect()->route('admin.books.index');
    }

    public function sandbox()
    {
        $sandboxes = Sandbox::paginate(15);
        return view('dashboard.books.sandbox' , compact(['sandboxes']));
    }

    public function orders(Request $request)
    {
        if($request->has('search')){
            $search = $request->get('search');
            $orders = Order::where('id' , $search)
            ->orWhere('paymob_transaction_id' , $search)
            ->orWhere('paymob_order_id' , $search)
            ->orWhere('email' ,  'like',"%$search%")
            ->orWhere('firstname' , 'like',"%$search%")
            ->orWhere('lastname' , 'like',"%$search%")
            ->orWhere('phone' ,  'like',"%$search%")
            ->orWhere('zip' ,  'like',"%$search%")
            ->orWhere('address' , 'like',"%$search%")
            ->paginate(15);
        }else{
            $orders = Order::paginate(15);
        }
        return view('dashboard.books.orders' , compact(['orders']));
    }

    public function showsandbox($id)
    {
        $sandbox = Sandbox::where('id', $id)->first();
        $sandbox->read_at = Carbon::now();
        $sandbox->save();
        $html = view('dashboard.books.row' , compact('sandbox'))->render();
        return response()->json(['html' => $html]);
    }

    public function showorder($id)
    {
        $order = Order::where('id', $id)->first();
        $order->read_at = Carbon::now();
        $order->save();
        $html = view('dashboard.books.order_row' , compact('order'))->render();
        return response()->json(['html' => $html]);
    }
}
