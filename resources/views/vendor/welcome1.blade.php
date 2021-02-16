@extends('layouts.app')

@section('content')

<section id="home" class="height-450" style="background:url('{{ asset('images/wall2.jpg') }}')">
    <div class="display-table">
        <div class="display-table-cell vertical-align-middle">
            
            <div class="container text-center">
                
                <h1 class="nomargin size-50 weight-300 wow fadeInUp" data-wow-delay="0.4s">�������������-��������������� ����� </h1>
                <p class="lead font-lato size-30 wow fadeInUp" data-wow-delay="0.7s"> ��� ���������� ��������� ������ ���������������� ������ �� ������ ����� ��� ������������� �������� ����� ��� ���Ļ</p>
                <p>��� ������� � �������, ����������, ����������������� ��������������</p>
                <div class="margin-top-30">

                    <a href="/register" class="btn btn-3d btn-lg btn-red"><i class="glyphicon glyphicon-th-large"></i>�����������</a>
                    <span class="size-17 hidden-xs">&nbsp; &nbsp; &nbsp;</span>
                    <a href="/login" class="btn btn-3d btn-lg btn-teal"><i class="glyphicon glyphicon-user"></i>&nbsp; &nbsp; &nbsp;����&nbsp; &nbsp; &nbsp; &nbsp;</a>
                </div>

            </div>

        </div>
    </div>
</section>


<!-- FEATURES -->
<section id="features" class="pt-20">
    <div class="container">

        <header class="text-center margin-bottom-60">
            <h2>���������������� �������</h2>
            <p class="lead font-lato">�������� � ������ ��������� � ������� ������ �����</p>
            <hr />
        </header>

        <!-- FEATURED BOXES 3 -->
        <div class="row">
            <div class="col-md-3 col-xs-6">
                <div class="text-center">
                    <i class="ico-light ico-lg ico-rounded ico-hover et-circle-compass"></i>
                    <h4>��������� ������</h4>
                    <!--   <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>-->
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="text-center">
                    <i class="ico-light ico-lg ico-rounded ico-hover et-piechart"></i>
                    <h4>������������</h4>
                    <!--   <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>-->
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="text-center">
                    <i class="ico-light ico-lg ico-rounded ico-hover et-strategy"></i>
                    <h4>�������������</h4>
                    <!--    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus.</p>-->
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="text-center">
                    <i class="ico-light ico-lg ico-rounded ico-hover fa fa-video-camera"></i>
                    <h4>��������</h4>
                    <!--   <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus. </p>-->
                </div>
            </div>
        </div>
        <!-- /FEATURED BOXES 3 -->

        

    </div>
</section>
<!-- /FEATURES -->



@endsection
