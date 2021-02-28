@extends('layouts.dark')
@section('title')
    Kullanıcı Paneli
@endsection
@section('content')
    <div class="row mb-4">
        <div class="col-12 col-sm-12">
            <div class="row">

                <div class="col-12 col-md-12 mb-4">
                    <div class="card redial-border-light redial-shadow">
                        <div class="card-body">
                            <h6 class="header-title pl-3 redial-relative">Products</h6>
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Added</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>0001</td>
                                    <td>Product 1</td>
                                    <td>Description for Product</td>
                                    <td>$ 12.20</td>
                                    <td>233</td>
                                    <td><span class="badge badge-primary text-white">Stock</span></td>
                                    <td>04/10/2017</td>
                                </tr>
                                <tr>
                                    <td>0002</td>
                                    <td>Product 2</td>
                                    <td>Description for Product</td>
                                    <td>$ 13.20</td>
                                    <td>245</td>
                                    <td><span class="badge badge-primary text-white">Stock</span></td>
                                    <td>04/10/2017</td>
                                </tr>
                                <tr>
                                    <td>0003</td>
                                    <td>Product 3</td>
                                    <td>Description for Product</td>
                                    <td>$ 14.20</td>
                                    <td>210</td>
                                    <td><span class="badge badge-danger text-white">Removed</span></td>
                                    <td>04/10/2017</td>
                                </tr>
                                <tr>
                                    <td>0004</td>
                                    <td>Product 4</td>
                                    <td>Description for Product</td>
                                    <td>$ 17.20</td>
                                    <td>310</td>
                                    <td><span class="badge badge-warning text-white">Out of Stock</span></td>
                                    <td>04/10/2017</td>
                                </tr>
                                <tr>
                                    <td>0005</td>
                                    <td>Product 5</td>
                                    <td>Description for Product</td>
                                    <td>$ 11.20</td>
                                    <td>110</td>
                                    <td><span class="badge badge-danger text-white">Removed</span></td>
                                    <td>04/10/2017</td>
                                </tr>
                                <tr>
                                    <td>0006</td>
                                    <td>Product 6</td>
                                    <td>Description for Product</td>
                                    <td>$ 14.80</td>
                                    <td>220</td>
                                    <td><span class="badge badge-primary text-white">Stock</span></td>
                                    <td>04/10/2017</td>
                                </tr>
                                <tr>
                                    <td>0007</td>
                                    <td>Product 7</td>
                                    <td>Description for Product</td>
                                    <td>$ 17.50</td>
                                    <td>200</td>
                                    <td><span class="badge badge-danger text-white">Removed</span></td>
                                    <td>04/10/2017</td>
                                </tr>
                                <tr>
                                    <td>0008</td>
                                    <td>Product 8</td>
                                    <td>Description for Product</td>
                                    <td>$ 14.50</td>
                                    <td>109</td>
                                    <td><span class="badge badge-warning text-white">Out of Stock</span></td>
                                    <td>04/10/2017</td>
                                </tr>
                                <tr>
                                    <td>0009</td>
                                    <td>Product 9</td>
                                    <td>Description for Product</td>
                                    <td>$ 16.50</td>
                                    <td>185</td>
                                    <td><span class="badge badge-danger text-white">Removed</span></td>
                                    <td>04/10/2017</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>
@endsection
@section('js')

@endsection
