@extends('layouts.default')
@section('content')

@include('includes.manage_data_menu')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

            <h3>Dota2 Heroes Form</h3>
            <br><br><br>

			<form method="POST" action="{{ route('adm_dota2_heroes_form_proc') }}">
				@csrf

					@if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Something it's wrong:
                            <ul>
                            	@foreach ($errors->all() as $error)
                            		<li>{{ $error }}</li>
                            	@endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    <input type="hidden" name="OpsiForm" value="{{ $opsi }}">

					<div class="mb-3">
					 	<label for="exampleFormControlInput1" class="form-label">Hero ID</label>
					 	<input type="text" class="form-control" name="HeroID" value="{{ old('HeroID', $dataform['HeroID']) }}">
					</div>

					<div class="mb-3">
					 	<label for="exampleFormControlInput1" class="form-label">Hero Name</label>
					 	<input type="text" class="form-control" name="HeroName" value="{{ old('HeroName', $dataform['HeroName']) }}">
					</div>

					<div class="mb-3">
					 	<label for="exampleFormControlInput1" class="form-label">Picture</label>
					 	<input type="text" class="form-control" name="Picture" value="{{ old('Picture', $dataform['Picture']) }}">
					</div>

					<div class="mb-3">
					 	<label for="exampleFormControlInput1" class="form-label">Primary Attribute</label>
					 	<select class="form-select" name="PrimAttr" aria-label="Default select example">
					 		@if (old('PrimAttr', $dataform['PrimAttr']) == "str")
								<option selected="" value="str">Strength</option>
							@else
								<option value="str">Strength</option>
							@endif

							@if (old('PrimAttr', $dataform['PrimAttr']) == "agi")
								<option selected="" value="agi">Agility</option>
							@else
								<option value="agi">Agility</option>
							@endif

							@if (old('PrimAttr', $dataform['PrimAttr']) == "int")
								<option selected="" value="int">Intelligence</option>
							@else
								<option value="int">Intelligence</option>
							@endif
						</select>
					</div>

					<div class="mb-3">
					 	<label for="exampleFormControlInput1" class="form-label">Attack Type</label>
					 	<select class="form-select" name="AttackType" aria-label="Default select example">
					 		@if (old('AttackType', $dataform['AttackType']) == "Melee")
								<option selected="" value="Melee">Melee</option>
							@else
								<option value="Melee">Melee</option>
							@endif

							@if (old('AttackType', $dataform['AttackType']) == "Ranged")
								<option selected="" value="Ranged">Ranged</option>
							@else
								<option value="Ranged">Ranged</option>
							@endif
						</select>
					</div>

					<div class="mb-3">
					 	<label for="exampleFormControlInput1" class="form-label">Roles</label><br>
					 	<div class="form-check form-check-inline">
						 	<input class="form-check-input" type="checkbox" name="HeroRoles[]" id="RolesCarry" value="Carry"
						 		{{ (is_array(old('HeroRoles', $dataform['HeroRoles'])) and in_array('Carry', old('HeroRoles', $dataform['HeroRoles']))) ? ' checked' : '' }}
						 	>
						 	<label class="form-check-label" for="RolesCarry">Carry</label>
						</div>
						<div class="form-check form-check-inline">
						 	<input class="form-check-input" type="checkbox" name="HeroRoles[]" id="RolesEscape" value="Escape"
						 		{{ (is_array(old('HeroRoles', $dataform['HeroRoles'])) and in_array('Escape', old('HeroRoles', $dataform['HeroRoles']))) ? ' checked' : '' }}
						 	>
						 	<label class="form-check-label" for="RolesEscape">Escape</label>
						</div>
						<div class="form-check form-check-inline">
						 	<input class="form-check-input" type="checkbox" name="HeroRoles[]" id="RolesNuker" value="Nuker"
						 		{{ (is_array(old('HeroRoles', $dataform['HeroRoles'])) and in_array('Nuker', old('HeroRoles', $dataform['HeroRoles']))) ? ' checked' : '' }}
						 	>
						 	<label class="form-check-label" for="RolesNuker">Nuker</label>
						</div>
						<div class="form-check form-check-inline">
						 	<input class="form-check-input" type="checkbox" name="HeroRoles[]" id="RolesInitiator" value="Initiator"
						 		{{ (is_array(old('HeroRoles', $dataform['HeroRoles'])) and in_array('Initiator', old('HeroRoles', $dataform['HeroRoles']))) ? ' checked' : '' }}
						 	>
						 	<label class="form-check-label" for="RolesInitiator">Initiator</label>
						</div>
						<div class="form-check form-check-inline">
						 	<input class="form-check-input" type="checkbox" name="HeroRoles[]" id="RolesDurable" value="Durable"
						 		{{ (is_array(old('HeroRoles', $dataform['HeroRoles'])) and in_array('Durable', old('HeroRoles', $dataform['HeroRoles']))) ? ' checked' : '' }}
						 	>
						 	<label class="form-check-label" for="RolesDurable">Durable</label>
						</div>
						<div class="form-check form-check-inline">
						 	<input class="form-check-input" type="checkbox" name="HeroRoles[]" id="RolesDisabler" value="Disabler"
						 		{{ (is_array(old('HeroRoles', $dataform['HeroRoles'])) and in_array('Disabler', old('HeroRoles', $dataform['HeroRoles']))) ? ' checked' : '' }}
						 	>
						 	<label class="form-check-label" for="RolesDisabler">Disabler</label>
						</div>					
						<div class="form-check form-check-inline">
						 	<input class="form-check-input" type="checkbox" name="HeroRoles[]" id="RolesJungler" value="Jungler"
						 		{{ (is_array(old('HeroRoles', $dataform['HeroRoles'])) and in_array('Jungler', old('HeroRoles', $dataform['HeroRoles']))) ? ' checked' : '' }}
						 	>
						 	<label class="form-check-label" for="RolesJungler">Jungler</label>
						</div>											
						<div class="form-check form-check-inline">
						 	<input class="form-check-input" type="checkbox" name="HeroRoles[]" id="RolesSupport" value="Support"
						 		{{ (is_array(old('HeroRoles', $dataform['HeroRoles'])) and in_array('Support', old('HeroRoles', $dataform['HeroRoles']))) ? ' checked' : '' }}
						 	>
						 	<label class="form-check-label" for="RolesSupport">Support</label>
						</div>
						<div class="form-check form-check-inline">
						 	<input class="form-check-input" type="checkbox" name="HeroRoles[]" id="RolesPusher" value="Pusher"
						 		{{ (is_array(old('HeroRoles', $dataform['HeroRoles'])) and in_array('Pusher', old('HeroRoles', $dataform['HeroRoles']))) ? ' checked' : '' }}
						 	>
						 	<label class="form-check-label" for="RolesPusher">Pusher</label>
						</div>
					</div>

					<br><br>

					<h3>Notes</h3>
					<div class="d-flex justify-content-between">
						<div><button type="button" class="btn btn-primary btn-xs" onclick="ShowNotes('insert',null,null);" data-bs-toggle="modal" data-bs-target="#HeroNotesModal">Insert Notes</button></div>
					</div>
					<table class="table table-striped table-hover">
				  	<thead>
				    <tr>
				      <th scope="col">Notes</th>
				      <th scope="col">Action</th>
				    </tr>
				  	</thead>
				  	<tbody id="tbody-notes">
						@if( count($datanotes) > 0 )
                			@foreach($datanotes as $key=>$item)
						  		<tr>
						  			<td scope="row">{{ $item->Notes }}</td>
						  			<td>
										<button type="button" class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#HeroNotesModal" onclick="ShowNotes('update', {{ $item->NotesID }}, '{{ $item->Notes }}');">Update</button>
										&nbsp;
										<button type="button" class="btn btn-danger btn-xs" onclick="DeleteNotes({{ $item->NotesID }});">Delete</button>
						  			</td>
						  		</tr>
							@endforeach
		                @else
		                    <td colspan="2">No data to display</td>
		                @endif
				  	</tbody>
				  	</table>

					<!-- Modal -->
					<div class="modal fade" id="HeroNotesModal" tabindex="-1" aria-labelledby="HeroNotesModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Hero Notes</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="mb-3">
										<input type="hidden" name="NotesID" id="NotesID" value="">
									 	<textarea class="form-control" name="HeroNotes" id="HeroNotes"></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" id="btn-savenotes" class="btn btn-secondary">Save Notes</button>
									<button type="button" id="btn-closenotes" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
								</div>
							</div>
					  	</div>
					</div>

					<br><br>
					<div class="col-auto">
						<button type="submit" class="btn btn-primary mb-3">Save</button>
						<button type="button" class="btn btn-secondary mb-3" onclick="window.location='{{ route("adm_dota2_heroes") }}'">Back</button>
					</div>

			</form>

        </div>
    </section>
</div>

<script type="text/javascript">
$(document).ready(function($){
	
	document.getElementById("btn-savenotes").addEventListener("click", function(e) {
		e.preventDefault();

		//cek validasi
		let HeroNotes = $('#HeroNotes').val();
		if(HeroNotes == '') {
			Swal.fire(
			  	'Form not valid',
			  	'Notes is empty',
				'info'
			);
			return false;
		}

		let formData = {
            NotesID: $('#NotesID').val(),
            HeroNotes: $('#HeroNotes').val(),
            HeroID: {{ $dataform['HeroID'] }}
        };

        $.ajax({
            type: 'POST',
            url: '{{ route('adm_dota2_heroes_form_notes_proc') }}',
            data: formData,
            dataType: 'json',
            success: function (data) {
                //console.log(data);

                $('#tbody-notes').find('tr').remove().end();
                $.each(data.datanotes, function(index, val) {
					$('#tbody-notes').append('<tr><td scope="row">'+val.Notes+'</td><td><button type="button" class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#HeroNotesModal" onclick="ShowNotes(\'update\','+val.NotesID+',\''+val.Notes+'\');">Update</button>&nbsp;<button type="button" class="btn btn-danger btn-xs">Delete</button></td></tr>');
                });

                //Trigger close button
                document.getElementById('btn-closenotes').click();
            },
            error: function (data) {
                Swal.fire(
    			  	'Network Error',
    			  	'Process Failed',
    				'error'
    			);
            }
        });

	});

});

function ShowNotes(opsi, NotesID, Notes) {
	if(opsi == 'insert') {
		document.getElementById("NotesID").value = "";
		document.getElementById("HeroNotes").value = "";
	}

	if(opsi == 'update') {
		document.getElementById("NotesID").value = NotesID;
		document.getElementById("HeroNotes").value = Notes;
	}	
}

function DeleteNotes(NotesID) {
	Swal.fire({
		title: 'Are you sure want to delete ?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete'
	}).then((result) => {
		if (result.isConfirmed) {
			
			$.ajax({
                type: 'POST',
                url: '{{ route('adm_dota2_heroes_form_notes_delete') }}',
                data: {
		            NotesID: NotesID,
		            HeroID: {{ $dataform['HeroID'] }}
		        },
                dataType: 'json',
                success: function (data) {
                    //console.log(data);

                    $('#tbody-notes').find('tr').remove().end();
                    $.each(data.datanotes, function(index, val) {
    					$('#tbody-notes').append('<tr><td scope="row">'+val.Notes+'</td><td><button type="button" class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#HeroNotesModal" onclick="ShowNotes(\'update\','+val.NotesID+',\''+val.Notes+'\');">Update</button>&nbsp;<button type="button" class="btn btn-danger btn-xs">Delete</button></td></tr>');
                    });
                },
                error: function (data) {
                    Swal.fire(
        			  	'Network Error',
        			  	'Process Failed',
        				'error'
        			);
                }
            });

		}
	})
}
</script>

@endsection