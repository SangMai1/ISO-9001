@extends('layouts.master')
@section('title', 'Trang chủ')

@section('content')
    <x-input title="title" type="text" name="name" float />
    <select id="combobox" autocomplete>
        <option value="ActionScript">ActionScript</option>
        <option value="AppleScript">AppleScript</option>
        <option value="Asp">Asp</option>
        <option value="BASIC">BASIC</option>
        <option value="C">C</option>
        <option value="C++">C++</option>
        <option value="Clojure">Clojure</option>
        <option value="COBOL">COBOL</option>
        <option value="ColdFusion">ColdFusion</option>
        <option value="Erlang">Erlang</option>
        <option value="Fortran">Fortran</option>
        <option value="Groovy">Groovy</option>
        <option value="Haskell">Haskell</option>
        <option value="Java">Java</option>
        <option value="JavaScript">JavaScript</option>
        <option value="Lisp">Lisp</option>
        <option value="Perl">Perl</option>
        <option value="PHP">PHP</option>
        <option value="Python">Python</option>
        <option value="Ruby">Ruby</option>
        <option value="Scala">Scala</option>
        <option value="Scheme">Scheme</option>
    </select>
    
    <script>
        $('#combobox').autoCompleteSelect()
    </script>
@endsection
