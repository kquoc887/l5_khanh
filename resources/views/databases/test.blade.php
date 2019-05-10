@extends('databases.master')
@section('content')
  <h2>Laravel Databases</h2>
   <!-- Button trigger modal -->
  <div align="right">
    <button type="button" class="btn btn-success btn-sm" id="create">Create User</button>
  </div>
  <div class="form-inline mb-2">
    <div class="btn-group">
        <input type="text" name="inputPaginationListUsers" id="inputPaginationListUsers" class="form-control" placeholder="Nhập số trang" aria-describedby="helpId">
        <button class="btn btn-primary btn-flat" id="buttonPaginationListUsers">Go</button>
    </div>
  </div>
  <table class="table table-bordered table-hover" id="myTable">
    <thead>
    <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Action</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Action</th>
    </tr>
    </tfoot>
  </table>

  <!-- Modal Create -->
  <div class="modal fade" id="myModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <span id="form_result"></span>
          <form action="" method="POST" id="form-signup">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                  <label for="email">Email <span class="text-danger" id="email_error"></span></label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" aria-describedby="helpId">
            </div>
            <div class="form-group">
                  <label for="password">Password <span class="text-danger" id="password_error"></span></label>
                  
                  <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" aria-describedby="helpId">
            </div>
            <div class="form-group">
                  <label for="password">Repeat Password <span class="text-danger" id="repassword_error"></span></label>
                  <input type="password" name="repassword" id="repassword" class="form-control" placeholder="Enter Repassword" aria-describedby="helpId">
            </div>
            <div id="changePass">
                <label for="changepass">You want to change password? </label>
                <input type="checkbox" name="chkChange" id="chkChange">
            </div>
            <div class="form-group">
                <label for="lastname">First Name <span class="text-danger" id="firstname_error"></span></label>
               
                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name" aria-describedby="helpId ">
            </div>
            <div class="form-group">
                  <label for="fullname">Last Name <span class="text-danger" id="lastname_error"></span></label>
                
                  <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name" aria-describedby="helpId">
            </div>
            <div class="form-group">
              <label for="address">Address <span class="text-danger" id="address_error"></span></label>
              <textarea class="form-control" name="address" id="address" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="">Phone <span class="text-danger" id="phone_error"></span></label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone"  aria-describedby="helpId">
              </div>
            <div class="form-group">
                <button type="button" class="btn btn-danger btn-flat cancelbtn" data-dismiss="modal" id="cancel" >Cancel</button>
                <button type="submit" class="btn btn-success btn-flat signupbtn" id="action_button" value="Sign up">Sign up</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--Modal Delete -->
  @include('databases.modal.confirm_modal')
@endsection

@section('scripts')
<script src="{{asset('js/action.js')}}"></script>
@endsection