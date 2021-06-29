<div class="text-center p-8 mb-8 bg-white border-b border-gray-200">
<div>
        <div class="grid grid-rows-1 mb-4">
            <h3 class="font-bold text-xl float-left "> @if($updateMode) {{ __('Update')}} @else {{  __('Add')}} @endif
                {{__('an Experience')}}</h3>
        </div>
        <div class="grid grid-rows-1">
            @if (session()->has('message'))
                <div class="text-white px-6 py-4 border-0 relative mb-4 bg-green-500">
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
                <div class="text-white px-6 py-4 border-0 relative mb-4 bg-red-500">
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
        <div class="grid grid-rows-1">
            <div class="flex flex-wrap -mx-2 space-y-4 md:space-y-0">
                <div class="w-full px-2 md:w-1/5">
                    <x-jet-label for="phone" value="{{ __('Enterprise') }}" />
                    <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" placeholder="Enter the enterprse" type="text" wire:model="enterprise"/>
                    @error('enterprise') <span class="text-red-700 block sm:inline font-bold ml-2 error">{{ $message }}</span>@enderror
                </div>
                <div class="w-full px-2 md:w-1/5">
                    <x-jet-label for="phone" value="{{ __('Description') }}" />
                    <textarea class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" placeholder="Enter the desc" type="text" wire:model="desc"></textarea>
                    @error('desc') <span class="text-red-700 block sm:inline font-bold ml-2 error">{{ $message }}</span>@enderror
                </div>
                <div class="w-full px-2 md:w-1/5">
                    <x-jet-label for="phone" value="{{ __('Start Date') }}" />
                    <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" placeholder="Enter the start date" type="date" wire:model="startDate"/>
                    @error('startDate') <span class="text-red-700 block sm:inline font-bold ml-2 error">{{ $message }}</span>@enderror
                </div>
                <div class="w-full px-2 md:w-1/5">
                    <x-jet-label for="phone" value="{{ __('End Date') }}" />
                    <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" placeholder="Enter the end date" type="date" wire:model="endDate"/>
                    @error('endDate') <span class="text-red-700 block sm:inline font-bold ml-2 error">{{ $message }}</span>@enderror
                </div>
                <div class="w-full px-2  pt-4 md:w-1/5">
                    @if($updateMode)
                        <button class="bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent w-5/12"  wire:click.prevent="update()">update</button>
                        <button class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent w-5/12"  wire:click.prevent="cancelUpdate()">cancel</button>
                    @else
                        <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent w-full" wire:click.prevent="store()">Add</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div>
        @if(sizeof($experiences))
        <div class="grid grid-rows-1 m-4">
            <h3 class="text-center font-bold text-xl">{{__('Experiences\'s List')}}</h3>
        </div>
        @endif

        <div>
            <div class="flex flex-wrap -mx-2 space-y-4 md:space-y-0 m-2">
                <div class="w-full px-2 md:w-1/5">
                    <x-jet-label for="phone" value="{{ __('Enterprise') }}" />

                </div>
                <div class="w-full px-2 md:w-1/5">
                    <x-jet-label for="phone" value="{{ __('Description') }}" />

                </div>
                <div class="w-full px-2 md:w-1/5">
                    <x-jet-label for="phone" value="{{ __('Start Date') }}" />

                </div>
                <div class="w-full px-2 md:w-1/5">
                    <x-jet-label for="phone" value="{{ __('End Date') }}" />

                </div>
                <div class="w-full px-2 md:w-1/5">
                </div>
            </div>
            @foreach($experiences as $key => $value)
                <div class="flex flex-wrap -mx-2 space-y-4 md:space-y-0 m-2">
                    <div class="w-full px-2 md:w-1/5">
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="text" value="{{$value->enterprise}}" />
                    </div>
                    <div class="w-full px-2 md:w-1/5">
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="text" value="{{$value->desc}}" />
                    </div>
                    <div class="w-full px-2 md:w-1/5">
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="date" disabled="true" value="{{$value->startDate}}"/>
                    </div>
                    <div class="w-full px-2 md:w-1/5">
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="date" disabled="true" value="{{$value->endDate}}"/>
                    </div>
                    <div class="w-full px-2 md:w-1/5">
                        <button class="bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent w-5/12" wire:click.prevent="edit({{$value->id}})">edit</button>
                        <button class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent w-5/12"  wire:click.prevent="delete({{$value->id}})">remove</button>
                    </div>
                </div>
            @endforeach
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
