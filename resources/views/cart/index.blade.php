@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
    <main class="container my-5">
        <h1>Your Shopping Cart</h1>
        <hr>

        @if(count($items) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.update', $product->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $items[$product->id] }}" min="1">
                                    <button class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </td>
                            <td>{{ $product->price }} €</td>
                            <td>{{ $product->price * $items[$product->id] }} €</td>
                            <td>
                                <form method="POST" action="{{ route('cart.destroy', $product->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Your cart is empty.</p>
        @endif
    </main>
@endsection
