<?php

namespace App\Http\Controllers;

use App\Imports\MultipleContainerImport;
use Illuminate\Http\Request;
use App\Imports\ShipmentsImport;
use App\Models\Branch;
// use App\Models\FCL_BKG;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Shipment;
use App\Models\ShipmentBooking;
use App\Models\ShipmentDetail;
use App\Models\ShipmentMailDetail;
use App\Models\ShipmentMain2;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
// use Webklex\IMAP\Facades\Client;
use Webklex\IMAP\Facades\Client;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ShipmentController extends Controller
{
    
    public function shipmentDetails()
    {
        $pageName = 'Shipment'; // Example dynamic data
        return view('Backend.ship-detail', compact('pageName'));
    }

    public function shipment()
    {
        return view('Backend.shipment');
    }
    public function showShipment(Request $request)
    {
        $pageName = 'Shipment'; // Example dynamic data
      
        $user_id = session('loginId') ?? null;
        if ($user_id) {
            $user = User::find($user_id);
            if ($user) {
                $user_role = $user->role;
                $user_branches = $user->branch; // Comma-separated branches
                $loggedInUserName = $user->name;
                $loggedInUserDesignation = $user->role;
            } else {
                $user_role = null;
                $user_branches = null;
                $loggedInUserName = '';
                $loggedInUserDesignation = '';
            }
            $query = ShipmentDetail::query();

            // Apply branch filter if provided
            if ($request->has('branch') && !empty($request->branch)) {
                if (!in_array('all', $request->branch)) {
                    $query->whereIn('BRANCH', $request->branch);
                }
            }
          

             // Additional branch filtering from request
                

            // Split branches into an array
            $branchArray = !empty($user_branches) ? explode(',', $user_branches) : [];
             // Get selected branches from request

            if (!empty($user_role) && $user_role == "Admin") {
                // Fetch shipments that match the user's branches
                $shipments_count =  DB::table('shipment_details')->count();
                $shipments = $query->get();
                // $shipments =  DB::table('shipment_details')->get();
                $UsersCount = User::count();
            } else if (!empty($user_role) && ($user_role == "Manager" || $user_role == "User")) {
                // Fetch shipments that match the user's branches
                $shipments_count = !empty($branchArray)
                    ? DB::table('shipment_details')->whereIn('BRANCH', $branchArray)->count()
                    : 0; // Empty collection if no branches
                $shipments = !empty($branchArray)
                    ? DB::table('shipment_details')->whereIn('BRANCH', $branchArray)->get()
                    : 0; // Empty collection if no branches

                $shipmentsDetails = !empty($branchArray)
                    ? DB::table('shipment_details')->whereIn('BRANCH', $branchArray)->get()
                    : 0; // Empty collection if no branches
                $usersQuery = User::where(function ($q) use ($branchArray) {
                    foreach ($branchArray as $branch) {
                        // Add multiple LIKE conditions
                        $q->orWhere('branch', 'LIKE', "%$branch%");
                    }
                });
                if ($user_role != "User") {
                    // $UsersList = $usersQuery->where('id', '!=', $user_id)->where('role', '!=', 'Admin')->get();
                    // $UsersCount = $usersQuery->where('id', '!=', $user_id)->where('role', '!=', 'Admin')->count();
                    $UsersCount = $usersQuery->where('role', '!=', 'Admin')->count();
                } else {
                    $UsersCount = 0;
                }
            }
            $branches = Branch::where('branch_status', 'active')->get();
            if ($request->ajax()) {
                return view('Backend.shipment', compact('pageName', 'shipments', 'UsersCount', 'shipments_count', 'loggedInUserName', 'loggedInUserDesignation','branches'))->render();
            }
            return view('Backend.shipment', compact('pageName', 'shipments', 'UsersCount', 'shipments_count', 'loggedInUserName', 'loggedInUserDesignation','branches'));
        }
    }
//   public function showShipment(Request $request)
// {
//     $pageName = 'Shipment'; // Example dynamic data
//     $user_id = session('loginId') ?? null;

//     if ($user_id) {
//         $user = User::find($user_id);
//         if ($user) {
//             $user_role = $user->role;
//             $user_branches = $user->branch; // Comma-separated branches
//             $loggedInUserName = $user->name;
//             $loggedInUserDesignation = $user->role;
//         } else {
//             $user_role = null;
//             $user_branches = null;
//             $loggedInUserName = '';
//             $loggedInUserDesignation = '';
//         }

//         // Split user's branches into an array
//         $branchArray = !empty($user_branches) ? explode(',', $user_branches) : [];

//         // Handle branch filter from the request
//         $selectedBranches = $request->get('branch', []);

//         // Prepare the query for filtering shipments
//         $shipmentsQuery = DB::table('shipment_details');

//         // Apply branch filter if user role is not Admin
//         if (!empty($user_role) && $user_role != 'Admin') {
//             // If user role is Manager or User, limit to their assigned branches
//             if (!empty($branchArray)) {
//                 $shipmentsQuery->whereIn('BRANCH', $branchArray);
//             }
//         }

//         // Apply filter based on the selected branch(es) from the dropdown
//         if (!empty($selectedBranches) && !in_array('all', $selectedBranches)) {
//             $shipmentsQuery->whereIn('BRANCH', $selectedBranches);
//         }

//         // Get the filtered results
//         $shipments = $shipmentsQuery->get();
//         $shipments_count = $shipmentsQuery->count();

//         // Fetch user count, branch, etc.
//         if (!empty($user_role) && $user_role != 'Admin') {
//             $usersQuery = User::where(function ($q) use ($branchArray) {
//                 foreach ($branchArray as $branch) {
//                     $q->orWhere('branch', 'LIKE', "%$branch%");
//                 }
//             });
//             $UsersCount = $usersQuery->where('role', '!=', 'Admin')->count();
//         } else {
//             $UsersCount = User::count();
//         }

//         // Fetch active branches for the filter dropdown
//         $branches = Branch::where('branch_status', 'active')->get();

//         return view('Backend.shipment', compact('pageName', 'shipments', 'UsersCount', 'shipments_count', 'loggedInUserName', 'loggedInUserDesignation', 'branches'));
//     }

//     // If no user is logged in, redirect to login or handle the error appropriately
//     return redirect()->route('login');
// }


    public function import(Request $request)
    {
        // Validate the file input
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }

        try {
            // Import the data from the file
            Excel::import(new ShipmentsImport, $request->file('file'));
            return redirect()->back()->with('success', 'Shipments imported successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function importMultiple(Request $request)
    {

        // Excel::import(new MultipleContainerImport, $request->file('file'));exit;
        // Validate the file input
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }

        try {
            // Import the data from the file
            Excel::import(new MultipleContainerImport, $request->file('file'));
            return redirect()->back()->with('success', 'Shipments imported with multiple containers and packages successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function exportToXml()
    {
        $shipments = Shipment::first();

        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="us-ascii"?><XmlInterchange xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" Version="1" xmlns="http://www.edi.com.au/EnterpriseService/"/>');

        $interchangeInfo = $xml->addChild('InterchangeInfo');
        foreach ($shipments as $shipment) {
            $date = $interchangeInfo->addChild('Date', $shipment->date);
            // Add other fields as required
        }

        return Response::make($xml->asXML(), 200, [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename="shipments.xml"',
        ]);
    }

    //     public function exportShipmentsXml()
    // {
    //     $shipments = Shipment::all(); // Retrieve all shipments (or use appropriate query)
    //     // print_r($shipments);exit;

    //     return view('export-xml', compact('shipments'));
    // }

    public function exportShipmentsXml() // this is the main file
    {
        $shipments = Shipment::first(); // Or use appropriate query to fetch shipments

        // Render Blade template to XML content
        $xmlContent = view('new_xml_file', compact('shipments'))->render();

        // Set response headers for XML download
        $headers = [
            'Content-Type' => 'text/xml',
            'Content-Disposition' => 'attachment; filename="shipments.xml"',
        ];

        // Return the XML content as a download
        return Response::make($xmlContent, 200, $headers);
    }

    public function exportNewFile()
    {
        $shipment = Shipment::first();

        $getView = view('next_export_file', compact('shipment'))->render();

        $headers = [
            'Content-Type' => 'text/xml',
            'Content-Disposition' => 'attachment; filename="shipments_details.xml"',
        ];

        return Response::make($getView, 200, $headers);
    }

    public function exportShipmentsXmlById($id) // this is the main file
    {
        $shipments = Shipment::find($id); // Or use appropriate query to fetch shipments
        if ($shipments) {
            // Render Blade template to XML content
            $xmlContent = view('new_xml_file', compact('shipments'))->render();

            // Set response headers for XML download
            $headers = [
                'Content-Type' => 'text/xml',
                'Content-Disposition' => 'attachment; filename="shipments.xml"',
            ];
            return Response::make($xmlContent, 200, $headers);
        } else {
            echo "No shipment found";
        }
    }

    public function shipmentView()
    {
        $shipments = Shipment::all();
        return view('shipmens', compact('shipments'));
    }

    public function get_new_mails(Request $request)
    {
        $getStatus = false;
        if ($request->id != "" && $request->id != null) {
            $id = $request->id;
            $getStatus = $this->viewMailDetails2($id);
        }

        return response()->json(["data" => $getStatus]);
    }
    public function checkNewMails()
    {
        try {
            $oClient = Client::account('default');
            $oClient->connect();
            $oFolder = $oClient->getFolder('INBOX');
            $keyword = 'BOOKING ERP';
            $today = Carbon::now()->format('d-M-Y');
            $aMessage = $oFolder->query()
                ->unseen()
                ->subject($keyword)
                ->since($today)
                ->markAsRead() // Filter emails since today's date
                ->get();
            $count = $aMessage->count();
            $insert = 0;
            if ($count > 0) {
                //------------------------------------ new mail insert start ---------
                foreach ($aMessage as $key => $message) {
                    $getSubject = $message->getSubject();
                    if (preg_match('/\[#([A-Z0-9]+)\]/', $getSubject, $matches)) {
                        $keyword = $matches[1]; // GLWWMUMGDY30082340
                        echo $keyword;
                        $chkBookID = ShipmentDetail::where('BKGNO', $keyword)->first();
                        if ($chkBookID) {
                            $newFolder = $chkBookID->id;
                            $existingMail = ShipmentMailDetail::where('uid', $message->getUid())->exists();
                            if (!$existingMail) {
                                $htmlBody = $message->getHTMLBody();
                                $htmlBody = preg_replace('/[^\x20-\x7F]/', '&nbsp;', $htmlBody);
                                $attachments = $message->getAttachments();
                                $attachmentPaths = [];
                                // Define directories
                                $attachmentDir = storage_path('app/public/attachments/' . $newFolder);
                                $bodyImageDir = storage_path('app/public/body_pics/' . $newFolder);
                                
                                // Create directories if they don't exist
                                if (!is_dir($attachmentDir)) {
                                    mkdir($attachmentDir, 0755, true);
                                }

                                if (!is_dir($bodyImageDir)) {
                                    mkdir($bodyImageDir, 0755, true);
                                }

                                // Initialize ImageManager


                                // Save attachments
                                $attachmentMap = [];
                                $attachments->each(function ($attachment) use ($attachmentDir, &$attachmentPaths, &$attachmentMap) {
                                    $filename = $attachment->getName();
                                    $filename = urldecode($filename);
                                    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);

                                    // Append attachment ID to filename to ensure uniqueness
                                    $uniqueFilename = pathinfo($filename, PATHINFO_FILENAME) . '.' . pathinfo($filename, PATHINFO_EXTENSION);
                                    $savePath = $attachmentDir . DIRECTORY_SEPARATOR . $uniqueFilename;

                                    // Check if the attachment is an image
                                    if (strpos($attachment->getMimeType(), 'image/') === 0) {
                                        $multipleImages = new ImageManager(new Driver());
                                        $img = $multipleImages->read($attachment->getContent());
                                        $img->toJpeg(80)->save($savePath);
                                    } else {
                                        file_put_contents($savePath, $attachment->getContent());
                                        // Map cid to unique filename                      
                                    }
                                    $attachmentPaths[] = $savePath;
                                    $attachmentMap[$attachment->getId()] = $uniqueFilename;
                                });

                                $dom = new \DOMDocument();
                                @$dom->loadHTML($htmlBody);
                                $xpath = new \DOMXPath($dom);
                                $images = $xpath->query('//img[@src]');

                                foreach ($images as $image) {
                                    if ($image instanceof \DOMElement) {
                                        $imgSrc = $image->getAttribute('src');

                                        if (strpos($imgSrc, 'cid:') === 0) {
                                            $cid = substr($imgSrc, 4); // Remove 'cid:' prefix
                                            if (isset($attachmentMap[$cid])) {
                                                $filename = $attachmentMap[$cid];
                                                $bodyPicPath = $bodyImageDir . DIRECTORY_SEPARATOR . $filename;
                                                if (file_exists($attachmentDir . DIRECTORY_SEPARATOR . $filename)) {
                                                    $image->setAttribute('src', asset('storage/attachments/' . $newFolder . '/' . $filename));
                                                }
                                            }
                                        } elseif (strpos($imgSrc, 'data:image') === 0) {
                                            $imageType = 'png';
                                            if (preg_match('/^data:image\/(jpg|jpeg|png|gif);base64/', $imgSrc, $matches)) {
                                                $imageType = $matches[1];
                                            }
                                            // Generate the base64 data URI with the correct image type
                                            $base64Data = explode(',', $imgSrc)[1]; // Extract base64 encoded data
                                            $dataUri = 'data:image/' . $imageType . ';base64,' . $base64Data;
                                            // Update the src attribute to use the base64 data URI
                                            $image->setAttribute('src', $dataUri);
                                        } elseif (filter_var($imgSrc, FILTER_VALIDATE_URL)) {
                                            // try {
                                            $imgContent = file_get_contents($imgSrc);
                                            if ($imgContent !== false) {
                                                $image->setAttribute('src', $imgSrc);
                                            }
                                            // } catch (\Exception $e) {
                                            //     // Handle error
                                            // }
                                        }
                                    }
                                }

                                $htmlBody = $dom->saveHTML();

                                // $sendDetails[] = [
                                //     'subject' => $message->getSubject(),
                                //     'body' => $htmlBody,
                                //     'uid' => $message->getUid(),
                                //     'to' => $message->getTo(),
                                //     'from' => $message->getFrom()[0]->mail,
                                //     'date' => $message->getDate(),
                                //     'cc' => $message->getCc(),
                                //     'bcc' => $message->getBcc(),
                                //     'sender' => $message->getSender(),
                                //     'attach_count' => $attachments->count(),
                                //     'attachment_paths' => $attachmentPaths,
                                //     'bkg_no' => '#'.$keyword,
                                //     'unique_mail_id' => $message->getUid(),
                                // ];
                                // Insert each message detail separately
                                ShipmentMailDetail::firstOrCreate(
                                    ['uid' => $message->getUid()],
                                    [
                                        'subject' => $message->getSubject(),
                                        'body' => $htmlBody,
                                        'to' => $message->getTo(),
                                        'from' => $message->getFrom()[0]->mail ?? null,
                                        'date' => $message->getDate(),
                                        'cc' => $message->getCc(),
                                        'bcc' => $message->getBcc(),
                                        'sender' => $message->getSender(),
                                        'attach_count' => $attachments->count(),
                                        'attachment_paths' => json_encode($attachmentPaths),
                                        'bkg_no' => '#' . $keyword,
                                        'unique_mail_id' => $message->getUid(),
                                    ]
                                );

                                $insert++;
                            }
                        } else {
                        }
                    } else {
                        echo "Booking number not found.";
                    }
                }
                //------------------------------------ new mail insert end -----------

            } else {
                echo "No new mail found";
            }
            if ($insert > 0) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            // return "IMAP connection failed: " . $e->getMessage();
            return false;
        }
        if ($insert > 0) {
            return true;
        } else {
            return false;
        }
        //--------------------------------------------------------------       
    }


    public function viewMailDetails($id)
    {
        $user_id = session('loginId') ?? null;
        if ($user_id) {
            $user = User::find($user_id);
            if ($user) {
                $user_role = $user->role;
                $user_branches = $user->branch; // Comma-separated branches
                $loggedInUserName = $user->name;
                $loggedInUserDesignation = $user->role;
            } else {
                $user_role = null;
                $user_branches = null;
                $loggedInUserName = '';
                $loggedInUserDesignation = '';
            }

            // Split branches into an array
            $branchArray = !empty($user_branches) ? explode(',', $user_branches) : [];

            if (!empty($user_role) && $user_role == "Admin") {
                // Fetch shipments that match the user's branches
                $shipments_count =  DB::table('shipment_details')->count();
                $UsersCount = User::count();
            } else if (!empty($user_role) && ($user_role == "Manager" || $user_role == "User")) {
                // Fetch shipments that match the user's branches
                $shipments_count = !empty($branchArray)
                    ? DB::table('shipment_details')->whereIn('BRANCH', $branchArray)->count()
                    : 0; // Empty collection if no branches

                $shipmentsDetails = !empty($branchArray)
                    ? DB::table('shipment_details')->whereIn('BRANCH', $branchArray)->get()
                    : 0; // Empty collection if no branches
                $usersQuery = User::where(function ($q) use ($branchArray) {
                    foreach ($branchArray as $branch) {
                        // Add multiple LIKE conditions
                        $q->orWhere('branch', 'LIKE', "%$branch%");
                    }
                });
                if ($user_role != "User") {
                    // $UsersList = $usersQuery->where('id', '!=', $user_id)->where('role', '!=', 'Admin')->get();
                    //   $UsersCount = $usersQuery->where('id', '!=', $user_id)->where('role', '!=', 'Admin')->count();
                    $UsersCount = $usersQuery->where('role', '!=', 'Admin')->count();
                } else {
                    $UsersCount = 0;
                }
            }
            $row_id = $id;
            $shipments = ShipmentDetail::find($row_id);

            $sendDetails = [];
            $keyword = '#' . $shipments->BKGNO;

            $existingBkg = ShipmentMailDetail::where('bkg_no', $keyword)->orderby('id', 'desc')->get();
            if (count($existingBkg) > 0) {
                $sendDetails = $existingBkg;
            }
            $pageName = 'Shipment';
            return view('Backend.ship-detail', compact('pageName', 'sendDetails', 'row_id', 'loggedInUserName', 'loggedInUserDesignation', 'UsersCount', 'shipments_count'));
        }
    }
    public function viewMailDetails2($id)
    {
        $shipments = ShipmentDetail::find($id);
        $sendDetails = [];
        $keyword = '#' . $shipments->BKGNO;
        $newFolder = $shipments->id;
        $insert = 0;
        try {
            // Connect to the IMAP server
            $oClient = Client::account('default');
            $oClient->connect();
            $oFolder = $oClient->getFolder('INBOX');
            $aMessage = $oFolder->query()->SUBJECT($keyword)->markAsRead()->get();

            foreach ($aMessage as $key => $message) {
                $existingMail = ShipmentMailDetail::where('uid', $message->getUid())->exists();
                if (!$existingMail) {
                    // $htmlBody2 = $message->getHTMLBody();
                    $htmlBody = $message->getHTMLBody();
                    $htmlBody = preg_replace('/[^\x20-\x7F]/', '&nbsp;', $htmlBody);
                    // $htmlBody = mb_convert_encoding($htmlBody, 'UTF-8', 'ISO-8859-1'); // Adjust encodings as necessary
                    // $htmlBody = str_replace("\xC2\xA0", '&nbsp;', $htmlBody);



                    // print_r($htmlBody);continue;
                    // $htmlBody = preg_replace('/[^\x20-\x7F]/', '&nbsp;', $htmlBody);


                    $attachments = $message->getAttachments();
                    $attachmentPaths = [];

                    // Define directories
                    $attachmentDir = storage_path('app/public/attachments/' . $newFolder);
                    $bodyImageDir = storage_path('app/public/body_pics/' . $newFolder);

                    // Create directories if they don't exist
                    if (!is_dir($attachmentDir)) {
                        mkdir($attachmentDir, 0755, true);
                    }

                    if (!is_dir($bodyImageDir)) {
                        mkdir($bodyImageDir, 0755, true);
                    }

                    // Initialize ImageManager


                    // Save attachments
                    $attachmentMap = [];
                    $attachments->each(function ($attachment) use ($attachmentDir, &$attachmentPaths, &$attachmentMap) {
                        $filename = $attachment->getName();
                        $filename = urldecode($filename);
                        $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);

                        // Append attachment ID to filename to ensure uniqueness
                        $uniqueFilename = pathinfo($filename, PATHINFO_FILENAME) . '.' . pathinfo($filename, PATHINFO_EXTENSION);
                        $savePath = $attachmentDir . DIRECTORY_SEPARATOR . $uniqueFilename;
                        // $uniqueFilename = pathinfo($filename, PATHINFO_FILENAME) . '_' . $attachment->getId() . '.' . pathinfo($filename, PATHINFO_EXTENSION);
                        // $savePath = $attachmentDir . DIRECTORY_SEPARATOR . $uniqueFilename;

                        // Check if the attachment is an image
                        if (strpos($attachment->getMimeType(), 'image/') === 0) {
                            $multipleImages = new ImageManager(new Driver());
                            $img = $multipleImages->read($attachment->getContent());
                            $img->toJpeg(80)->save($savePath);
                        } else {
                            file_put_contents($savePath, $attachment->getContent());
                            // Map cid to unique filename                      
                        }
                        $attachmentPaths[] = $savePath;
                        $attachmentMap[$attachment->getId()] = $uniqueFilename;
                    });

                    $dom = new \DOMDocument();
                    @$dom->loadHTML($htmlBody);
                    $xpath = new \DOMXPath($dom);
                    $images = $xpath->query('//img[@src]');

                    foreach ($images as $image) {
                        if ($image instanceof \DOMElement) {
                            $imgSrc = $image->getAttribute('src');

                            if (strpos($imgSrc, 'cid:') === 0) {
                                $cid = substr($imgSrc, 4); // Remove 'cid:' prefix
                                if (isset($attachmentMap[$cid])) {
                                    $filename = $attachmentMap[$cid];
                                    $bodyPicPath = $bodyImageDir . DIRECTORY_SEPARATOR . $filename;
                                    if (file_exists($attachmentDir . DIRECTORY_SEPARATOR . $filename)) {
                                        // Move the image to the body_pics folder
                                        // if (!copy($attachmentDir . DIRECTORY_SEPARATOR . $filename, $bodyPicPath)) {
                                        //     throw new \Exception('Failed to move the image to the body_pics folder.');
                                        // }

                                        // Update the src attribute to point to the body_pics folder
                                        $image->setAttribute('src', asset('storage/attachments/' . $newFolder . '/' . $filename));
                                    }
                                }
                            } elseif (strpos($imgSrc, 'data:image') === 0) {
                                $imageType = 'png';
                                if (preg_match('/^data:image\/(jpg|jpeg|png|gif);base64/', $imgSrc, $matches)) {
                                    $imageType = $matches[1];
                                }
                                // Generate the base64 data URI with the correct image type
                                $base64Data = explode(',', $imgSrc)[1]; // Extract base64 encoded data
                                $dataUri = 'data:image/' . $imageType . ';base64,' . $base64Data;
                                // Update the src attribute to use the base64 data URI
                                $image->setAttribute('src', $dataUri);
                            } elseif (filter_var($imgSrc, FILTER_VALIDATE_URL)) {
                                try {
                                    $imgContent = file_get_contents($imgSrc);
                                    if ($imgContent !== false) {
                                        // $imageType = pathinfo($imgSrc, PATHINFO_EXTENSION);
                                        // $imageType = in_array($imageType, ['jpg', 'jpeg', 'png', 'gif']) ? $imageType : 'png';

                                        // $fileName = 'image_' . uniqid() . '.' . $imageType;
                                        // $filePath = $bodyImageDir . DIRECTORY_SEPARATOR . $fileName;
                                        // file_put_contents($filePath, $imgContent);
                                        // $image->setAttribute('src', asset('storage/body_pics/' . $newFolder.'/'.$fileName));
                                        $image->setAttribute('src', $imgSrc);
                                    }
                                } catch (\Exception $e) {
                                    // Handle error
                                }
                            }
                        }
                    }

                    $htmlBody = $dom->saveHTML();
                    // Detect and convert encoding if needed
                    // $charset = $message->getCharset(); // Assuming the library provides charset
                    // if (!$charset) {
                    //     $charset = 'ISO-8859-1'; // Fallback if charset is not provided
                    // }
                    // $attachmentPaths = []; // Assuming you have an array to hold the attachment paths

                    // foreach ($attachments as $attachment) {
                    //     // Store the file in the storage directory and get the relative path
                    //     $path = $attachment->store('public/attachments/' . $message->getUid());

                    //     // Convert the stored path to a publicly accessible path
                    //     $publicPath = str_replace('public/', '', $path);

                    //     // Add the public path to the array
                    //     $attachmentPaths[] = $publicPath;
                    // }



                    $sendDetails[] = [
                        'subject' => $message->getSubject(),
                        'body' => $htmlBody,
                        'uid' => $message->getUid(),
                        'to' => $message->getTo(),
                        'from' => $message->getFrom()[0]->mail,
                        'date' => $message->getDate(),
                        'cc' => $message->getCc(),
                        'bcc' => $message->getBcc(),
                        'sender' => $message->getSender(),
                        'attach_count' => $attachments->count(),
                        'attachment_paths' =>json_encode($attachmentPaths),
                        'bkg_no' => $keyword,
                        'unique_mail_id' => $message->getUid(),
                    ];
                    // Insert each message detail separately
                    ShipmentMailDetail::firstOrCreate(
                        ['uid' => $message->getUid()],
                        [
                            'subject' => $message->getSubject(),
                            'body' => $htmlBody,
                            'to' => $message->getTo(),
                            'from' => $message->getFrom()[0]->mail ?? null,
                            'date' => $message->getDate(),
                            'cc' => $message->getCc(),
                            'bcc' => $message->getBcc(),
                            'sender' => $message->getSender(),
                            'attach_count' => $attachments->count(),
                            'attachment_paths' => json_encode($attachmentPaths),
                            'bkg_no' => $keyword,
                            'unique_mail_id' => $message->getUid(),
                            'unique_mail_id' => $message->getUid(),
                        ]
                    );

                    // $sendDetails[] = [
                    //     'subject' => $message->getSubject(),
                    //     'body' => $htmlBody,
                    //     'uid' => $message->getUid(),
                    //     'to' => $message->getTo(),
                    //     'from' => $message->getFrom()[0]->mail,
                    //     'date' => $message->getDate(),
                    //     'cc' => $message->getCc(),
                    //     'bcc' => $message->getBcc(),
                    //     'sender' => $message->getSender(),
                    //     'attach_count' => $attachments->count(),
                    //     'attachment_paths' => json_encode($attachmentPaths), // Store as JSON if array
                    //     'bkg_no' => $keyword,
                    //     'unique_mail_id' => $message->getUid(),
                    // ];

                    // Insert the data
                    $insert++;
                }
            }
            if ($insert > 0) {
                if($shipments->mail_read_status == 1){
                    $shipments->mail_count = $shipments->mail_count + $insert;
                }else{
                    $shipments->mail_read_status = 1;
                    $shipments->mail_count = $insert;
                }
                $shipments->save();
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            // return "IMAP connection failed: " . $e->getMessage();
            return false;
        }
        if ($insert > 0) {
            return true;
        } else {
            return false;
        }
        // $pageName = 'Shipment';
        // return view('Backend.ship-detail', compact('pageName', 'sendDetails'));
    }

    public function exportMultipleShipmentsXmlById($id) // this is the main file
    {
        $find = ShipmentMain2::find($id);
        if ($find) {
            $shipmentDetails = ShipmentMain2::with(['shipMarksAN', 'shipPackages', 'shipContainer'])
                ->where('id', $id)
                ->get();
            if ($shipmentDetails) {
                // Render Blade template to XML content
                $xmlContent = view('new_multi_container_xml_file', compact('shipmentDetails'))->render();

                // Set response headers for XML download
                $headers = [
                    'Content-Type' => 'text/xml',
                    'Content-Disposition' => 'attachment; filename="shipment_with_multiple_containers.xml"',
                ];
                return Response::make($xmlContent, 200, $headers);
            } else {
                echo "No shipment found";
            }
        }
    }

//     public function downloadAttachment($filePath)
// {
//     // Decode the file path
//     $decodedPath = urldecode($filePath);

//     // Construct the full path to the file
//     $filePath = storage_path('app/public/attachments/' . $decodedPath);

//     // Check if file exists
//     if (file_exists($filePath)) {
//         return response()->download($filePath);
//     } else {
//         return abort(404);
//     }
// }
}
