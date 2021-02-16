@extends('layouts.app')

@section('content')
<div style="min-height: calc(100vh - 168px);">
    <section class="page-header dark page-header-xs">
        <div class="container">
            <div class="session__header">
                <img class="session__img" src="/images/session-vnutr.png" alt="">
                <h1 class="session__title">Рекомендованные кейсы</h1>
            </div>
            <p>кейсы по вопросам охраны труда и безопасности производственных процессов, рекомендованные для изучения</p>

            <!-- page tabs -->
            <!-- <ul class="page-header-tabs list-inline">
                <li class="active"><a href="">Тяжелые травмы</a></li>
                <li><a href="">Легкие травмы</a></li>
                <li><a href="">Прочее</a></li>
            </ul> -->
            <!-- /page tabs -->
        </div>
    </section>
    <div class="container" style="margin-top: 30px;">
        @foreach ($cases as $case)
        <ul class="kn-material__container">
            <li class="kn-material__item">
                <img class="kn-material__item-img" src="/images/kn-base-keys.png" alt="">
                <div class="kn-material__info">
                    <h3 class="kn-material__item-name">{{$case->name}}</h3>
                    <span class="kn-material__item-category">{!!$case->conditions!!}</span>
                    <ul class="kn-material__tags-container">
                        <li class="kn-material__tag">{{$case->categories}}</li>
                    </ul>
                </div>
                <button type="button" data-remote="/recommended_cases/{{$case->id}}"  data-toggle="modal"  data-target="#caseModal" class="kn-material__button">Подробнее</button>                
            </li>
        </ul>
        @endforeach
    </div>

   
</div>

<div id="caseModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Просмотр кейса</h4>
			</div>

			<!-- Modal Body -->
			<div class="modal-body">
				
			</div>

			<!-- Modal Footer -->

		</div>
	</div>
</div>
@endsection


@section('scripts')
<script>
$('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-content').load($(this).data("remote"));
    });
</script>
@endsection