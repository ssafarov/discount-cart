@extends('_layout')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add a coupon</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="{{ route('coupons.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">Coupon title:</label>
                        <input type="text" class="form-control" name="title"/>
                    </div>

                    <div class="form-group">
                        <h5>Coupon rules</h5>
                        <table>
                            <thead>
                            <tr>
                                <th>Rule Type</th>
                                <th>Trigger</th>
                                <th>Trigger Condition</th>
                                <th>Trigger Value</th>
                                <th>Discount</th>
                                <th>Discount Value</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select type="text" class="form-control" name="rules[0][type]">
                                            <option value="single">Single / First</option>
                                            <option value="and">And</option>
                                            <option value="or">Or</option>
                                            <option value="add">Add to following</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[0][trigger]">
                                            <option value="count">Items count</option>
                                            <option value="summ">Cart total</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[0][triggerCondition]">
                                            <option value="equal">Equal to</option>
                                            <option value="greater">Greater than</option>
                                            <option value="less">Less than</option>
                                            <option value="greaterEq">Greater or equal than</option>
                                            <option value="lessEq">Less or equal than</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" name="rules[0][triggerValue]"/></td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[0][discount]">
                                            <option value="amount">Fixed discount</option>
                                            <option value="percent">Percent discount</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" name="rules[0][discountValue]"/></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select type="text" class="form-control" name="rules[1][type]">
                                            <option value="single">Single / First</option>
                                            <option value="and">And</option>
                                            <option value="or">Or</option>
                                            <option value="add">Add to following</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[1][trigger]">
                                            <option value="count">Items count</option>
                                            <option value="summ">Cart total</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[1][triggerCondition]">
                                            <option value="equal">Equal to</option>
                                            <option value="greater">Greater than</option>
                                            <option value="less">Less than</option>
                                            <option value="greaterEq">Greater or equal than</option>
                                            <option value="lessEq">Less or equal than</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" name="rules[1][triggerValue]"/></td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[1][discount]">
                                            <option value="amount">Fixed discount</option>
                                            <option value="percent">Percent discount</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" name="rules[1][discountValue]"/></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select type="text" class="form-control" name="rules[2][type]">
                                            <option value="single">Single / First</option>
                                            <option value="and">And</option>
                                            <option value="or">Or</option>
                                            <option value="add">Add to following</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[2][trigger]">
                                            <option value="count">Items count</option>
                                            <option value="summ">Cart total</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[2][triggerCondition]">
                                            <option value="equal">Equal to</option>
                                            <option value="greater">Greater than</option>
                                            <option value="less">Less than</option>
                                            <option value="greaterEq">Greater or equal than</option>
                                            <option value="lessEq">Less or equal than</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" name="rules[2][triggerValue]"/></td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[2][discount]">
                                            <option value="amount">Fixed discount</option>
                                            <option value="percent">Percent discount</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" name="rules[2][discountValue]"/></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select type="text" class="form-control" name="rules[3][type]">
                                            <option value="single">Single / First</option>
                                            <option value="and">And</option>
                                            <option value="or">Or</option>
                                            <option value="add">Add to following</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[3][trigger]">
                                            <option value="count">Items count</option>
                                            <option value="summ">Cart total</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[3][triggerCondition]">
                                            <option value="equal">Equal to</option>
                                            <option value="greater">Greater than</option>
                                            <option value="less">Less than</option>
                                            <option value="greaterEq">Greater or equal than</option>
                                            <option value="lessEq">Less or equal than</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" name="rules[3][triggerValue]"/></td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[3][discount]">
                                            <option value="amount">Fixed discount</option>
                                            <option value="percent">Percent discount</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" name="rules[3][discountValue]"/></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select type="text" class="form-control" name="rules[4][type]">
                                            <option value="single">Single / First</option>
                                            <option value="and">And</option>
                                            <option value="or">Or</option>
                                            <option value="add">Add to following</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[4][trigger]">
                                            <option value="count">Items count</option>
                                            <option value="summ">Cart total</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[4][triggerCondition]">
                                            <option value="equal">Equal to</option>
                                            <option value="greater">Greater than</option>
                                            <option value="less">Less than</option>
                                            <option value="greaterEq">Greater or equal than</option>
                                            <option value="lessEq">Less or equal than</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" name="rules[4][triggerValue]"/></td>
                                    <td>
                                        <select type="text" class="form-control" name="rules[4][discount]">
                                            <option value="amount">Fixed discount</option>
                                            <option value="percent">Percent discount</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" name="rules[4][discountValue]"/></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-primary">Add coupon</button>
                </form>
            </div>
        </div>
    </div>
@endsection
