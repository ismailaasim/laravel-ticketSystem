@extends('Backend.layout.app')

@section('main-content')
<link rel="stylesheet" href="{{asset('/assets/css/shipDetail-style.css')}}">
  
   
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <hr class="horizontal dark mt-0">

    <div class="container-fluid py-3 ">
        <div class="row mt-3">
            <div class="header me-4">
                <a href="{{ url('backend/shipment') }}" class="py-2 ms-4">
                    <i class="fa fa-arrow-left me-2"></i>
                    Back
                </a>
                <h5 class="card-title py-4 ms-4">Shipment Tracking</h5>
                <hr class="horizontal dark mt-0">
            </div>
        </div>

    <div class="row mt-3 ms-auto ">
        @csrf
        <div class="container load_new_mail_card">
            @if (!empty($sendDetails))
                @foreach ($sendDetails as $sendDetail)
                    <div class="card bg-in my-3">
                        <div class="card-body">
                            <div class="email-header  d-flex justify-content-between">
                                <div class="email-item">
                                    <button class="btn btn-sm btn1 mb-3">{{ $sendDetail['from'] }}</button>
                                </div>
                                <br>
                                <div>
                                    <p class="text-secondary mb-3">Posted On: {{ $sendDetail['date'] }}</p>
                                </div>
                            </div>
                            <div class="email-item mb-4">
                                <div class="email-header d-flex justify-content-between ">

                                    <div>
                                        
                                        <br>
                                        <p><strong><b>Subject :</b></strong> {{ $sendDetail['subject'] }}</p>
                                        <p><strong><b>From :</b></strong> {{ $sendDetail['from'] }}</p>
                                        <p><strong><b>To :</b></strong> {{ $sendDetail['to'] }}</p>
                                        <p><strong><b>CC :</b></strong> {{ $sendDetail['cc'] }}</p>
                                        <p><strong><b>Attach Count :</b></strong> {{ $sendDetail['attach_count'] }}</p>
                                        <p>
                                            
                                            {{-- <a href="" id="toggle-attachments" class="btn btn-link"></a> --}}
                                            {{-- <button class="btn btn-primary " style="border-radius:50%" id="toggle-attachments">{{ $sendDetail['attach_count'] }}</button> --}}
                                        
                                        @if (!empty($sendDetail['attachment_paths']))
                                            <div id="attachments-container" class="container d-flex gap-3" style="display: none;">
                                                @foreach (json_decode($sendDetail['attachment_paths']) as $attachmentPath)
                                                    @php
                                                        $filename = basename($attachmentPath);
                                                        $fileSize = filesize($attachmentPath); // file size in bytes
                                                        $fileSizeFormatted = number_format($fileSize / 1024, 1); // KB
                                                        $relativePath = str_replace(storage_path('app/public/attachments/'), '', $attachmentPath);
                                                        $extension = pathinfo($attachmentPath, PATHINFO_EXTENSION);
                                                        $fileUrl = Storage::url('attachments/' . $relativePath);
                                                    @endphp
                                        
                                                    <div class="col-md-3 cus2 shadow" style="margin-bottom: 20px;">
                                                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif','jfif']))
                                                            <img src="{{ $fileUrl }}" alt="{{ $filename }}" class="image">
                                                        @elseif($extension === 'pdf')
                                                            <embed src="{{ $fileUrl }}" type="application/pdf" class="image">
                                                        @elseif(in_array($extension, ['xls', 'xlsx', 'csv']))
                                                            <img src="{{ asset('assets/img/excel_icon.png') }}" class="image" alt="">
                                                        @endif
                                        
                                                        <div class="file-info" style="height: 30px;">
                                                            <div class="d-flex align-items-center justify-content-center gap-3" style="padding: 5px;">
                                                                <i class="fa-solid fa-file"></i>
                                                                <span style="font-size: 13px;">{{ Illuminate\Support\Str::limit($filename, 15, '...') }}</span>
                                                            </div>
                                                        </div>
                                        
                                                        <div class="overlay">
                                                            <div class="">
                                                                <p class="" style="font-size:13px; color:#ffff">{{ $filename }}</p>
                                                                <p style="font-size:13px; color:#ffff">{{ $fileSizeFormatted }} KB</p>
                                                            </div>
                                                            <div class="d-flex justify-content-center" style="gap:20px; margin-top:20px">
                                                                <a href="{{ $fileUrl }}" download="{{ $filename }}" class="fa-solid fa-download text-secondary"
                                                                    style="padding:6px 6px; background: white; border-radius: 5px;"></a>
                                                                    @if(in_array($extension,['xls','xlsx','csv']))
                                                                <a href="{{ $fileUrl }}" target="_blank" class="fa-solid fa-eye text-secondary d-none"
                                                                    style="padding:6px 6px; background: white; border-radius: 5px;"></a>
                                                                    @else
                                                                    <a href="{{ $fileUrl }}" target="_blank" class="fa-solid fa-eye text-secondary"
                                                                    style="padding:6px 6px; background: white; border-radius: 5px;"></a>
                                                                    @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    
                                    </div>
                                    <div>
                                        {{-- <br><br>
                                        <p class="text-secondary">Posted On: 20/02/2024 - 12:35 PM</> --}}
                                    </div>
                                </div>
                                <div class="email-body bg-light p-3 my-3 rounded">
                                    <p><strong><b>Body : </b></strong></p>
                                    <p>{!! $sendDetail['body'] !!}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                <div class="card p-5">
                    <h3 class="text-center text-danger">No email notifications found</h3>
                </div>
            @endif
        </div>
    </div>
    </div>
@endsection
@push('custom-script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // this is not working
            
            
            var row_id = "{{ $row_id }}";
            var _token = $("input[name='_token']").val();

            function fetchNewMails() {
                if (row_id != "" && row_id != null) {

                    $.ajax({
                        url: "{{ route('get_new_mails') }}",
                        type: 'POST',
                        data: {
                            _token: _token,
                            id: row_id,
                        },
                        success: function(data) {
                            console.log("Result : " + data);
                            console.log(data.data);
                            if (data.data) {
                                // show toast start
                                toastr.options = {
                                    "closeButton": false,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-bottom-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                toastr.success('New mail has come');

                                // show toast end
                                $(".card-body").addClass("highlight-green");
                                $.get(location.href, function(data) {
                                    var newContent = $(data).find('.load_new_mail_card').html();
                                    $(".load_new_mail_card").html(newContent);
                                    // 500ms for smooth scrolling, adjust as needed
                                    setTimeout(function() {
                                        $(".card-body").removeClass(
                                            "highlight-green");
                                    }, 2000);
                                });
                            }
                        }
                    });
                }
            }
            fetchNewMails();
            setInterval(fetchNewMails, 60000);
 
            // i want to fix a toggle when the click attach count then show the attachment files
            

        });
    </script>
@endpush

