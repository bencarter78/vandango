@extends('emails.totalpeople_email_master')

@section('content')
    <h3>Welcome to Total People</h3>

    <p>
        First of all, congratulations! By choosing Total People to support you through your qualification you’ve made a
        brilliant decision.
    </p>

    <p>
        Total People are one of the largest providers of work-based learning in the North West of England, and it’s our
        mission to improve people’s lives by enabling them to fulfil their potential.
    </p>

    <p>
        As part of your learning journey you’ve been allocated a dedicated Training Adviser – this person will support
        you every step of the way. Your Training Adviser is called {{ $eportfolio->applicant->adviser->fullName }}; if
        they haven’t yet been in touch with you they soon will be, to discuss your programme of learning and the support
        and training that you will receive.
    </p>

    <h4>Getting Started</h4>

    <p>
        To start your journey, we have registered you for a OneFile account – this is our online portfolio. All your
        work will be kept in one place, accessible from anywhere, on any device – desktop, laptop, tablet or mobile -
        and can also be accessed offline. Your Training Adviser will visit you in the workplace, but by using OneFile
        they can also offer you support and guidance remotely.
    </p>

    <p>
        OneFile will also give you access to our Virtual Learning Environment (VLE), online courses and other resources,
        from course handouts to videos.
    </p>

    <p>
        To activate this account you will need to follow the steps below:
    </p>

    <ol>
        <li>Go to <a href="https://www.onefile.co.uk">www.onefile.co.uk</a></li>
        <li>At the top of the page click “LOG IN”</li>
        <li>Click “Forgot password?” and enter your email, <strong>{{ $eportfolio->applicant->email }}</strong></li>
        <li>
            An email with instructions on how to reset your password will be sent to you. Please note, if this email
            does not arrive in your inbox, please check your spam/junk folder.
        </li>
    </ol>

    <p>
        <strong>Please make a note of your login details</strong>, you will need these when you meet with your Training
        Adviser.
    </p>

    <p>
        It’s important to us that you are happy, confident and enjoy your learning. We want you to fulfil your potential
        and achieve your ambitions.
    </p>

    <p>
        If you have any questions, concerns or queries please do not hesitate to contact us on 01606 734000.
    </p>

    <p>
        Thank you for choosing Total People.
    </p>

    <p>
        Linda Dean<br>
        <strong>Managing Director</strong><br>
        <strong>Total People Ltd</strong>
    </p>
@stop