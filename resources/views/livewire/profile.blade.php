
<div class="text-center p-8 mb-8 bg-white border-b border-gray-200">
    <div>
        <div class="grid grid-rows-1 mb-4">
            <h3 class="font-bold text-xl float-left "> @if($updateMode) {{ __('Update')}} @endif
                {{__('My Profile Information')}}</h3>
        </div>
        <div class="grid grid-rows-1 m-2">
            <div class="flex flex-wrap -mx-1 space-y-1 md:space-y-0">
                <div class="w-full px-2 md:w-full text-center">
                    <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                        <!-- Profile Photo File Input -->
                        <input type="file" class="hidden"  wire:model="photo"  x-ref="photo" x-on:change=" photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);"
                        />

                        <!-- Current Profile Photo -->
                        <div class="mt-2" id="img-div">
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="rounded-full h-20 w-20 object-cover">
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview">
                            <span class="block rounded-full w-20 h-20"
                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>
                        @if($updateMode)
                        <button type="button" class="bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent w-3/12 mt-2"  type="button" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Select A New Photo') }}
                        </button>

                        @if ($user->profile_photo_path)
                            <button type="button" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent w-2/12 mt-2" wire:click.prevent="deleteProfilePhoto()">
                                {{ __('Remove Photo') }}
                            </button>
                        @endif
                        <input-error for="photo" class="mt-2" />
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if($updateMode)
        <div class="grid grid-rows-1 m-2">
            <div class="flex flex-wrap -mx-2 space-y-2 md:space-y-0">
                <div class="w-full px-2 md:w-1/2">
                    <!-- Name -->
                    <x-jet-label for="name" value="{{ __('First Name') }}" />
                    <input id="name" type="text" class="mt-1 block w-full"   wire:model="name" />
                    <input-error for="name" class="mt-2" />
                </div>
                <div class="w-full px-2 md:w-1/2">
                    <!-- Last Name -->
                    <x-jet-label for="lastName" value="{{ __('Last Name') }}" />
                    <input id="lastName" type="text" class="mt-1 block w-full"   wire:model="lastName"/>
                    <input-error for="lastName" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="grid grid-rows-1 m-2">
            <div class="flex flex-wrap -mx-2 space-y-2 md:space-y-0">
                <div class="w-full px-2 md:w-1/2">
                    <!-- dateOfBirth -->
                    <x-jet-label for="dateOfBirth" value="{{ __('Date Of Birth') }}" />
                    <input id="dateOfBirth" type="date" class="mt-1 block w-full"  wire:model="dateOfBirth"  />
                    <input-error for="dateOfBirth" class="mt-2" />
                </div>
                <div class="w-full px-2 md:w-1/2">
                    <!-- phone -->
                    <x-jet-label for="phone" value="{{ __('Phone') }}" />
                    <input id="phone" type="text" class="mt-1 block w-full"   wire:model="phone" />
                    <input-error for="phone" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="grid grid-rows-1 m-2">
            <div class="flex flex-wrap -mx-2 space-y-2 md:space-y-0">
                <div class="w-full px-2 md:w-1/2">
                    <!-- Email -->
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <input id="email" type="email" class="mt-1 block w-full"   wire:model="email" />
                    <input-error for="email" class="mt-2" />

                </div>
                <div class="w-full px-2 md:w-1/2">
                    <!-- Address -->
                    <x-jet-label for="Address" value="{{ __('Address') }}" />
                    <input id="Address" type="text" class="mt-1 block w-full"   wire:model="address" />
                    <input-error for="Address" class="mt-2" />
                    <!-- city country -->
                </div>
            </div>
        </div>

        <div class="grid grid-rows-1 mt-4">
            <div class="flex flex-wrap -mx-1 space-y-1 md:space-y-0">
                <div class="w-full px-2 md:w-full">
                    @if($updateMode)
                        <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent w-2/12" wire:click.prevent="update()">
                            {{ __('Save') }}
                        </button>
                        <button class="bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent w-2/12" wire:click.prevent="cancel()">
                            {{ __('Cancel') }}
                        </button>
                    @else
                        <button class="bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent w-3/12" wire:click.prevent="edit()">
                            {{ __('Edit') }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="grid grid-rows-1 m-2">
            <div class="flex flex-wrap -mx-2 space-y-2 md:space-y-0">
                <div class="w-full px-2 md:w-1/2">
                    <!-- Name -->
                    <x-jet-label for="name" value="{{ __('First Name') }}" />
                    <input id="name" type="text" class="mt-1 block w-full"  readonly value="{{$user->name}}" />
                    <input-error for="name" class="mt-2" />
                </div>
                <div class="w-full px-2 md:w-1/2">
                    <!-- Last Name -->
                    <x-jet-label for="lastName" value="{{ __('Last Name') }}" />
                    <input id="lastName" type="text" class="mt-1 block w-full"  readonly value="{{$user->lastName}}" />
                    <input-error for="lastName" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="grid grid-rows-1 m-2">
            <div class="flex flex-wrap -mx-2 space-y-2 md:space-y-0">
                <div class="w-full px-2 md:w-1/2">
                    <!-- dateOfBirth -->
                    <x-jet-label for="dateOfBirth" value="{{ __('Date Of Birth') }}" />
                    <input id="dateOfBirth" type="date" class="mt-1 block w-full"  readonly value="{{$intern->dateOfBirth}}"/>
                    <input-error for="dateOfBirth" class="mt-2" />
                </div>
                <div class="w-full px-2 md:w-1/2">
                    <!-- phone -->
                    <x-jet-label for="phone" value="{{ __('phone') }}" />
                    <input id="phone" type="text" class="mt-1 block w-full"  value="{{$intern->phone}}" />
                    <input-error for="phone" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="grid grid-rows-1 m-2">
            <div class="flex flex-wrap -mx-2 space-y-2 md:space-y-0">
                <div class="w-full px-2 md:w-1/2">
                    <!-- Email -->
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <input id="email" type="email" class="mt-1 block w-full"  readonly value="{{$user->email}}" />
                    <input-error for="email" class="mt-2" />

                </div>
                <div class="w-full px-2 md:w-1/2">
                    <!-- Address -->
                    <x-jet-label for="Address" value="{{ __('Address') }}" />
                    <input id="Address" type="text" class="mt-1 block w-full"  readonly value="{{$intern->address}}" />
                    <input-error for="Address" class="mt-2" />
                    <!-- city country -->
                </div>
            </div>
        </div>

        <div class="grid grid-rows-1 mt-4">
            <div class="flex flex-wrap -mx-1 space-y-1 md:space-y-0">
                <div class="w-full px-2 md:w-full">
                    @if($updateMode)
                        <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent w-2/12" wire:click.prevent="update()">
                            {{ __('Save') }}
                        </button>
                        <button class="bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent w-2/12" wire:click.prevent="cancel()">
                            {{ __('Cancel') }}
                        </button>
                    @else
                        <button class="bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent w-3/12" wire:click.prevent="edit()">
                            {{ __('Edit') }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endif




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
<style>
    #img-div {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
