@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<style type="text/css">
td {
    text-transform: capitalize;
}

.card-counter{
    margin: 5px;
    padding: 20px 20px;
    background-color: #fff;
    height: 120px;
    border-radius: 5px;
    transition: .3s linear all;
    box-shadow: 0 6px 7px -3px rgba(0,0,0,.2),0 10px 15px 2px rgba(0,0,0,.14),0 4px 20px 3px rgba(0,0,0,.12)!important;
  }

  .card-counter:hover{
    transition: .3s linear all;
    box-shadow: 0 11px 15px -7px rgba(0,0,0,.25),0 24px 38px 3px rgba(0,0,0,.24),0 9px 46px 8px rgba(0,0,0,.22)!important;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }  

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter.secondary{
    background-color: #FFF;
    color: #000;
  }  

  .card-counter i{
    font-size: 5.5em;
    opacity: 0.5;
    color: #000;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 30px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    font-weight: 500;
    text-transform: capitalize;
    opacity: 0.5;
    display: block;
    font-size: 20px;
  }
</style>
<div id="app">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('strings.backend.dashboard.welcome') {{ $logged_in_user->name }}!</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <counter-card></counter-card>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-transparent">
                    <div class="card-header">
                        <strong>Раст на профит</strong>
                    </div><!--card-header-->
                    <div class="card-body-transparent">
                        <growth-chart></growth-chart>
                    </div><!--card-body-transparent-->
                </div><!--card-->
            </div>
            <div class="col-md-6">
                <div class="card-transparent">
                    <div class="card-header">
                        <strong>Родова статистика</strong>
                    </div><!--card-header-->
                    <div class="card-body-transparent">
                        <doughnut-chart></doughnut-chart>
                    </div><!--card-body-transparent-->
                </div><!--card-->
            </div>
            <div class="col-md-6">
                <div class="card-transparent">
                    <div class="card-header">
                        <strong>Пресметка по Категории</strong>
                    </div><!--card-header-->
                    <div class="card-body-transparent">
                        <line-chart></line-chart>
                    </div><!--card-body-transparent-->
                </div><!--card-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card-transparent">
                    <div class="card-header">
                        <strong>Статистика по возраст</strong>
                    </div><!--card-header-->
                    <div class="card-body-transparent">
                        <bar-chart></bar-chart>
                    </div><!--card-body-transparent-->
                </div><!--card-->
            </div>
            <div class="col-md-6">
                <div class="card-transparent">
                    <div class="card-header">
                        <strong>Статистика по градови</strong>
                    </div><!--card-header-->
                    <div class="card-body-transparent">
                        <pie-chart></pie-chart>
                    </div><!--card-body-transparent-->
                </div><!--card-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card-transparent">
                    <div class="card-header">
                        <strong>Топ 5 Играчи (Уплата)</strong>
                    </div><!--card-header-->
                    <div class="card-body-transparent">
                        <top-ten></top-ten>
                    </div><!--card-body-transparent-->
                </div><!--card-->
            </div>
            <div class="col-md-6">
                <div class="card-transparent">
                    <div class="card-header">
                        <strong>Топ 5 Играчи (Исплата)</strong>
                    </div><!--card-header-->
                    <div class="card-body-transparent">
                        <top-ten-win></top-ten-win>
                    </div><!--card-body-transparent-->
                </div><!--card-->
            </div>
        </div>
    </div>
</div>
    <!-- <div id="particles-js"></div> -->

@endsection
