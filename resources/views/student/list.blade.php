<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
            <a href="{{route('students.create')}}">
                <x-button class="flex justify-end float-right">
                    {{ __('Create') }}
                </x-button>
            </a>
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Session Status -->
                    <x-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-validation-errors class="mb-4" :errors="$errors" />

                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Reporting Teacher</th>
                            <th width="100px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('students.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'age', name: 'age'},
                    {data: 'gender', name: 'gender'},
                    {data: 'teacher.name', name: 'teacher'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('.data-table').on('click', '.btn-delete[data-remote]', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = $(this).data('remote');
                if(confirm('Are you sure? Do you want to delete this student?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: '_DELETE', submit: true}
                    }).always(function (data) {
                        $('.data-table').DataTable().draw(false);
                    });
                }
            });

        });
    </script>
</x-app-layout>

