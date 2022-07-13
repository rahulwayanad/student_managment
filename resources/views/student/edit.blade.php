<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Edit Students') }}
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

                        <form method="POST" action="{{ route('students.update',$student->id) }}">
                            @csrf
                            @method('PATCH')
                            <!-- Name -->
                            <div>
                                <x-label for="name" :value="__('Name')" />

                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$student->name" required autofocus />
                            </div>
                            <!-- Age -->
                            <div>
                                <x-label for="name" :value="__('Age')" />

                                <x-input id="age" class="block mt-1 w-full" type="text" name="age" :value="$student->age" required autofocus />
                            </div>
                            <!-- gender -->
                            <div>
                                <x-label for="gender" :value="__('Gender')" />
                                <select class="block mt-1 w-full" name='gender' placeholder='Select'>
                                    @foreach($genders as $key => $value)
                                        <option @if($student->gender == $value ) selected @endif  value="{{ $key }}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Teachers -->
                            <div>
                                <x-label for="teacher" :value="__('Reporting Teacher')" />
                                <select class="block mt-1 w-full" name='teacher_id' placeholder='Select'>
                                    <option value="">Select</option>
                                    @foreach($teachers as $key => $teacher)
                                        <option @if($student->teacher_id == $teacher->id  ) selected @endif   value="{{ $teacher->id }}">{{$teacher->name}}</option>
                                    @endforeach
                                </select>
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
