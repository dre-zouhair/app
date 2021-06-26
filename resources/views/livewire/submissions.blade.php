<div class="p-8 mb-8 grid grid-cols-1">
    <div class="bg-white shadow-lg mx-2 p-2 col-span-1 border-b border-gray-200">

        @foreach($submissions as $value)
            <div class="box-border border-2 2xl:border-blue-100 p-2 mt-2" >
                <h1 class="text-4xl" >{{$value->id}} </h1>
                <h1>{{$value->internship()->getResults()->title}}</h1>
                <h1>{{$value->internship()->getResults()->enterprise()->getResults()->name}}</h1>
                <h1 class="text-4xl" >{{$value->desc}} </h1>
            </div>
        @endforeach
            @if($submissions->count() == 0 )
                <div class="box-border border-2 2xl:border-blue-100 p-2 mt-2" >
                     No submissions yet
                </div>
            @endif
    </div>
</div>



