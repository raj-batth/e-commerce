<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Online-Store
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container my-12 mx-auto px-4 md:px-12">
            <div class="mx-1 lg:-mx-4 text-right">
                <strong>Price:</strong>
                <a href="{{ route('productIndex', ['sort'=>"asc"]) }}">Low to High</a> |
                <a href="{{ route('productIndex', ['sort'=>"desc"]) }}">High to Low</a> 
            </div>
            <div class="flex flex-wrap justify-center mx-1 lg:-mx-4">
                @if(count($products)>1)
                    @foreach($products as $product)
                    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 mb-4 rounded overflow-hidden shadow-md my-5 mx-2 bg-green-50">
                        <img class="w-full" src="img/{{$product->image}}" alt="products">
                        <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2 h-12">{{$product->name}}</div>
                          <p class="text-gray-700 h-12 text-base">
                            {{$product->description}}
                          </p>
                          <br>
                          <div> <strong>In Stock:</strong> @if($product->quantity >0 ){{$product->quantity}} @else Not-Available @endif</div>
                          <span> <strong>Price:</strong> ${{$product->price}}</span>
                          @auth           
                            @if($product->quantity > 0)               
                                <div class="text-right pt-4">
                                <a href="{{ route('orderIndex', ['id'=>$product->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 border border-blue-700 rounded ">
                                    Purchase
                                </a>
                                </div>
                               @endif
                          @endif
                        </div>
                      </div>
                    @endforeach
                @else
                    <p>No Poducts Found</p>
                @endif
            </div>
            {{ $products->withQueryString()->links()}}
        </div>
    </div>
</x-app-layout>
