<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Food;

use App\Models\t_order;

use App\Models\t_feedback;

use App\Mail\AdminNotification;

use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
   

    public function food_menu()
    {
        return view('admin.food_menu');
    }

    public function upload(Request $request)
    {
        $data = new food;

        $image = $request->f_image;

        $imagename = time().'.'.$image->getClientOriginalExtension();

            $request->f_image->move('food_image',$imagename);

            $data->f_image=$imagename;

            $data->f_title=$request->f_title;

            $data->f_price=$request->f_price;

            $data->f_desc=$request->f_desc;

            $data->save();

            return redirect()->back();
    }
    public function order(Request $request)
    {

        $order = new t_order;

          $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'std_no' => 'required',
            'message' => 'required',
        ]);
        

            $order->name=$request->name;

            $order->phone=$request->phone;

            $order->std_no=$request->std_no;

            $order->message=$request->message;

            $order->date=$request->date;

            $order->time=$request->time;

            $order->save();

        // Optionally, you can add a success message and redirect the user
        return redirect()->back()->with('success', 'Order placed successfully!');
    
    }

    public function food_table()
    {   
        $item = food::all();
        return view('admin.food_table',compact('item'));
    }
    public function update_menu($id)
    {   
        $f_item = food::find($id);
        return view('admin.edit_food',compact('f_item'));
    }
    public function save_menu(Request $request, $id)
   {
    $s_food=food::find($id);

    $s_food->f_title=$request->f_title;

    $image=$request->file;

    if($image)
    {

    $imagename=time().'.'.$image->getClientOriginalExtension();

    $request->file->move('food_image',$imagename);

    $s_food->f_image=$imagename;

    }

    $s_food->f_price=$request->f_price;

    $s_food->f_desc=$request->f_desc;

    $s_food->save();

    return redirect()->back();


   }
   public function delete_order($id)
   {
        $menu=food::find($id);

        $menu->delete();

        return redirect()->back();
   }
   public function clear_order($id)
   {
        $cus_order=t_order::find($id);

        $cus_order->delete();

        return redirect()->back();
   }

   public function feedback(Request $request)
   {

       $feedback = new t_feedback;
         // Validate the form data
         $request->validate([
           'message' => 'required',
       ]);

           $feedback->message=$request->message;

           $feedback->save();

       return redirect()->back();
   
   }
   public function view_feedback()
   {

       $cus_review = t_feedback::all();
       return view('admin.view_feedback',compact('cus_review'));
   
   }
   
   
 
}
