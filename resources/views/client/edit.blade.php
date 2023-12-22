@extends('layouts.mbt')
@section('content')
    <div class="col-lg-6">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Edytuj klienta</h5>
            </div>
            <form class="ibox-content" method="post" action="{{ route('client-update', $client->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row form-row m-b">
                    @include('client._form')
                    <div class="col-12 m-b-sm">
                        @if ($client->logo)
                            <label>Aktualne logo</label>
                            <div>
                                <img style="max-width:100%" src="{{ Storage::url($client->logo) }}">
                            </div>
                        @endif
                        <label class="m-t">Zmień logo</label>
                        <input type="file" class="form-control" name="logo">
                    </div>
                </div>
                <a href="{{ route('client-index') }}" class="btn btn-default">Powrót</a>
                <button type="submit" class="btn btn-primary">Zapisz</a>
            </form>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Loga dodatkowe</h5>
            </div>
            <div class="ibox-tools">
                <button class="btn btn-xs m-b text-light mr-3" style="background-color: #d2798d;" data-toggle="modal" data-target="#addLogo">Dodaj logo dodatkowe</button>
            </div>
            <div class="ibox-content">
                @if(count($additionalLogos) > 0)
                    @foreach ($additionalLogos as $additionalLogo)
                    <form id="delete-additional-logo" method="post" action="{{ route('additional-logo-destroy', $additionalLogo->id) }}" enctype="multipart/form-data">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <div>
                            <button type="submit" data-toggle="tooltip" class="btn btn-primary btn-xs tooltip-more delete-warning" href="{{route('additional-logo-destroy', $additionalLogo->id)}}" data-original-title="Usuń"><i class="fas fa-trash" aria-hidden="true"></i></button>
                            <img src="{{ url('storage/'.$additionalLogo->name) }}" alt="" height="50">
                        </div>
                    </form>
                        <hr>
                    @endforeach
                @else
                    Brak dodanego loga dodatkowego
                @endif
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="addLogo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Dodaj logo dodatkowe</h4>
            </div>
            
            <form id="additional-logo" class="ibox-content" method="post" action="{{ route('additional-logo-store', $client->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <label for="">Logo dodatkowe</label>
                    <div class="custom-file m-b-sm">
                        <!-- <input id="inputGroupFile01" type="file" class="custom-file-input form-control" name="additional_logo"> -->
                        <label class="m-t">Zmień logo</label>
                        <input type="file" class="form-control" name="logo">
                        <!-- <label class="custom-file-label" for="inputGroupFile01">Wybierz plik</label> -->
                        <small>Dozwolone formaty plików: .jpg, .png, .jpeg, .svg</small> <br>
            
                        <small class="text-danger"></small>
                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Anuluj</button>
                    <button type="submit" form="additional-logo" class="btn btn-primary">Zapisz</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    // @if (count($errors) > 0)
    //     $('#).modal('show');
    // @endif

    $('#additional-logo').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var url = e.currentTarget.action;

        $.ajax({
            url:url,
            type:'post',
            data:new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
                $('#addLogo').modal('toggle');
            },
            error: function(error) {
                if (error.status == 422){
                    var errors = $.parseJSON(error.responseText);
                    $("small.text-danger").text(errors.message);
                }
            }
        });
    });

    // $(function () {
    //     $('.tooltip-more').tooltip()
    // })

    $('.delete-warning').click(function (e) {
        var form =  $(this).closest("form");
        e.preventDefault();

        swal({
            title: "Usunąć?",
            text: "Elementu nie będzie się dało odzyskać!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Usuń",
            cancelButtonText: "Nie usuwaj",
            closeOnConfirm: true,
            closeOnCancel: true 
        }, function () {
            form.submit();
        });
    });
</script>
@endsection
