<div class="p-8 mb-8 grid grid-cols-1">
    <div class="bg-white shadow-lg mx-2 p-2 col-span-1 border-b border-gray-200">
        <h1 class="text-center text-4xl text-blue-600 my-8"><b>My accepted submissions</b></h1>

        @foreach($rejected as $value)
            <div class="box-border border-2 2xl:border-blue-100 p-2 mt-2 p-4" >
                <h2>
                    <span class="text-4xl"> {{$value->internship()->getResults()->title}} </span>
                    <span class="float-right text-2xl text-blue-400 mt-2">
                       {{$value->internship()->getResults()->enterprise()->getResults()->name}}
                    </span>
                </h2>
                <p class="text-xl text-green-400 ml-4" >
                    Accepted at {{$value->updated_at}}
                </p>

                <p lass="text-gray-700 ml-4" >
                    {{$value->desc}}
                </p>
            </div>
        @endforeach
        @if($rejected->count() == 0 )
            <div class="box-border border-2 2xl:border-blue-100 p-2 mt-2" >
                No submissions accepted yet
            </div>
        @endif
    </div>
</div>



