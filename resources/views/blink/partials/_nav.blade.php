<li><a href="{!! url('/blink') !!}"><i class="fa fa-home"></i> Blink</a></li>
<li><a href="{!! url('/blink/me') !!}">Me</a></li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Search</a>
    <ul class="dropdown-menu">
        <li><a href="{!! url('/blink/contacts') !!}">Contacts</a></li>
        <li><a href="{!! url('/blink/enquiries') !!}">Enquiries</a></li>
        <li><a href="{!! url('/blink/opportunities') !!}">Opportunities</a></li>
        <li><a href="{!! url('/blink/organisations') !!}">Organisations</a></li>
        <li><a href="{!! url('/blink/vacancies') !!}">Vacancies</a></li>
    </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports</a>
    <ul class="dropdown-menu">
        <li><a href="{!! route('blink.organisations.enquiries.index') !!}">Organisations</a></li>
        <li><a href="{!! url('/blink/departments') !!}">Departments</a></li>
        <li><a href="{!! url('/blink/reports/vacancies') !!}">Vacancies</a></li>
        <li><a href="{!! url('/blink/reports/campaigns') !!}">Campaigns</a></li>
    </ul>
</li>
<li><a href="{!! route('blink.courses.index') !!}">Pricing</a></li>
<li>
    <a href="mailto:{!! config('vandango.email') !!}?subject=I Need Help With Blink&body=I am on this page: {!! request()->url() !!} and...">Help</a>
</li>