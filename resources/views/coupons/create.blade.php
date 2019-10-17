@extends('_layout')
@section('main')
    <div class="row">
        @if ($errors->any())
            <div class="col-sm-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <br/>
        @endif
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add a coupon</h1>
            <div>
                <form method="post" action="{{ route('coupons.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">Coupon title:</label>
                        <input type="text" class="form-control" name="title"/>
                    </div>
                    <div class="form-group">
                        <h5>Coupon discount scheme</h5>
                        <table>
                            <thead>
                            <tr>
                                <th>Discount type</th>
                                <th>Discount Value</th>
                                <th>Discount Condition</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <select type="text" class="form-control" name="discount[0][type]">
                                        <option value="amount">Fixed amount</option>
                                        <option value="percent">Percent of total</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="discount[0][value]"/></td>
                                <td>
                                    <input type="hidden" name="discount[0][condition]" value="basic">
                                    <span>Basic discount</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select type="text" class="form-control" name="discount[1][type]">
                                        <option value="amount">Fixed amount</option>
                                        <option value="percent">Percent of total</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="discount[1][value]"/></td>
                                <td>
                                    <select type="text" class="form-control" name="discount[1][condition]">
                                        <option value="greater">If greater than basic</option>
                                        <option value="extra">Add to basic</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select type="text" class="form-control" name="discount[2][type]">
                                        <option value="amount">Fixed amount</option>
                                        <option value="percent">Percent of total</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="discount[2][value]"/></td>
                                <td>
                                    <select type="text" class="form-control" name="discount[2][condition]">
                                        <option value="greater">If greater than basic</option>
                                        <option value="extra">Add to basic</option>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
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
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="hidden" name="rules[0][type]" value="single">
                                        <span>Single / First</span>
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
                                </tr>
                                <tr>
                                    <td>
                                        <select type="text" class="form-control" name="rules[1][type]">
                                            <option value="and">And</option>
                                            <option value="or">Or</option>
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
                                </tr>
                                <tr>
                                    <td>
                                        <select type="text" class="form-control" name="rules[2][type]">
                                            <option value="and">And</option>
                                            <option value="or">Or</option>
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
                                </tr>
                                <tr>
                                    <td>
                                        <select type="text" class="form-control" name="rules[3][type]">
                                            <option value="and">And</option>
                                            <option value="or">Or</option>
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
                                </tr>
                                <tr>
                                    <td>
                                        <select type="text" class="form-control" name="rules[4][type]">
                                            <option value="and">And</option>
                                            <option value="or">Or</option>
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
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-success">Add coupon</button>
                    <a href="/coupons" class="btn btn-secondary">Cancel</a>

                </form>
            </div>
        </div>
    </div>
@endsection
