@extends('layouts.admin')
@section('title', $viewData['title'] ?? 'Products')
@section('content')
<div class="card">
   <div class="card-header">
    
   Manage Products

   </div>
   <div class="card-body">
       <table class="table table-bordered table-striped">
       <!-- load tablelist of products from here -->
           <table class="table table-bordered table-striped">
               <thead>
                   <tr>
                   <th scope="col">ID</th>
                   <th scope="col">Name</th>
                   <th scope="col">Edit</th>
                   <th scope="col">Delete</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach(($viewData['products'] ?? collect()) as $product)  
                       <tr>
                       <td>{{ $product->id }}</td>
                       <td>{{ $product->name }}</td>
                       <td>Edit</td>
                       <td>Delete</td>
                       </tr>
                   @endforeach
               </tbody>
           </table>
       </table>
   </div>
</div>
@endsection
