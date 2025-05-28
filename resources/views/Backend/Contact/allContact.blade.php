@extends('layouts.BackendLayout')
@section('title', 'Contact-Us')
@section('backend')
<div class="container">
       <div class="card shadow">
                <div class="card-header">All Contacts</div>
                <div class="card-body">
                    <table class="table table-responsive table-striped table-bordered">
                         <thead>
                            <tr class="text-center">
                            <th>SL</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Subject</th>
                           <th>Message</th>
                           <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                            @forelse($contacts as $key=>$contact)
                               <tr class="text-center">
                                <td>{{++$key}}</td>
                                <td class="text-start">{{$contact->name}}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->subject}}</td>
                                <td>{{$contact->message}}</td>
                                <td>
                                    <a href="{{route('contactDelete', $contact->id)}}" class="btn btn-sm btn-danger btnDelete" ><i class='bx bxs-trash' ></i></a>
                                </td>
                                </tr>
                               @empty
                               <tr>
                                <td colspan="4">No brand has been found!</td>
                               </tr>   

                               @endforelse


                            
                        </tbody>
                    </table>
                </div>
            </div>
</div>

@push('scripts') 
<script>
    $(document).ready(function(){
       $('.btnDelete').click(function(e){
        e.preventDefault()
        let url = $(this).attr('href')
      
    Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
   window.location.href = url
  }
});

})
})
</script>

@endpush

@endsection

