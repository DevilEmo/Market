<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\stallowner;
use App\parking;
use App\payment;
use Carbon\Carbon;
use DB;
use App\Http\Resources\stallowner as stallownerResources;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create_stall_owner()
    {
        if (auth()->user()->account_type !== 'admin') {
            return redirect('/cashier/rent_payment')->with('error', 'Unauthorized page');
        }else{
            return view('admin.create_stall_owner');
        }
        
    }
    public function update_stall_owner($id)
    {
        if (auth()->user()->account_type !== 'admin') {
            return redirect('/cashier/rent_payment')->with('error', 'Unauthorized page');
        }else{
            $stallowner = stallowner::find($id);
            return view('admin.update_stall_owner')->with('stallowner', $stallowner);
        }
    }
    public function stall_owner_list(Request $request)
    {
        if (auth()->user()->account_type !== 'admin') {
            return redirect('/cashier/rent_payment')->with('error', 'Unauthorized page');
        }else{
            // $data = stallowner::filter($request)->orderBy('updated_at','desc')->get();
            $data = stallowner::filter($request)->orderBy('stall_number','asc')->get();
            return view('admin.stall_owner_list')->with('data',$data);
        }
    }
    public function parking_records(Request $request)
    {   
        if (auth()->user()->account_type !== 'admin') {
            return redirect('/cashier/rent_payment')->with('error', 'Unauthorized page');
        }else{
            $parking = parking::filter($request)->orderBy('created_at','desc')->paginate(15);
            $prev = DB::table('parkings')->latest('created_at')->first();
            $data = [
                'prev' => $prev,
                'parking' => $parking,
            ];
            return view('admin.parking_records')->with($data);
        }
    }
    public function create_payment($id)
    {   
        $stallowner = stallowner::find($id);

        $stallowner->duedate = today()->day(20)->addMonth()->format('Y-m-d');

        $dt = Carbon::create($stallowner->contract_date);
        $startdate = $stallowner->contract_date;
        
        $date1 = $dt->format('d');
        $date2 = $dt->daysInMonth;
        $no_of_day = ($date2 - $date1)+1;

        // dd($date2.'-'.$date1.'-'.$no_of_day);
        $duedate = $dt->day(20)->addMonth()->format('Y-m-d');
        // $duedate= $stallowner->duedate;
        $goodwill = 0;
            switch ($stallowner->class) {
                case 'A':
                    $goodwill = (30000*.25)+((30000-(30000*.25))/12);
                    $rentalfee = ($stallowner->area*5.5)*$no_of_day;
                    // $rentalfee = ($stallowner->area*3.75*($stalldate('m')));
                    break;
                case 'B':
                    $goodwill = (25000*.25)+((25000-(25000*.25))/12);
                    $rentalfee = ($stallowner->area*4.5)*$no_of_day;
                    break;
                case 'C':
                    $goodwill = (20000*.25)+((20000-(20000*.25))/12);
                    $rentalfee = ($stallowner->area*3.75)*$no_of_day;
                    break;
                case 'D':
                    $goodwill = (15000*.25)+((15000-(15000*.25))/12);
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
                    $goodwill = (20000*.25)+((20000-(20000*.25))/12);
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
                    $goodwill = (15000*.25)+((15000-(15000*.25))/12);
                    break;
                default:
                    $goodwill = 0;
                    break;
            }
        $data = [
            'stallowner' => $stallowner,
            'goodwill' => $goodwill,
            'rentalfee' => $rentalfee,
            'duedate' => $duedate,
        ];

        return view('admin.create_payment')->with($data);
    }
    public function admin_parking_view($id)
    {   
        $parking = parking::find($id);
        $data = [
            'parking' => $parking,
        ];
        return view('cashier.printparking')->with($data);
    }

    public function printdetail($id)
    {
        $parking = parking::find($id);
        $data = [
            'parking' => $parking,
        ];
        return view('admin.ticketdetail')->with($data);
        
    }
    
    
}
