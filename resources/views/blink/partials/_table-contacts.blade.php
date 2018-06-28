<div class="table-responsive">
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Job Title</th>
            <th>Tel</th>
            <th>Email</th>
            <th class="text-center">Actions</th>
        </tr>
        @foreach($contacts as $contact)
            <tr>
                <td>{!! $contact->name !!}</td>
                <td>{!! $contact->job_title !!}</td>
                <td>{!! $contact->tel !!}</td>
                <td>{!! $contact->email !!}</td>
                <td class="text-center">
                    <small class="text-upper">
                        <a class="is-link" href="{!! route('blink.contacts.show', $contact->id) !!}">
                            View
                        </a>
                    </small>
                </td>
            </tr>
        @endforeach
    </table>
</div>