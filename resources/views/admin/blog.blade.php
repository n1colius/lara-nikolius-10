@extends('layouts.default')
@section('content')
@include('includes.manage_data_menu')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

            <h3>Blog</h3>
            <br><br><br>

            <div class="d-flex justify-content-between">
				<div>
					<button 
						type="button" 
						class="btn btn-primary btn-xs"
						onclick="window.location='{{ route("adm_blog_form", ['opsi' => 'insert']) }}'"
					>Insert Data</button>
				</div>
				<div>
					<div class="input-group rounded">
					 	<input type="search" class="form-control rounded" placeholder="Search by title" aria-label="Search" aria-describedby="search-addon" id="txtsearch" value="{{$search}}" />
					 	<span class="input-group-text border-0" id="search-addon"><i class="fas fa-search"></i></span>
					</div>
				</div>
		  	</div>

		  	<table class="table table-striped table-hover">
		  	  	<thead>
		  	    <tr>
					<th scope="col">Blog ID</th>
					<th scope="col">Title</th>
					<th scope="col">Date</th>
					<th scope="col">Tags</th>
					<th scope="col">Action</th>
		  	    </tr>
		  	  	</thead>
		  	  	<tbody>
				  	@if(count($data)>0)
	                	@foreach($data as $key=>$item)
							<tr>
								<th scope="row">{{$item->BlogId}}</th>
								<td>{{$item->BlogTitle}}</td>
								<td>{{$item->BlogDate}}</td>
								<td>{{$item->BlogTag}}</td>
								<td>
									<button 
										type="button" 
										class="btn btn-warning btn-xs"
										onclick="window.location='{{ route("adm_blog_form", ['opsi' => 'update','id' => $item->BlogId]) }}'"
									>Update</button>
									&nbsp;&nbsp;
									<button 
										type="button" 
										class="btn btn-danger btn-xs"
										onclick="DeleteBlog('{{ route("adm_blog_delete",['id'=>$item->BlogId]) }}');"
									>Delete</button>
								</td>
						    </tr>
	                	@endforeach

	                @else
	                    <td colspan="5">No data to display</td>
	                @endif
		  	  	</tbody>
		  	</table>

	  		<div class="d-flex justify-content-between">
	  			<div>Showing {{$startdata}} to {{$enddata}} of {{$datacount}} entries</div>
	  			<div>
	  				{{$paginator->links('vendor.pagination.bootstrap-4')}}
	  			</div>
	  	  	</div>

        </div>
    </section>
</div>

<script type="text/javascript">
function DeleteBlog(UrlDelete) {
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
			window.location = UrlDelete;
		}
	});
}
</script>

@endsection