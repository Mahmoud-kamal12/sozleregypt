<?php

namespace App\Http\Controllers\Web;

use App\Book;
use App\Cart;
use App\Helpers\PayMob;
use App\Http\Controllers\Controller;
use App\Order;
use App\Sandbox;
use App\Shipping;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebController extends Controller
{


    public function ReplacementCases()
    {
        return view('web.ReplacementCases');
    }

    public function home(){
        return view('web.home');
    }

    public function getBooksByClassification($classId){
        $books = Book::where('classification_id' , '=' , $classId)->paginate(10);
        return view('web.pages.all-books' , compact('books'));
    }

    public function getBook($slug){
        $book = Book::where('slug' , '=' , $slug)->firstOrFail();

        return view('web.pages.book-details' , compact('book'));
    }

    public function sandbox(Request $request){

        $sand = Sandbox::create($request->all());
        $success = "email send successfuly";
        session()->flash('success' ,$success);
        return  redirect()->back();
    }

    public function addfavorite($bookid){
        $book = Book::where('id' , '=' , $bookid)->first();
        try{
            $book->favorite()->attach(auth()->user());
            return  response()->json([
                'status' => 'success',
                'message' => 'add success'
            ],200);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'add failed',
                'details' => $e->getMessage()
            ],500);;
        }

    }

    public function deletefavorite($bookid){
        $book = Book::where('id' , '=' , $bookid)->first();
        try{
            $book->favorite()->detach(auth('web')->user());
            return  response()->json([
                'status' => 'success',
                'message' => 'add success'
            ],200);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'deleted failed',
                'details' => $e->getMessage()
            ],500);;
        }

    }

    public function addcart($bookid){
        $book = Book::where('id' , '=' , $bookid)->first();

        try{

            $user = auth('web')->user();
            $findBook = $user->cart()->find($book);
            if (!$findBook){
                $user->cart()->attach( $book , ['quantity' => 1]);
            }else{
                $q = request()->has('quantity') &&  request()->get('quantity') ? request()->get('quantity') : ($findBook->pivot->quantity + 1);
                $user->cart()->updateExistingPivot($book , [ 'quantity' => $q] , false);
            }
            $cart = auth()->user()->cart()->get();
            $sum = 0;
            foreach ($cart as $c){
                $sum += $c->pivot->quantity * $c->price_le_after_discount;
            }
            return  response()->json([
                'status' => 'success',
                'message' => 'add success',
                'sum' =>$sum
            ],200);

        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'add failed',
                'details' => $e->getMessage()
            ],500);
        }

    }

    public function deletecart($bookid){
        $book = Book::where('id' , '=' , $bookid)->first();
        try{
            $book->cart()->detach(auth()->user());
            $cart = auth()->user()->cart()->get();
            $sum = 0;
            foreach ($cart as $c){
                $sum += $c->pivot->quantity * $c->price_le_after_discount;
            }
            return  response()->json([
                'status' => 'success',
                'message' => 'deleted success',
                'sum' => $sum
            ],200);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'deleted failed',
                'details' => $e->getMessage()
            ],500);;
        }

    }

    public function profile(Request $request){
        try{
            $cart = auth()->user()->cart()->get();
            $favorite = auth()->user()->favorite()->get();
            $sum = 0;
            foreach ($cart as $c){
                $sum += $c->pivot->quantity * $c->price_le_after_discount;
            }
            $shop = false;
            $fav = false;
            $acc = false;
            if ($request->has('shop')){
                $shop = true;
            }elseif ($request->has('fav')){
                $fav = true;
            }elseif ($request->has('acc')){
                $acc = true;
            }

            return view('web.pages.profile' , compact('cart','shop','fav' ,'acc', 'favorite' , 'sum'));
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'details' => $e->getMessage()
            ],500);;
        }

    }

    public function search(Request $request){
        try{
            $word = $request->get('word');

            $books = Book::whereTranslationLike('name',"%$word%")
                ->orwhereTranslationLike('binding_type',"%$word%")
                ->orwhereTranslationLike('paper_type',"%$word%")
                ->orwhereTranslationLike('printing_colors',"%$word%")
                ->orwhereTranslationLike('about',"%$word%")
                ->orWhere('ISBN' , 'like',"%$word%")
                ->orWhere('code' , 'like',"%$word%")
                ->get();

            return response()->json([
                'status' => 'success',
                'data' =>   $books
            ],200);

        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'details' => $e->getMessage()
            ],500);;
        }

    }

    public function searchDetails(Request $request){
        try{
            $word = $request->get('word');

            $books = Book::whereTranslationLike('name',"%$word%")
                ->orwhereTranslationLike('binding_type',"%$word%")
                ->orwhereTranslationLike('paper_type',"%$word%")
                ->orwhereTranslationLike('printing_colors',"%$word%")
                ->orwhereTranslationLike('about',"%$word%")
                ->orWhere('ISBN' , 'like',"%$word%")
                ->orWhere('code' , 'like',"%$word%")
                ->get();

            return response()->json([
                'status' => 'success',
                'data' =>   $books
            ],200);

        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'details' => $e->getMessage()
            ],500);;
        }

    }

    public function paymob($orderId = null , Request $request , PayMob $payMob){

        $user = auth()->user();

        if ($orderId){
            $order = Order::where('id',$orderId)->first();
        }else{
            $items = $user->cart_items()->get(['book_id' , 'quantity']);

            if (count($items) <= 0){
                $success = "السله فارغه";
                session()->flash('error' ,$success);
                return  redirect()->back();
            }

            $shipping = Shipping::where('id',$request->city)->first();

            $order = Order::create([
                'user_id'=> $user->id ,
                'email' => $request->email,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'city' => $shipping->city,
                'address' => $request->address,
                'zip' => $request->zip,
                'country' => $request->country]);
            foreach ($items as $item){
                $order->items()->create(['book_id' => $item->book_id , 'quantity' => $item->quantity , 'order_id' => $order->id]);
            }
            $total_amout_cents = $order->items()->sum('amount_cents') + ($shipping->cost * 100);
            $order->update(['amount_cents'=> $total_amout_cents]);
        }

        $items = $order->items()->get(['name' , 'quantity' , 'amount_cents'])->toArray();
        $auth  = $payMob->authPaymob();

        if (property_exists($auth, 'detail')) {
            session()->flash('success' ,"حدث خطأ ما يرجى المحاوله فى وقت لاحق");
            return  redirect()->back();
        }

        $paymobOrder = $payMob->makeOrderPaymob(
            $auth->token,
            $order->amount_cents,
            $items
        );
        $idOrder = null;
        if (isset($paymobOrder->message)) {
            if ($paymobOrder->message == 'duplicate') {
                $idOrder = $order->paymob_order_id;
            }
        }else{
            $order->update(['paymob_order_id' => $paymobOrder->id]);
            $idOrder = $paymobOrder->id;
        }

        $payment_key = $payMob->getPaymentKeyPaymob(
            $auth->token,
            $order->amount_cents,
            $idOrder,
            $order->email,
            $order->firstname,
            $order->lastname,
            $order->phone,
            $order->city,
            $order->country,
            $order->zip
        );

        if ($request->card_number && $request->card_holdername && $request->card_expiry_mm && $request->card_expiry_yy && $request->card_cvv){
            $redirect =  $payMob->makePayment(
                $payment_key->token,
                $request->card_number,
                $request->card_holdername,
                $request->card_expiry_mm,
                $request->card_expiry_yy,
                $request->card_cvv,
                $order->paymob_order_id,
                $order->firstname,
                $order->lastname,
                $order->email,
                $order->phone,
                $order->zip,
                $order->city,
                $order->country
            );

            if (isset($redirect->redirect)){
                $redirect = $redirect->redirect;
            }elseif (isset($redirect->redirection_url)){
                $redirect = $redirect->redirection_url;
            }

        }else{
            $redirect = "https://accept.paymobsolutions.com/api/acceptance/iframes/".$payMob->iframe_id."?payment_token=".$payment_key->token;
        }
        return redirect($redirect);
    }

    public function processedCallback(Request $request)
    {
        $data = $request->all();
        $orderId = $data['order'];
        $order = Order::where('paymob_order_id' , $orderId)->first();
        // Statuses.
        $isSuccess  = filter_var($data['success'] , FILTER_VALIDATE_BOOLEAN) ;
        $isVoided   = filter_var($data['is_voided'],FILTER_VALIDATE_BOOLEAN);
        $isRefunded = filter_var($data['is_refunded'],FILTER_VALIDATE_BOOLEAN);
        $order->update([
            'paymob_order_status' => $data['success'],
            'paymob_transaction_id' => $data['id']
        ]);
        if ($isSuccess && !$isVoided && !$isRefunded) { // transcation succeeded.
            /*
            $name = $order->firstname ." ". $order->lastname;
            Mail::send('email.order', ['order' => $order], function($message) use($request , $name , $order){
                $message->to($order->email , $name);
                $message->from(env('MAIL_USERNAME' , 'learnweb2021@gmail.com') , env('APP_NAME' , 'SozlerEgypt'));
                $message->subject('Order success');
            });
            */
            auth()->user()->cart_items()->delete();

            $success = "تمت عملية الشراء بنجاح ورقم الاوردر هو " . $order->id;
            session()->flash('success' ,$success);
            return  redirect()->route('web.home');
        } elseif ($isSuccess && $isVoided) { // transaction voided.
            $success = "is_voided";
            session()->flash('success' ,$success);
            return  redirect()->route('web.home' );
        } elseif ($isSuccess && $isRefunded) { // transaction refunded.
            $success = "is_refunded";
            session()->flash('success' ,$success);
            return  redirect()->route('web.home' );
        } elseif (!$isSuccess) { // transaction failed.
            $success = "حدثت مشكله يرجى المحالوله مر اخرى";
            session()->flash('error' ,$success);
            return  redirect()->route('web.home');
        }

        return response()->json(['success' => true], 200);
    }

}
