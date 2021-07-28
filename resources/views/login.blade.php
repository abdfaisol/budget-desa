@extends('layout.login')

@section('content')

   <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0" style="max-width: 350px">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div>
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form class="user" method="POST" action="ceklogin">
                                        @csrf
                                        <div class="form-group">
                                        <input type="text" class="form-control form-control-user  @error('username') is-invalid @enderror" id="nopol" name="username" aria-describedby="emailHelp" placeholder="Username" required value="<?php if (isset($_GET['user_old'])){echo $_GET['user_old'];}?>">
                                        <div class="invalid-feedback">
                                        @error('username') 
                                            {{ $message }} 
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user  @error('password') is-invalid @enderror" id="nopol" name="password" aria-describedby="emailHelp" placeholder="password" required value="">
                                        <div class="invalid-feedback">
                                        @error('password') 
                                            {{ $message }} 
                                        @enderror
                                    </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>
@endsection