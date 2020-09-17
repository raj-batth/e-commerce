<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            Order Summary
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container my-12 mx-auto px-4 md:px-12">
            <div class="flex flex-wrap justify-center mx-1 lg:-mx-4 bg-gray-100 pb-6">
                <table class=" text-left w-full">
                    <thead>
                      <tr class="bg-gray-300">
                        <th class="px-8 py-2">Product</th>
                        <th class="px-8 py-2">Price</th>
                        <th class="px-8 py-2">Tax</th>
                        <th class="px-8 py-2">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="px-4 py-2">
                            <img class="w-32 inline-block rounded" src="img/{{$order[0]->image}}" alt="products">
                            <span class="text-gray-900 font-bold text-xl mb-2 px-4">{{$order[0]->name}}</span>
                        </td>
                        <td class="px-8 py-2"> $ {{$order[0]->price}}</td>
                        <td class="px-8 py-2"> {{$tax}}%</td>
                        <td class="px-8 py-2"> $ {{$total}}</td>
                      </tr>
                      <tr>
                          <td colspan="4" class="px-3 lg:px-20">
                            <h3 class="text-gray-900 font-bold text-xl my-6">Shipping Info</h3>
                            <form method="POST" action="{{ route('orderStore') }}" class="w-full">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$order[0]->id}}">
                                <input type="hidden" name="price" value="{{$order[0]->price}}">
                                <input type="hidden" name="tax" value="{{$tax}}">
                                <input type="hidden" name="total_amount" value="{{$total}}">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                      First Name *
                                    </label>
                                    <input 
                                        class="appearance-none block w-full bg-gray-200 text-gray-700  @error('first_name') border border-red-500 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" 
                                        id="grid-first-name" type="text" placeholder="Jane" name="first_name" value="{{old('first_name')}}">
                                    @error('first_name')
                                        <p class="text-red-500 text-xs italic">{{$message}}</p>                                        
                                    @enderror
                                  </div>
                                  <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                      Last Name *
                                    </label>
                                    <input 
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('last_name') border border-red-500 @enderror" 
                                        id="grid-last-name" type="text" placeholder="Doe" name="last_name" value="{{old('last_name')}}">
                                        @error('last_name')
                                            <p class="text-red-500 text-xs italic">{{$message}}</p>                                        
                                         @enderror
                                  </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                  <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-address">
                                      Address *
                                    </label>
                                    <input 
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('address') border border-red-500 @enderror" 
                                        id="grid-address" type="text" placeholder="Address" name="address" value="{{old('address')}}">
                                        @error('address')
                                            <p class="text-red-500 text-xs italic">{{$message}}</p>                                        
                                         @enderror
                                    {{-- <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p> --}}
                                  </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-2">
                                  <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                                      City *
                                    </label>
                                    <input 
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('city') border border-red-500 @enderror" 
                                        id="grid-city" type="text" placeholder="Ottawa" name="city" value="{{old('city')}}">
                                        @error('city')
                                            <p class="text-red-500 text-xs italic">{{$message}}</p>                                        
                                         @enderror
                                  </div>
                                  <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                      State *
                                    </label>
                                    <div class="relative">
                                        <input 
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('state') border border-red-500 @enderror" 
                                            id="grid-state" type="text" placeholder="ON" name="state" value="{{old('state')}}">
                                            @error('state')
                                            <p class="text-red-500 text-xs italic">{{$message}}</p>                                        
                                            @enderror
                                    </div>
                                  </div>
                                  <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                                      Postal Code * 
                                    </label>
                                    <input 
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('postal_code') border border-red-500 @enderror" 
                                        id="grid-zip" type="text" placeholder="G1R 5N5" name="postal_code" value="{{old('postal_code')}}"> 
                                        @error('postal_code')
                                            <p class="text-red-500 text-xs italic">{{$message}}</p>                                        
                                         @enderror
                                  </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6 text-right">
                                    <div class="w-full px-3 my-3">
                                        <input 
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded mr-4" 
                                            type="submit" value="Checkout">              
                                    </div>
                                  </div>
                            </form>
                          </td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>