@extends('layouts.default')

@section('content')
    @if(!empty($data['email']))
        <table>
            <tr>
                <td>Name: {{ $data['address'] }}</td>
            </tr>
            <tr>
                <td>Age: {{ $data['post_code'] }}</td>
            </tr>
            <tr>
                <td>Position: {{ $data['email'] }}</td>
            </tr>
            <tr>
                <td>Address: {{ $data['phone'] }}</td>
            </tr>
        </table>
    @else
        <div class="h1">Вы не установили E-mail</div>
    @endif
@stop
