<div class="text-center p-8 p-4">
    <div class="bg-white mb-8">
             <div class="grid grid-rows-1 mb-4">
            <h3 class="font-bold text-xl float-left ">
                {{__('Add an Enterprise')}}</h3>
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
            <div class="flex flex-wrap -mx-2 space-y-4 grid grid-cols-2 gap-4 md:space-y-0">
                <div class="w-full px-2">
                    <input class="w-full h-10 px-3 text-base placeholder-gray-600 border focus:shadow-outline" placeholder="Enter the name" type="text" wire:model="name"/>
                    @error('name') <span class="text-red-700 block sm:inline font-bold ml-2 error">{{ $message }}</span>@enderror
                </div>
                <div class="w-full px-2 ">
                    <input class="w-full h-10 px-3 text-base placeholder-gray-600 border focus:shadow-outline" placeholder="Enter the city" type="text" wire:model="city"/>
                    @error('city') <span class="text-red-700 block sm:inline font-bold ml-2 error">{{ $message }}</span>@enderror
                </div>
                <div class="w-full px-2 ">
                    <input class="w-full h-10 px-3 text-base placeholder-gray-600 border focus:shadow-outline" placeholder="Enter the phone" type="text" wire:model="phone"/>
                    @error('phone') <span class="text-red-700 block sm:inline font-bold ml-2 error">{{ $message }}</span>@enderror
                </div>

                <div class="w-full px-2 ">
                    <input class="w-full h-10 px-3 text-base placeholder-gray-600 border focus:shadow-outline" placeholder="Enter the fax" type="text" wire:model="fax"/>
                    @error('fax') <span class="text-red-700 block sm:inline font-bold ml-2 error">{{ $message }}</span>@enderror
                </div>

                <div class="w-full px-2 col-span-2 ">
                    <input class="w-full h-10 px-3 text-base placeholder-gray-600 border focus:shadow-outline " placeholder="Enter the address" type="text" wire:model="address"/>
                    @error('address') <span class="text-red-700 block sm:inline font-bold ml-2 error">{{ $message }}</span>@enderror
                </div>

                <div class="w-full px-2 ">
                    <input class="w-full h-10 px-3 text-base placeholder-gray-600 border focus:shadow-outline" placeholder="Enter the admin Email" type="text" wire:model="adminEmail"/>
                    @error('adminEmail') <span class="text-red-700 block sm:inline font-bold ml-2 error">{{ $message }}</span>@enderror
                </div>

                <div class="w-full px-2 ">
                    <input class="w-full h-10 px-3 text-base placeholder-gray-600 border focus:shadow-outline" placeholder="Enter the contact Email" type="text" wire:model="contactEmail"/>
                    @error('contactEmail') <span class="text-red-700 block sm:inline font-bold ml-2 error">{{ $message }}</span>@enderror
                </div>

                <div class="w-full px-2 ">
                    <input class="w-full h-10 px-3 text-base placeholder-gray-600 border focus:shadow-outline" placeholder="Enter the password" type="password" wire:model="password"/>
                    @error('password') <span class="text-red-700 block sm:inline font-bold ml-2 error">{{ $message }}</span>@enderror
                </div>

                <div class="w-full px-2 ">
                    <input class="w-full h-10 px-3 text-base placeholder-gray-600 border focus:shadow-outline" placeholder="Confirm the password" type="password" wire:model="confirm_password"/>
                    @error('confirm_password') <span class="text-red-700 block sm:inline font-bold ml-2 error">{{ $message }}</span>@enderror
                </div>



                <div class="w-full px-2 text-center  col-span-2">
                        <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent w-1/2" wire:click.prevent="store()">
                            Create
                        </button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white border-t border-gray-200 mt-8">
            @if(sizeof($enterprises))
                <div class="grid grid-rows-1 m-4">
                    <h3 class="text-center font-bold text-xl">{{__('Enterprise List')}}</h3>
                </div>
            @endif
                @if (session()->has('messageDeleted'))
                    <div class="text-white px-6 py-4 border-0 relative mb-4 bg-green-500">
                    <span class="text-xl inline-block mr-5 align-middle">
                    <i class="fas fa-bell"></i>
                </span>
                        <span class="inline-block align-middle mr-8">
                    {{ session('messageDeleted') }}
                </span>
                        <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert(event)">
                            <span>×</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('errorDeleted'))
                    <div class="text-white px-6 py-4 border-0 relative mb-4 bg-red-500">
                    <span class="text-xl inline-block mr-5 align-middle">
                    <i class="fas fa-bell"></i>
                </span>
                        <span class="inline-block align-middle mr-8">
                    {{ session('errorDeleted') }}
                </span>
                        <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert(event)">
                            <span>×</span>
                        </button>
                    </div>
                @endif

            <div class="grid grid-rows-1 m-4">
                <div class="flex flex-wrap -mx-2 space-y-4 grid grid-cols-7 gap-1 mt-4 md:space-y-0 m-2">
                    <div class="w-full px-2 ">
                     Name
                    </div>
                    <div class="w-full px-2 ">
                       city
                    </div>
                    <div class="w-full px-2 ">
                      phone
                    </div>
                    <div class="w-full px-2 ">
                       fax
                    </div>
                    <div class="w-full px-2 ">
                       address
                    </div>
                    <div class="w-full px-2 ">
                       email
                    </div>


                </div>
                <hr class="m-2 bg-yellow-600 h-0.5"/>
                @foreach($enterprises as $key => $value)
                    <div class="flex flex-wrap -mx-2 space-y-4 grid grid-cols-7 gap-0 mt-4 md:space-y-0 m-2">
                    <div class="w-full">
                        {{$value->name}}
                    </div>
                    <div class="w-full ">
                        {{$value->city}}
                    </div>
                    <div class="w-full ">
                        {{$value->phone}}
                    </div>
                    <div class="w-full ">
                        {{$value->fax}}
                    </div>
                    <div class="w-full ">
                        {{$value->address}}
                    </div>
                    <div class="w-full ">
                        {{$value->email}}
                    </div>
                    <div class="" wire:click.prevent="remove({{$value->id}})">
                        <span class="text-red-500 text-right">delete</span>
                    </div>

                </div>
                    <hr class="m-2 bg-yellow-600 h-0.5"/>
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
