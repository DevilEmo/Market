<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\stallowner;
use App\payment;
use App\parking;
use Carbon\Carbon;
use DB;

class CashierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rent_payment(Request $request)
    {
        $data = stallowner::filter($request)->orderBy('stall_number','asc')->get();
       
        // $data = stallowner::filter($request)->orderBy('created_at','desc')->paginate(20);
        // $data = stallowner::orderBy('created_at','desc')->paginate(20);
        return view('cashier.rent_payment')->with('data',$data);
        // return view('cashier.rent_payment');
    }
    public function parking_payment()
    {
        return view('cashier.parking_payment');
    }
    public function about_us()
    {
        return view('cashier.about_us');
    }
    public function create_payment($id)
    {
        $stallowner = stallowner::find($id);
        $prev = payment::where('stallowner_id',$stallowner->id)->latest('id')->first();
       
        // $prev = DB::table('payments')->latest('created_at')->first();

        // $prev = $prev->duedate day(20)->addMonth()->format('Y-m-d');

        $dt = Carbon::create($prev->duedate);

        $no_of_day = $dt->daysInMonth;
       
        $duedate = $dt->day(20)->addMonth()->format('Y-m-d');
        
        $goodwill = 0;
        if ($prev->payment_number <= 11) {
            switch ($stallowner->class) {
                case 'A':
                    $goodwill = (30000-(30000*.25))/12;
                    break;
                case 'B':
                    $goodwill = (25000-(25000*.25))/12;
                    break;
                case 'C':
                    $goodwill = (20000-(20000*.25))/12;
                    break;
                case 'D':
                    $goodwill = (15000-(15000*.25))/12;
                    break;
                case 'meatshop':
                    $goodwill = (20000-(20000*.25))/12;
                    break;
                case 'fishshop':
                    $goodwill = (15000-(15000*.25))/12;
                    break;
                default:
                    $goodwill = 0;
                    break;
            }
        }

        switch ($stallowner->class) {
            case 'A':
                $rentalfee = ($stallowner->area*5.5)*$no_of_day;
                break;
            case 'B':
                $rentalfee = ($stallowner->area*4.5)*$no_of_day;
                break;
            case 'C':
                $rentalfee = ($stallowner->area*3.75)*$no_of_day;
                break;
            case 'D':
                $rentalfee = ($stallowner->area*3.25)*$no_of_day;
                break;
            case 'meatshop':
                switch ($stallowner->stall_number) {
                    case '1':
                        $rentalfee = 30*$no_of_day;
                        break;
                    case '2':
                        $rentalfee = 30*$no_of_day;
                        break;
                    case '3':
                        $rentalfee = 30*$no_of_day;
                        break;
                    case '4':
                        $rentalfee = 25*$no_of_day;
                        break;
                    case '5':
                        $rentalfee = 25*$no_of_day;
                        break;
                    case '6':
                        $rentalfee = 25*$no_of_day;
                        break;
                    case '7':
                        $rentalfee = 20*$no_of_day;
                        break;
                    case '8':
                        $rentalfee = 20*$no_of_day;
                        break;
                    case '9':
                        $rentalfee = 20*$no_of_day;
                        break;
                    
                    default:
                        $rentalfee = 15*$no_of_day;
                        break;
                }
                break;
            case 'fishshop':
                switch ($stallowner->stall_number) {
                    case '1':
                        $rentalfee = 30*$no_of_day;
                        break;
                    case '2':
                        $rentalfee = 30*$no_of_day;
                        break;
                    case '3':
                        $rentalfee = 30*$no_of_day;
                        break;
                    case '4':
                        $rentalfee = 25*$no_of_day;
                        break;
                    case '5':
                        $rentalfee = 25*$no_of_day;
                        break;
                    case '6':
                        $rentalfee = 25*$no_of_day;
                        break;
                    case '7':
                        $rentalfee = 20*$no_of_day;
                        break;
                    case '8':
                        $rentalfee = 20*$no_of_day;
                        break;
                    case '9':
                        $rentalfee = 20*$no_of_day;
                        break;
                    
                    default:
                        $rentalfee = 15*$no_of_day;
                        break;
                }
                break;
            default:
                $goodwill = 0;
                break;
        }
            
        $total_amount = $goodwill+$rentalfee+50;
        $data = [
            'stallowner' => $stallowner,
            'prev' => $prev,
            'goodwill' => $goodwill,
            'rentalfee' => $rentalfee,
            'duedate' => $duedate,
            'total_amount' => $total_amount,
        ];
       
        return view('cashier.create_payment')->with($data);
    }
    public function parking_records(Request $request)
    {   
        if (auth()->user()->account_type !== 'cashier') {
            return redirect('/admin/stall_owner_list')->with('error', 'Unauthorized page');
        }else{
            $prev = DB::table('payments')->latest('created_at')->first();
            $parking = parking::filter($request)->orderBy('created_at','desc')->paginate(15);
            $data = [
                'prev' => $prev,
                'parking' => $parking,
            ];
            return view('cashier.parking_payment')->with($data);
        }
    }
    
    
}
