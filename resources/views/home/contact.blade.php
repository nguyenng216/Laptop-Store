@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('css/home_main/content_container.css') }}">
<style>
  /* Reset mọi lệch trái nếu CSS khác đang áp lên */
  .home_container .form-control { margin-left: 0 !important; }
  .home_container .form-label { margin-left: 0 !important; }
</style>
@endsection

@section('title', $viewData['title'])

@section('content')
<div class="home_container">
  <div class="container mt-5">
    <h1>Contact Us</h1>
    <p>Have any questions? Fill out the form below, and we'll get back to you soon.</p>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger mb-4">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('contact.submit') }}" enctype="multipart/form-data">
      @csrf

      <div class="row g-1 mb-3">
        <label for="name" class="col-sm-2 col-form-label text-sm-end">Your Name</label>
        <div class="col-sm-9">
          <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
      </div>

      <div class="row g-1 mb-3">
        <label for="email" class="col-sm-2 col-form-label text-sm-end">Your Email</label>
        <div class="col-sm-9">
          <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
      </div>

      <div class="row g-1 mb-3">
        <label for="message" class="col-sm-2 col-form-label text-sm-end">Your Message</label>
        <div class="col-sm-9">
          <textarea id="message" name="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
        </div>
      </div>

      <div class="row g-1 mb-3">
        <label for="image" class="col-sm-2 col-form-label text-sm-end">Image</label>
        <div class="col-sm-9">
          <input id="image" class="form-control" type="file" name="image" accept="image/*">
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
  </div>
</div>
@endsection

@section('footer' , $viewData['footer'])
