<div class="modal-header">
 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  <h4 class="modal-title">Редактирование вопроса анкеты</h4>
</div>
	<form method="POST" action="/adm/surveys/{{$survey->id}}/update_question/{{$question->id}}">
	@csrf
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Текст вопроса:</label>
					<input type="text" value="{{$question->body}}" class="form-control" name="body" placeholder="" required />
				</div>

			</div>
		</div>
	</div>
    <div class="modal-footer">
      <a href="#" data-dismiss="modal" class="btn">Отмена</a>
      <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form> 