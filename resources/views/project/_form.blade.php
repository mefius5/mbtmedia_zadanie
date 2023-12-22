<div class="ibox-title">
    <h5>Edytuj projekt</h5>
</div>
<div class="inbox-content">
    <div class="col-12 m-b-sm">
        <label>Nazwa projektu*</label>
        <input type="text" class="form-control" name="name" value="{{ old('name', $project->name) }}">
    </div>

        <div class="col-12 m-b-sm">
            <label>Klient</label>
            <div class="client-select-list">
                <div class="row client-select mb-2">
                    <div class="col-10 mt-xs">
                        <select type="text" class="form-control" name="client_ids[]">
                            <option value=""></option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-1 mt-xs">
                        <a type="button" class="btn btn-default remove-select"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            

            <button type="button" class="btn btn-default btn-xs m-t-xs" id="add-clients-select"><i class="fa fa-plus text-info" aria-hidden="true"></i> Dodaj kolejny</button>
        
            
        </div>
    <div class="col-12 m-b-sm">
        <label>Termin</label>
        <input type="date" class="form-control" name="deadline" value="{{ old('deadline', $project->deadline) }}">
    </div>
    <div class="col-12 m-b-sm">
        <label>Opis projektu</label>
        <textarea class="form-control" name="description">{{ old('description', $project->description) }}</textarea>
    </div>
</div>

<div class="ibox-title">
    <h5>Wybierz Logo</h5>


</div>

<script type="text/javascript">

    var clientSelectList = $('.client-select-list');

    var htmlContent = clientSelectList.html();

    $('#add-clients-select').click(function(e) {
        e.preventDefault();
        clientSelectList.append(htmlContent);
    });

    $(clientSelectList).on('click', '.remove-select', function(e) {
        e.preventDefault();

        $(this).closest('.client-select').remove();
    })

    // $(clientSelectList).on('change', 'select[name="client_ids"]', function(e) {
    //     e.preventDefault();

    // });

</script>
