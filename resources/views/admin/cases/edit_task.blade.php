<div class="modal-header">
 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  <h4 class="modal-title">Редактирование задания</h4>
</div>
	<form method="POST" action="/adm/cases/{{$case->id}}/update_task/{{$task->id}}">
	@csrf
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Поставновка задачи:</label>
                    <textarea class="summernote form-control" name="task" cols="30" rows="10">
                        {!! $task->task !!}
                    </textarea>
				</div>

			</div>
		</div>
	</div>
    <div class="modal-footer">
      <a href="#" data-dismiss="modal" class="btn">Отмена</a>
      <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form> 

<script>
   $(document).ready(function() {
        $('.summernote').summernote({height: '250px'});
    });
</script>