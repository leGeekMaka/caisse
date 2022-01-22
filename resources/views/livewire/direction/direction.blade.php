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
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <h6 class="mb-10">Demandes en cours</h6>
                    <div class="table-wrapper table-responsive">
                        <table class="table striped-table">
                            <thead>
                            <tr>
                                <th></th>
                                <th><h6>Nom Employé</h6></th>
                                <th><h6>Objet</h6></th>
                                <th><h6>Montant</h6></th>
                                <th><h6>pièce jointe</h6></th>
                                <th><h6>Motif</h6></th>
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
                            @forelse ($directions as $direction )
                                <tr>
                                    <td>
                                        <h6 class="text-sm">{{ $i++ }}</h6>
                                    </td>
                                    <td>
                                        <p> Alex GOBE </p>
                                    </td>
                                    <td>
                                        <p>{{ $direction->object }} </p>
                                    </td>

                                    <td>
                                        <p>{{ $direction->message }}</p>
                                    </td>
                                    <td>
                                        {{ $direction->fileName }}
                                        <div class="more-btn-wrapper">
                                            <button class="more-btn dropdown-toggle" id="moreAction" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                <i class="text-muted lni lni-more-alt" > afficher</i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction">
                                                <li class="dropdown-item">
                                                    <a
                                                            data-fancybox data-type="iframe" data-fancybox data-options='{"type" : "iframe", "iframe" : {"preload" : yess, "css" : {"width" : "600px"}}}'
                                                            data-src="{{ asset('storage/'.$direction->path) }}"
                                                            href="javascript:void(0)" class="text-gray">{{ $direction->fileName }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <p> <span> {{ $direction->reason }} </span> </p>
                                    </td>
                                    <td>
                                        <p> <span class="status-btn close-btn"> {{ $direction->status }} </span> </p>
                                    </td>

                                    <td>
                                        <p>{{$direction->created_at}}</p>
                                    </td>
                                    <td>
                                        <div class="action">
                                            <button wire:click="display({{$direction->id}})" class="edit"
                                                    data-bs-toggle="modal" data-bs-target="#ModalTwo">
                                                <i class="lni lni-eye"></i>
                                            </button>
{{--                                            <button class="edit" data-bs-toggle="modal">--}}
{{--                                                <i class="lni lni-pencil"></i>--}}
{{--                                            </button>--}}
{{--                                            <button class="text-danger" data-bs-toggle="modal">--}}
{{--                                                <i class="lni lni-trash-can"></i>--}}
{{--                                            </button>--}}
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
                <!-- end card -->
            </div>
        </div>

        <div class="warning-modal">
            <div wire:ignore.self class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="ModalTwo" tabindex="-1" aria-hidden="true">
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
                                    <input type="text" disabled wire:model="object" placeholder="objet" />
                                </div>
                                <div class="input-style-1">
                                    <label>Message</label>
                                    <input type="text" disabled wire:model="amount" placeholder="votre message" />
                                </div>
                                <div class="input-style-1">
                                    <label>Piece jointe</label>
                                    <input class="form-control" disabled type="file" wire:model="path" />
                                </div>
                                <div class="input-style-1">
                                    <label>motif du refus</label>
                                    <textarea class="form-control" type="text" wire:model="reason"
                                              placeholder="Votre motif" cols="15" rows="5"></textarea>
                                </div>
                                <div class="select-style-1">
                                    <label>Statut</label>
                                    <div class="select-position">
                                        <select wire:model="direction">
                                            <option disabled value="&nbsp;" >Selectionner le statut</option>
                                            <option value="" >Selectionner le statut</option>
                                            <option value="validate">Accepter</option>
                                            <option value="refuse">Refuser</option>
                                        </select>
                                        @error('responsible') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="main-btn danger-btn-outline rounded-md btn-hover" data-bs-dismiss="modal"
                                            wire:click="cancel">Annuler
                                    </button>
                                    <button class="main-btn active-btn-outline rounded-md btn-hover"
                                            wire:click="update">Enregistrer
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
</div>
