@extends('quan-tri-vien.main')

@section('main-content')
<style>
	/* Style inputs with type="text", select elements and textareas */
	input[type=text], select, textarea {
	  width: 100%; /* Full width */
	  padding: 12px; /* Some padding */ 
	  border: 1px solid #ccc; /* Gray border */
	  border-radius: 4px; /* Rounded borders */
	  box-sizing: border-box; /* Make sure that padding and width stays in place */
	  margin-top: 6px; /* Add a top margin */
	  margin-bottom: 16px; /* Bottom margin */
	  resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
	}
	
	/* Style the submit button with a specific background color etc */
	
	/* When moving the mouse over the submit button, add a darker green color */
	
	/* Add a background color and some padding around the form */
	.btn {
    height:50px;
    width:500px;
	border-radius: 25px;
	
}
.container-send {
  height: 200px;
  position: relative;
  border: 3px;

}

.vertical-center {
  margin: 0;
  position: absolute;
  top: 10%;
  left: 25%;
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}
	</style>
	<div class="content-wrapper">
		<form action="{{ route('send.email',['id' => $tk->id])}}" class="contact100-form validate-form" method="post">
			@csrf
				@if(session()->has('message'))
					<div class="alert alert-success">
					{{ session()->get('message') }}
					</div>
				@endif
				<span class="contact100-form-title" >Contact Form</span>
				<div class="wrap-input100 validate-input" data-validate = "Name is required">
					<input class="input100" type="text" name="name" placeholder="Name"value="{{auth()->user()->ho_ten}}"readonly>
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-user" aria-hidden="true"></i>
					</span>
					@error('name')
						<span class="text-danger"> {{ $message }} </span>
					@enderror
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<input class="input100" type="text" name="email" placeholder="Email" value="{{$tk->email}}"readonly>
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-envelope" aria-hidden="true"></i>
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Subject is required">
					<input class="input100" type="text" name="subject" placeholder="Subject">
					<span class="focus-input100"></span>
					@error('subject')
						<span class="text-danger"> {{ $message }} </span>
					@enderror<br/>
					<span class="symbol-input100">
					<i class="fa fa-envelope" aria-hidden="true"></i>
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<textarea class="input100" name="content" placeholder="Message"></textarea>
					<span class="focus-input100"></span>
					@error('content')
					<span class="text-danger"> {{ $message }} </span>
					@enderror
				</div>
				<div class="container-send">
					<div class="vertical-center"> 
					<button type="submit" class="btn btn-primary mr-2">Send</button>
					</div>
				</div>
		</form>
	</div>
@endsection