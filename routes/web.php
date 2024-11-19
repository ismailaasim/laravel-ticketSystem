<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
// use Webklex\IMAP\Facades\Client;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\MSAccessController;
use App\Mail\TestEmail;
use App\Http\Controllers\ProductController; //add ProductController
use App\Http\Controllers\ShipmentController;
// ------------------------ New Code start ---------------------------

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ShipmentNewController;
// ------------------------ New Code start - End---------------------------


// use Webklex\PHPIMAP\Client;
// use Webklex\PHPIMAP\Client;

// Route::get('/fetch-emails', function () {
//     try {
//         // Create an IMAP client instance
//         $client = new Client();

//         // Set the account configuration
//         $client->setAccount(config('imap.accounts.default'));

//         // Connect to the IMAP server
//         $client->connect();

//         // Get the "INBOX" folder
//         $folder = $client->getFolder('INBOX');

//         // Fetch emails sorted by date descending (latest first)
//         $emails = $folder->query()->limit(1)->get();

//         // Check if any emails were fetched
//         if ($emails->isEmpty()) {
//             return "No emails found in INBOX.";
//         }

//         // Get the latest email
//         $latestEmail = $emails->first();

//         // Display email details
//         echo "Subject: " . $latestEmail->getSubject() . "<br>";
//         echo "From: " . $latestEmail->getFrom()[0]->mail . "<br>";
//         echo "Body: " . $latestEmail->getTextBody() . "<br>";
//         echo "<hr>";

//         // Disconnect from the IMAP server
//         $client->disconnect();

//         return "Latest email fetched successfully!";
//     } catch (\Exception $e) {
//         return "IMAP connection failed: " . $e->getMessage();
//     }
// });


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ------------------------ New Code start ---------------------------
Route::get('/', [LoginController::class, 'login'])->name('login')->middleware('alreadyLoggedIn');
Route::get('/register', [RegisterController::class, 'register'])->name('register')->middleware('alreadyLoggedIn');
Route::post('/registration-user', [RegisterController::class, 'registerUser'])->name('register-user');
Route::post('/login-Authuser', [LoginController::class, 'loginUser'])->name('login-user');

Route::prefix('backend')->middleware('isLoggedIn')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('dashboard');
    Route::get("/shipment", [ShipmentController::class, 'showShipment'])->name('shipment');
    Route::get("/shipDetail", [AdminController::class, 'shipmentDetails'])->name('shipDetail');
    Route::get("/logout", [AdminController::class, 'logout'])->name('logout-user');
    // UserList Routes
    Route::get('/user-list', [UserListController::class, 'index'])->name('user-List');
    Route::post('/user-store', [UserListController::class, 'store'])->name('userStore');
    Route::get('/user-list/{id}/edit', [UserListController::class, 'edit'])->name('EditUserList');
    Route::put('/user-list/{id}/update', [UserListController::class, 'update'])->name('UpdateUserList');
    // Route to fetch updated table content
    // Route::get('/fetch-updated-table', [UserListController::class, 'fetchTable'])->name('user.fetchTable');

    Route::delete('/user-list/{id}/delete', [UserListController::class, 'destroy'])->name('user.delete');
    Route::get('view_mail_details/{id}', [ShipmentController::class, "viewMailDetails"]);
    Route::get('/filter-shipments', [ShipmentNewController::class, "filterShipments"])->name('filter.shipments');
    Route::post('get_new_mails', [ShipmentController::class, "get_new_mails"])->name('get_new_mails');
    Route::post('/user-list/{id}/generate-password', [UserListController::class, 'generatePassword'])->name('user.generatePassword');
});
// ------------------------ New Code start - End ---------------------------

Route::get('/home/{id}', [ProductController::class, 'index']);
Route::get('/mailDetails', [ProductController::class, 'mailDetails']);
Route::post('upload_image', [ProductController::class, 'uploadImage'])->name('upload');
Route::post('save', [ProductController::class, 'store'])->name('store');
Route::get('conversations', [ProductController::class, 'conversations']);


Route::get('/send-test-email', function () {
    Mail::to('f.praveenkumar@colanonline.com')->send(new TestEmail());

    return "Test email sent!";
});

Route::get('main_form', [TicketController::class, "loadMailForm"]);




Route::get('/fetch-emails', function () {
    try {

        $oClient = Webklex\IMAP\Facades\Client::account('default');
        $oClient->connect();
        $oFolder = $oClient->getFolder('INBOX');
        // $aMessage = $oFolder->query()->from('f.praveenkumar@colanonline.com')->get();       
        // $aMessage = $oFolder->query()->from('f.praveenkumar@colanonline.com')->limit(2, 1)->get();       
        // $aMessage = $oFolder->query()->from('f.praveenkumar@colanonline.com')->markAsRead()->get();
        $aMessage = $oFolder->query()->SUBJECT('#GLWWMUMLE 0204242139')->markAsRead()->get();
        // $aMessages = $oFolder->query()->subject('#1232224')->markAsRead()->get();

        foreach ($aMessage as $key => $message) {
            echo "<pre>";
            echo "<u>Subject</u>: " . $message->getSubject() . "<br>";
            echo "<u>HTML Body</u>: " . $message->getHTMLBody() . "<br>";
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
});
// Route::get('/read-last-email', function () {
//     try {
//         // Create an IMAP client instance
//         $client = new Client();

//         // Set the account configuration
//         $client->setAccount(config('imap.accounts.default'));

//         // Connect to the IMAP server
//         $client->connect();

//         // Get the "INBOX" folder
//         $folder = $client->getFolder('INBOX');

//         // Fetch emails sorted by date descending (latest first)
//         $messages = $folder->query()->latest()->limit(1)->get();

//         // Check if any emails were fetched
//         if ($messages->isEmpty()) {
//             return "No emails found in INBOX.";
//         }

//         // Get the latest message
//         $message = $messages->first();

//         // Display email details
//         echo "Subject: " . $message->getSubject() . "<br>";
//         echo "From: " . $message->getFrom()[0]->mail . "<br>";
//         echo "Body: " . $message->getTextBody() . "<br>";
//         echo "<hr>";

//         // Disconnect from the IMAP server
//         $client->disconnect();

//         return "Last email fetched successfully!";
//     } catch (\Exception $e) {
//         return "Error fetching last email: " . $e->getMessage();
//     }
// });

Route::get('/ms_acces2', [MSAccessController::class, 'checkMS']);
Route::get('/getODBCDetails', [MSAccessController::class, 'getODBCDetails']);
Route::get('/createStudentTable', [MSAccessController::class, 'createStudentTable']);
Route::get('/getColumnNames', [MSAccessController::class, 'getColumnNames']);
Route::get('/syncData', [MSAccessController::class, 'syncData']);

Route::get('/import_view', function () {
    return view('import');
});
Route::get('/multiple_import', function () {
    return view('multiple_import');
});

Route::get('/booking_details', [MSAccessController::class, 'loadBookingDetails']);

Route::post('/import-shipments', [ShipmentController::class, 'import'])->name('import.shipments');
Route::post('/import-multi-shipments', [ShipmentController::class, 'importMultiple'])->name('import.multiple.shipments');
Route::get('/export/{id}', [ShipmentController::class, 'exportShipmentsXmlById']);
Route::get('/export-mcontainer/{id}', [ShipmentController::class, 'exportMultipleShipmentsXmlById']);
Route::get('/shipments', [ShipmentController::class, 'shipmentView']);
// Route::get('view_mail_details/{id}', [ShipmentController::class, "viewMailDetails"]);
Route::get('checkNewMails', [ShipmentController::class, "checkNewMails"]);
// Route::get('download/{filePath}', [ShipmentController::class, 'downloadAttachment'])->name('download.attachment');
Route::get('view_mail_details2/{id}', [ShipmentController::class, "viewMailDetails2"]);



Route::get('master', function () {
    return view('profile', ['name' => 'contact profile']);
});


Route::get('master2', function () {
    return view('profile_2', ['name' => 'contact us']);
});

Route::get('/download-access-db', function () {
    $ftp_server = '192.168.2.249';
    $ftp_port = 21;
    $ftp_user_name = 'Testdb';
    $ftp_user_pass = '$Test@2024&';

    // Remote and local file paths
    $remote_file = '/Testdb/EXNOM.mdb'; // Update this path
    // $local_file = 'C:\\Users\\CIPL1186\\Documents\\EXNOM.mdb'; // Update this path
    $local_file = storage_path('app/msaccess/EXNOM.mdb');
    // Ensure the local directory exists
    $local_directory = dirname($local_file);
    if (!file_exists($local_directory)) {
        mkdir($local_directory, 0777, true);
    }
    // $sftp->get($remoteFile, $local_file);

    // Establish an FTP connection
    $ftp_conn = ftp_connect($ftp_server, $ftp_port) or die("Could not connect to $ftp_server");

    // Login to FTP server
    if (@ftp_login($ftp_conn, $ftp_user_name, $ftp_user_pass)) {
        echo "Connected to FTP server.";
    } else {
        die("Could not connect to FTP server.");
    }

    // Download the file
    if (ftp_get($ftp_conn, $local_file, $remote_file, FTP_BINARY)) {
        echo "Successfully downloaded $remote_file to $local_file";
    } else {
        echo "Error downloading $remote_file";
    }

    // Close the connection
    ftp_close($ftp_conn);
});

Route::get('checkLiveDB', [MSAccessController::class, 'checkLiveDB']);

// new
// Route::prefix('backend')->group(function () {
//     // Route::get('/user', [UserListController::class,'showUser'])->name('user');
//     Route::post('get_new_mails', [ShipmentController::class, "get_new_mails"])->name('get_new_mails');

//     Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
//     Route::get("/shipment", [ShipmentController::class, 'showShipment'])->name('shipment');
//     Route::get("/shipDetail", [ShipmentController::class, 'shipmentDetails'])->name('shipDetail');


//     // UserList Routes
//     Route::get('/user-list', [UserListController::class, 'index'])->name('user-List');
//     Route::post('/user-store', [UserListController::class, 'store'])->name('userStore');
//     Route::get('/user-list/{id}/edit', [UserListController::class, 'edit'])->name('EditUserList');
//     Route::put('/user-list/{id}/update', [UserListController::class, 'update'])->name('UpdateUserList');
// });
