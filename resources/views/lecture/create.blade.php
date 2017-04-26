<div class="container">
    <div class="block-header">
        <h2>Lecture - Create Lecture</h2>
    </div>
    <div class="card">
        <form class="form-horizontal" method="POST" action="{{action('LectureController@postCreate')}}" id="lecture_create_form">
            {{csrf_field()}}
            <div class="card-body card-padding">
                <h3><i class="zmdi zmdi-account m-r-5"></i>  Info</h3>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputName">Name*</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <input name="name" type="text" placeholder="Name" id="inputName" class="form-control input-sm" value="{{old('name')}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputDescription">Description*</label>
                    <div class="col-sm-10">
                        <div class="fg-line">
                            <input name="description" type="text" placeholder="Description" id="inputDescription" class="form-control input-sm" value="{{old('description')}}">
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