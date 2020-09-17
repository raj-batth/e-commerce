<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="container my-12 mx-auto px-4 md:px-12 text-center">
        @if(isset($message))
          <div class="my-12 @if($type === 'success') bg-green-100 @else bg-red-100 @endif p-10 ">{{$message}}</div>
        @endif
        {{-- @if(isset($error))
          <div class="my-12 bg-red-100 p-10">{{$error}}</div>
        @endif --}}
        <a href="{{ route('productIndex')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded ">
          Back
        </a>
      </div>
  </div>
</x-app-layout>
