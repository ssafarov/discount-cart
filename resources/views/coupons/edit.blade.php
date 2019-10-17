@extends('_layout')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Update a coupon</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif
            <form method="post" action="{{ route('coupons.update', $coupon->uuid) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="coupon_title">Coupon title:</label>
                    <input type="text" class="form-control" id="title" name="coupon_title" value={{ $coupon->title }} />
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
