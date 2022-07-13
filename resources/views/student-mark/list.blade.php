<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
            <a href="{{route('student-marks.create')}}">
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
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Maths</th>
                            <th>Science</th>
                            <th>History</th>
                            <th>Term</th>
                            <th>Total Mark</th>
                            <th>Created On</th>
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
                ajax: "{{ route('student-marks.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'student.name', name: 'student'},
                    {data: 'maths', name: 'maths'},
                    {data: 'science', name: 'science'},
                    {data: 'history', name: 'history'},
                    {data: 'term', name: 'term'},
                    {data: 'total', name: 'total'},
                    {data: 'created_on', name: 'created_on'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });

        $('.data-table').on('click', '.btn-delete[data-remote]', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = $(this).data('remote');
            if(confirm('Are you sure? Do you want to delete this student mark?')) {
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
    </script>
</x-app-layout>

