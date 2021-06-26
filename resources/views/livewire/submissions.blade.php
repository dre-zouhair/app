<div class="p-8 mb-8 grid grid-cols-1">
    <div class="grid grid-rows-1">
        @if (session()->has('message'))
            <div class="text-white px-6 py-4 border-0  relative mb-4 bg-green-500">
                    <span class="text-xl inline-block mr-5 align-middle">
                    <i class="fas fa-bell"></i>
                </span>
                <span class="inline-block align-middle mr-8">
                    {{ session('message') }}
                </span>
                <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert(event)">
                    <span>×</span>
                </button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="text-white px-6 py-4 border-0  relative mb-4 bg-red-500">
                    <span class="text-xl inline-block mr-5 align-middle">
                    <i class="fas fa-bell"></i>
                </span>
                <span class="inline-block align-middle mr-8">
                    {{ session('error') }}
                </span>
                <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert(event)">
                    <span>×</span>
                </button>
            </div>
        @endif
    </div>
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
