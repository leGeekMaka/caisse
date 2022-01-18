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
{{--            <div class="col-lg-4">--}}
{{--                <button  type="button" class="main-btn btn-sm primary-btn btn-hover mb-2"--}}
{{--                         data-bs-toggle="modal" data-bs-target="#ModalTwo"><i class="lni lni-plus me-2"></i> Faire une démande--}}
{{--                </button>--}}
{{--            </div>--}}
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <h6 class="mb-10">Mes demandes en cours</h6>
                    <div class="table-wrapper table-responsive">
                        <table class="table striped-table">
                            <thead>
                            <tr>
                                <th></th>
                                <th><h6>Nom Employé</h6></th>
                                <th><h6>Objet</h6></th>
                                <th><h6>Message</h6></th>
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
                            @forelse ($responsibles as $responsible )
                                <tr>
                                    <td>
                                        <h6 class="text-sm">{{ $i++ }}</h6>
                                    </td>
                                    <td>
                                        <p> Alex GOBE </p>
                                    </td>
                                    <td>
                                        <p>{{ $responsible->object }} </p>
                                    </td>

                                    <td>
                                        <p>{{ $responsible->message }}</p>
                                    </td>
                                    <td>
                                        <p> RAS </p>
                                    </td>
                                    <td>
                                        <p> <span> {{ $responsible->reason }} </span> </p>
                                    </td>
                                    <td>
                                        <p> <span class="status-btn close-btn"> {{ $responsible->status }} </span> </p>
                                    </td>

                                    <td>
                                        <p>{{$responsible->created_at}}</p>
                                    </td>
                                    <td>
                                        <div class="action">
                                            <button wire:click="display({{$responsible->id}})" class="edit"
                                                    data-bs-toggle="modal" data-bs-target="#ModalTwo">
                                                <i class="lni lni-eye"></i>
                                            </button>
{{--                                            <button wire:click="edit({{$responsible->id}})" class="edit"--}}
{{--                                                    data-bs-toggle="modal" data-bs-target="#ModalTwo">--}}
{{--                                                <i class="lni lni-pencil"></i>--}}
{{--                                            </button>--}}
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
                                    @error('object') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="input-style-1">
                                    <label>Message</label>
                                    <input type="text" disabled wire:model="message" placeholder="votre message" />
                                    @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="input-style-1">
                                    <label>Piece jointe</label>
                                    <input class="form-control" disabled type="file" wire:model="path" placeholder="piece jointe" />

                                </div>
                                 <div class="input-style-1">
                                    <label>motif du refus</label>
                                     <textarea class="form-control"  type="text" wire:model="reason"
                                               placeholder="Votre motif" cols="15" rows="5"></textarea>
                                </div>
                                <div class="select-style-1">
                                    <label>Statut</label>
                                    <div class="select-position">
                                        <select wire:model="responsible">
                                            <option disabled value="&nbsp;" >Selectionner le statut</option>
                                            <option value="" >Selectionner le statut</option>
                                            <option value="validate">Accepter</option>
                                            <option value="refuse">Refuser</option>
                                        </select>
                                        @error('responsible') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
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
                                                wire:click="update">Enregistrer
                                        </button>
                                    @endif
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
