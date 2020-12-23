@if (session('message'))
    <div class="alert-message">{{ session('message') }}</div>
    @php Session::forget('message') @endphp
@endif
