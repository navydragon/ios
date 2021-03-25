@extends('layouts.layout-1')

@section('breadcrumb')
	<li>Управление</li>
@endsection

@section('header')
	Управление
@endsection


@section('content')

    <!-- Counters -->
<div class="row">
    <div class="col-sm-6 col-xl-3">

        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img class="result__img" src="/images/result-1.png" alt="" style="width: 50px; height: 50px;">
                    <div class="ml-3">
                        <div class="text-muted small">Проведено оценочных сессий</div>
                        <div class="text-large">{{$projects->count()}}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-6 col-xl-3">

        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img class="result__img" src="/images/result-2.png" alt="" style="width: 50px; height: 50px;">
                    <div class="ml-3">
                        <div class="text-muted small">Проведено мероприятий</div>
                        <div class="text-large">{{$evs->count()}}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-6 col-xl-3">

        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img class="result__img" src="/images/result-4.png" alt="" style="width: 50px; height: 50px;">
                    <div class="ml-3">
                        <div class="text-muted small">Типов мероприятий в базе</div>
                        <div class="text-large">{{$types}}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-6 col-xl-3">

        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img class="result__img" src="/images/result-5.png" alt="" style="width: 50px; height: 50px;">
                    <div class="ml-3">
                        <div class="text-muted small">Пользователи системы</div>
                        <div class="text-large">{{$users->count()}}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- / Counters -->

<!-- <div class="card mb-4">
        <h6 class="card-header with-elements">
            <div class="card-header-title">Статистика использования</div>
            <div class="card-header-elements ml-auto">
                <label class="text m-0">
                    <span class="text-light text-tiny font-weight-semibold align-middle">
                        SHOW STATS
                    </span>
                    <span class="switcher switcher-sm d-inline-block align-middle mr-0 ml-2">
                        <input type="checkbox" class="switcher-input" checked>
                        <span class="switcher-indicator">
                            <span class="switcher-yes"></span>
                            <span class="switcher-no"></span>
                        </span>
                    </span>
                </label>
            </div>
        </h6>
        <div class="row no-gutters row-bordered">
            <div class="col-md-8 col-lg-12 col-xl-8">
                <div class="card-body">
                    <div style="height: 210px;">
                        <canvas id="statistics-chart-1"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-12 col-xl-4">
                <div class="card-body">

                    <div class="row">
                        <div class="col-6 col-xl-5 text-muted mb-3">Пройдено тестов</div>
                        <div class="col-6 col-xl-7 mb-3">
                            <span class="text-big">???</span>
                        </div>
                        <div class="col-6 col-xl-5 text-muted mb-3">Заполнено анкет</div>
                        <div class="col-6 col-xl-7 mb-3">
                            <span class="text-big">???</span>
                        </div>
                        <div class="col-6 col-xl-5 text-muted mb-3">Выполнено заданий</div>
                        <div class="col-6 col-xl-7 mb-3">
                            <span class="text-big">???</span>
                        </div>
                        <div class="col-6 col-xl-5 text-muted mb-3">Просмотрено материалов</div>
                        <div class="col-6 col-xl-7 mb-3">
                            <span class="text-big">???</span>
                        </div>
                        <div class="col-6 col-xl-5 text-muted mb-3">Участовало в вебинарах</div>
                        <div class="col-6 col-xl-7 mb-3">
                            <span class="text-big">???</span>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
</div> -->
    <!-- / Statistics -->

<div class="row">
	<div class="col-md-12">
			<div class="card mb-4">
				<div class="card-header">Календарь</div>
		        <div class="card-body">
		            <div id='fullcalendar-default-view'></div>
		        </div>
	    </div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-lg-12 col-xl-6">
	<!-- Сообщения на форумах -->
    <div class="card mb-4">
        <h6 class="card-header">Последние сообщения форума</h6>
        <div class="card-body">
        	@foreach ($messages as $message)
        		<div class="media pb-1 mb-3">
                <img src="{{ url('storage/avatars/'.$message->author->avatar) }}" class="d-block ui-w-40 rounded-circle" alt>
                <div class="media-body ml-3">
                    <a target="_blank" href="/adm/users/{{$message->author->id}}">{{$message->author->name}}</a>
                    <span class="text-muted">прокомментировал тему</span>
                    <a target="_blank" href="forums/{{$message->thread->forum->id}}/threads/{{$message->thread->id}}">{{$message->thread->name}}</a>
                    <p class="my-1">{!! $message->message !!}</p>
                    <div class="clearfix">
                        <span class="float-left text-muted small">
                        	{{\Carbon\Carbon::createFromTimeStamp(strtotime($message->created_at))->format('d.m.Y')}} 
                        	({{\Carbon\Carbon::createFromTimeStamp(strtotime($message->created_at))->diffForHumans()}})
                        </span>
                    </div>
                </div>
            </div>
        	@endforeach
            
           
        </div>
        <a target="_blank" href="/forums" class="card-footer text-body d-block text-center small font-weight-semibold">ПОДРОБНЕЕ</a>
    </div>
    <!-- / Сообщения на форумах  -->

	</div>
	<div class="col-md-6 col-lg-12 col-xl-6">

	    <!-- Support tickets -->
	    <div class="card mb-4">
	        <h6 class="card-header">Заявки</h6>
	        <div class="card-body">
	            <div>
	            	@foreach($tickets as $ticket)
	                <div class="badge {{$ticket->get_badge_class()}} float-right">{{$ticket->type->name}}</div>
	                <a href="/adm/tickets/{{$ticket->id}}">{{$ticket->name}}</a>&nbsp;
	                <span class="text-muted">#{{$ticket->id}}</span>
	                <br>
	                <small class="text-muted">Создал <a href="javascript:void(0)" class="text-body">{{$ticket->author->name}}</a> &nbsp;·&nbsp; {{\Carbon\Carbon::createFromTimeStamp(strtotime($ticket->created_at))->diffForHumans()}}</small>
	                @endforeach
	            </div>
	        </div>
	        <a href="/adm/tickets" class="card-footer text-body d-block text-center small font-weight-semibold">ПОДРОБНЕЕ</a>
	    </div>
	    <!-- / Support tickets -->

	</div>
</div>

<!-- Event modal -->
    <form class="modal modal-top fade" id="fullcalendar-default-view-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить мероприятие в каlендарь</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label form-label-lg">Название</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label form-label-lg">Тип</label>
                        <select class="custom-select">
                            <option value="" selected>Встреча</option>
                            <option value="fc-event-success">Вебинар</option>
                            <option value="fc-event-info">Обучение</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default md-btn-flat" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary md-btn-flat">Сохранить</button>
                </div>
            </div>
        </div>
    </form>
    <!-- / Event modal -->

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('/vendor/libs/fullcalendar/fullcalendar.css') }}">
@endsection

@section('scripts')

    <!-- Dependencies -->
    <script src="{{ asset('/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('/vendor/libs/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('/vendor/libs/fullcalendar/locale-all.js') }}"></script>
    <script src="{{ mix('/vendor/libs/chartjs/chartjs.js') }}"></script>

   <script type="text/javascript">
   	$(function () {
	  var today = new Date();
	  var y = today.getFullYear();
	  var m = today.getMonth();
	  var d = today.getDate();
	  var eventList = [
	  	@foreach($events as $event)
	    {
	        title : '{{$event["title"]}}',
	        start : '{{$event["start"]}}',
	        @if ($event["end"])
	                end: '{{ $event["end"] }}',
	        @endif
	    },
	    @endforeach
	  ]
	  // Default view
	  // color classes: [ fc-event-success | fc-event-info | fc-event-warning | fc-event-danger | fc-event-dark ]
	  var defaultCalendar = new Calendar($('#fullcalendar-default-view')[0], {
	    plugins: [
	      calendarPlugins.bootstrap,
	      calendarPlugins.dayGrid,
	      calendarPlugins.timeGrid,
	      calendarPlugins.interaction
	    ],
	    dir: $('html').attr('dir') || 'ltr',

	    // Bootstrap styling
	    themeSystem: 'bootstrap',
	    bootstrapFontAwesome: {
	      close: ' ion ion-md-close',
	      prev: ' ion ion-ios-arrow-back scaleX--1-rtl',
	      next: ' ion ion-ios-arrow-forward scaleX--1-rtl',
	      prevYear: ' ion ion-ios-arrow-dropleft-circle scaleX--1-rtl',
	      nextYear: ' ion ion-ios-arrow-dropright-circle scaleX--1-rtl'
	    },

	    header: {
	      left: 'title',
	      center: 'dayGridMonth,timeGridWeek,timeGridDay',
	      right: 'prev,next today'
	    },

	    defaultDate: today,
	    navLinks: false, // can click day/week names to navigate views
	    selectable: false,
	    weekNumbers: true, // Show week numbers
	    nowIndicator: true, // Show "now" indicator
	    firstDay: 1, // Set "Monday" as start of a week
	    businessHours: {
	      dow: [1, 2, 3, 4, 5], // Monday - Friday
	      start: '9:00',
	      end: '18:00',
	    },
	    editable: true,
	    eventLimit: true, // allow "more" link when too many events
	    events: eventList,
	    locale: "ru",
	    views: {
	      dayGrid: {
	        eventLimit: 5
	      }
	    },

	    select: function (selectionData) {
	      $('#fullcalendar-default-view-modal')
	        .on('shown.bs.modal', function() {
	          $(this).find('input[type="text"]').trigger('focus');
	        })
	        .on('hidden.bs.modal', function() {
	          $(this)
	            .off('shown.bs.modal hidden.bs.modal submit')
	            .find('input[type="text"], select').val('');
	          defaultCalendar.unselect();
	        })
	        .on('submit', function(e) {
	          e.preventDefault();
	          var title = $(this).find('input[type="text"]').val();
	          var className = $(this).find('select').val() || null;

	          if (title) {
	            var eventData = {
	              title: title,
	              start: selectionData.startStr,
	              end: selectionData.endStr,
	              className: className
	            }
	            defaultCalendar.addEvent(eventData);
	          }

	          $(this).modal('hide');
	        })
	        .modal('show');
	    },

	    eventClick: function(calEvent) {
	      //alert('Event: ' + calEvent.event.title);
	    }
	  });

	  defaultCalendar.render();
	});

	var chart1 = new Chart(document.getElementById('statistics-chart-1').getContext("2d"), {
    type: 'line',
    data: {
      labels: ['2018-10', '2018-11', '2018-12', '2019-01', '2019-02', '2019-03', '2019-04', '2019-05'],
      datasets: [{
        label: 'Входы',
        data: [93, 25, 95, 59, 46, 68, 4, 41],
        borderWidth: 1,
        backgroundColor: 'rgba(28,180,255,.05)',
        borderColor: 'rgba(28,180,255,1)'
      }, {
        label: 'Активности',
        data: [83, 1, 43, 28, 56, 82, 80, 66],
        borderWidth: 1,
        borderDash: [5, 5],
        backgroundColor: 'rgba(136, 151, 170, 0.1)',
        borderColor: '#8897aa'
      }],
    },
    options: {
      scales: {
        xAxes: [{
          gridLines: {
            display: false
          },
          ticks: {
            fontColor: '#aaa'
          }
        }],
        yAxes: [{
          gridLines: {
            display: false
          },
          ticks: {
            fontColor: '#aaa',
            stepSize: 20
          }
        }]
      },

      responsive: false,
      maintainAspectRatio: false
    }
  });
	 chart1.resize();
   </script>
@endsection