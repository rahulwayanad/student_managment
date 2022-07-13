<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Edit Teachers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-card>

                        <!-- Session Status -->
                        <x-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('student-marks.update',$student_mark->id) }}">
                            @csrf
                            @method('PATCH')
                            <!-- Students -->
                            <div>
                                <x-label for="students" :value="__('Student')" />
                                <select class="block mt-1 w-full" name='student_id' placeholder='Select'>
                                    <option value="">Select</option>
                                    @foreach($students as $key => $student)
                                        <option @if($student_mark->student_id == $student->id ) selected @endif  value="{{ $student->id }}">{{$student->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Terms -->
                            <div>
                                <x-label for="students" :value="__('Term')" />
                                <select class="block mt-1 w-full" name='term' placeholder='Select'>
                                    <option value="">Select</option>
                                    @foreach($terms as $key => $term)
                                        <option  @if($student_mark->term == $term ) selected @endif  value="{{ $term }}">{{$term}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Mathematics Mark -->
                            <div>
                                <x-label for="maths" :value="__('Mathematics Mark')" />
                                <x-input id="maths" class="block mt-1 w-full" type="text" name="maths" :value="$student_mark->maths" required autofocus />
                            </div>
                            <!-- Science Mark -->
                            <div>
                                <x-label for="science" :value="__('Science Mark')" />
                                <x-input id="science" class="block mt-1 w-full" type="text" name="science" :value="$student_mark->science" required autofocus />
                            </div>
                            <!-- History Mark -->
                            <div>
                                <x-label for="history" :value="__('History Mark')" />
                                <x-input id="history" class="block mt-1 w-full" type="text" name="history" :value="$student_mark->history" required autofocus />
                            </div>


                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-3">
                                    {{ __('Update') }}
                                </x-button>
                            </div>
                        </form>
                    </x-card>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
