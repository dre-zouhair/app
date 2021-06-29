@if(sizeof($submissions))
    <div class="p-8 mb-8 grid grid-cols-3">
        <div class="bg-white shadow-lg mx-2 p-2 col-span-1 border-b border-gray-200">
            @foreach($submissions as $value)
                <div class="box-border border-2 2xl:border-blue-100 p-2 mt-2" wire:click="submission({{$value['id']}})">
                    <h2 class="text-2xl mb-2">{{$value['desc']}} </h2>
                    <h1 class="text-blue-300 text-xl" > Submissions :{{\App\Models\Internship::find($value['internship_id'])->title}} </h1>
                    <p> Submited at at : {{$value['created_at']}}</p>
                </div>
            @endforeach

            @if($index> 0)
                @if(! sizeof($submissions))
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
            <div class=" bg-white bg-white shadow-lg mx-2 p-4 col-span-2 border-b border-gray-200">
                <div class="text-center text-4xl text-blue-600">Submission Info</div>

                <div class="mt-4 grid grid-cols-3 gap-4">
                    <div class="mt-4">
                        <label class="text-gray-600">{{ __('Full Name') }}</label>
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600  focus:shadow-outline" type="text"  readonly value="{{$user->name}}{{__(" ")}}{{$user->lastName}}" />
                    </div>

                    <div class="mt-4">
                        <label class="text-gray-600">{{ __('Birth Day') }}</label>
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600  focus:shadow-outline" type="date"  readonly value="{{$intern->dateOfBirth}}" />
                    </div>

                    <div class="mt-4">
                        <label class="text-gray-600">{{ __('Email') }}</label>
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600  focus:shadow-outline" type="text"  readonly value="{{$user->email}}" />
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-3 gap-4">
                    <div class="mt-4">
                        <label class="text-gray-600">{{ __('Phone') }}</label>
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600  focus:shadow-outline" type="text"  readonly value="{{$intern->phone}}" />
                    </div>

                    <div class="mt-4 col-span-2">
                        <label class="text-gray-600 " >{{ __('Address') }}</label>
                        <input class="w-full h-10 px-3 text-base placeholder-gray-600  focus:shadow-outline" type="text"  readonly value="{{$intern->address}}" />
                    </div>

                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="mt-4 text-2xl text-center col-span-3">
                        Trainings
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="mt-4 text-center">
                        Title
                    </div>
                    <div class="mt-4 text-center">
                        Start Date
                    </div>
                    <div class="mt-4 text-center">
                        End Date
                    </div>
                </div>
                @foreach($intern->trainings()->getResults() as $value)
                    <div class="grid grid-cols-3 gap-4">
                        <div class="mt-4">
                            <input class="w-full h-10 px-3 text-base placeholder-gray-600  focus:shadow-outline" type="text"  readonly value="{{$value->title}}" />
                        </div>
                        <div class="mt-4">
                            <input class="w-full h-10 px-3 text-base placeholder-gray-600  focus:shadow-outline" type="text"  readonly value="{{$value->startDate}}" />
                        </div>
                        <div class="mt-4">
                            <input class="w-full h-10 px-3 text-base placeholder-gray-600  focus:shadow-outline" type="text"  readonly value="{{$value->endDate}}" />
                        </div>
                    </div>
                @endforeach

                <div class="grid grid-cols-3 gap-4">
                    <div class="mt-4 text-2xl text-center col-span-3">
                        Experiences
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="mt-4 text-center">
                        Title
                    </div>
                    <div class="mt-4 text-center">
                        Start Date
                    </div>
                    <div class="mt-4 text-center">
                        End Date
                    </div>
                </div>
                @foreach($intern->experiences()->getResults() as $value)
                    <div class="grid grid-cols-3 gap-4">
                        <div class="mt-4">
                            <input class="w-full h-10 px-3 text-base placeholder-gray-600  focus:shadow-outline" type="text"  readonly value="{{$value->enterprise}}" />
                        </div>
                        <div class="mt-4">
                            <input class="w-full h-10 px-3 text-base placeholder-gray-600  focus:shadow-outline" type="text"  readonly value="{{$value->startDate}}" />
                        </div>
                        <div class="mt-4">
                            <input class="w-full h-10 px-3 text-base placeholder-gray-600  focus:shadow-outline" type="text"  readonly value="{{$value->endDate}}" />
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="mt-4 col-span-3">
                            <input class="w-full h-10 px-3 text-base placeholder-gray-600  focus:shadow-outline" type="text"  readonly value="{{$value->desc}}" />
                        </div>
                    </div>
                @endforeach

                <div class="grid grid-cols-3 gap-4 mb-2">
                    <div class="mt-4 text-2xl text-center col-span-3">
                        Skills
                    </div>
                </div>
                <div class="grid grid-cols-10 gap-1">
                @foreach($intern->skills()->getResults() as $value)
                        <div style="padding-top: 0.1em; padding-bottom: 0.1rem"  class="text-xl px-3 bg-green-200 fill-current text-green-800">
                            {{$value->label}}
                        </div>
                @endforeach
                 </div>

                <div class="mt-4">
                    <label class="text-gray-600">{{ __('Desc') }}</label><br>
                    @foreach($lines as $value)
                        {{$value}}<br>
                    @endforeach
                </div>
                <div class="text-center">
                    <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent m-2 w-4/12" wire:click.prevent="accept()">
                        Accept </button>

                    <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent m-2 w-4/12" wire:click.prevent="reject()">
                        Reject </button>
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
            No submissions yet !
            <br>
        </div>
    </div>
@endif

