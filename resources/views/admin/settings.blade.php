@extends('layouts.layout')

@section('content')
<x-admin-nav />
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Update your details</h5>
        <div class="max-w-full mx-auto bg-white rounded p-6 shadow-md">
            <form action="/admin/settings" method="POST">
                @if($errors->any())
                <span style="color: red;">{{$errors->first()}}</span>
                @endif
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                    <input type="text" id="name" name="name"
                        class="w-full border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-500"
                        placeholder="Enter your name" value="{{Auth::user()->name}}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-500"
                        placeholder="Enter your email" value="{{Auth::user()->email}}" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-500"
                        placeholder="*********" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Confirm password</label>
                    <input type="password" id="password" name="confirmPassword"
                        class="w-full border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-500"
                        placeholder="*********" required>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update
                        Details</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop