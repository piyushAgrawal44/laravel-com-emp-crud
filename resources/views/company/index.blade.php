<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company') }}
        </h2>
        <a href="{{route('company.create')}}">+ New Company</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 ">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-5">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Logo
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($companies as $company)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $company->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $company->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{  asset($company->logo) }}" alt="Company Logo" class="h-20 w-auto rounded" >
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('company.edit', $company->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                    <form action="{{ route('company.destroy', $company->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <div class="mt-4">
                        {{ $companies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
