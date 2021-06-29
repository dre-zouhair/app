@if($internshipsList->count())
    <div class="p-8 mb-8 grid grid-cols-3">
        <div class="bg-white shadow-lg mx-2 p-2 col-span-1 border-b border-gray-200">
            @foreach($internships as $value)
                <div class="box-border border-2 2xl:border-blue-100 p-2 mt-2" wire:click="internship({{$value['id']}})">
                    <h2 class="text-2xl mb-2">{{$value['title']}} </h2>
                    <h1 class="text-blue-300 text-xl" > Submissions :{{\App\Models\Internship::find($value['id'])->submissions()->getResults()->count()}} </h1>
                    <p> Starts at : {{$value['startDate']}}</p>
                    <p> Duration : {{$value['duration']}}</p>
                    <p> This offer expires at : {{$value['expirationDate']}}</p>
                </div>
            @endforeach

            @if($index> 0)
                @if(! sizeof($internships))
                    <div class="text-center">
                        @endif
                        <button class="mt-8 bg-transparent hover:bg-yellow-400 text-yellow-600 font-semibold hover:text-white py-2 px-4 border border-yellow-400 hover:border-transparent m-2 w-4/12" wire:click="paginate(-1)">
                            Back
                        </button>
                        @if(! sizeof($internships))
                    </div>
                @endif
            @endif
            @if(sizeof($internshipsList) > 5 && $index < sizeof($internshipsList) )
                <button class="mt-8 bg-transparent hover:bg-green-400 text-green-600 font-semibold hover:text-white py-2 px-4 border border-green-400 hover:border-transparent m-2 w-4/12" wire:click="paginate(1)">
                    Next
                </button>
            @endif

        </div>

        @if($display)
            @if(!$update)

            <div class=" bg-white bg-white shadow-lg mx-2 p-4 col-span-2 border-b border-gray-200">
                <div class="text-center text-4xl text-blue-600">Internship Details</div>
                <div>
                    <h1 class="text-4xl">{{$internship->title}}</h1>
                </div>
                <div class="text-blue-300 text-xl" >
                    {{$internship->enterprise()->getResults()->name}} -
                    {{$internship->enterprise()->getResults()->internships()->where('expirationDate' ,'>', \Carbon\Carbon::now())->getResults()->count()}} in total offers
                </div>
                <div>
                    <h1 class="text-xl"> starts at {{$internship->startDate}} for a duration of  {{$internship->duration}} months</h1>
                </div>
                <div>
                    <h1 class="text-xl text-red-600">This offer expires at {{$internship->expirationDate}}</h1>
                </div>
                <div class="mt-6"> <b>Description : </b>

                    @foreach($lines as $value)
                        {{$value}}
                        <br>
                    @endforeach
                </div>
                <div class="text-center">
                    <button class="bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent m-2 w-4/12" wire:click.prevent="edit()">
                        Edit
                    </button>
                    <button class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent m-2 w-4/12" wire:click.prevent="cancel()">
                        Cancel </button>
                </div>


            </div>
            @else
                <div class=" bg-white bg-white shadow-lg mx-2 p-4 col-span-2 border-b border-gray-200">
                    <div class="text-center text-4xl text-blue-600">Update an Internship</div>
                    <div>
                        <h1 class="mt-4">
                            <label class="text-gray-600">{{ __('Title') }}</label>
                            <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="text" wire:model="title" />

                            @error('title') <br><span class="text-red-700 block sm:inline  ml-2 error">{{ $message }}</span>@enderror

                        </h1>
                    </div>
                    <div class="text-blue-300 mt-4 grid grid-cols-3 gap-4" >
                        <div class="col-span-1">
                            <label class="text-gray-600">{{ __('Field label') }}</label>
                            <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="text" wire:model="label" />
                            @error('label') <br><span class="text-red-700 block sm:inline  ml-2 error">{{ $message }}</span>@enderror

                        </div>
                        <div class="col-span-2">
                            <label class="text-gray-600">{{ __('Field full name') }}</label>
                            <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="text" wire:model="fullName" />
                            @error('fullName')<br> <span class="text-red-700 block sm:inline  ml-2 error">{{ $message }}</span>@enderror

                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mt-4">
                        <div>
                            <label class="text-gray-600">{{ __('Start date') }}</label>
                            <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="date" wire:model="startDate" />
                            @error('startDate') <br><span class="text-red-700 block sm:inline  ml-2 error">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="text-gray-600">{{ __('Duration') }}</label>
                            <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="text" wire:model="duration" />
                            @error('duration') <br><span class="text-red-700 block sm:inline  ml-2 error">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="text-gray-600">{{ __('Expiration date') }}</label>
                            <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="date" value="{{$internship->expirationDate}}" wire:model="expirationDate" />
                            @error('expirationDate') <br><span class="text-red-700 block sm:inline  ml-2 error">{{ $message }}</span>@enderror
                        </div>

                    </div>

                    <div class="mt-4">
                        <label class="text-gray-600">{{ __('Details') }}</label>
                        @error('details') <br><span class="text-red-700 block sm:inline  ml-2 error">{{ $message }}</span>@enderror
                        <textarea rows="15" class="w-full px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="text" value="{{$internship->details}}" wire:model="details" ></textarea>
                    </div>
                    <div class="text-center">
                        <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent m-2 w-4/12" wire:click.prevent="update()">
                            Update </button>
                        <button class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent m-2 w-4/12" wire:click.prevent="cancel()">
                            Cancel </button>
                    </div>


                </div>
            @endif
        @else

            <div class=" bg-white bg-white shadow-lg mx-2 p-4 col-span-2 border-b border-gray-200">
                <div class="text-center text-4xl text-blue-600">Create an Internship</div>

                <div>
                    <h1 class="mt-4">
                        <label class="text-gray-600">{{ __('Title') }}</label>
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="text" wire:model="title" />

                        @error('title') <br><span class="text-red-700 block sm:inline  ml-2 error">{{ $message }}</span>@enderror

                    </h1>
                </div>
                <div class="text-blue-300 mt-4 grid grid-cols-3 gap-4" >
                    <div class="col-span-1">
                        <label class="text-gray-600">{{ __('Field label') }}</label>
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="text" wire:model="label" />
                        @error('label') <br><span class="text-red-700 block sm:inline  ml-2 error">{{ $message }}</span>@enderror

                    </div>
                    <div class="col-span-2">
                        <label class="text-gray-600">{{ __('Field full name') }}</label>
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="text" wire:model="fullName" />
                        @error('fullName')<br> <span class="text-red-700 block sm:inline  ml-2 error">{{ $message }}</span>@enderror

                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    <div>
                        <label class="text-gray-600">{{ __('Start date') }}</label>
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="date" wire:model="startDate" />
                        @error('startDate') <br><span class="text-red-700 block sm:inline  ml-2 error">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="text-gray-600">{{ __('Duration') }}</label>
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="text" wire:model="duration" />
                        @error('duration') <br><span class="text-red-700 block sm:inline  ml-2 error">{{ $message }}</span>@enderror
                    </div>
                  <div>
                      <label class="text-gray-600">{{ __('Expiration date') }}</label>
                      <input class="w-full h-10 px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="date" wire:model="expirationDate" />
                      @error('expirationDate') <br><span class="text-red-700 block sm:inline  ml-2 error">{{ $message }}</span>@enderror
                  </div>

                </div>

                <div class="mt-4">
                    <label class="text-gray-600">{{ __('Details') }}</label>
                    @error('details') <br><span class="text-red-700 block sm:inline  ml-2 error">{{ $message }}</span>@enderror
                    <textarea rows="15" class="w-full px-3 text-base placeholder-gray-600 border  focus:shadow-outline" type="text" wire:model="details" ></textarea>
                </div>
                <div class="text-center">
                    <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent m-2 w-4/12" wire:click.prevent="createInternship()">
                        Create </button>
                </div>


            </div>
        @endif

    </div>
@else
    <div class="bg-white shadow-lg mx-2 p-2 w-full border-b border-gray-200">
        <div class="text-black px-6 p-4 border-0  relative m-4 bg-white">
                    <span class="text-xl inline-block mr-5 align-middle">
                    <i class="fas fa-bell"></i>
                </span>
            Try adding some offers !
            <br>
        </div>
    </div>
@endif

