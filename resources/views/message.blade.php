@if(Session::has('message'))
    <div class="alert-message">{{ Session::get('message') }}</div>
@endif
