@extends('layouts.admin_login')

@section('content')
<section>
    <div class="signinpanel">
        <div class="row">
            <div class="col-md-2"></div><!-- col-sm-7 -->
            <div class="col-md-8">
                <form class="form-horizontal" method="POST" action="{{ route('admin.login') }}">
                        {{ csrf_field() }}
                    <h4 class="nomargin">Sign In</h4>
                    <p class="mt5 mb20">Login to access your account.</p>
                    <input type="text" class="form-control uname" name="username" placeholder="Username" value="{{ old('username') }}" />
                    <input type="password" class="form-control pword" name="password" placeholder="Password" />
                    
                    <button class="btn btn-success btn-block" type="submit">Login</button>
                    
                </form>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->

        
    </div><!-- signin -->
  
</section>
@endsection
