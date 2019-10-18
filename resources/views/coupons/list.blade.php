@extends('_layout')

@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h2 class="display-3">Coupons</h2>
            <div>
                <a style="margin: 19px;" href="{{ route('coupons.create')}}" class="btn btn-primary">New coupon</a>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>Title</td>
                    <td style="width:70%;">Description</td>
                    <td colspan=2>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($coupons as $coupon)
                    <tr>
                        <td>{{$coupon->title}}</td>
                        <td>{{$coupon->description}}</td>
                        <td>
                            <a href="{{ route('coupons.edit',$coupon->uuid)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('coupons.destroy', $coupon->uuid)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
