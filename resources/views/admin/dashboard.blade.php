@extends('admin.layout.master')
@section('title', 'Dashboard')
@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>

                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-4" >
                                <div class="overview-item overview-item--c1" style="height: 200px;">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{ count($acc) }}</h2>
                                                <span>Total Account</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c2" style="height: 200px;">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{ count($order) }}</h2>
                                                <span>Order Total</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c4" style="height: 200px;">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix"> 
                                            <div class="icon">
                                                <i class="fa-solid fa-envelope"></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{ count($message) }}</h2>
                                                <span>Total message</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c4" style="height: 200px;">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix"> 
                                            <div class="icon">
                                                <i class="fa-solid fa-pizza-slice"></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{ count($product) }}</h2>
                                                <span>Total Product</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
@endsection