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
            <div class="col-lg-4">
              <button  type="button" class="main-btn btn-sm primary-btn btn-hover mb-2"
                      data-bs-toggle="modal" data-bs-target="#ModalTwo"><i class="lni lni-plus me-2"></i> Faire une démande
              </button>
            </div>
            <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div class="tab-style-1 m-4">
                            <nav class="nav " id="nav-tab">
                                <button class="active" id="tab-1-1" data-bs-toggle="tab" data-bs-target="#tabContent-1-1">
                                    En cours
                                </button>
                                <button id="tab-1-2" data-bs-toggle="tab" data-bs-target="#tabContent-1-2">
                                    Refusé
                                </button>
                                <button id="tab-1-3" data-bs-toggle="tab" data-bs-target="#tabContent-1-3">
                                    Accepté
                                </button>
                            </nav>
                            <div class="tab-content" id="nav-tabContent1">
                                <div class="tab-pane fade show active" id="tabContent-1-1">
                                    <div class="card-style mb-30">
                                        <h6 class="mb-10"></h6>
                                        <div class=" d-flex flex-wrap justify-content-between align-items-center py-3">
                                        </div>
                                        <div class="table-wrapper table-responsive">
                                            <table class="table striped-table">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th><h6>Objet</h6></th>
                                                    <th><h6>Montant</h6></th>
                                                    <th><h6>pièce jointe</h6></th>
                                                    <th><h6>statut</h6></th>
                                                    <th><h6>Date</h6></th>
                                                    <th><h6>Actions</h6></th>
                                                </tr>
                                                <!-- end table row-->
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i = 1
                                                @endphp
                                                @forelse ($employers as $employer )
                                                    <tr>
                                                        <td>
                                                            <h6 class="text-sm">{{ $i++ }}</h6>
                                                        </td>
                                                        <td>
                                                            <p>{{ $employer->object }} </p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $employer->amount }}</p>
                                                        </td>
                                                        <td>
                                                            {{ $employer->fileName }}
                                                            <div class="more-btn-wrapper">
                                                                <button class="more-btn dropdown-toggle" id="moreAction" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                    <i class="text-muted lni lni-more-alt" > afficher</i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction">
                                                                    <li class="dropdown-item">
                                                                        <a
                                                                                data-fancybox data-type="iframe" data-fancybox data-options='{"type" : "iframe", "iframe" : {"preload" : yess, "css" : {"width" : "600px"}}}'
                                                                                data-src="{{ asset('storage/'.$employer->path) }}"
                                                                                href="javascript:void(0)" class="text-gray">{{ $employer->fileName }}
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                        </td>
                                                        <td>
                                                            <p>
                                                                @if($employer->status === "pending")
                                                                    <span class="status-btn close-btn"> En attente </span>
                                                                @endif
                                                                @if($employer->status === "refuse")
                                                                    <span class="status-btn close-btn"> Refusé </span>
                                                                @endif
                                                                @if($employer->status === "validate")
                                                                    <span class="status-btn success-btn"> accepté </span>
                                                                @endif
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p>{{$employer->created_at}}</p>
                                                        </td>
                                                        <td>
                                                            <div class="action">
                                                                <button wire:click="getToken({{$employer->id}})" class="edit"
                                                                        data-bs-toggle="modal" data-bs-target="#Modalfour">
                                                                    <i class="lni lni-eye"></i>
                                                                </button>
                                                                <button wire:click="edit({{$employer->id}})" class="edit"
                                                                        data-bs-toggle="modal" data-bs-target="#ModalTwo" data-bs-toggle="modal">
                                                                    <i class="lni lni-pencil"></i>
                                                                </button>
                                                                <button class="text-danger" wire:click="getId({{$employer->id}})"
                                                                        data-bs-toggle="modal" data-bs-target="#ModalTree">
                                                                    <i class="lni lni-trash-can"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                @empty
                                                    Vous n'avez emis aucune demande
                                                @endforelse
                                                <!-- end table row -->
                                                </tbody>
                                            </table>
                                            <!-- end table -->
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tabContent-1-2">
                                    <div class="card-style mb-30">
                                        <h6 class="mb-10"></h6>
                                        <div class=" d-flex flex-wrap justify-content-between align-items-center py-3">
                                        </div>
                                        <div class="table-wrapper table-responsive">
                                            <table class="table striped-table">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th><h6>Objet</h6></th>
                                                    <th><h6>Montant</h6></th>
                                                    <th><h6>pièce jointe</h6></th>
                                                    <th><h6>statut</h6></th>
                                                    <th><h6>Motif</h6></th>
                                                    <th><h6>Date</h6></th>
                                                    <th><h6>Actions</h6></th>
                                                </tr>
                                                <!-- end table row-->
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i = 1
                                                @endphp
                                                @forelse ($requestsRefused as $employer )
                                                    <tr>
                                                        <td>
                                                            <h6 class="text-sm">{{ $i++ }}</h6>
                                                        </td>
                                                        <td>
                                                            <p>{{ $employer->object }} </p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $employer->amount }}</p>
                                                        </td>
                                                        <td>
                                                            {{ $employer->fileName }}
                                                            <div class="more-btn-wrapper">
                                                                <button class="more-btn dropdown-toggle" id="moreAction" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                    <i class="text-muted lni lni-more-alt" > afficher</i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction">
                                                                    <li class="dropdown-item">
                                                                        <a
                                                                                data-fancybox data-type="iframe" data-fancybox data-options='{"type" : "iframe", "iframe" : {"preload" : yess, "css" : {"width" : "600px"}}}'
                                                                                data-src="{{ asset('storage/'.$employer->path) }}"
                                                                                href="javascript:void(0)" class="text-gray">{{ $employer->fileName }}
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                        </td>
                                                        <td>
                                                            <p>
                                                                @if($employer->status === "pending")
                                                                    <span class="status-btn close-btn"> En attente </span>
                                                                @endif
                                                                @if($employer->status === "refuse")
                                                                    <span class="status-btn close-btn"> Refusé </span>
                                                                @endif
                                                                @if($employer->status === "validate")
                                                                    <span class="status-btn success-btn"> accepté </span>
                                                                @endif
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p>{{$employer->reason}}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{$employer->created_at}}</p>
                                                        </td>
                                                        <td>
                                                            <div class="action">
                                                                <button wire:click="getToken({{$employer->id}})" class="edit"
                                                                        data-bs-toggle="modal" data-bs-target="#Modalfour">
                                                                    <i class="lni lni-eye"></i>
                                                                </button>
                                                                <button wire:click="edit({{$employer->id}})" class="edit"
                                                                        data-bs-toggle="modal" data-bs-target="#ModalTwo" data-bs-toggle="modal">
                                                                    <i class="lni lni-pencil"></i>
                                                                </button>
                                                                <button class="text-danger" wire:click="getId({{$employer->id}})"
                                                                        data-bs-toggle="modal" data-bs-target="#ModalTree">
                                                                    <i class="lni lni-trash-can"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                @empty
                                                    Vous n'avez emis aucune demande
                                                @endforelse
                                                <!-- end table row -->
                                                </tbody>
                                            </table>
                                            <!-- end table -->
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tabContent-1-3">
                                    <div class="card-style mb-30">
                                        <h6 class="mb-10"></h6>
                                        <div class=" d-flex flex-wrap justify-content-between align-items-center py-3">
                                        </div>
                                        <div class="table-wrapper table-responsive">
                                            <table class="table striped-table">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th><h6>Objet</h6></th>
                                                    <th><h6>Montant</h6></th>
                                                    <th><h6>pièce jointe</h6></th>
                                                    <th><h6>statut</h6></th>
                                                    <th><h6>Date</h6></th>
                                                    <th><h6>Actions</h6></th>
                                                </tr>
                                                <!-- end table row-->
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i = 1
                                                @endphp
                                                @forelse ($validatedRequest as $employer )
                                                    <tr>
                                                        <td>
                                                            <h6 class="text-sm">{{ $i++ }}</h6>
                                                        </td>
                                                        <td>
                                                            <p>{{ $employer->object }} </p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $employer->amount }}</p>
                                                        </td>
                                                        <td>
                                                            {{ $employer->fileName }}
                                                            <div class="more-btn-wrapper">
                                                                <button class="more-btn dropdown-toggle" id="moreAction" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                    <i class="text-muted lni lni-more-alt" > afficher</i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction">
                                                                    <li class="dropdown-item">
                                                                        <a
                                                                                data-fancybox data-type="iframe" data-fancybox data-options='{"type" : "iframe", "iframe" : {"preload" : yess, "css" : {"width" : "600px"}}}'
                                                                                data-src="{{ asset('storage/'.$employer->path) }}"
                                                                                href="javascript:void(0)" class="text-gray">{{ $employer->fileName }}
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                        </td>
                                                        <td>
                                                            <p>
                                                                @if($employer->status === "pending")
                                                                    <span class="status-btn close-btn"> En attente </span>
                                                                @endif
                                                                @if($employer->status === "refuse")
                                                                    <span class="status-btn close-btn"> Refusé </span>
                                                                @endif
                                                                @if($employer->status === "validate")
                                                                    <span class="status-btn success-btn"> accepté </span>
                                                                @endif
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p>{{$employer->created_at}}</p>
                                                        </td>
                                                        <td>
                                                            <div class="action">
                                                                <button wire:click="getToken({{$employer->id}})" class="edit"
                                                                        data-bs-toggle="modal" data-bs-target="#Modalfour">
                                                                    <i class="lni lni-eye"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                @empty
                                                    Vous n'avez emis aucune demande
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
                    </div>
            </div>
          </div>

          <div class="warning-modal">
                <div wire:ignore.self class="modal fade mod" data-bs-backdrop="static" data-bs-keyboard="false"
                     id="ModalTwo" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content card-style warning-card">
                        <div class="modal-header px-0 border-0 d-flex justify-content-end ">
                                <button class="border-0 bg-transparent h2" wire:click="cancel" data-bs-dismiss="modal">
                                    <i class="lni lni-cross-circle"></i>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="input-style-1">
                                    <label>Objet</label>
                                    <input type="text" wire:model.defer="object" placeholder="objet" />
                                    @error('object') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="input-style-1">
                                    <label>Montant</label>
                                    <input type="text" wire:model.defer="amount" placeholder="montant" />
                                    @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="input-style-1">
                                    <label>Piece jointe</label>
                                    @if($edit === "true")
                                    <p> nom du fichier : {{$fileName}}</p>
                                    @endif
                                    <input class="form-control" type="file" name="path" wire:model.defer="path" placeholder="piece jointe" />
                                    <div wire:loading wire:target="path">Téléchargement...</div>
                                </div>
                                <div class="text-center">
                                    @if($edit === "true")
                                        <button class="main-btn danger-btn-outline rounded-md btn-hover" data-bs-dismiss="modal"
                                                wire:click="cancel">Annuler
                                        </button>
                                        <button class="main-btn active-btn-outline rounded-md btn-hover"
                                                wire:click="update">Modifier
                                        </button>
                                    @else
                                        <button class="main-btn danger-btn-outline rounded-md btn-hover" data-bs-dismiss="modal"
                                                wire:click="cancel">Annuler
                                        </button>
                                        <button class="main-btn active-btn-outline rounded-md btn-hover"
                                                wire:click="store">Enregistrer
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    {{-- modal de suppression--}}

    <div class="warning-modal">
        <div  wire:ignore.self class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="ModalTree" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content card-style warning-card text-center">
                    <div class="modal-header px-0 border-0 d-flex justify-content-end ">
                        <button class="border-0 bg-transparent h1" wire:click="cancel" data-bs-dismiss="modal">
                            <i class="lni lni-cross-circle"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="icon text-danger mb-20">
                            <i class="lni lni-warning"></i>
                        </div>
                        <div class="content mb-30">
                            <h2 class="mb-15">Attention !</h2>
                            <p class="text-sm text-medium">
                                Vous allez supprimer : <strong> {{ $object }}</strong>
                            </p>
                        </div>
                        <div class="action d-flex flex-wrap justify-content-center">
                            <button data-bs-dismiss="modal" wire:click="$emit('destroy')" class="main-btn danger-btn rounded-full btn-hover m-1"
                            > Supprimer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    modal afficher le token--}}

    <div class="warning-modal">
        <div wire:ignore.self class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"
             id="Modalfour" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content card-style warning-card">
                    <div class="modal-header px-0 border-0 d-flex justify-content-end ">
                        <button class="border-0 bg-transparent h2" wire:click="cancel" data-bs-dismiss="modal">
                            <i class="lni lni-cross-circle"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                           <h6 class="display-6"> Token : {{$token}}</h6>
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

        Livewire.on('closeModalDestroy', () =>{
            let myModalEl = document.getElementById('ModalTree');
            let modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide()
        });

        document.addEventListener('closeAlert',closeAlert);
        function closeAlert(){
            setTimeout(()=>{
                let alertNode = document.querySelector('#alert-message');
                let alert = new bootstrap.Alert(alertNode);
                alert.close()
            },3000)
        }
    </script>
@endpush