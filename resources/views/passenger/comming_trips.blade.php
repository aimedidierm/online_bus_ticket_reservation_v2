@extends('layouts.layout')

@section('content')
<x-passenger-nav />
<div class="p-4 sm:ml-64">
    <div class="flex justify-between">
        <a href="#" class="flex items-center pl-2.5 mb-5">
            <span class="self-center text-xl font-semibold whitespace-nowrap">Trips management</span>
        </a>

        @if($errors->any())<span
            class="self-center text-1xl font-semibold whitespace-nowrap dark:text-red-600">{{$errors->first()}}</span>
        @endif
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bus
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Driver
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Place
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created AT
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($trips->isEmpty())
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" colspan="8"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        No data available
                    </th>
                </tr>
                @else
                @foreach ($trips as $trip)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$trip->trip->time}}
                    </th>
                    <td class="px-6 py-4">
                        {{$trip->trip->bus->plate}}
                    </td>
                    <td class="px-6 py-4">
                        {{$trip->trip->bus->driver}}
                    </td>
                    <td class="px-6 py-4">
                        {{$trip->trip->origin}} To {{$trip->trip->destination}}
                    </td>
                    <td class="px-6 py-4">
                        {{$trip->trip->price}} Rwf
                    </td>
                    <td class="px-6 py-4">
                        {{$trip->status}}
                    </td>
                    <td class="px-6 py-4">
                        {{$trip->created_at}}
                    </td>
                    <td class="px-6 py-4">
                        <a type="button" href="/passenger/track"
                            class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Track
                            Bus</a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@stop