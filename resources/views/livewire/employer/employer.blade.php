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
              <div class="card-style mb-30">
                <h6 class="mb-10">Mes demandes en cours</h6>
                <div class="table-wrapper table-responsive">
                  <table class="table striped-table">
                    <thead>
                      <tr>
                        <th></th>
                        <th><h6>Objet</h6></th>
                        <th><h6>Message</h6></th>
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
                            <p>{{ $employer->message }}</p>
                          </td>
                          <td>
                            <p> {{ $employer->fileName }} </p>
                          </td>
                          <td>
                            <p> <span class="status-btn close-btn"> {{ $employer->status }} </span> </p>
                          </td>
                          <td>
                            <p>{{$employer->created_at}}</p>
                          </td>
                          <td>
                            <div class="action">
                              <button class="edit" data-bs-toggle="modal">
                                  <i class="lni lni-pencil"></i>
                              </button>
                              <button class="text-danger" data-bs-toggle="modal">
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
              <!-- end card -->
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
                                <form id="form-upload" wire:submit.prevent="store" enctype="multipart/form-data" >
                                <div class="input-style-1">
                                    <label>Objet</label>
                                    <input type="text" wire:model.defer="object" placeholder="objet" />
                                    @error('object') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="input-style-1">
                                    <label>Message</label>
                                    <input type="text" wire:model.defer="message" placeholder="votre message" />
                                    @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="input-style-1">
                                    <label>Piece jointe</label>
                                    <input class="form-control" type="file" name="path" wire:model.defer="path" placeholder="piece jointe" />
                                    <div wire:loading wire:target="path">Téléchargement...</div>
                                </div>
                                <div class="text-center">
                                    <button class="main-btn active-btn-outline rounded-md btn-hover"
                                            type="submit">Enregistrer
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