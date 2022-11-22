@extends('COMMON.layout.layout_customerMail')

@section('body')
        <p>Hi {{ $name }},</p>
        <p>Thank you for creating a {{ $siteName['site_name'] }} account. For your security, please verify your account by clicking the link below.</p>
        <a href="http://localhost:8000/mail/{{ $link }}" target="_blank"> Verify Link</a>
        <p>Question? Need help? please visit <a href="http://localhost:8000/policyinfo" target="_blank">Privacy Policy</a></p>
        <p>Happy Connecting,</p>
        <span>{{ $siteName }}</span>                                                                                                                                                                                                                                                                                                                                 </a>
@endsection
