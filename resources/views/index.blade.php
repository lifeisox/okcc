@extends('layouts.master')

@section('styles')
<style>
    #churchLocation {
        height: 800px;
        width: 100%;
    }
</style>
@endsection

@section('content')

@include('includes.intro')
@include('includes.location')
@include('includes.contact')

@endsection

@section('scripts')
<script>
    // Contact Form
    $("#contactForm #sendMessageButton").on( 'click', function(e) {
        e.preventDefault();
        const formId = $("#contactForm");
        const postData = { 
            'fullname': formId.find("input[name='fullname']").val(),
            'email': formId.find("input[name='email']").val(),
            'phone': formId.find("input[name='phone']").val(),
            'content': formId.find("textarea[name='content']").val(), 
        };
        axios({ method: 'post', url: '{!! route('contact') !!}', data: postData })
        .then(function (response) {
            sendSuccessMessage();
            formId[0].reset(); // Clear create form 
        })
        .catch(function (error) {
            axiosErrorMessage(error);
        });
    });

    // Location: Google Map
    function initMap() {
        var options = {
            clickableIcons: true, // A map icon represents a point of interest, also known as a POI. By default map icons are clickable.
            zoom: 16, // Most roadmap imagery is available from zoom levels 0 to 18
            zoomControl: true,
            center: { lat: 45.4052, lng: -75.7047 }
        }
        var contentString = `
            <div class="container p-3">
                <h4 class="mb-3">오타와한인교회</h4>
                <h6><i class="fas fa-home fa-fw fa-lg text-primary"></i> 384 Arlington Ave. Ottawa, ON, K1R 6Z5</h6>
                <h6><i class="fas fa-phone-volume fa-fw fa-lg text-primary"></i> 1-613-236-4442</h6>
                <div class="mt-2 text-right">
                    <a type="button" class="btn btn-info" href="https://www.google.com/maps/dir//Ottawa+Korean+Community+Church,+384+Arlington+Ave,+Ottawa,+ON+K1R+6Z5/@45.4052733,-75.774749,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x4cce044ab37c3861:0xae40f066ca278ea!2m2!1d-75.7047091!2d45.4051742" target="_blank">Get Directions</a>
                </div>
            </div>
        `;

        // The map, centered at Ottawa Korean Community Church
        var map = new google.maps.Map( document.getElementById('churchLocation'), options );

        // The marker, positioned at Ottawa Korean Community Church
        var marker = new google.maps.Marker({
            position: { lat: 45.4052, lng: -75.7047 }, 
            clickable: true,
            title: '@lang('messages.location.title')',
            icon: { url: '{{ URL::asset('/images/MapMarker.png') }}', size: new google.maps.Size(64, 64) },
            draggable: true,
            animation: google.maps.Animation.DROP,
            map: map
        });
        
        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
        infowindow.open(map, marker);
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3Mh2D9ibHxw9ijjv4rtIohVVK7NnmxG8&callback=initMap" async defer></script>
@endsection