<div class="modal-header">
 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  <h4 class="modal-title">{{$case->name}}</h4>
</div>
	
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="toggle toggle-transparent-body" style="margin: 10px auto 30px;">
                <div class="toggle">
                    <label class="accordeon__label">
                        <div class="case__img case-condition"></div>
                        <span class="accordeon__stage">Описание ситуации/Условие</span>
                    </label>
                    <div class="toggle-content">
                        {!! $case->conditions !!}
                    </div>
                </div>
                <div class="toggle">
                    <label class="accordeon__label">
                        <div class="case__img case-details"></div>
                        <span class="accordeon__stage">Детальное описание</span>
                    </label>
                    <div class="toggle-content">
                        {!! $case->description !!}
                    </div>
                </div>
                <div class="toggle">
                    <label class="accordeon__label">
                        <div class="case__img case-task"></div>
                        <span class="accordeon__stage">Задания</span>
                    </label>
                    <div class="toggle-content">
                        <div class="list-group">
                            @foreach ($case->tasks as $task)
                            <li class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex justify-content-between w-100">
                            <h5 class="mb-1">Задание №{{$task->sort}}</h5>
                            </div>
                            {!! $task->task !!}
                            </li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    _toggle();
</script>