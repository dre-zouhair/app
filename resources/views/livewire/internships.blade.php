<div class="p-8 mb-8 grid grid-cols-3">
    <div class="bg-white shadow-lg mx-2 p-2 col-span-1 border-b border-gray-200">

        @foreach($internships as $value)
            <div class="box-border border-2 2xl:border-blue-100 p-2 mt-2" wire:click="internship({{$value['id']}})">
               <h1 class="text-4xl" >{{$value['title']}} </h1>
               <h1 class="text-blue-300 text-xl" > Enterprise :{{\App\Models\Enterprise::find($value['enterprise_id'])->name}} </h1>
                <p class="text-3xl"  > Start at : {{$value['startDate']}}</p>
                <p class="text-2xl"   >Duration :{{$value['duration']}}</p>
            </div>
        @endforeach
            @if($index> 0)
                @if(! sizeof($internships))
                    <div>No data
                @endif
                <button class="mt-8 bg-transparent hover:bg-yellow-400 text-yellow-600 font-semibold hover:text-white py-2 px-4 border border-yellow-400 hover:border-transparent m-2 w-4/12" wire:click="paginate(-1)">
                    Back
                </button>
                @if(! sizeof($internships))
                            </div>
                @endif
            @endif
            @if(sizeof($internships))
            <button class="mt-8 bg-transparent hover:bg-green-400 text-green-600 font-semibold hover:text-white py-2 px-4 border border-green-400 hover:border-transparent m-2 w-4/12" wire:click="paginate(1)">
                Next
            </button>
            @endif

    </div>
@if($display)
    <div class=" bg-white bg-white shadow-lg mx-2 p-2 col-span-2 border-b border-gray-200">

            <div>
               <h1 class="text-6xl">{{$internship->title}}</h1>
            </div>
            <div>
                {{$internship->enterprise()->getResults()->name}} -
                {{$internship->enterprise()->getResults()->internships()->where('expirationDate' ,'>', \Carbon\Carbon::now())->getResults()->count()}} offers
            </div>
            <div>
               <h1 class="text-2xl">{{$internship->startDate}} -  {{$internship->duration}} months</h1>
            </div>
            <div>
               <h1 class="text-2xl">{{$internship->expirationDate}}</h1>
            </div>
            <div>
                {{$internship->details}}
            </div>

        <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent m-2 w-4/12" wire:click.prevent="submit()">
            subit</button>

    </div>

    @if($modal)
        <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div>
                                    <p> Enter your message</p>
                                    <div class="mt-1">
                                        <textarea id="desc" wire:model="desc" name="desc" rows="10" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 text-center">
                            <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent m-2 w-4/12" wire:click.prevent="save()">
                                Deactivate
                            </button>
                            <button class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent w-4/12 m-2" wire:click.prevent="closeModal()">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    @endif

</div>



