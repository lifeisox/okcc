@extends('layouts.master')

@section('content')

@include('includes.intro')

@include('includes.contact')

@endsection

@section('scripts')
<script>

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

</script>
@endsection