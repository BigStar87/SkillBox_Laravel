@extends('layouts.default')

@section('content')
    @if($data['age'] >= 18)
    <table>
        <tr>
            <td>Name: {{ $data['name'] }}</td>
        </tr>
        <tr>
            <td>Age: {{ $data['age'] }}</td>
        </tr>
        <tr>
            <td>Position: {{ $data['position'] }}</td>
        </tr>
        <tr>
            <td>Address: {{ $data['address'] }}</td>
        </tr>
    </table>
    @else
        <div class="h1">Вы не совершеннолетний</div>
    @endif
@stop
