@extends('layouts.app')

@section('title','Calendar')

@push('css')
<link rel="stylesheet" href="{{ asset('admin/css/calendar.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/fullcalendar.css') }}">
<link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('admin/css/jquery.datetimepicker.min.css') }}">
@endpush

@section('content')
   <div class="container">
    <div class="row">
        @foreach($reservations as $reservation)
        <div class="col-lg-3 col-md-6 col-sm-6">
             <div class="card card-stats">
                     <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon" style="margin-top: 0px!important; padding:0px;">
                            <span class="badge badge-pill">Not Confirmed</span>
                        </div>
                     <p class="card-category">{{ $reservation->service->name }}</p>
                     <h6 class="card-title">{{ $reservation->date_and_time }}</h6>
                         <div class="stats">
                            <form id="status-form-{{ $reservation->id }}" action="{{ route('reservation.status',$reservation->id) }}" style="display: none;" method="POST">
                                @csrf
                            </form>
                            <button type="button" class="btn btn-dark btn-sm float-left" onclick="if(confirm('Have you confirmed this resevation by phone?')){
                                    event.preventDefault();
                                    document.getElementById('status-form-{{ $reservation->id }}').submit();
                                    }else {
                                    event.preventDefault();
                                    }">
                                    Confirm
                            </button>
                            <button type="button" class="btn btn-primary btn-sm float-right addEventButton" >BOOk it</button>
                         </div>
                    </div>
            </div>
         </div>
         @endforeach
     </div>

    <div class="row">
           <div class="col-md-12 my-5" id="calendar">
            </div>
  </div>

   <div  id="dialog" title="Add Event" style="display: none;">
       <form id="form" action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="from-group">
            <label for="title">Event title</label>
            <input type="text" name="title" class="form-control" id="title">
        </div>
        <div class="from-group">
             <label for="start">Event Start</label>
             <input  type="text" name="start" class="form-control start" id="datetimepicker1">
         </div>
         <div class="from-group">
             <label for="end">Event End</label>
             <input  type="text" name="end" class="form-control end" id="datetimepicker2">
         </div>
         <div class="from-group">
             <label for="note">Note</label>
             <textarea name="note" id="note" class="form-control"></textarea>
         </div>

         <div class="from-group">
             <label for="color">Background Color</label>
             <input type="color" class="form-control" name="color" id="color">
         </div>
         <div class="from-group">
            <label for="text_color">Text Color</label>
            <input type="color" class="form-control" name="text_color" id="text_color">
        </div>
        <input type="hidden" id="eventId" name="id">
         <div class="from-group" >
             <button type="submit" class="btn btn-primary btn-sm float-right" id="update">Add Event</button>
         </div>
       </form>
   </div>



@endsection

@push('scripts')
<script>
    jQuery(document).ready(function($) {
      function convert(str) {
        const d = new Date(str);
        let month = '' + (d.getMonth() + 1);
        let day = '' + d.getDate();
        let year = d.getFullYear();
        if(month.length < 2) month = '0' + month;
        if(day.length < 2) day = '0' + day;
        let hour = ''+d.getUTCHours();
        let minutes = ''+d.getUTCMinutes();
        let seconds = ''+d.getUTCSeconds();
        if(hour.length < 2) hour = '0' + hour;
        if(minutes.length < 2) minutes = '0' + minutes;
        if(seconds.length < 2) seconds = '0' + seconds;
        return [year,month,day].join('-')+' '+[hour,minutes,seconds].join(':');
      };
      toastr.options = {
        "closeButton" => true,
        "debug" => false,
        "newestOnTop" => false,
        "progressBar" => true,
        "positionClass" => "toast-top-right",
        "preventDuplicates" => false,
        "onclick" => null,
        "showDuration" => "300",
        "hideDuration" => "1000",
        "timeOut" => "5000",
        "extendedTimeOut" => "1000",
        "showEasing" => "swing",
        "hideEasing" => "linear",
        "showMethod" => "fadeIn",
        "hideMethod" => "fadeOut"


        };

      $('.addEventButton').on('click', function(){
        $( "#dialog" ).dialog({
            title:'Add Event'
        })
      }),
      $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month, agendaWeek, agendaDay'
        },
        navLinks: true,
        events: "{{ route('allEvent') }}",
        businessHours: true,
        dayMaxEvents: true,
        selectable: true,
        height: 650,
        editable: false,
        showCurrentDates: false,
        defaulthView: 'month',
        theme: false,
        lang: 'en',
    select: function(start, end){
        $(".start").val(convert(start));
        $(".end").val(convert(end));
        $( "#dialog" ).dialog({
            title:'Add Event'
        })
    },
    dayClick: function(date, event, view) {
        $( "#dialog" ).dialog({
            title:'Add Event'
        })
    },
    eventClick: function(event){
        $("#title").val(event.title);
        $(".start").val(convert(event.start));
        $(".end").val(convert(event.end));
        $("#note").val(event.note);
        $("#color").val(event.color);
        $("#text_color").val(event.text_color);
        $("#eventId").val(event.id);
        $("#update").html('Update Event');
        $("#dialog").dialog({
            title:'Edit Event',
            buttons: {
            "Delete Event": function() {
                var id = $("#eventId").val();
                // var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    type:'DELETE',
                    url: "{{ route('event.delete', 'id') }}",
                    dataType: 'json',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        },
                    success: function(res) {
                        location.reload();
                        toastr.success(res.success, 'Success!');
                    }
                });
                $('#calendar').fullCalendar('refetchEvents'); //the event has been removed from the database at this point so I just refetch the events
                $(this).dialog( "close" );

                },
            },
                create:function () {
                $(this).closest(".ui-dialog")
                    .find(".ui-button")
                    .eq(1).addClass("custom")
                }

        });

    }


    });

});
</script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.js'></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ asset('admin/js/jquery.datetimepicker.full.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/jquery.datetimepicker.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/jquery.datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @if($errors->any())
        @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
        @endforeach
    @endif

    <script>
        $(function () {
            $('#datetimepicker1').datetimepicker({
                timeFormat: 'dd MM yyyy - HH:00',
                startDate: '+0d',
                autoclose: true,
                hoursDisabled: '0,1,2,3,4,5,6,7,8,21,22,23',
                daysOfWeekDisabled: '0',
                step: 30
            });
        })
    </script>
    <script>
        $(function () {
            $('#datetimepicker2').datetimepicker({
                timeFormat: 'dd MM yyyy - HH:00',
                startDate: '+0d',
                autoclose: true,
                hoursDisabled: '0,1,2,3,4,5,6,7,8,21,22,23',
                daysOfWeekDisabled: '0',
                step: 30
            });
        })
    </script>

@endpush

