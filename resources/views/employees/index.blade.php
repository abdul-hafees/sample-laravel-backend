<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route("employees.create") }}" type="submit" class="btn btn-primary">Create Product</a>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <th scope="row">{{ $employee->id }}</th>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>
                                    <a href="{{ route('employees.edit', $employee->id) }}">Edit</a>
                                    <a class="delete" href="{{ route('employees.destroy', $employee->id) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(function () {

                $('.delete').on('click', function (e) {
                    e.preventDefault();

                    let href = $(this).attr('href');

                    if (confirm("Are you sure?")) {
                        $.ajax({
                            type: "DELETE",
                            url: href,
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(data){
                                location.reload();
                            }
                        });
                    }
                    return false;
                })
            })
        </script>
    @endpush
</x-app-layout>

