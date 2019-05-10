<!doctype html>
<html lang="en">
  <head>
    <title>App-Signup</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <h2>Model Signup Form</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success btn-lg btn-flat" data-toggle="modal" data-target="#modelSignUp">Sign Up</button>
    
    <!-- Modal -->
    <div class="modal fade" id="modelSignUp" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sign Up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <span class="alert-success" id="form_result"></span>
                <form action="{{route('users.store')}}" id="form_signup" method="POST">
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
                      <div class="form-group">
                          <label for="firstname">First Name <span class="text-danger" id="firstname_error"></span></label>
                          <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name" aria-describedby="helpId">
                      </div>
                      <div class="form-group">
                            <label for="lastname">Last Name <span class="text-danger" id="lastname_error"></span></label>
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
                          <button type="button" class="btn btn-danger btn-flat cancelbtn" data-dismiss="modal" id="close">Cancel</button>
                          <button type="submit" class="btn btn-success btn-flat signupbtn" id="action_button" value="Sign up">Sign up</button>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    @routes
    <script src="{{asset('js/signup.js')}}"></script>
  </body>
</html>