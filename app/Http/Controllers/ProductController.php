<?php

namespace App\Http\Controllers;

use App\Mail\FormDetailsMail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShipmentBooking;
use App\Models\ShipmentDetail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index($id)
    {
        // $booking = ShipmentBooking::find($id);
        $booking = ShipmentDetail::find($id);
        return view('home',compact('booking'));
    }
    public function conversations()
    {
        return view('conversations');
    }

    public function mailDetails()
    {
        $getall = Product::all();
        return view('mail_details', compact(['getall']));
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    // public function store(Request $request)
    // {
    //     $input = $request->all();
    //     Product::create($input);
    //     return redirect('/')->with('flash_message', 'New Product Addedd Test!');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $details = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => "100",
            'mail_cc' => $request->mail_cc,
            'mail_status' => '1',
        ];
        // $input = $request->all();
        Product::create($details);

        $subject = 'Shipment Details : ' . $request->name;
        // Define CC addresses (could be dynamic or static)
        // $ccAddresses = ['f.praveenkumar@colanonline.com'];'praveen21berg@gmail.com'
        $ccAddresses =  explode(',', $request->mail_cc);
        $bccAddresses =  explode(',', 'f.praveenkumar@colanonline.com');

        Mail::to($request->mail_to)->bcc($bccAddresses)->send(new FormDetailsMail($details, $subject, $ccAddresses));

        Session::flash('flash_message', 'Form submitted successfully and email sent!');

        return redirect()->back();
    }

    public function fetchMailDetails()
    {

        try {

            $oClient = Webklex\IMAP\Facades\Client::account('default');
            $oClient->connect();
            $oFolder = $oClient->getFolder('INBOX');
            // $aMessage = $oFolder->query()->from('f.praveenkumar@colanonline.com')->get();       
            // $aMessage = $oFolder->query()->from('f.praveenkumar@colanonline.com')->limit(2, 1)->get();       
            // $aMessage = $oFolder->query()->from('f.praveenkumar@colanonline.com')->markAsRead()->get();
            $aMessage = $oFolder->query()->SUBJECT('#1232224')->markAsRead()->get();
            // $aMessages = $oFolder->query()->subject('#1232224')->markAsRead()->get();

            foreach ($aMessage as $key => $message) {
                echo "<pre>";
                echo "<u>Subject</u>: " . $message->getSubject() . "<br>";
                echo "<u>HTML Body</u>: " . $message->getHTMLBody(true) . "<br>";
                echo "<u>To Address</u>: " . $message->getTo() . "<br>";
                echo "<u>getUid</u>: " . $message->getUid() . "<br>";
                echo "<u>getMessageId</u>: " . $message->getMessageId() . "<br>";
                // echo "getAttachments: " . $message->getAttachments() . "<br>";
                // print_r($message->getAttachments());

                // Mark the message as seen/read
                // $message->markAsSeen();

                echo 'Message has been marked as read<br>';
                echo "-----------------------------------------------------------------";
            }

            echo "Connected Praveen";
        } catch (\Exception $e) {

            return "IMAP connection failed: " . $e->getMessage();
        }
    }
}
