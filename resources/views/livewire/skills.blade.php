<div class="text-center p-8 mb-8 bg-white border-b border-gray-200">
    <div>
        <div class="grid grid-rows-1 mb-4">
            <h3 class="font-bold text-xl float-left "> {{__('Add a skill ')}}</h3>
        </div>
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

    </div>
    <div>
        <div class="flex flex-col space-y-2">
            <div class="flex space-x-2">
                <div>
                    <input class="h-10 px-3 text-base placeholder-gray-600 border focus:shadow-outline" placeholder="Enter the title" type="text" wire:model="label"/>
                    <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 outline-white" wire:click.prevent="store()">Add</button>
                </div>

            @foreach($skills as $key => $value)
                <div style="padding-top: 0.1em; padding-bottom: 0.1rem"  class="text-sm px-3 bg-green-200 fill-current text-green-800">
                    {{$value->label}}
                    <button class="bg-transparent border-none text-red-700 font-semibold  py-2 px-4   w-5/12"  wire:click.prevent="delete({{$value->id}})">
                        X</button>
                </div>
            @endforeach
            </div>
        </div>
    </div>

</div>
<script>
    function closeAlert(event){
        let element = event.target;
        while(element.nodeName !== "BUTTON"){
            element = element.parentNode;
        }
        element.parentNode.parentNode.removeChild(element.parentNode);
    }
</script>
