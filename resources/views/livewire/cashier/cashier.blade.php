<div>
    <div>
        <div class="row">
            @if(session()->has('message'))
                <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('message')}} </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{session('error')}} </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon purple">
                    <i class="lni lni-cart-full"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">Solde </h6>
                        <h6 class="text-bold mb-10"> {{ $balance }} FCFA</h6>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="tab-style-1 m-4">
                <nav class="nav"  id="nav-tab">
                    <button wire:ignore class="active" id="tab-1-1" data-bs-toggle="tab" data-bs-target="#tabContent-1-1">
                        En cours
                    </button>
                    <button wire:ignore id="tab-1-2" data-bs-toggle="tab" data-bs-target="#tabContent-1-2">
                        Décaissement
                    </button>
                    <button wire:ignore id="tab-1-3" data-bs-toggle="tab" data-bs-target="#tabContent-1-3">
                        Payé
                    </button>
                </nav>
                <div class="tab-content" id="nav-tabContent1">

                    <div wire:ignore.self  class="tab-pane fade show active" id="tabContent-1-1">
                        <div class="card-style mb-30">
                            <h6 class="mb-10"></h6>
                            <div class=" d-flex flex-wrap justify-content-between align-items-center py-3">
                            </div>
                            <div class="table-wrapper table-responsive">
                                <table class="table striped-table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th><h6>Nom Employé</h6></th>
                                        <th><h6>Objet</h6></th>
                                        <th><h6>Montant</h6></th>
                                        <th><h6>Poste</h6></th>
                                        <th><h6>Date</h6></th>
                                        <th><h6>Actions</h6></th>
                                    </tr>
                                    <!-- end table row-->
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 1
                                    @endphp
                                    @forelse ($requests as $request )
                                        <tr>
                                            <td>
                                                <h6 class="text-sm">{{ $i++ }}</h6>
                                            </td>
                                            <td>
                                                <p> Alex GOBE </p>
                                            </td>
                                            <td>
                                                <p>{{ $request->object }} </p>
                                            </td>

                                            <td>
                                                <p>{{ $request->amount }}</p>
                                            </td>
                                            <td>
                                                role
                                            </td>
                                            <td>
                                                <p>{{$request->created_at}}</p>
                                            </td>
                                            <td>
                                                <div class="action">
                                                    <button wire:click="getId({{$request->id}})" class="edit"
                                                            data-bs-toggle="modal" data-bs-target="#ModalTwo">
                                                        <i class="lni lni-checkmark"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                    @empty
                                        Il n'y a pas de démande
                                    @endforelse
                                    <!-- end table row -->
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>
                        </div>
                    </div>


                    {{-- panel 2   --}}
                    <div wire:ignore.self class="tab-pane fade" id="tabContent-1-2">
                        <div class="card-style mb-30">
                            <h6 class="mb-10"></h6>
                            <div class=" d-flex flex-wrap justify-content-between align-items-center py-3">
                            </div>
                            <div class="table-wrapper table-responsive">
                                <table class="table striped-table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th><h6>Nom Employé</h6></th>
                                        <th><h6>Objet</h6></th>
                                        <th><h6>Montant</h6></th>
                                        <th><h6>Poste</h6></th>
                                        <th><h6>Date</h6></th>
                                        <th><h6>Actions</h6></th>
                                    </tr>
                                    <!-- end table row-->
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 1
                                    @endphp
                                    @forelse ($outflows as $request )
                                        <tr>
                                            <td>
                                                <h6 class="text-sm">{{ $i++ }}</h6>
                                            </td>
                                            <td>
                                                <p> Alex GOBE </p>
                                            </td>
                                            <td>
                                                <p>{{ $request->object }} </p>
                                            </td>

                                            <td>
                                                <p>{{ $request->amount }}</p>
                                            </td>
                                            <td>
                                                role
                                            </td>
                                            <td>
                                                <p>{{$request->created_at}}</p>
                                            </td>
                                            <td>
                                                <div class="action">
                                                    <button wire:click="getId({{$request->id}})" class="edit"
                                                            data-bs-toggle="modal" data-bs-target="#ModalFour">
                                                        payer
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                    @empty
                                        Il n'y a pas de démande
                                    @endforelse
                                    <!-- end table row -->
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>
                        </div>
                    </div>

                   {{-- panel 3   --}}
                    <div wire:ignore.self class="tab-pane fade" id="tabContent-1-3">
                        <div class="card-style mb-30">
                            <h6 class="mb-10"></h6>
                            <div class=" d-flex flex-wrap justify-content-between align-items-center py-3">
                            </div>
                            <div class="table-wrapper table-responsive">
                                <table class="table striped-table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th><h6>Nom Employé</h6></th>
                                        <th><h6>Objet</h6></th>
                                        <th><h6>Montant</h6></th>
                                        <th><h6>Poste</h6></th>
                                        <th><h6>Date</h6></th>
                                    </tr>
                                    <!-- end table row-->
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 1
                                    @endphp
                                    @forelse ($paids as $request )
                                        <tr>
                                            <td>
                                                <h6 class="text-sm">{{ $i++ }}</h6>
                                            </td>
                                            <td>
                                                <p> Alex GOBE </p>
                                            </td>
                                            <td>
                                                <p>{{ $request->object }} </p>
                                            </td>

                                            <td>
                                                <p>{{ $request->amount }}</p>
                                            </td>
                                            <td>
                                                role
                                            </td>
                                            <td>
                                                <p>{{$request->created_at}}</p>
                                            </td>
{{--                                            <td>--}}
{{--                                                <div class="action">--}}
{{--                                                    <button wire:click="display({{$request->id}})" class="edit"--}}
{{--                                                            data-bs-toggle="modal" data-bs-target="#ModalTwo">--}}
{{--                                                        <i class="lni lni-eye"></i>--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
                                        </tr>

                                    @empty
                                        Il n'y a pas de démande
                                    @endforelse
                                    <!-- end table row -->
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="warning-modal">
                <div  wire:ignore.self class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="ModalTwo" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content card-style warning-card text-center">
                            <div class="modal-header px-0 border-0 d-flex justify-content-end ">
                                <button class="border-0 bg-transparent h1" wire:click="cancel" data-bs-dismiss="modal">
                                    <i class="lni lni-cross-circle"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="content mb-30">
                                    <h2 class="mb-15">Valider le décaissement !</h2>
                                    <p class="text-sm text-medium">
                                        Nom : <strong> {{ $name }}</strong>
                                    </p>
                                    <p class="text-sm text-medium">
                                        Objet : <strong> {{ $object }}</strong>
                                    </p>
                                    <p class="text-sm text-medium">
                                        montant : <strong> {{ $amount }}</strong>
                                    </p>

                                </div>
                                <div class="action d-flex flex-wrap justify-content-center">
                                    <button data-bs-dismiss="modal" wire:click="generateToken" class="main-btn success-btn rounded-full btn-hover m-1"
                                    > valider
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


              {{--     payer       --}}
            <div class="warning-modal">
                <div  wire:ignore.self class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="ModalFour" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content card-style warning-card text-center">
                            <div class="modal-header px-0 border-0 d-flex justify-content-end ">
                                <button class="border-0 bg-transparent h1" wire:click="cancel" data-bs-dismiss="modal">
                                    <i class="lni lni-cross-circle"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="content mb-30">
                                    <h2 class="mb-15">Payer !</h2>
                                    <p class="text-sm text-medium">
                                        Nom : <strong> {{ $name }}</strong>
                                    </p>
                                    <p class="text-sm text-medium">
                                        Objet : <strong> {{ $object }}</strong>
                                    </p>
                                    <p class="text-sm text-medium">
                                        montant : <strong> {{ $amount }}</strong>
                                    </p>
                                    <p class="text-sm text-medium">
                                       <h4> Token : <strong> {{ $token }}</strong> </h4>
                                    </p>
                                </div>
                                <div class="action d-flex flex-wrap justify-content-center">
                                    <button data-bs-dismiss="modal" wire:click="paid"
                                             class="main-btn success-btn rounded-full btn-hover m-1">
                                        Payer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @push('scripts')
        <script>
            Livewire.on('closeModal', () => {
                let myModalEl = document.getElementById('ModalTwo');
                let modal = bootstrap.Modal.getInstance(myModalEl);
                modal.hide()
            });
        </script>

    @endpush
</div>
