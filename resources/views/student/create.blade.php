<div class="container">
    <div class="block-header">
        <h2>Student - Create Profile</h2>
    </div>
    <div class="card">
        <form class="form-horizontal" method="POST" action="{{action('StudentController@postCreate')}}" id="student_create_form">
            {{csrf_field()}}
            <div class="card-body card-padding">
                <h3><i class="zmdi zmdi-account m-r-5"></i> Personal Info</h3>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputFirstName">First Name*</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <input name="first_name" type="text" placeholder="First Name" id="inputFirstName" class="form-control input-sm" value="{{old('first_name')}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputLastName">Last Name*</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <input name="last_name" type="text" placeholder="Surname" id="inputLastName" class="form-control input-sm" value="{{old('last_name')}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputEmail">Email</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <input name="email" type="text" placeholder="Email" id="inputEmail" class="form-control input-sm" value="{{old('email')}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputMobileNumber">Mobile Number</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <input name="mobile_number" type="text" placeholder="Mobile Number" id="inputMobileNumber" class="form-control input-sm" value="{{old('mobile_number')}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputAddress">Address</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <input name="address" type="text" placeholder="Address" id="inputAddress" class="form-control input-sm" value="{{old('address')}}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="row">
                            <button class="btn col-xs-offset-1 col-xs-3 btn-primary" type="submit">Create</button>
                            <button class="btn col-xs-offset-2 col-xs-3 btn-default" type="reset">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>