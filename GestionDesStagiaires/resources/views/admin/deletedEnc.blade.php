@include('assets.headerAdmin')

<body class="hold-transition sidebar-mini layout-fixed">
    @include('assets.navbarAdmin')
    @include('assets.sidebarAdmin')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-playwrite">Encadrants</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <!-- Additional content header if needed -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content py-4">
             <div class="container mx-auto px-4">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-3">
                    <form action="{{ route('encSearch') }}" method="post" class="flex flex-col sm:flex-row items-center w-full sm:w-auto space-y-3 sm:space-y-0 sm:space-x-2">
                        @csrf
                        @method('post')
                        <div class="relative w-full sm:w-60">
                            <input type="text" id="usernameSearchInput" name="search" class="px-3 py-2 border rounded-md focus:ring-2 focus:ring-purple-400 w-full pr-12" placeholder="Search by name" value="{{ old('search', $search ?? '') }}" required>
                            <button type="submit" class="absolute inset-y-0 right-0 px-3 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-purple-400">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <a href="/admin/encadrant" class="text-blue-500 hover:text-blue-800 flex items-center space-x-1 mt-3 sm:mt-0">
                        <i class="fas fa-sync-alt"></i> <span>Load All</span>
                    </a>
                </div>




            </div>  



            @if($data->isEmpty())
            <div > 
                <p class="ml-6  text-red font-bold">Aucun encadrant n'était trouvé.</p>
            </div>
@else 
                @include('assets.success')
                <div class="table-responsive">
                    <table class="table-auto w-full border-collapse border border-gray-200">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">Nom</th>
                                <th class="border border-gray-300 px-4 py-2">Prénom</th>
                                <th class="border border-gray-300 px-4 py-2">Departement</th>
                                <th class="border border-gray-300 px-4 py-2" colspan="2">Actions</th> <!-- Column for actions -->
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($data as $item)
                    
                                <tr>
                                    
                                    <td class="border border-gray-300 px-4 py-2">{{ $item->nom }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $item->prenom }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $item->departement->nom }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="/admin/encRestore/{{$item->id}}" onclick="deletedConfirm()"> <i class="fas fa-undo-alt fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                        
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-center mt-3">
                        {{ $data->appends(['search' => request()->input('search')])->links() }}
                    </div>
                </div>

                @endif
            </div>
        </section>
    </div>

    <!-- Additional scripts or JavaScript if required -->
    <script>
        function deletedConfirm() {
        return confirm("Êtes-vous sûr de vouloir restaurer ce encadrant ?");
    }
    </script>
</body>