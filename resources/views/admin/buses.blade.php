@extends('layouts.layout')

@section('content')
<x-admin-nav />
<div class="p-4 sm:ml-64">
    <a href="#" class="flex items-center pl-2.5 mb-5">
        <span class="self-center text-xl font-semibold whitespace-nowrap">List of all buses</span>
    </a>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Plate
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Driver
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Capacity
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created AT
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($buses->isEmpty())
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" colspan="4"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        No data available
                    </th>
                </tr>
                @else
                @foreach ($buses as $bus)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$bus->plate}}
                    </th>
                    <td class="px-6 py-4">
                        {{$bus->driver}}
                    </td>
                    <td class="px-6 py-4">
                        {{$bus->capacity}} Seats
                    </td>
                    <td class="px-6 py-4">
                        {{$bus->created_at}}
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@stop