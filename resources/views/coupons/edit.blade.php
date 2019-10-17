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
            <h1 class="display-3">Edit coupon: <b>{{$coupon->title}}</b></h1>
            <div>
                <form method="post" action="{{ route('coupons.store', $coupon->uuid) }}">
                    @csrf
                    <input type="hidden" value="{{$coupon->title}}"/>
                    <div class="form-group">
                        <label for="title"><h5>Coupon description:</h5></label>
                        <textarea class="form-control" name="description" cols="20"
                                  rows="6">{{$coupon->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <h5>Coupon discount scheme<sup class="color-red">*</sup>:</h5>
                        <table style="width: 100%">
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
                                    <select class="form-control" name="discount[0][type]">
                                        <option value="amount"
                                                @if ($coupon->discounts[0]['type'] === 'amount') selected="selected" @endif>Fixed
                                            amount
                                        </option>
                                        <option value="percent"
                                                @if ($coupon->discounts[0]['type'] === 'percent') selected="selected" @endif>
                                            Percent of total
                                        </option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="discount[0][value]"
                                           value="{{$coupon->discounts[0]['value']}}"/></td>
                                <td>
                                    <input type="hidden" name="discount[0][condition]" value="basic">
                                    <span>Basic discount</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control" name="discount[1][type]">
                                        <option value="amount"
                                                @if (isset($coupon->discounts[1]['type']) && $coupon->discounts[1]['type'] === 'amount') selected="selected" @endif>Fixed
                                            amount
                                        </option>
                                        <option value="percent"
                                                @if (isset($coupon->discounts[1]['type']) && $coupon->discounts[1]['type'] === 'percent') selected="selected" @endif>
                                            Percent of total
                                        </option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="discount[1][value]"
                                           value="@if (isset($coupon->discounts[1]['value']) ) {{$coupon->discounts[1]['value']}}@endif"/></td>
                                <td>
                                    <select class="form-control" name="discount[1][condition]">
                                        <option value="greater"
                                                @if (isset($coupon->discounts[1]['condition']) && $coupon->discounts[1]['condition'] === 'greater') selected="selected" @endif>
                                            If greater than basic
                                        </option>
                                        <option value="extra"
                                                @if (isset($coupon->discounts[1]['condition']) && $coupon->discounts[1]['condition'] === 'extra') selected="selected" @endif>Add
                                            to basic
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control" name="discount[2][type]">
                                        <option value="amount"
                                                @if (isset($coupon->discounts[2]['type']) && $coupon->discounts[2]['type'] === 'amount') selected="selected" @endif>Fixed
                                            amount
                                        </option>
                                        <option value="percent"
                                                @if (isset($coupon->discounts[2]['type']) && $coupon->discounts[2]['type'] === 'percent') selected="selected" @endif>
                                            Percent of total
                                        </option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="discount[2][value]"
                                           value="@if (isset($coupon->discounts[2]['value']) ) {{$coupon->discounts[2]['value']}}@endif"/></td>
                                <td>
                                    <select class="form-control" name="discount[2][condition]">
                                        <option value="greater"
                                                @if (isset($coupon->discounts[2]['condition']) && $coupon->discounts[2]['condition'] === 'greater') selected="selected" @endif>
                                            If greater than basic
                                        </option>
                                        <option value="extra"
                                                @if (isset($coupon->discounts[2]['condition']) && $coupon->discounts[2]['condition'] === 'extra') selected="selected" @endif>Add
                                            to basic
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="alert alert-light"><span class="color-red">*</span> - Hint: At least on row should be filled. Only discounts with non zero amounts will be stored.</div>
                    </div>
                    <div class="form-group">
                        <h5>Coupon rules<sup class="color-red">*</sup>:</h5>
                        <table style="width: 100%">
                            <thead>
                            <tr>
                                <th>Rule</th>
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
                                    <select class="form-control" name="rules[0][trigger]">
                                        <option value="amount"
                                                @if (isset($coupon->rules[0]['trigger']) && $coupon->rules[0]['trigger'] === 'amount') selected="selected" @endif>Items amount</option>
                                        <option value="total"
                                                @if (isset($coupon->rules[0]['trigger']) && $coupon->rules[0]['trigger'] === 'total') selected="selected" @endif>Cart total</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="rules[0][triggerCondition]">
                                        <option value="equal"
                                                @if (isset($coupon->rules[0]['triggerCondition']) && $coupon->rules[0]['triggerCondition'] === 'equal') selected="selected" @endif>Equal to</option>
                                        <option value="greater"
                                                @if (isset($coupon->rules[0]['triggerCondition']) && $coupon->rules[0]['triggerCondition'] === 'greater') selected="selected" @endif>Greater than</option>
                                        <option value="less"
                                                @if (isset($coupon->rules[0]['triggerCondition']) && $coupon->rules[0]['triggerCondition'] === 'less') selected="selected" @endif>Less than</option>
                                        <option value="greaterEq"
                                                @if (isset($coupon->rules[0]['triggerCondition']) && $coupon->rules[0]['triggerCondition'] === 'greaterEq') selected="selected" @endif>Greater or equal than</option>
                                        <option value="lessEq"
                                                @if (isset($coupon->rules[0]['triggerCondition']) && $coupon->rules[0]['triggerCondition'] === 'lessEq') selected="selected" @endif>Less or equal than</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="rules[0][triggerValue]"
                                           value="@if (isset($coupon->rules[0]['triggerValue']) ) {{$coupon->rules[0]['triggerValue']}}@endif"/></td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control" name="rules[1][type]">
                                        <option value="and"
                                                @if (isset($coupon->rules[1]['type']) && $coupon->rules[1]['type'] === 'and') selected="selected" @endif>And</option>
                                        <option value="or"
                                                @if (isset($coupon->rules[1]['type']) && $coupon->rules[1]['type'] === 'or') selected="selected" @endif>Or</option>

                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="rules[1][trigger]">
                                        <option value="amount"
                                                @if (isset($coupon->rules[1]['trigger']) && $coupon->rules[1]['trigger'] === 'amount') selected="selected" @endif>Items amount</option>
                                        <option value="total"
                                                @if (isset($coupon->rules[1]['trigger']) && $coupon->rules[1]['trigger'] === 'total') selected="selected" @endif>Cart total</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="rules[1][triggerCondition]">
                                        <option value="equal"
                                                @if (isset($coupon->rules[1]['triggerCondition']) && $coupon->rules[1]['triggerCondition'] === 'equal') selected="selected" @endif>Equal to</option>
                                        <option value="greater"
                                                @if (isset($coupon->rules[1]['triggerCondition']) && $coupon->rules[1]['triggerCondition'] === 'greater') selected="selected" @endif>Greater than</option>
                                        <option value="less"
                                                @if (isset($coupon->rules[1]['triggerCondition']) && $coupon->rules[1]['triggerCondition'] === 'less') selected="selected" @endif>Less than</option>
                                        <option value="greaterEq"
                                                @if (isset($coupon->rules[1]['triggerCondition']) && $coupon->rules[1]['triggerCondition'] === 'greaterEq') selected="selected" @endif>Greater or equal than</option>
                                        <option value="lessEq"
                                                @if (isset($coupon->rules[1]['triggerCondition']) && $coupon->rules[1]['triggerCondition'] === 'lessEq') selected="selected" @endif>Less or equal than</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="rules[1][triggerValue]"
                                           value="@if (isset($coupon->rules[1]['triggerValue']) ) {{$coupon->rules[1]['triggerValue']}}@endif"/></td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control" name="rules[2][type]">
                                        <option value="and"
                                                @if (isset($coupon->rules[2]['type']) && $coupon->rules[2]['type'] === 'and') selected="selected" @endif>And</option>
                                        <option value="or"
                                                @if (isset($coupon->rules[2]['type']) && $coupon->rules[2]['type'] === 'or') selected="selected" @endif>Or</option>

                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="rules[2][trigger]">
                                        <option value="amount"
                                                @if (isset($coupon->rules[2]['trigger']) && $coupon->rules[2]['trigger'] === 'amount') selected="selected" @endif>Items amount</option>
                                        <option value="total"
                                                @if (isset($coupon->rules[2]['trigger']) && $coupon->rules[2]['trigger'] === 'total') selected="selected" @endif>Cart total</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="rules[2][triggerCondition]">
                                        <option value="equal"
                                                @if (isset($coupon->rules[2]['triggerCondition']) && $coupon->rules[2]['triggerCondition'] === 'equal') selected="selected" @endif>Equal to</option>
                                        <option value="greater"
                                                @if (isset($coupon->rules[2]['triggerCondition']) && $coupon->rules[2]['triggerCondition'] === 'greater') selected="selected" @endif>Greater than</option>
                                        <option value="less"
                                                @if (isset($coupon->rules[2]['triggerCondition']) && $coupon->rules[2]['triggerCondition'] === 'less') selected="selected" @endif>Less than</option>
                                        <option value="greaterEq"
                                                @if (isset($coupon->rules[2]['triggerCondition']) && $coupon->rules[2]['triggerCondition'] === 'greaterEq') selected="selected" @endif>Greater or equal than</option>
                                        <option value="lessEq"
                                                @if (isset($coupon->rules[2]['triggerCondition']) && $coupon->rules[2]['triggerCondition'] === 'lessEq') selected="selected" @endif>Less or equal than</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="rules[2][triggerValue]"
                                           value="@if (isset($coupon->rules[2]['triggerValue']) ) {{$coupon->rules[2]['triggerValue']}}@endif"/></td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control" name="rules[3][type]">
                                        <option value="and"
                                                @if (isset($coupon->rules[3]['type']) && $coupon->rules[3]['type'] === 'and') selected="selected" @endif>And</option>
                                        <option value="or"
                                                @if (isset($coupon->rules[3]['type']) && $coupon->rules[3]['type'] === 'or') selected="selected" @endif>Or</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="rules[3][trigger]">
                                        <option value="amount"
                                                @if (isset($coupon->rules[3]['trigger']) && $coupon->rules[3]['trigger'] === 'amount') selected="selected" @endif>Items amount</option>
                                        <option value="total"
                                                @if (isset($coupon->rules[3]['trigger']) && $coupon->rules[3]['trigger'] === 'total') selected="selected" @endif>Cart total</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="rules[3][triggerCondition]">
                                        <option value="equal"
                                                @if (isset($coupon->rules[3]['triggerCondition']) && $coupon->rules[3]['triggerCondition'] === 'equal') selected="selected" @endif>Equal to</option>
                                        <option value="greater"
                                                @if (isset($coupon->rules[3]['triggerCondition']) && $coupon->rules[3]['triggerCondition'] === 'greater') selected="selected" @endif>Greater than</option>
                                        <option value="less"
                                                @if (isset($coupon->rules[3]['triggerCondition']) && $coupon->rules[3]['triggerCondition'] === 'less') selected="selected" @endif>Less than</option>
                                        <option value="greaterEq"
                                                @if (isset($coupon->rules[3]['triggerCondition']) && $coupon->rules[3]['triggerCondition'] === 'greaterEq') selected="selected" @endif>Greater or equal than</option>
                                        <option value="lessEq"
                                                @if (isset($coupon->rules[3]['triggerCondition']) && $coupon->rules[3]['triggerCondition'] === 'lessEq') selected="selected" @endif>Less or equal than</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="rules[3][triggerValue]"
                                           value="@if (isset($coupon->rules[3]['triggerValue']) ) {{$coupon->rules[3]['triggerValue']}}@endif"/></td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control" name="rules[4][type]">
                                        <option value="and"
                                                @if (isset($coupon->rules[4]['type']) && $coupon->rules[4]['type'] === 'and') selected="selected" @endif>And</option>
                                        <option value="or"
                                                @if (isset($coupon->rules[4]['type']) && $coupon->rules[4]['type'] === 'or') selected="selected" @endif>Or</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="rules[4][trigger]">
                                        <option value="amount"
                                                @if (isset($coupon->rules[4]['trigger']) && $coupon->rules[4]['trigger'] === 'amount') selected="selected" @endif>Items amount</option>
                                        <option value="total"
                                                @if (isset($coupon->rules[4]['trigger']) && $coupon->rules[4]['trigger'] === 'total') selected="selected" @endif>Cart total</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="rules[4][triggerCondition]">
                                        <option value="equal"
                                                @if (isset($coupon->rules[4]['triggerCondition']) && $coupon->rules[4]['triggerCondition'] === 'equal') selected="selected" @endif>Equal to</option>
                                        <option value="greater"
                                                @if (isset($coupon->rules[4]['triggerCondition']) && $coupon->rules[4]['triggerCondition'] === 'greater') selected="selected" @endif>Greater than</option>
                                        <option value="less"
                                                @if (isset($coupon->rules[4]['triggerCondition']) && $coupon->rules[4]['triggerCondition'] === 'less') selected="selected" @endif>Less than</option>
                                        <option value="greaterEq"
                                                @if (isset($coupon->rules[4]['triggerCondition']) && $coupon->rules[4]['triggerCondition'] === 'greaterEq') selected="selected" @endif>Greater or equal than</option>
                                        <option value="lessEq"
                                                @if (isset($coupon->rules[4]['triggerCondition']) && $coupon->rules[4]['triggerCondition'] === 'lessEq') selected="selected" @endif>Less or equal than</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="rules[4][triggerValue]"
                                           value="@if (isset($coupon->rules[4]['triggerValue']) ) {{$coupon->rules[4]['triggerValue']}}@endif"/></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="alert alert-light"><span class="color-red">*</span> - Hint: At least on row should be filled. Only rules with non zero trigger values be stored.</div>

                    </div>

                    <button type="submit" class="btn btn-success">Update coupon</button>
                    <a href="/coupons" class="btn btn-secondary">Cancel</a>

                </form>
            </div>
        </div>
    </div>
@endsection
