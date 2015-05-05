@extends('layout')

@section('navbar')
@show

@section('sidebar')
@endsection

@section('body')
<!-- <form action="" method="POST">
    <div class="row field field-username">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo @$entry['username'] ?>">
    </div>
    <div class="row field field-password">
        <label>Password</label>
        <input type="password" name="password">
    </div>
    <input type="hidden" name="keep" value="1">
    <div class="row">
        <input type="submit" value="Login">
    </div>
</form> -->
<style>
    #login {
        width: 400px;
        margin-top: 5%;
        border: none;
        background: inherit;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }
    #login input {
        border: 1px solid #ddd;
    }
    #login input:focus {
        border: 1px dashed #94BC2C;
    }
</style>
<div id="login">
   <div class="title">
      <h2>
         Man Power
         <br>
         <strong>Project Management System</strong>
      </h2>
   </div>
   <form method="POST">
      <div class="row">
         <div class="span-12">
            <input type="text" name="username" value="<?php echo @$entry['username'] ?>" placeholder="Username" />
         </div>
         <div class="span-12">
            <input type="password" name="password" placeholder="Password" />
         </div>
         <div class="span-12">
            <label class="placeholder">
            <input type="checkbox" class="checkbox">
               Keep me sign in
            </label>
         </div>
         <div class="span-12">
            <input type="submit" value="Login"></input>
         </div>
      </div>
   </form>
</div>
@endsection