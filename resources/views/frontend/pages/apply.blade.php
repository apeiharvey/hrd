@extends($view_path.'.layout.master')
@section('content')
	<div class="container m-b-24">
		<div class="row">
			<div class="col-xs-12 m-t-24 m-b-16 text-center">
				<h1 class="main-title">Want to be a part of ELITE? </h1>
			</div>
		</div>
		<div class="row font-16">
			<div class="container">
				<div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
					<form id="applyForm" name="applyForm" action="{{url('apply-job')}}" method="POST" enctype="multipart/form-data">
						{!!csrf_field()!!}
						<div class="row m-t-8 input-field">
							<div class="text-left label-form col-xs-12">
					    		<label>Name<b>*</b></label>
					    	</div>
					    	<div class="col-xs-12 col-sm-6">
								<input id="firstname" name="firstName" class="input-text" type="text" placeholder="First Name">
							</div>
							<div class="col-xs-12 col-sm-6">
								<input name="lastName" class="input-text" type="text" placeholder="Last Name">
							</div>
						</div>
						<div class="row m-t-8 input-field">
							<div class="text-left label-form col-xs-12">
					    		<label>Email<b>*</b></label><span class="email-validate font-red"><em>Wrong Email Format</em></span>
					    	</div>
							<input id="email" name="email" class="input-text" type="text" placeholder="example@example.com">
						</div>
						<div class="row m-t-8 input-field">
							<div class="text-left label-form col-xs-12">
					    		<label>Phone<b>*</b></label><span class="phone-validate font-red"><em>Min 7 Digit Number</em></span>
					    	</div>
							<input id="phone" title="Phone Number" name="phone" class="input-text" type="text" placeholder="08xxxxxxxxxx">
						</div>
						<div class="row m-t-8">
							<div class="text-left label-form col-xs-12">
					    		<label>Website / LinkedIn URL</label>
					    	</div>
							<input name="website" class="input-text" type="text" placeholder="Website / LinkedIn URL">
						</div>
						<div class="row m-t-8">
							<div class="text-left label-form col-xs-12">
					    		<label>Experience</label>
					    	</div>
					    	<textarea name="experience" class="input-text input-textarea" placeholder="Describe your previous job experience" rows="5"></textarea>
						</div>
						<div class="row m-t-8 text-left input-field">
							<div class="label-form">
								<label>Resume<b>*</b> </label>
							</div>
							<div class="input-file">
								<input type="file" name="file" id="file" class="inputfile" />
								<label class="labelinputfile" for="file">Choose a file</label>
								<span id="fileName" class="fileName">Your file name : </span>
							</div>
							<!-- <span>This field is required</span> -->
							<div class="label-form m-t-8">
								<label>Notes : </label><span> Maximum file size is 2MB (Accepted files:pdf)</span>
							</div>
						</div>
						<div class="row m-t-8 text-left">
							<em class="required-note">( <b>*</b> ) Required field</em>
						</div>
						<input type="hidden" name="vacancyID" value="0">
						<div class="row text-right">
							<div class="col-xs-12">
								<button id="btn-submit" type="submit" class="btn-submit">Send Application</button>
							</div>
						</div>
					</form>
					<div class="row m-t-24">
						<div class="message-applied alert">
						</div>
					</div>
					<div id="myModal" class="modal">
						<div class="modal-content">
							<div class="modal-header text-center">
								<span class="close">&times;</span>
								<h2></h2>
							</div>
							<div class="modal-body text-center font-16">
								<p></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection