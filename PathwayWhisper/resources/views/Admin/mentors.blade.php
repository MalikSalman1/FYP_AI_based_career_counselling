@extends('admin.layouts.main')
@section('content')
<!-- Content -->


<div class="container-xxl flex-grow-1 container-p-y">




  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Mentors Menu</h4>






@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  @foreach($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach
  
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif



  <form action="{{route('mentors.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Form controls -->
    <div class="col">
      <div class="card mb-4">
        <h5 class="card-header">Add Mentors</h5>

        <div class="card-body">
          @if(Session::has('success'))
          <div class="alert alert-success alert-dismissible" style="color:#427200" role="alert">
            {{Session::get('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="color:#427200" aria-label="Close"></button>
          </div>
          @elseif(Session::has('error'))
          <div class="alert alert-danger alert-dismissible" style="color:#ff0000" role="alert">
            {{Session::get('error')}}
            <button type="button" class="btn-close" daa-bs-dismiss="alert" style="color:#ff0000" aria-label="Close"></button>
          </div>
          @endif
         
          <div class="mb-3">
            <label for="name" class="form-label">Mentor Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="eg: Muntaha" />
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="mb-3">
            <label for="email" class="form-label">Mentor Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="eg: Muntaha@gmail.com" />
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Mentor Image</label>
            <input type="file" class="form-control" name="image" id="image" />
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="eg: 123456" />
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="eg: 123456" />
            @error('password_confirmation')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            
          </div>
          
          <div class="demo-inline-spacing">

            <button type="Submit" class="btn btn-secondary" style="background-color: green">Submit</button>

          </div>
        </div>

      </div>
</form>
  <!-- table start -->
  <div class="card mb-4" style="padding: 1%;">
    <h5 class="card-header">mentors</h5>
    <div class="table-responsive text-nowrap">
      <table class="table" id="companies_table">
        <thead>
          <tr>
            <!-- fetch all column names in lecturers -->
            <th>#</th>
            <th>Mentor Name</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="sort_rows">
            <!-- fetch all data from lecturers table -->
            @foreach($mentors as $mentor)
            <tr>
            <input type="hidden" value="{{$mentor->id}}">
                <td>
                
                {{$loop->iteration}}
                </td>
                <td>{{$mentor->name}}</td>
                <td>{{$mentor->email}}</td>
                <td>
                <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  
                  <!-- href mentors.delete -->
                  <a class="dropdown-item" style="cursor: pointer;" href="{{route('mentors.delete', $mentor->id)}}"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
                </td>
            </tr>
            @endforeach

        </tbody>
      </table>
    </div>
  </div>
  <!-- table end -->
  
</div>
</div>
</div>
<script>
  $('#companies_table').DataTable();

</script>

<!-- / Content -->
@endsection