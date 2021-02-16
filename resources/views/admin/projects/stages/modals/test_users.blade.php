<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">X</button>
  <h4>Результат теста: {{$ta->user->name}}</h4>
</div>
<div class="modal-body">

      <div class="col-md-12">
      <h3>Тест: {{$ta->test->name}}</h3>
      <table class="table table-striped">
        <tr><td><strong>ID попытки:</strong></td><td> {{$ta->id}}</td></tr>
        <tr><td><strong>Тест начат:</strong></td><td> {{$ta->created_at}}</td></tr>
        <tr><td><strong>Завершен:</strong></td><td>{{$ta->updated_at}}</td></tr>
        <tr><td><strong>Результат:</strong></td><td>{{$ta->result == 1 ? "Пройден" : "Не пройден"}} ({{$ta->score}} / {{$ta->test->questions->count()}})</td></tr>
      </table>
      <hr>
      @php $n = 1; @endphp
      @foreach($ta->test->questions as $question)
      <div class="row">
        <div class="col-md-2 alert  alert-default margin-bottom-30" id="q{{$n}}">
          <p><strong>Вопрос № {{$n}}</strong></p>
          <p>{{$question->is_right($ta->id) == true ? "Верно" : "Неверно" }}</p>
        </div>
        
        <div class="col-md-9 alert alert-info alert-mini text-dark ml-0"><strong>{{$question->name}}</strong>
        <div style="padding-left: 20px">
        @if ($question->type_id == 1)
          <p class="mb-1">Выберите один  ответ:</p>
          @foreach ($question->answers as $answer)
            @php $cl = ""; @endphp
            @if ( ($answer->is_chosen($ta->id) == 1) && ($answer->right == 1) )
              @php $cl = "bg-success"; @endphp
            @endif
            @if ( ($answer->is_chosen($ta->id) == 1) && ($answer->right == 0) )
              @php $cl = "bg-danger"; @endphp
            @endif
            <div class="{{$cl}}">
            <label class="radio mb-0">
              <input type="radio" disabled name="questions[{{$question->id}}]" value="{{$answer->id}}" {{$answer->is_chosen($ta->id) == true ? "checked" : "" }} > <i></i> {{$answer->name}} 
              
            </label>
            </div>
          @endforeach
        @endif
        @if ($question->type_id == 2)
          <p class="mb-1">Выберите один или несколько ответов:</p>
          @foreach ($question->answers as $answer)
            @php $cl = ""; @endphp
            @if ( ($answer->is_chosen($ta->id) == 1) && ($answer->right == 1) )
              @php $cl = "bg-success"; @endphp
            @endif
            @if ( ($answer->is_chosen($ta->id) == 1) && ($answer->right == 0) )
              @php $cl = "bg-danger"; @endphp
            @endif
            <div class="{{$cl}}">
            <label class="checkbox mb-0">
              <input type="checkbox" disabled name="questions[{{$question->id}}][]" value="{{$answer->id}}" {{$answer->is_chosen($ta->id) == true ? "checked" : "" }}> <i></i> {{$answer->name}} 
            </label>

            </div>
          @endforeach
        @endif

        </div>
        </div>
      </div>
      @php $n++; @endphp
      @endforeach
      </form>
    </div>


  <div class="modal-footer">
      <a href="#" data-dismiss="modal" class="btn btn-default">Отмена</a>
      <button  class="btn btn-primary">Экспорт</button>
  </div>
</div>